<?php
require '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$stripe = new \Stripe\StripeClient($_SERVER['stripe_secret_key']);

// Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['fname'];
$email = "somekindofemail@example.com";
$token = $POST['stripeToken'];

//Create a customer in stripe
$customer = $stripe->customers->create(array(
    "email" => $email,
    "source" => $token
));

// Charge Customer
$charge = $stripe->paymentIntents->create(array(
    "amount" => 5000,
    "currency" => "SGD",
    "description" => "Test description of payment",
    "receipt_email" => $email,
    "confirm" => true,
    "customer" => $customer->id
));


//Redirect to Success
print_r($charge);


?>