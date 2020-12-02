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

    <link rel="stylesheet" href="external_css/star-rating.min.css">
    <link rel="stylesheet" href="external_css/krajee-fas/theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/dayjs.min.js" integrity="sha512-C2m821NxMpJ4Df47O4P/17VPqt0yiK10UmGl59/e5ynRRYiCSBvy0KHJjhp2XIjUJreuR+y3SIhVyiVilhCmcQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.9.6/plugin/relativeTime.min.js" integrity="sha512-ZpD5q39qjKdG3a3p8cttXCwl9C7InezFKiIVFaxmethhYdzvYTMxJuqqg3I0WmI5D7G4Qt0HiYfXjagboH8/jQ==" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

</head>

<body>
    <main>
        <?php
        require '../vendor/autoload.php';

        use sitvago\Hotel;
        use sitvago\Review;

        $id = $_GET['key'];

        $hotelObj = new Hotel();
        $sss = new Hotel();
        $roomCategoriesResults = $hotelObj->getRoomCategories();
        $hotelSelected = $hotelObj->getHotelInfoForBooking($id);
        $hotelImagesSelected = $hotelObj->getHotelImagesForBooking($id);
        $hotelPrices = $hotelObj->getHotelPricesForBooking($id);
        $counterImage = 0;

        $review = new Review();
        $results = $review->getSingleHotelReview($id);

        if (count($hotelSelected) === 0) {
            header('location: notfound.php');
        }
        ?>

        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            include "navbar_User.php";
            echo "<script>var userID = " . $_SESSION['user_id'] . ";";
            echo "var userIsLoggedIn = true;</script>";
        } else if (!isset($_SESSION['username'])) {
            include "navbar_nonUser.php";
            echo "<script>var userIsLoggedIn = false;</script>";
        }
        ?>
        <link rel="stylesheet" href="css/booking.css">
        <section class="ftco-section">
            <div class="container">
                <!--First Row Starts Here -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach ($hotelImagesSelected as $rowImage) : ?>
                                        <div class="carousel-item <?php
                                                                    if ($counterImage == 0) {
                                                                        echo ' active';
                                                                        $counterImage++;
                                                                    }
                                                                    ?>">
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
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 sidebar ftco-animate pl-md-5">
                        <h1 class="hotel_selected"><?= $hotelSelected['name'] ?></h1>
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
                                <!--<span id="error"></span>-->
                            </div>
                        </form>
                        <p>
                            <h2 id="price"></h2>
                        </p>
                        <div id="descriptionArea"></div>
                        <hr />
                    </div>
                </div>
                <!--First Row End Here -->

                <!--Review Section Starts Here -->
                <div class="container review-container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel-heading">
                                <h3 class="panel-title">Recent Reviews</h3>
                            </div>
                            <div id="reviewsSection" class="panel-body">
                                <?php if (count($results) === 0) : ?>
                                    <script>
                                        var noReviews = true;
                                    </script>
                                    <div id="emptyReview">
                                        <h6 class="text-center mt-5 mb-5">Hmmm, looks like there's no reviews for this hotel yet..</h6>
                                        <hr />
                                    </div>
                                <?php else : ?>
                                    <script>
                                        var noReviews = false;
                                        dayjs.extend(window.dayjs_plugin_relativeTime);
                                        const now = dayjs();
                                    </script>
                                    <?php foreach ($results as $row) : ?>
                                        <div class=reviewItem mt-3">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <p class="float-left">Posted by : &nbsp;&nbsp;&nbsp;<?= $row['username'] ?></p>
                                                    <p id="reviewDate<?= $row['id'] ?>" class="ml-auto"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5><?= $row['title'] ?></h5>
                                                </div>
                                                <div class="col-md-12">
                                                    <p><?= $row['content'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <script>
                                            if (now.diff('<?= $row['created_at'] ?>', 'day') < 7) {
                                                var relativePostedTime = dayjs().to(dayjs('<?= $row['created_at'] ?>'));
                                                document.getElementById('reviewDate<?= $row['id'] ?>').innerHTML = relativePostedTime;
                                            } else {
                                                var createdAt = dayjs('<?= $row['created_at'] ?>').format('D MMM YYYY');
                                                document.getElementById('reviewDate<?= $row['id'] ?>').innerHTML = createdAt;
                                            }
                                        </script>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php if (isset($_SESSION['username'])) : ?>
                                <div>
                                    <div class="mt-5">
                                        <h3>Share your experience</h1>
                                            <label for="inputReviewTitle">Title your Review</label>
                                            <input type="text" id="inputReviewTitle" style="min-width: 100%" placeholder="If you could describe your experience in one sentence, what would it be?"></input>

                                            <label for="inputReviewContent" class="mt-3">Your Review</label>
                                            <textarea id="inputReviewContent" rows="5" style="min-width: 100%" placeholder="Need some help? Why not start by describing the service quality and the amenities!"></textarea>
                                    </div>
                                    <button id="btnPost" class="btn btn-primary float-right">Post Review</button>
                                </div>
                            <?php else : ?>
                                <div class="mt-5">
                                    <p class="text-center">Please <a href="https://sitvago.com/loginpage.php">Sign in</a> or <a href="https://sitvago.com/register.php">Register an account</a> to post a review.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <!--Review Section End Here -->
            </div>
        </section>
        <?php
        include "footer.php";
        ?>

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
        <script src="js/star-rating.min.js"></script>
        <script src="external_css/krajee-fas/theme.min.js"></script>


        <script>
            var hotelID = <?= $id ?>;
            var userName = "<?= $_SESSION['username'] ?>";

            var hotelDescriptionText = decodeURI("<?= $hotelSelected['description'] ?>");
            document.getElementById("descriptionArea").innerHTML = hotelDescriptionText;

            var pricesData = new Object();
            <?php foreach ($hotelPrices as $prices) : ?>
                <?php $amtIn2DP = number_format((float) $prices['price_per_night'], 2, '.', ''); ?>
                pricesData["<?= $prices['room_category_id'] ?>"] = "<?= $amtIn2DP ?>";
            <?php endforeach; ?>

            $('select').on('change', function() {
                var id = $(this).children(":selected").attr("id");
                document.getElementById("price").innerHTML = "SGD$" + pricesData[id] + " per night";
                document.getElementById("amountPN").value = pricesData[id];
            });

            // $("#input-id").rating({min:1, max:10, step:2, size:'lg'});

            //The review section
            var buttonPost = document.getElementById("btnPost");

            if (userIsLoggedIn) {

            } else {

            }

            function WebFormInfo(userID, hotelID, reviewTitle, reviewContent, reviewRating) {
                this.option = "postReview";
                this.user_id = userID;
                this.hotel_id = hotelID;
                this.title = reviewTitle;
                this.content = reviewContent;
                this.rating = reviewRating;
            }

            var postReview = function(e) {
                var collectedTitle = $("#inputReviewTitle").val();
                var collectedContent = $("#inputReviewContent").val();

                var webFormData = new WebFormInfo(userID, hotelID, collectedTitle, collectedContent, 5);
                var webFormDataInString = JSON.stringify(webFormData);
                console.log(webFormDataInString);

                // If statement for future validation checks.
                if (true) {
                    $postReviewHandler = jQuery.ajax({
                        type: 'POST',
                        url: 'handler.php',
                        dataType: 'json',
                        contentType: 'application/json;',
                        data: webFormDataInString
                    })

                    $postReviewHandler.done(function(data) {
                        // Append the review to the list of reviews
                        console.log(data.message);
                        if (noReviews) {
                            document.getElementById("emptyReview").style.display = "none";

                            var reviewAreaElement = document.getElementById('reviewsSection');
                            reviewAreaElement.innerHTML += "<div class='reviewItem mt-3'><div class='col-md-12'><div class='row'>" +
                                "<p class='float-left'>Posted by : &nbsp;&nbsp;&nbsp;" + userName + "</p>" +
                                "<p id='reviewDate' class='ml-auto'>just now</p>" +
                                "</div></div><div class='row'><div class='col-md-12'><h5>" + collectedTitle + "</h5>" +
                                "</div><div class='col-md-12'><p>" + collectedContent + "</p></div></div></div><hr />";

                        } else {
                            var reviewAreaElement = document.getElementById('reviewsSection');
                            reviewAreaElement.innerHTML += "<div class='reviewItem mt-3'><div class='col-md-12'><div class='row'>" +
                                "<p class='float-left'>Posted by : &nbsp;&nbsp;&nbsp;" + userName + "</p>" +
                                "<p id='reviewDate' class='ml-auto'>just now</p>" +
                                "</div></div><div class='row'><div class='col-md-12'><h5>" + collectedTitle + "</h5>" +
                                "</div><div class='col-md-12'><p>" + collectedContent + "</p></div></div></div><hr />";
                        }

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                        Command: toastr["success"]("We have successfully published your review!", "Woots!")
                    });
                    $postReviewHandler.fail(function(jqXHR, textStatus, error) {
                        console.log(error);
                    });
                }
            }

            buttonPost.addEventListener('click', postReview, false);
        </script>
    </main>
</body>

</html>