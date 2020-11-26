<!DOCTYPE html>
<?php
session_start();


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
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html>
    <head>

        <title>Sitvago's Home </title>
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


        <main role="main">

            <div class="jumbotron">
                <div class="container text-center text-white">
                    <h1 class="display-2" >Welcome to SITVAGO!</h1>
                    <p>Book a Hotel with us! Your satisfaction matters to us </p>
                    <section class="search-sec">
                        <div class="container">
                            <form action="#" method="post" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-lg-14">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                <input type="text" class="form-control search-slt" placeholder="Stay where?">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0 ">
                                                <input type="text" class="form-control search-slt" placeholder="Preferred Location">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0 ">
                                                <select class   ="form-control search-slt" id="exampleFormControlSelect1">
                                                    <option>Sort By</option>
                                                    <option>Example one</option>
                                                    <option>Example one</option>
                                                    <option>Example one</option>
                                                    <option>Example one</option>
                                                    <option>Example one</option>
                                                    <option>Example one</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                <button type="button" class="btn btn-danger wrn-btn">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>

                </div>
            </div>



            <div class="album py-5 bg-light">
                <div class="container">

                    <div class="row"> 
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" 
                                     <title>The Barracks Hotel Sentosa</title><img src="images/hotel/barrackshotel.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">The Barracks Hotel Sentosa</h5>
                                    <p class="card-text">Availability: 5</p>
                                    <p class="card-text">Ratings: 3/5</p>
                                    <div class="d-flex justify-content-between align-items-center">     
                                        <div class="btn-group">
                                            <a href="booking.php" class="btn btn-light" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" 
                                     <title>Capella Singapore</title><img src="images/hotel/capella.jpg" class='img-fluid' ></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Capella Singapore</h5>
                                    <p class="card-text">Availability: 2</p>
                                    <p class="card-text">Ratings: 4.5/5</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="barrackhotel_preview.php" class="btn btn-light" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" 
                                     <title>Mandarin Oriental</title><img src="images/hotel/mandarinoriental.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Mandarin Oriental</h5>
                                    <p class="card-text">Availability: 4</p>
                                    <p class="card-text">Ratings: 1/5</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="barrackhotel_preview.php" class="btn btn-light" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" 
                                     <title>Hotel Goodwood Park</title><img src="images/hotel/goodwoodpark.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Hotel Goodwood Park</h5>
                                    <p class="card-text">Hotel Goodwood Park</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="barrackhotel_preview.php" class="btn btn-light" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" 
                                     <title>Hilton Singapore</title><img src="images/hotel/Hilton.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Hilton Singapore</h5>
                                    <p class="card-text">Hilton Singapore</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="barrackhotel_preview.php" class="btn btn-light" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" 
                                     <title>M Social Singapore</title><img src="images/hotel/msocial.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">M Social Singapore</h5>
                                    <p class="card-text">M Social Singapore</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="barrackhotel_preview.php" class="btn btn-light" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" 
                                     <title>Carlton Hotel Singapore</title><img src="images/hotel/carlton.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Carlton Hotel Singapore</h5>
                                    <p class="card-text">Carlton Hotel Singapore</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="barrackhotel_preview.php" class="btn btn-light" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" 
                                     <title>Village Hotel Bugis</title><img src="images/hotel/villagehotelbugis.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Village Hotel Bugis</h5>
                                    <p class="card-text">Village Hotel Bugis</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="barrackhotel_preview.php" class="btn btn-light" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" preserveAspectRatio="xMidYMid slice" 
                                     <title>Shangri-La Hotel</title><img src="images/hotel/Shangrila.jpg" class='img-fluid'></svg>
                                <div class="card-body">
                                    <h5 class="card-title">Shangri-La Hotel</h5>
                                    <p class="card-text">Shangri-La Hotel</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="barrackhotel_preview.php" class="btn btn-light" role="button">View</a>
                                        </div>
                                    </div>
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