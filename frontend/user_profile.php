<!DOCTYPE html>
<?php
require '../vendor/autoload.php';

use sitvago\Booking;

session_start();
if (!isset($_SESSION['username'])) {
    $Message = "Please login to view your profile.";
    header("location: loginpage.php?Message=" . urlencode($Message));
} else {
    $userID = ($_SESSION['userID']);
    $username = ($_SESSION['username']);
    $first_name = ($_SESSION['first_name']);
    $last_name = ($_SESSION['last_name']);
    $email = ($_SESSION['email']);
    $phone_number = ($_SESSION['phone_number']);
    $country = ($_SESSION['country']);
    $billing_address = ($_SESSION['billing_address']);
}

//display error details for update user profile
if (isset($_SESSION['errorsDetails'])) {
    $errorsDetails = ($_SESSION['errorsDetails']);
} else {
    $errorsDetails = "";
}

//display error details for change password
if (isset($_SESSION['errorsPW'])) {
    $errorsPW = ($_SESSION['errorsPW']);
} else {
    $errorsPW = "";
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: home.php");
}

//Ending a php session after 30 minutes of inactivity
$minutesBeforeSessionExpire = 30;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {
    session_unset();     // unset $_SESSION   
    session_destroy();   // destroy session data  
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity

$bookings = new Booking();
$results = $bookings->getBookings($userID);
?>
<html lang="en">
    <head>

        <title>Singapore Tourism Attraction </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
              integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
              crossorigin="anonymous">

        <!-- Font and Icons CSS -->
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <!--jQuery-->
        <script defer
                src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                crossorigin="anonymous">
        </script>

        <!-- Bootstrap -->
        <script defer
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
                integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
                crossorigin="anonymous">
        </script>
        <link href='css/profile.css' rel="stylesheet">



        <style>
			
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
            .jumbotron{
                background: url(images/home_cover.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
            }

            body {
                zoom: 90%;
                font-family: Arial;
            }


        </style>
        <!-- Custom styles for this template -->

        <link href="css/album.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if (isset($_SESSION['username'])) {
            include "navbar_User.php";
        } else if (!isset($_SESSION['username'])) {
            include "navbar_nonUser.php";
        }
        ?>

        <main>

            <div class="jumbotron">
                <div class="container text-center text-white">
                    <h1 class="display-2" ><?php echo $first_name ?>'s Profile</h1>
                    <p>View your account and bookings here!</p>
                </div>
			</div>
            

            <div class="tab_container"> 


                <div class="tab">
                    <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'Account')">Account Settings</button>
                    <button class="tablinks" id="bookingstab" onclick="openCity(event, 'Bookings')">Bookings</button>
                </div>

                <div id="Account" class="tabcontent">

                    <div class="signup-form" id="edit_profile">
                        <form action="user_handler.php" method="post" onSubmit="if (confirm('Confirm changes?')) {
                                } else {
                                    return false;
                                }
                                ;">
                                  <?php if (is_array($errorsDetails)): ?>
                                      <?php foreach ($errorsDetails as $error): ?>

                                    <p><?php echo $error ?></p>


                                <?php endforeach ?>
								<?php unset($_SESSION['errorsDetails']); ?>
                            <?php endif ?>
                            <div class="form-group">
                                <h2>Account Details</h2>
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" id="username" value = "<?php echo $username ?>" maxlength="50" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input type="text" class="form-control" name="fname" id="fname" value = "<?php echo $first_name ?>" maxlength="50" required  readonly>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input type="text" class="form-control" name="lname" id="lname" value = "<?php echo $last_name ?>" maxlength="50" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" value = "<?php echo $email ?>" maxlength="50" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone number:</label>
                                <input type="tel" class="form-control" name="phone_number" id="phone_number" value = "<?php echo $phone_number ?>" maxlength="8" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <input type="text" class="form-control" name="country" id="country" value = "<?php echo $country ?>" maxlength="50" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="billing_address">Billing Address:</label>
                                <input type="text" class="form-control" name="billing_address" id="billing_address" value = "<?php echo $billing_address ?>" required readonly>
                            </div>
                            <div style="overflow:auto;">
                                <button type="button" id="editBtn" onclick="editFunction()">Edit Profile</button>
                                <button type="button" id="passwordBtn" onclick="passwordFunction()">Change Password</button>
                                <button type="button" id="prevBtn" onclick="prevFunction()">Cancel</button>
                                <button type="submit" id="submitBtn" name="update_user" onclick="submitFunction()">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="form-signin" id="change_password">
                        <form action="user_handler.php" method="post">

                            <?php if (is_array($errorsPW)): ?>
                                <?php foreach ($errorsPW as $error): ?>

                                    <p><?php echo $error ?></p>
											

                                <?php endforeach ?>
								<?php unset($_SESSION['errorsPW']); ?>
                            <?php endif ?>



                            <!-- Remember to add 'required' field later, currently remove for demo purpose -->
                            <h2>Change Password</h2>
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" class="form-control" name="username" id="username2" value = "<?php echo $username ?>" readonly>

                            <label for="inputPassword1" class="sr-only">Current Password</label>
                            <input type="password" id="inputPassword1" class="form-control" placeholder="Current Password" name="password">

                            <label for="inputNewPassword2" class="sr-only">New Password</label>
                            <input type="password" id="inputPassword2" class="form-control" placeholder="New Password" name="new_password">

                            <label for="inputConfirmedPassword" class="sr-only">Confirmed Password</label>
                            <input type="password" id="inputConfirmedPassword3" class="form-control" placeholder="Confirmed Password" name="confirmed_password">

                            <button type="button" id="prevBtn2" onclick="prevFunction()">Cancel</button>
                            <button type="submit" id="submitBtn2" name="update_password">Submit</button>
                        </form>
                    </div>
                </div>

                <div id="Bookings" class="tabcontent">
                    <?php foreach ($results as $row) : ?>
                        <div class="card">

                            <h5 class="card-header">Hotel Name: <?= $row['hotel_name'] ?></h5>
                            <div class="card-body">
                                <p class="card-text">Transaction ID: <?= $row['stripe_payment_id'] ?></p>
                                <p class="card-text">Booking ID: <?= $row['id'] ?></p>
                                <p class="card-title">Room Type: <?= $row['room_type'] ?></p>
                                <p class="card-text">Amount Paid: <?= $row['price'] ?></p>
                                <p class="card-text">Check-in Date: <?= $row['check_in'] ?></p>
                                <p class="card-text">Check-out Date: <?= $row['check_out'] ?></p>
                                <p class="card-text">Booking Date: <?= $row['created_at'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>

        <?php
			include "footer.php";
		?>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
		<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script>
                                function openCity(evt, cityName) {
                                    var i, tabcontent, tablinks;
                                    tabcontent = document.getElementsByClassName("tabcontent");
                                    document.getElementById("prevBtn").style.display = "none";
									document.getElementById("prevBtn2").style.display = "none";
                                    document.getElementById("change_password").style.display = "none";
                                    document.getElementById("submitBtn").style.display = "none";
									document.getElementById("submitBtn2").style.display = "none";
                                    for (i = 0; i < tabcontent.length; i++) {
                                        tabcontent[i].style.display = "none";
                                    }
                                    tablinks = document.getElementsByClassName("tablinks");
                                    for (i = 0; i < tablinks.length; i++) {
                                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                                    }
                                    document.getElementById(cityName).style.display = "block";
                                    evt.currentTarget.className += " active";
                                }
                                function editFunction() {
                                    document.getElementById("fname").readOnly = false;
                                    document.getElementById("lname").readOnly = false;
                                    document.getElementById("email").readOnly = false;
                                    document.getElementById("phone_number").readOnly = false;
                                    document.getElementById("country").readOnly = false;
                                    document.getElementById("billing_address").readOnly = false;
                                    document.getElementById("submitBtn").style.display = "inline";
									document.getElementById("submitBtn2").style.display = "none";
                                    document.getElementById("editBtn").style.display = "none";
                                    document.getElementById("prevBtn").style.display = "inline"
									document.getElementById("prevBtn2").style.display = "none";
                                    document.getElementById("passwordBtn").style.display = "none";

                                }
                                function passwordFunction() {
                                    document.getElementById("editBtn").style.display = "none";
                                    document.getElementById("passwordBtn").style.display = "none";
                                    document.getElementById("edit_profile").style.display = "none";
                                    document.getElementById("change_password").style.display = "block";
									document.getElementById("prevBtn").style.display = "none";
                                    document.getElementById("prevBtn2").style.display = "inline"
									document.getElementById("submitBtn2").style.display = "inline";
									document.getElementById("bookingstab").disabled = true;
									document.getElementById("defaultOpen").disabled = true;

                                }
                                function prevFunction() {
                                    document.getElementById("submitBtn").style.display = "none";
									document.getElementById("submitBtn2").style.display = "none";
                                    document.getElementById("editBtn").style.display = "inline";
                                    document.getElementById("passwordBtn").style.display = "inline";
                                    document.getElementById("edit_profile").style.display = "block";
                                    document.getElementById("fname").readOnly = true;
                                    document.getElementById("lname").readOnly = true;
                                    document.getElementById("email").readOnly = true;
                                    document.getElementById("phone_number").readOnly = true;
                                    document.getElementById("country").readOnly = true;
                                    document.getElementById("billing_address").readOnly = true;
                                    document.getElementById("change_password").style.display = "none";
                                    document.getElementById("prevBtn").style.display = "none";
									document.getElementById("prevBtn2").style.display = "none";
									document.getElementById("bookingstab").disabled = false;
									document.getElementById("defaultOpen").disabled = false;
                                }
                                // Get the element with id="defaultOpen" and click on it
                                document.getElementById("defaultOpen").click();






        </script>

    </body>

</html>