<?php
require '../vendor/autoload.php';

use sitvago\Hotel;

$id = $_GET['key'];

$hotelObj = new Hotel();
$sss = new Hotel();
$roomCategoriesResults = $hotelObj->getRoomCategories();
$hotelSelected = $hotelObj->getHotelInfoForBooking($id);
$hotelImagesSelected = $hotelObj->getHotelImagesForBooking($id);
$hotelPrices = $hotelObj->getHotelPricesForBooking($id);
// $roomPrice = $hotelObj->getRoomCategoryRate($hotelSelected,$roomCategoriesResults);
//$roomDescription = $hotelObj->getRoomDescription();
$counterImage = 0;
?>
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
    session_start();
    if (isset($_SESSION['username'])) {
        include "navbar_User.php";
    } else if (!isset($_SESSION['username'])) {
        include "navbar_nonUser.php";
    }
    ?>
    <link rel="stylesheet" href="css/booking.css">
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($hotelImagesSelected as $rowImage) : ?>
                                    <div class="carousel-item <?php if ($counterImage == 0) {
                                                                    echo ' active';
                                                                    $counterImage++;
                                                                } ?>">
                                        <img src="<?= $rowImage['secure_url'] ?>" class="d-block w-100" alt="...">
                                    </div>
                                <?php endforeach; ?>
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
                            <div class="container icon-containers">
                                <div class="row icon-row">
                                    <div class="col-sm col-icon">
                                        <p></p>
                                        <i class='fas fa-glass-martini-alt my-icon'></i>
                                        <p>Drinking<br>Lounge.</p>
                                    </div>
                                    <div class="col-sm col-icon">
                                        <p></p>
                                        <i class='fas fa-bath my-icon'> </i>
                                        <p>Relaxing<br>Bathtub.</p>
                                    </div>
                                    <div class="col-sm col-icon">
                                        <p></p>
                                        <i class="fas fa-smoking my-icon"></i>
                                        <p>Smoking<br>Room.</p>
                                    </div>
                                    <div class="col-sm col-icon">
                                        <p></p>
                                        <i class='fas fa-utensils my-icon'></i>
                                        <p>Breakfast<br>Buffet.</p>
                                    </div>
                                    <div class="col-sm col-icon">
                                        <p></p>
                                        <i class='fas fa-wifi my-icon'></i>
                                        <p>Free<br>Wi-Fi.</p>
                                    </div>
                                    <div class="col-sm col-icon">
                                        <p></p>
                                        <i class="fas fa-dumbbell my-icon"></i>
                                        <p>Free<br>Gym.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="d-md-flex mt-5 mb-5"><ul class="list"> <li><span>Max:</span></li></ul></div> -->

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 sidebar ftco-animate pl-md-5">
                    <!--div class="sidebar-box ftco-animate">-->
                    <h3 class="hotel_selected"><?= $hotelSelected['name'] ?></h3>
                    <form action="confirmation.php" method="POST" autocomplete="off" id="hotel_form" name="hotel_form">
                        <div class="form-group">
                            <input class="form-control" type="text" id="checkin" name="checkin" placeholder="Check-In-Date" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="checkout" name="checkout" placeholder="Check-Out-Date" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="TypeOfRooms" name="TypeOfRooms" required>
                                <option value="disabled" selected disabled>Choose A Room Type</option>
                                <?php foreach ($roomCategoriesResults as $row) : ?>
                                    <option id="<?= $row['id'] ?>" value="<?= $row['category_name'] ?>"><?= $row['category_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="hotelName" name="hotelName" value="<?= $hotelSelected['name'] ?>" hidden>
                            <input class="form-control" type="text" id="amountPN" name="amountPN" value="" hidden>
                            <button class="btn btn-primary" type="submit" name="book_btn" id="book_btn">Book Now!</button></a>
                            <span id="error"></span>
                        </div>
                    </form>
                    <p>
                        <h3 id="price"></h3>
                    </p>
                    <div id="descriptionArea">TEST</div>
                    <hr/>
                    <div id="review">
                        THROW THE CONTENT HERE WILL EDIT LATER HERE FOR REVIEW
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
<script>
    var hotelDescriptionText = decodeURI("<?= $hotelSelected['description'] ?>");
    document.getElementById("descriptionArea").innerHTML = hotelDescriptionText;

    var pricesData = new Object();
    <?php foreach ($hotelPrices as $prices) : ?>
        <?php $amtIn2DP = number_format((float)$prices['price_per_night'], 2, '.', ''); ?>
        pricesData["<?= $prices['room_category_id'] ?>"] = "<?= $amtIn2DP ?>";
    <?php endforeach; ?>

    $('select').on('change', function() {
        var id = $(this).children(":selected").attr("id");
        document.getElementById("price").innerHTML = "SGD$" + pricesData[id] + " per night";
        document.getElementById("amountPN").value = pricesData[id];
    });
</script>