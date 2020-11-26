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
        
        <!-- For Calender --> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
         <!-- Own Script -->
        <script defer src="js/booking.js"></script>
        
    </head>
    <body>
    <?php
    include "navbar.php";
    ?>       
        <link rel="stylesheet" href="css/booking.css">
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
                                <h2 class="mb-4"></h2>
                                    <div class="container icon-containers">
                                        <div class="row icon-row">
                                            <div class="col-sm-2 col-icon">
                                                <i class='fas fa-glass-martini-alt'></i>
                                                    <p>Drinking<br>Lounge.</p>
                                            </div>
                                            <div class="col-sm-2 col-icon">
                                                <i class='fas fa-bath'> </i>
                                                     <p>Relaxing<br>Bathtub.</p>
                                            </div>
                                            <div class="col-sm-2 col-icon">
                                                <i class="fas fa-smoking"></i>
                                                      <p>Smoking<br>Room.</p>
                                            </div>
                                            <div class="col-sm-2 col-icon">
                                                <i class='fas fa-utensils'></i>
                                                      <p>Breakfast<br>Buffet.</p>
                                            </div>
                                             <div class="col-sm-2 col-icon">
                                                 <i class='fas fa-wifi'></i>
                                                     <p>Free<br>Wi-Fi.</p>                                                        
                                             </div>
                                             <div class="col-sm-2 col-icon">
                                                 <i class="fas fa-dumbbell"></i> 
                                                      <p>Free<br>Gym.</p>
                                             </div>
                                         </div>
                                    </div>   
                                
                                <!-- <div class="d-md-flex mt-5 mb-5"><ul class="list"> <li><span>Max:</span></li></ul></div> -->
                                                                     
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 sidebar ftco-animate pl-md-5">
                        <div class="sidebar-box ftco-animate">
                            <h3 class="hotel_selected">Barrack Hotel Rooms</h3>
                            <form action="confirmation.php">       
                                <div class ="form-group">
                                     <input class="form-control" type="text" id="checkin" placeholder="Check-In-Date" required>                       
                                </div>
                                <div class ="form-group">
                                    <input class="form-control" type="text" id="checkout" placeholder="Check-Out-Date" required>                                     
                                </div>
                                <div class ="form-group">
                                    <input class="form-control" list="browsers" id="TypeOfRooms" name="TypeOfRooms" placeholder="Type-Of-Room" required>
                                        <datalist id="browsers">
                                            <option value="Single Room"></option>
                                            <option value="Double Room"></option>
                                        </datalist>                                     
                                </div>
                                <div class="form-group">
                                        <button class="btn btn-primary" type="submit" id="submit">Book Now!</button></a>
                                </div>            
                            </form>
                            <p><h3 id="price">For only $99.99 per night!</h3></p>
                            <p>Some description about the hotel. This hotel is in Singapore, expensive but confirm worth it for $99.99 per night!</p>
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