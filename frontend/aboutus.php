<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sitvago's About Us Page </title>
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

        .jumbotron {
            background: url(../images/home_cover.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }

        .img-thumbnail {
            height: 150px;
        }

        .rounded {
            height: 100%;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/album.css" rel="stylesheet">

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
        <div class="bg-light">
            <div class="container py-5">
                <div class="row h-100 align-items-center py-5">
                    <div class="col-lg-6">
                        <h1 class="display-4">About Us</h1>
                        <p class="lead text-muted mb-0">Welcome to the Sitvago's Team, we are group of students at Singapore Institute of Technology.
                            We are a mixture of students from Software Engineering and Information Security. This is our website for our ICT1004 Project</p>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block"><img src="images/hotel/capella.jpg" alt="hotelpicture_for_aboutus" class="img-fluid"></div>
                </div>
            </div>
        </div>


        <div class="bg-light py-5">
            <div class="container py-5">
                <div class="row mb-4">
                    <div class="col-lg-5">
                        <h2 class="display-5 font-weight-light">Meet our Awesome Team</h2>
                        <p class="font-italic text-muted">Our team focus on making a hotel website which users are allowed to make reservations.</p>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="images/profilepic/zy.jpg" alt="profilepic of Zi Ying" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Zi Ying</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="images/profilepic/fm.jpg" alt="profilepic of Fumin" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Fu Min</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="images/profilepic/jx.jpg" alt="profilepic of Jing Xuan" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Soo Jing Xuan</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="images/profilepic/raina.jpg" alt="profilepic of Raina" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Raina</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 mb-5">
                        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="images/profilepic/gabriel.jpg" alt="profilepic of Gabriel" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Gabriel</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
</body>

</html>