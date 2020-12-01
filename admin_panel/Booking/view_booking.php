<?php
$id = $_GET['key'];

require '../../vendor/autoload.php';

if (isset($_COOKIE['session_id']))
    session_id($_COOKIE['session_id']);
session_start();
if (!isset($_COOKIE['session_id']))
    setcookie('session_id', session_id(), 0, '/', '.sitvago.com');

if (!isset($_SESSION['username'])) {
    $Message = "Please log in as Admin to view this page";
    header("location: https://sitvago.com/loginpage.php?Message=" . urlencode($Message));
} else if ($_SESSION['role_name'] != "Administrator") {
    header("location: https://sitvago.com/forbidden.php");
}

use sitvago\Booking;

$booking = new Booking();
$rowBooking = $booking->getSingleBookingAdmin($id);

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Hotel Sitvago CMS - View Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS Sources-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">

    <!--JS Sources-->
    <script src="https://kit.fontawesome.com/ebd40a1317.js" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/dayjs.min.js" integrity="sha512-C2m821NxMpJ4Df47O4P/17VPqt0yiK10UmGl59/e5ynRRYiCSBvy0KHJjhp2XIjUJreuR+y3SIhVyiVilhCmcQ==" crossorigin="anonymous"></script>
    <script defer src="/js/main.js"></script>
</head>

<body style="padding-top: 70px;">
    <?php
    include "../navbar_Admin.php";
    ?>
    <main class="container main-content ">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="row mb-2">

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <h5 class="card-title">Booking ID : <?= $rowBooking['id']; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Created : <?= $rowBooking['created_at'] ?></h6>
                                        <div class="row">
                                            <div class="card-body">
                                                <h3>Booking Information</h2>
                                                    <p><strong>Stripe Transaction ID :</strong> <?= $rowBooking['stripe_payment_id'] ?></p>
                                                    <p><strong>Hotel Name :</strong> <?= $rowBooking['hotel_name'] ?></p>
                                                    <p><strong>Check-in Date :</strong> <?= $rowBooking['check_in'] ?></p>
                                                    <p><strong>Check-out Date :</strong> <?= $rowBooking['check_out'] ?></p>
                                                    <p><strong>Room Type :</strong> <?= $rowBooking['room_type'] ?></p>
                                                    <p><strong>Amount paid :</strong> SGD$ <?= $rowBooking['price'] ?></p>
                                            </div>
                                            <div class="card-body">
                                                <h3>Customer Information</h2>
                                                    <p><strong>First Name :</strong> <?= $rowBooking['first_name'] ?></p>
                                                    <p><strong>Last Name :</strong> <?= $rowBooking['last_name'] ?></p>
                                                    <p><strong>Email Address :</strong> <?= $rowBooking['email'] ?></p>
                                                    <p><strong>Username :</strong> <?= $rowBooking['username'] ?></p>
                                                    <p><strong>Contact Number :</strong> <?= $rowBooking['phone_number'] ?></p>
                                                    <p><strong>Stripe Customer Reference ID :</strong> <?= $rowBooking['stripe_customer_id'] ?></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="float-right">
                                    <a id='btnBack' class='btn btn-info' href="https://admin.sitvago.com/Booking/">Back to Bookings</a>
                                    <?php echo "<button id='btnDelete' class='btn btn-danger' value='" . $id . "'>Cancel Booking</button>"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php
    include "../footer.php";
    ?>
</body>

</html>
<script type="text/javascript">
    var bookingID = <?= $id; ?>;
</script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var buttonDelete = document.getElementById("btnDelete");

        function WebFormInfo(inOption, bookingID) {
            this.option = inOption;
            this.id = bookingID;
        }

        var deleteBooking = function(e) {
            var webFormData = new WebFormInfo("deleteBooking", bookingID);
            var webFormDataInString = JSON.stringify(webFormData);
            console.log(webFormDataInString);

            swal({
                    title: "Are You Sure?",
                    text: "You are about to cancel a booking.",
                    icon: "warning",
                    buttons: ["Nope", "Yes"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $saveHotelHandler = jQuery.ajax({
                            type: 'DELETE',
                            url: 'booking_handler.php',
                            dataType: 'json',
                            contentType: 'application/json;',
                            data: webFormDataInString
                        })

                        $saveHotelHandler.done(function(data) {
                            swal({
                                title: "Deleted!",
                                text: data.message,
                                icon: "success"
                            }).then(function() {
                                window.location = "index.php";
                            });
                        });
                        $saveHotelHandler.fail(function(jqXHR, textStatus, error) {
                            swal({
                                title: "Something Went Wrong :(",
                                text: "There seems to be a problem with deletion.",
                                icon: "error"
                            });
                        });
                    }
                });
            }
        buttonDelete.addEventListener('click', deleteBooking, false);
    });
</script>