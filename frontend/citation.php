<!DOCTYPE html>

<?php
require '../vendor/autoload.php';

use sitvago\Hotel;

session_start();

if (isset($_GET['logout'])) {

    session_destroy();
    header("location: home.php");
}

if (isset($_GET['Message'])) {
    // unset($_SESSION['username']);
    print '<script type="text/javascript">alert("' . $_GET['Message'] . '");</script>';
}





//Ending a php session after 30 minutes of inactivity
$minutesBeforeSessionExpire = 30;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {
    session_unset();     // unset $_SESSION   
    session_destroy();   // destroy session data  
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity

$hotel = new Hotel();
$results = $hotel->retrieveHotelsForHomePage();
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html lang="en">

    <head>

        <title>Sitvago's Citation Page </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- Font and Icons CSS -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+SC:wght@500;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Custom styles for this template -->
        <link href="css/album.css" rel="stylesheet">
        <link href="css/searchbar.css" rel="stylesheet">


        <!--jQuery-->
        <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
        </script>

        <!-- Bootstrap -->
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous">
        </script>

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

            .jumbotron {
                background: url(images/home_cover.png) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
                min-height: 300px;
            }

            .bd-placeholder-img {
                width: 100%;
                height: 0;
            }

            .display-2 {
                font-family: 'Cormorant SC', serif;
            }


        </style>
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
            <div class="album py-5 bg-light">
                <div class="container">

                    <div class="row"> 
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice">
                                     <title>The Barracks Hotel Sentosa</title>
                                     <img src="images/hotel/barrackshotel.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">The Barracks Hotel Sentosa</h5>
                                    <p class="card-text">https://www.agoda.com/en-sg/the-barracks-hotel-sentosa-by-far-east-hospitality/hotel/singapore-sg.html?cid=1844104</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice">
                                     <title>Capella Singapore</title><img src="images/hotel/capella.jpg" class='img-fluid' ></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Capella Singapore</h5>
                                    <p class="card-text">https://www.travelplusstyle.com/hotels/capella-singapore</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" >
                                     <title>Mandarin Oriental</title><img src="images/hotel/mandarinoriental.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Mandarin Oriental</h5>
                                    <p class="card-text">https://www.booking.com/hotel/sg/hotel-mandarin-oriental.en-gb.html</p>
                       
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice"> 
                                     <title>Hotel Goodwood Park</title><img src="images/hotel/goodwoodpark.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Hotel Goodwood Park</h5>
                                    <p class="card-text">https://www.booking.com/hotel/sg/goodwood-park.en-gb.html</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" >
                                     <title>Hilton Singapore</title><img src="images/hotel/Hilton.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Hilton Singapore</h5>
                                    <p class="card-text">shorturl.at/arPU4 </p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice"> 
                                     <title>M Social Singapore</title><img src="images/hotel/msocial.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">M Social Singapore</h5>
                                    <p class="card-text">https://sethlui.com/m-social-singapore-designer-loft-style-hotel-perfect-modern-staycationers/</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" >
                                     <title>Carlton Hotel Singapore</title><img src="images/hotel/carlton.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Carlton Hotel Singapore</h5>
                                    <p class="card-text">https://www.hotelscombined.com.sg/Hotel/Carlton_Hotel_Singapore.htm</p>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice"> 
                                     <title>Village Hotel Bugis</title><img src="images/hotel/villagehotelbugis.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Village Hotel Bugis</h5>
                                    <p class="card-text">https://www.makemytrip.com/hotels-international/singapore/singapore-hotels/village_hotel_bugis_by_far_east_hospitality-details.html</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" >
                                     <title>Shangri-La Hotel</title><img src="images/hotel/Shangrila.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Shangri-La Hotel</h5>
                                    <p class="card-text">https://travel-dmc.com/hotel/shangri-la-hotel-singapore/</p>
                                    
                                </div>
                            </div>
                        </div>

                        </main>

                        <footer class="container">
                            <p>&copy; Sitvago 2020</p>
                        </footer>
                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
                        </html>