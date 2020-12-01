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

use sitvago\Hotel;
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
        <?php echo "<h1>Booking Details</h1>"; ?>

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
                                        <div class="card-body">
                                            <h3>Customer Details</h2>
                                            <p>First Name : <?= $rowBooking['first_name'] ?></p>
                                            <p>Last Name : <?= $rowBooking['last_name'] ?></p>
                                            <p>Email Address : <?= $rowBooking['email'] ?></p>
                                            <p>Username : <?= $rowBooking['phone_number'] ?></p>
                                            <p>Last Name : <?= $rowBooking['last_name'] ?></p>
                                        </div>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <?php echo "<button id='btnDelete' class='btn btn-danger' value='" . $id . "'>Delete</button>"; ?>
                                    <button id="btnCancel" class="btn btn-warning">Cancel</button>
                                    <?php echo "<button id='btnSave' class='btn btn-primary' value='" . $id . "'>Save Changes</button>"; ?>
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
    var hotelID = <?= $id; ?>;
    var hotelName = "<?= $rowHotel['name']; ?>";
</script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var buttonSave = document.getElementById("btnSave");
        var buttonDelete = document.getElementById("btnDelete");
        var buttonCancel = document.getElementById("btnCancel");

        function WebFormInfo(inOption, hotelID, hotelName, hotelGeoLocation, hotelDescription) {
            this.option = inOption;
            this.id = hotelID;
            this.name = hotelName;
            this.geoLocation = hotelGeoLocation;
            this.description = hotelDescription;
        }

        var saveHotel = function(e) {
            var collectedHotelName = $("#inputHotelName").val();
            var collectedGeoLocation = $("#selectArea").val();
            var collectedHotelDescription = encodeURI(CKEDITOR.instances.hotelDescription.getData());
            var id = $(this).attr("value");

            var webFormData = new WebFormInfo("updateHotel", id, collectedHotelName, collectedGeoLocation, collectedHotelDescription);
            var webFormDataInString = JSON.stringify(webFormData);
            console.log(webFormDataInString);

            // If statement for future validation checks.
            if (true) {
                $saveHotelHandler = jQuery.ajax({
                    type: 'PUT',
                    url: 'hotel_handler.php',
                    dataType: 'json',
                    contentType: 'application/json;',
                    data: webFormDataInString
                })

                $saveHotelHandler.done(function(data) {
                    swal({
                        title: "Updated Hotel Information",
                        text: data.message,
                        icon: "success"
                    }).then(function() {
                        window.location = "index.php";
                    });
                });
                $saveHotelHandler.fail(function(jqXHR, textStatus, error) {
                    swal({
                        title: "Something Went Wrong :(",
                        text: textStatus,
                        icon: "error"
                    });
                });
            }
        }

        var deleteHotel = function(e) {
            var webFormData = new WebFormInfo("deleteHotel", hotelID, hotelName, "", "");
            var webFormDataInString = JSON.stringify(webFormData);

            swal({
                    title: "Are You Sure?",
                    text: "You are about to remove " + hotelName + " from existence.",
                    icon: "warning",
                    buttons: ["Nope", "Confirm Plus Chop"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $saveHotelHandler = jQuery.ajax({
                            type: 'DELETE',
                            url: 'hotel_handler.php',
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
                            console.log(data);
                        });
                        $saveHotelHandler.fail(function(jqXHR, textStatus, error) {
                            swal({
                                title: "Something Went Wrong :(",
                                text: "There seems to be a problem with deletion.",
                                icon: "error"
                            });
                            console.log(error);
                            console.log(textStatus);
                            console.log(jqXHR);
                        });
                    }
                });
        }

        var cancelHotel = function(e) {
            swal({
                    title: "Are You Sure?",
                    text: "You are about to discard any changes made and return back to the hotel lists page.",
                    icon: "warning",
                    buttons: ["Nope", "Confirm Plus Chop"],
                    dangerMode: false,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location = "index.php";
                    }
                });
        }

        buttonSave.addEventListener('click', saveHotel, false);
        buttonCancel.addEventListener('click', cancelHotel, false);
        buttonDelete.addEventListener('click', deleteHotel, false);
    });


    // Your code to save "data", usually through Ajax.
</script>