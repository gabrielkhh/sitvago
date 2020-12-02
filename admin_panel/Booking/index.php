<?php
require '../../vendor/autoload.php';

if (isset($_COOKIE['session_id']))
    session_id($_COOKIE['session_id']);
session_start();
if (!isset($_COOKIE['session_id']))
    setcookie('session_id', session_id(), 0, '/', '.sitvago.com');

if (!isset($_SESSION['username'])) {
	$Message = "Please log in as Admin to view this page";
    header("location: https://sitvago.com/loginpage.php?Message=" .urlencode($Message));
}
else if($_SESSION['role_name']!= "Administrator"){
    header("location: https://sitvago.com/forbidden.php");
}

use sitvago\Booking;

$booking = new Booking();
$results = $booking->getBookingsAdmin();

if (!isset($_SESSION['username'])) {
    $Message = "Please log in as Admin to view this page";
    header("location: ../frontend/loginpage.php?Message=" . urlencode($Message));
} else if ($_SESSION['role_name'] != "Administrator") {
    $Message = "You do not have permission to view this page";
    header("location: ../frontend/home.php?Message=" . urlencode($Message));
}

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
    <title>Hotel Sitvago CMS - View Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS Sources-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">

    <!--JS Sources-->
    <script src="https://kit.fontawesome.com/ebd40a1317.js" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/dayjs.min.js" integrity="sha512-C2m821NxMpJ4Df47O4P/17VPqt0yiK10UmGl59/e5ynRRYiCSBvy0KHJjhp2XIjUJreuR+y3SIhVyiVilhCmcQ==" crossorigin="anonymous"></script>
    <script defer src="/js/main.js"></script>
</head>

<body style="padding-top: 70px;">
    <?php
    include "../navbar_Admin.php";
    ?>
    <main class="container main-content">
        <h1>Viewing All Booking</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="row mb-2">
                        <div class="col-md-10">
                            <h3>Manage Booking</h3>
                        </div>
                        <!--                            <div class="col-md-2">
                                <a role="button" class="float-right btn btn-info" href="create.php">Add Booking</a>
                            </div>-->
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-dark">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Booking ID</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Customer Email</th>
                                            <th scope="col">Hotel name</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Created</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody id="BookingTableBody" class="">
                                        <?php foreach ($results as $row) : ?>
                                            <script>
                                                var createdAt = dayjs('<?= $row['created_at'] ?>').format('D MMM YYYY h:mm A');
                                            </script>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['username'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <td><?= $row['hotel_name'] ?></td>
                                                <td><?= $row['price'] ?></td>
                                                <td id="createdDate<?= $row['id'] ?>">
                                                    <script>
                                                        document.getElementById('createdDate<?= $row['id'] ?>').innerHTML = createdAt;
                                                    </script>
                                                </td>
                                                <td><a role="button" class="btn btn-primary updateBtn" href="view_booking.php?key=<?= $row['id'] ?>" value="<?= $row['id'] ?>">View</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

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