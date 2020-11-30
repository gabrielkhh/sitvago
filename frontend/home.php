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
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="css/album.css" rel="stylesheet">


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
            background: url(images/home_cover.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }

        body {
            zoom: 90%;
        }

        .bd-placeholder-img {
            width: 100%;
            height: 0;
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
        <div class="jumbotron">
            <div class="container text-center text-white">
                <h1 class="display-2">Welcome to SITVAGO</h1>
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
                                            <select class="form-control search-slt" id="exampleFormControlSelect1">
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
                    <?php foreach ($results as $row) : ?>
                        <div class="col-md-4 hotel-card">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" preserveAspectRatio="xMidYMid slice">
                                    <title><?= $row['name'] ?></title><img src="<?= $row['secure_url'] ?>" class='img-fluid' alt="Barrack Hotel" />
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row['name'] ?></h5>
                                        <p><?= $row['original_src'] ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a class="btn btn-light" role="button" href="booking.php?key=<?= $row['id'] ?>">View</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
</body>
<footer class="container">
    <p>&copy; Sitvago 2020</p>
</footer>

</html>