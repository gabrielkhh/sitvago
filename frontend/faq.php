<!DOCTYPE html>

<html lang="en">

    <head>

        <title>Sitvago's FAQ </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- Font and Icons CSS -->
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <!--jQuery-->
        <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
        </script>

        <!-- Bootstrap -->
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous">
        </script>

        <script defer src="js/nav.js"></script>

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

            body{
                background-color: #f8f9fa;
            }

            .jumbotron {
                background: url(../images/home_cover.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
            }
        </style>
        <!-- Custom styles for this template -->
        <link href="css/faq.css" rel="stylesheet">

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
            <div class="container">
                <div class="container p-5 my-5 border-0 text-center">
                    <h1 class=display-3>Welcome to Sitvago's FAQ</h1>
                    <p>You can find common questions regarding our website here</p>
                </div>

                <div class="" id="accordion">
                    <div class="faqHeader">General questions</div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">How to login?</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="card-body">
                                First, account registration is needed. You can click on login, see top right in the navbar <strong>"Login"</strong>.
                                <br>You can register for an account if you do not have one. It's that simple :)
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">How to book our Hotels?</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="card-body">
                                The steps involved in this process are really simple. All you need to do is:
                                <ul>
                                    <li>Register an account</li>
                                    <li>Login into your account</li>
                                    <li>Go to the <strong>Home Page</strong>and select a desired hotel</li>
                                    <li>The next step is to book your hotels. See <strong>"Regarding Booking of our Hotels</strong> for more details</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Can I choose not to create an account?</a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="card-body">
                                Yes you can, however you will only be able to view our hotels. Booking is only available for registered users. See "<strong>General Questions - How to book a hotel?</strong>"
                            </div>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">Where to get our beautiful pictures?</a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse">
                            <div class="card-body">
                                We love to citate our images so that users can know where to get them.
                                <br>Sharing is Caring. Click <a href="citation.php">here</a> to view our citations.
                            </div>
                        </div>
                    </div>

                    <div class="faqHeader">Regarding Booking of our Hotels</div>
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Is refund possible after payment?</a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                            <div class="card-body">
                                Yes, to make a refund simply dial this hotline: 6235 3535 and our friendly customer service will assists you.
                                <br> Once Confirm, our admin will remove your booking and you will get your money back within 3 workings day.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Instructions on how to book our hotel </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                            <div class="card-body">
                                After you select your desired hotel, you will be brought to our booking page.
                                <ul>
                                    <li>Choose your check in/check out date</li>
                                    <li>Select your Room Type</li>
                                    <li>Click on <strong>Submit</strong> and you will be brought to payment page</li>
                                    <li>Final Step is fill in the payment form and click on submit.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container p-5 my-5 border-0"></div>
                </div>
            </div>
        </main>
        <?php
        include "footer.php";
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>
            window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
        </script>
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

        <!-- This is for the Active NavBar to auto change -->
        <script>
            $(document).ready(function () {
                $(".mr-auto .nav-item").bind("click", function (event) {
                    event.preventDefault();
                    var clickedItem = $(this);
                    $(".mr-auto .nav-item").each(function () {
                        $(this).removeClass("active");
                    });
                    clickedItem.addClass("active");
                });
            });
        </script>
    </body>


</html>