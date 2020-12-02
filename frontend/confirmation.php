<!DOCTYPE html>
<html lang="en">

<head>

    <title>Singapore Tourism Attraction </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Font and Icons CSS -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!--jQuery-->
    <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>

    <!-- Bootstrap -->
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous">
    </script>


    <!-- Script -->
    <script src="https://js.stripe.com/v3/"></script>
    <script defer src="js/confirmation.js"></script>
    </head>

<body>
    <main>
    <?php
    require '../vendor/autoload.php';

    session_start();

    if (!isset($_SESSION['username'])) {
        header("location: loginpage.php");
    }

    $userFName = $_SESSION['first_name'];
    $userLName = $_SESSION['last_name'];
    $userEmail = $_SESSION['email'];
    $userBillingAddress = $_SESSION['billing_address'];
    ?>
        
    <?php
    if (isset($_SESSION['username'])) {
        include "navbar_User.php";
    } else if (!isset($_SESSION['username'])) {
        include "navbar_nonUser.php";
    }
    //Get var necessary for price
    $roomType = $_POST['TypeOfRooms'];
    $checkIn = $_POST['checkin'];
    $checkOut = $_POST['checkout'];
    $origin = new DateTime($checkIn);
    $target = new DateTime($checkOut);
    //Difference between dates
    $days =  $origin ->diff($target)->format('%a');
    
    //Price of rooms
    $rate = $_POST['amountPN'];
    $price_before_round = $rate * $days;
    $price = "SGD$" . number_format((float)$price_before_round, 2, '.', '');
    $roomFee = 0;

    //Cal price based on type of room
    if ($roomType == "Deluxe"){
        $roomFee = $deluxe;
        $price = ($roomFee * $days);
    }
    if ($roomType == "Executive Suite"){
        $roomFee = $suite;
        $price = ($roomFee * $days);
    }
     if ($roomType == "Twin Room"){
        $roomFee = $twin;
        $price = ($roomFee * $days);
    }

    ?>


    <div class="row">
        <div class="col-75">
            <div class="container confirm-box">
                <form action="confirmationProcess.php" method="post" id="booking_form">
                    <link rel="stylesheet" href="css/confirmation.css">
                    <h1 class="book_confirm">Booking Confirmation</h1>
                    <div class="row">
                        <div role="input" class="col-50">
                            <label for="name"><i class="fa fa-user"></i> First Name</label>
                            <label for="fnameDisabled"><input class="confirm_input" type="text" id="fnameDisabled" name="fnameDisabled" placeholder="Auto-Fill" value="<?= $userFName ?>" disabled></label>
                            <label for="fname"><input class="confirm_input" type="text" id="fname" name="fname" placeholder="Auto-Fill" value="<?= $userFName ?>" hidden></label>
                            <label for="check-in-confirm"><i class="fa fa-calendar-check-o"></i> Check In Date</label>
                            <label for="ci_dateDisabled"><input class="confirm_input" type="text" id="ci_dateDisabled" name="ci_dateDisabled" value="<?= $_POST['checkin'] ?>" disabled></label>
                            <label for="ci_date"><input class="confirm_input" type="text" id="ci_date" name="ci_date" value="<?= $_POST['checkin'] ?>" hidden></label>
                            <label for="hotel-name"><i class="fa fa-building"></i> Hotel Name</label>
                            <label for="hotelnameDisabled"><input class="confirm_input" type="text" id="hotelnameDisabled" name="hotelnameDisabled" value="<?= $_POST['hotelName'] ?>" disabled></label>
                            <label for="hotel-name"><input class="confirm_input" type="text" id="hotel-name" name="hotel-name" value="<?= $_POST['hotelName'] ?>" hidden></label>
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <label for="emailDisabled"><input class="confirm_input" type="text" id="emailDisabled" name="emailDisabled" placeholder="Auto-Fill" required name="email" value="<?= $userEmail ?>" disabled></label>
                            <label for="email"><input class="confirm_input" type="text" id="email" name="email" placeholder="Auto-Fill" required name="email" value="<?= $userEmail ?>" hidden></label>
                            <label for="card-element">
                                Credit Or Debit Card
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </label>
                            <div id="card-element" class="form-control">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>    
                            
                        </div>
                        <div class="col-50">
                            <label for="city"><i class="fa fa-user"></i> Last Name</label>
                            <label for="lnameDisabled"><input class="confirm_input" type="text" id="lnameDisabled" name="lnameDisabled" placeholder="Auto-Fill" value="<?= $userLName ?>" disabled></label>
                            <label for="lname"><input class="confirm_input" type="text" id="lname" name="lname" placeholder="Auto-Fill" value="<?= $userLName ?>" hidden></label>                                        
                            <label for="check-out-confirm"><i class="fa fa-calendar-check-o"></i> Check Out Date</label>
                            <label for="codateDisabled"><input class="confirm_input" type="text" id="codateDisabled" name="codateDisabled" value="<?= $_POST['checkout'] ?>" disabled></label>
                            <label for="co_date"><input class="confirm_input" type="text" id="co_date" name="co_date" value="<?= $_POST['checkout'] ?>" hidden></label>
                            <label for="room-type"><i class="fa fa-bed"></i> Room Type</label>
                            <label for="roomtypeDisabled"><input class="confirm_input" type="text" id="roomtypeDisabled" name="roomtypeDisabled" value="<?= $_POST['TypeOfRooms'] ?>" disabled></label>
                            <label for="room-type"><input class="confirm_input" type="text" id="room-type" name="room-type" value="<?= $_POST['TypeOfRooms'] ?>" hidden></label>                                       
                            <label for="adr"><i class="fa fa-address-card-o"></i> Billing Address</label>
                            <label for="addressDisabled"><input class="confirm_input" type="text" id="adrDisabled" name="addressDisabled" placeholder="Auto-Fill" value="<?= $userBillingAddress ?>" disabled></label>
                            <label for="address"><input class="confirm_input" type="text" id="adr" name="address" placeholder="Auto-Fill" value="<?= $userBillingAddress ?>" hidden></label>
                            <label for="notice"><i class="fa fa-exclamation-circle"> Notice</i></label>
                            <p id="notice">Do check the price before confirming!</p>
                            
                        </div>                           
                    </div>
                    <label for="confirm_book_btn"><input type="submit" value="Confirm Booking" class="btn" name="confirm_book_btn" id="confirm_book_btn"></label>
                </form>
            </div>
        </div>
        <div class="col-25">
            <div class="row">
                <div class="container confirm-box">
                    <h1 class="price_confirm">Total Price</h1>
                    <p>Room Fee: <span class="price"><?=$rate?></span></p>
                    <p>Total Days: <span class="price"><?=$days?></span></p>
                    <p>Total: <span class="price"><?=$price?></span></p>
                </div>
            </div>
        </div>
    </div>
    </main>
</body>


</html>