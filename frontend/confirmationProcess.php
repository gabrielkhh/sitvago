<?php
session_start();
require '../vendor/autoload.php';

use sitvago\Booking;
use Dotenv\Dotenv;
use sitvago\Hotel;
use sitvago\User;
use Mailgun\Mailgun;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$stripe = new \Stripe\StripeClient($_SERVER['stripe_secret_key']);

// Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$email = $_POST['email'];
$checkinDate = $_POST['ci_date'];
$checkoutDate = $_POST['co_date'];
$userID = $_SESSION['user_id'];
$hotelName = $_POST['hotel-name'];
$roomCategoryName = $_POST['room-type'];
$token = $_POST['stripeToken'];

/*
//Sanitize_inputs might be causing problem for stripe 
$first_name = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["fname"]);
$last_name = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["lname"]);
$email = sanitize_input($_POST["email"]);
$roomCategoryName = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["room-type"]);
$hotelName= preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["hotel-name"]); 
$checkinDate = preg_replace("([^0-9-])", "", $_POST['ci_date']);
$checkoutDate = preg_replace("([^0-9-])", "", $_POST['co_date']);
$userID = $_SESSION['user_id'];
$token = $_POST['stripeToken'];
*/

$checkinDateInUnix = strtotime($checkinDate);
$checkoutDateInUnix = strtotime($checkoutDate);

$bookingDurationInDays = ($checkoutDateInUnix - $checkinDateInUnix) / 86400;
$hotelObj = new Hotel();
$bookingRate = $hotelObj->getRoomCategoryRate($hotelName, $roomCategoryName);

$price = $bookingRate['rate'] * $bookingDurationInDays;

$check_in_date_SQL = date("Y-m-d H:i:s", $checkinDateInUnix);
$check_out_date_SQL = date("Y-m-d H:i:s", $checkoutDateInUnix);

//Create the new booking in SQL
$bookingObj = new Booking();

$bookingResults = $bookingObj->addBooking($userID, $hotelName, $roomCategoryName, $price, $check_in_date_SQL, $check_out_date_SQL);
//See if the user has made a booking before
$userObj = new User();
$userStripeCustID = $userObj->getStripeCustID($userID);
if ($userStripeCustID['stripe_customer_id'] == NULL) {
    //Create a customer in stripe
    $customer = $stripe->customers->create(array(
        "email" => $email,
        "source" => $token
    ));

    $saveStripeCustID = $customer['id'];

    //Save the customer ID in SQL
    $newUser = new User();
    $saveStripeCustomerIDInfo = $newUser->saveStripeCustID($userID, $saveStripeCustID);

    //Because amount variables don't have decimal in stripe.
    $priceForStripe = $price * 100;

    // Charge Customer
    $charge = $stripe->paymentIntents->create(array(
        "amount" => $priceForStripe,
        "currency" => "SGD",
        "description" => "Booking with " . $hotelName . " for a duration of " . $bookingDurationInDays . " days.",
        "receipt_email" => $email,
        "confirm" => true,
        "customer" => $customer->id
    ));

    $txID = $charge['id'];
    //Save the txID to the booking entry in SQL
    $newBookingID = $bookingResults['insertedID'];
    $newBookingObj = new Booking();
    $updatedBookingInfo = $newBookingObj->updateBookingWithStripeTxID($newBookingID, $txID);
} else {
    $customer = $stripe->customers->retrieve(
        $userStripeCustID['stripe_customer_id'],
        []
    );

    //Because amount variables don't have decimal in stripe.
    $priceForStripe = $price * 100;

    // Charge Customer
    $charge = $stripe->paymentIntents->create(array(
        "amount" => $priceForStripe,
        "currency" => "SGD",
        "description" => "Booking with " . $hotelName . " for a duration of " . $bookingDurationInDays . " days.",
        "receipt_email" => $email,
        "confirm" => true,
        "customer" => $customer->id
    ));

    $txID = $charge['id'];
    //Save the txID to the booking entry in SQL
    $newBookingID = $bookingResults['insertedID'];
    $newBookingObj = new Booking();
    $updatedBookingInfo = $newBookingObj->updateBookingWithStripeTxID($newBookingID, $txID);
}

$resultantData = array(
    "stripeTxID" => $txID,
    "duration" => $bookingDurationInDays,
    "price" => number_format((float)$price, 2, '.', ''),
    "email" => $email,
    "fname" => $first_name,
    "lname" => $last_name,
    "roomtype" => $roomCategoryName,
    "hotelname" => $hotelName
);

//Redirect to Success
$_SESSION['INFO'] = $resultantData;

$html  = file_get_contents('https://sitvago.com/email_template/bookingEmail.php'); // this will retrieve the html document

$html = str_replace("HOTELNAME", "$hotelName", $html);
$html = str_replace("FNAME", "$first_name", $html);
$html = str_replace("TXID", "$txID", $html);
$html = str_replace("PRICE", number_format((float)$price, 2, '.', ''), $html);


# Instantiate the client.
$mg = Mailgun::create($_SERVER['mailgun_api_key']);
// Now, compose and send your message.
// $mg->messages()->send($domain, $params);
$mg->messages()->send('mg.sitvago.com', [
    'from'    => 'Sitvago noreply@sitvago.com',
    'to'      => $email,
    'subject' => 'Your Booking Has Been Confirmed',
    'html'    => $html
]);

header("Location:bookingConfirmation.php");

