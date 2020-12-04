<!DOCTYPE html>
<?php
require '../vendor/autoload.php';

use sitvago\FAQ;

$faqObj = new FAQ();
$results = $faqObj->getFAQsPublic();
$resultsCats = $faqObj->getFAQCategoriesPublic();

?>

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

        body {
            background-color: #f8f9fa;
        }

        .jumbotron {
            background: url(../images/home_cover.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }

        p {
            margin-bottom : 0rem;
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
                <?php foreach ($resultsCats as $cat) : ?>
                    <div class="faqHeader"><?= $cat['category_name'] ?></div>
                    <?php foreach ($results as $row) : ?>
                        <?php if ($row['cat_id'] === $cat['id']) : ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-header">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $row['id'] ?>"><?= $row['question'] ?></a>
                                    </h4>
                                </div>
                                <div id="collapse<?= $row['id'] ?>" class="panel-collapse collapse in">
                                    <div id="answer<?= $row['id'] ?>" class="card-body">
                                    </div>
                                    <script>
                                        var text = decodeURI("<?= $row['answer'] ?>");
                                        document.getElementById('answer<?= $row['id'] ?>').innerHTML = text;
                                    </script>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
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
        $(document).ready(function() {
            $(".mr-auto .nav-item").bind("click", function(event) {
                event.preventDefault();
                var clickedItem = $(this);
                $(".mr-auto .nav-item").each(function() {
                    $(this).removeClass("active");
                });
                clickedItem.addClass("active");
            });
        });
    </script>
</body>


</html>