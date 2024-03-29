<?php
require '../vendor/autoload.php';

use sitvago\Overview;
use sitvago\Review;

$overview = new Overview();
$review = new Review();
$reviewResults = $review->getReviewsData();
$results = $overview->getCount();

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
    <title>Hotel Sitvago CMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS Sources-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">

    <!--JS Sources-->
    <script src="https://kit.fontawesome.com/ebd40a1317.js" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.8.2/countUp.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/dayjs.min.js" integrity="sha512-C2m821NxMpJ4Df47O4P/17VPqt0yiK10UmGl59/e5ynRRYiCSBvy0KHJjhp2XIjUJreuR+y3SIhVyiVilhCmcQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/plugin/relativeTime.min.js" integrity="sha512-ZpD5q39qjKdG3a3p8cttXCwl9C7InezFKiIVFaxmethhYdzvYTMxJuqqg3I0WmI5D7G4Qt0HiYfXjagboH8/jQ==" crossorigin="anonymous"></script>
    <script defer src="/js/main.js"></script>
</head>

<body style="padding-top: 70px;">
    <?php
    include "navbar_Admin.php";
    ?>
    <main class="container main-content">
        <h1>Welcome Back, <?= $_SESSION['username'] ?>!</h1>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Hotels Present to Date</div>
                    <div class="card-body text-center">
                        <h1 id="hotelCounter" class="card-title text-center">Number</h1>
                        <a href="hotel/index.php" class="btn btn-primary">View Hotels</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Frequently Asked Questions</div>
                    <div class="card-body text-center">
                        <h1 id="faqCounter" class="card-title text-center">Number</h1>
                        <a href="faq/index.php" class="btn btn-primary">View FAQs</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Active Geo-Locations to Date</div>
                    <div class="card-body text-center">
                        <h1 id="geoCounter" class="card-title text-center">Number</h1>
                        <a href="geolocation/index.php" class="btn btn-primary">View Geo-Locations</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Total number of bookings</div>
                    <div class="card-body text-center">
                        <h1 id="bookingCounter" class="card-title text-center">Number</h1>
                        <a href="Booking/index.php" class="btn btn-primary">View Bookings</a>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Total number of reviews</div>
                    <div class="card-body text-center">
                        <h1 id="reviewCounter" class="card-title text-center">Number</h1>
                        <a href="review/index.php" class="btn btn-primary">View Reviews</a>
                    </div>
                </div>
            </div> -->
            <div class="col-md-12">
                <h1>Information at a glance</h1>
                
                <div class="mt-5">
                    <h3><?= $results[4]['ReviewCount']; ?> Reviews have been published on your site</h3>
                    <h6 id="reviewDataArea"></h6>
                </div>
                <script>
                    dayjs.extend(window.dayjs_plugin_relativeTime);
                    const now = dayjs();
                    var relativePostedTime = dayjs().to(dayjs('<?= $reviewResults[0]['created_at'] ?>'));
                    document.getElementById('reviewDataArea').innerHTML = "The latest review was published " + relativePostedTime + " for <?= $reviewResults[0]['name']; ?>.";
                </script>
            </div>

        </div>




    </main>
    <?php
    include "footer.php";
    ?>
    <script>
        var hotelNumbers = <?= $results[0]['HotelCount']; ?>;
        var faqNumbers = <?= $results[1]['FAQCount']; ?>;
        var geoNumbers = <?= $results[2]['GeoCount']; ?>;
        var bookingNumbers = <?= $results[3]['BookingCount']; ?>;
        var reviewNumbers = <?= $results[4]['ReviewCount']; ?>;

        let counterHotel = new CountUp('hotelCounter', 0, hotelNumbers);
        if (!counterHotel.error) {
            counterHotel.start();
        } else {
            console.error(counterHotel.error);
        }

        let counterFAQ = new CountUp('faqCounter', 0, faqNumbers);
        if (!counterFAQ.error) {
            counterFAQ.start();
        } else {
            console.error(counterFAQ.error);
        }

        let counterGeo = new CountUp('geoCounter', 0, geoNumbers);
        if (!counterGeo.error) {
            counterGeo.start();
        } else {
            console.error(counterGeo.error);
        }

        let counterBooking = new CountUp('bookingCounter', 0, bookingNumbers);
        if (!counterBooking.error) {
            counterBooking.start();
        } else {
            console.error(counterBooking.error);
        }

        // let counterReview = new CountUp('reviewCounter', 0, reviewNumbers);
        // if (!counterReview.error) {
        //     counterReview.start();
        // } else {
        //     console.error(counterReview.error);
        // }
    </script>
</body>

</html>