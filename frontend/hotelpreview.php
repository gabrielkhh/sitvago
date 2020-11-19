<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Barrack Hotel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="external_css/open-iconic-bootstrap.min.css">
        <link rel="stylesheet" href="external_css/animate.css">

        <link rel="stylesheet" href="external_css/owl.carousel.min.css">
        <link rel="stylesheet" href="external_css/owl.theme.default.min.css">
        <link rel="stylesheet" href="external_css/magnific-popup.css">

        <link rel="stylesheet" href="external_css/aos.css">

        <link rel="stylesheet" href="external_css/ionicons.min.css">

        <link rel="stylesheet" href="external_css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="external_css/jquery.timepicker.css">


        <link rel="stylesheet" href="external_css/flaticon.css">
        <link rel="stylesheet" href="external_css/icomoon.css">
        <link rel="stylesheet" href="external_css/style.css">

        <style>
            .carousel-item img {
                width: auto;
                height: 450px;
                max-height: 450px;
            }
        </style>
    </head>
    <body>
        <?php
        include "navbar.php";
        ?>

        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="images/rooms/Barrackhotel.jpg" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="images/rooms/Barrackhotel2.jpg" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="images/rooms/Barrackhotel3.jpg" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
                                <h2 class="mb-4">Barrack Hotel Rooms <span>- (x Available rooms； x will be updated via sql)</span></h2>
                                <p>This hotel very nice, very nice room, wide toilet, expensive</p>
                                <div class="d-md-flex mt-5 mb-5">
                                    <ul class="list">
                                        <li><span>Max:</span> 3 Persons (value retreive from SQL)</li>
                                        <li><span>Bed:</span> 1</li>
                                    </ul>
                                    <ul class="list ml-md-5">
                                        <li><span>View:</span> Sea View</li>
                                    </ul>
                                </div>
                                <p>Some description about the hotel? This hotel is in Singapore, expensive but confirm worth</p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 sidebar ftco-animate pl-md-5">
                        <div class="sidebar-box ftco-animate">
                            <h3>Put the reservations stuff here</h3>
                            <p>Check in from date to date?</p>
                            <p>Tabulate price based on how many days selected</p>
                            <p>Submit button to check out</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        <footer class="bg-light pb-5">
            <div class="container text-center">
                <p class="font-italic text-muted mb-0">&copy; Sitvago's 2020 Copyright</p>
            </div>
        </footer>

        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-migrate-3.0.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/jquery.stellar.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        
        <script src="js/aos.js"></script>
        <script src="js/scrollax.min.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>