<?php
require '../vendor/autoload.php';

use sitvago\Overview;

$overview = new Overview();
$results = $overview->getCount();
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
    <script defer src="/js/main.js"></script>
</head>

<body>
    <!-- <?php
            include "../../nav.inc.php";
            ?> -->
    <main class="container main-content">
        <h1>Welcome Back, Admin!</h1>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Hotels Present to Date</div>
                    <div class="card-body text-center">
                        <h1 id="hotelCounter" class="card-title text-center">Number</h5>
                            <a href="hotel/index.php" class="btn btn-primary">View Hotels</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Registered Users to Date</div>
                    <div class="card-body text-center">
                        <h1 id="userCounter" class="card-title text-center">Number</h5>
                            <a href="#" class="btn btn-primary">View Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Active Geo-Locations to Date</div>
                    <div class="card-body text-center">
                        <h1 id="geoCounter" class="card-title text-center">Number</h5>
                            <a href="geolocation/index.php" class="btn btn-primary">View Geo-Locations</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Total Bookings for all users</div>
                    <div class="card-body text-center">
                        <h1 id="hotelCounter" class="card-title text-center">Number</h5>
                            <a href="hotel/index.php" class="btn btn-primary">View Bookings</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Total Reviews for all Hotels</div>
                    <div class="card-body text-center">
                        <h1 id="hotelCounter" class="card-title text-center">Number</h5>
                            <a href="hotel/index.php" class="btn btn-primary">View Reviews</a>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Registered Users to Date</div>
                    <div class="card-body text-center">
                        <h1 id="userCounter" class="card-title text-center">Number</h5>
                            <a href="#" class="btn btn-primary">View Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header text-center">Active Geo-Locations to Date</div>
                    <div class="card-body text-center">
                        <h1 id="geoCounter" class="card-title text-center">Number</h5>
                            <a href="geolocation/index.php" class="btn btn-primary">View Geo-Locations</a>
                    </div>
                </div>
            </div>-->
        </div>

    </main>
    <!-- <?php
            include "../../footer.inc.php";
            ?> -->
</body>


</html>
<script type="text/javascript">
    var hotelNumbers = <?= $results[0]['HotelCount']; ?>;
    var userNumbers = <?= $results[1]['UserCount']; ?>;
    var geoNumbers = <?= $results[2]['GeoCount']; ?>;
</script>
<script>
    let counterHotel = new CountUp('hotelCounter', 0, hotelNumbers);
    if (!counterHotel.error) {
        counterHotel.start();
    } else {
        console.error(counterHotel.error);
    }

    let counterUser = new CountUp('userCounter', 0, userNumbers);
    if (!counterUser.error) {
        counterUser.start();
    } else {
        console.error(counterUser.error);
    }

    let counterGeo = new CountUp('geoCounter', 0, geoNumbers);
    if (!counterGeo.error) {
        counterGeo.start();
    } else {
        console.error(counterGeo.error);
    }
</script>