<!DOCTYPE html>
<?php
session_start();

if (isset($_GET['Message'])) {
    // unset($_SESSION['username']);
    print '<script>alert("' . $_GET['Message'] . '");</script>';
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
}
?>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html lang="en">
    <head>

        <title>Singapore Tourism Attraction Login Page</title>
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

            .mb-4{
                width:300px;
                height:110px;
            }
        </style>
        <!-- Custom styles for this template -->
        <link href="css/cover.css" rel="stylesheet">
        <link href='css/signin.css' rel="stylesheet">
    </head>
    <body class="text-center">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                    <nav class="nav nav-masthead justify-content-center">
                        <a class="nav-link active" href="aboutus.php">About Us</a>
                        <a class="nav-link active" href="home.php">Home</a>
                    </nav>
                </div>
            </header>

            <div class="form-signin">
                <form action="user_handler.php" method="post">
                    <img class="mb-4" src="images/logo_nobackground.png" alt="mainpagelogo">
                    <p> Login to access our site or <a href="register.php" class="font-weight-bolder" >Register</a> with us </p>

                    <!-- Remember to add 'required' field later, currently remove for demo purpose -->
                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text" id="inputUsername" class="form-control" placeholder="Username"  name="username" required autofocus >

                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required >

                    <button type="submit" id="submitBtn" name="login_user" class="btn btn-lg btn-primary btn-block">Login </button>
                    <div id="errMsg">
                        <?php
                        if (!empty($_SESSION['errMsg'])) {
                            echo $_SESSION['errMsg'];
                        }

                        unset($_SESSION['errMsg']);
                        ?>
                    </div>			
                </form>
            </div>
            <footer class="container">
                <div style="text-align:center;">
                    <p>&copy; Sitvago 2020</p>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Learn more about Sitvago and the team behind it.</a>
                </div>
            </footer>
        </div>
    </body>
</html>