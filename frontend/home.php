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

        <title>Sitvago's Home </title>
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

        <script defer src="js/nav.js"></script>

        <style>
            .jumbotron {
                background: url(images/home_cover.png) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size:100% 100%;
                padding-bottom:150px;   
            }

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

            .bd-placeholder-img {
                width: 100%;
                height: 0;
            }

            .display-2 {
                font-family: 'Cormorant SC', serif;
            }

            .btn btn-light button{
                color:black;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            include "navbar_User.php";
        } else if (!isset($_SESSION['username'])) {
            include "navbar_nonUser.php";
        }
        ?>
        <main>
            <div class="jumbotron">
                <div class="container text-center text-white">
                    <h1 class="display-2">Welcome to SITVAGO</h1>
                    <br>
                    <br>
                    <p>Book a Hotel with us! Your satisfaction matters to us </p>
                </div>
            </div>
        </div>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php foreach ($results as $row) : ?>
                        <div class="col-md-4 hotel-card">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" preserveAspectRatio="xMidYMid slice">
                                <title><?= $row['name'] ?></title>
                                <img src="<?= $row['secure_url'] ?>" class='img-fluid' alt="Barrack Hotel">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $row['name'] ?></h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a class="btn btn-light" role="button" href="booking.php?key=<?= $row['id'] ?>">View More</a>
                                        </div>
                                    </div>
                                    <span class="badge badge-dark mt-3"><?= $row['area_name'] ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>

</body>

</html>