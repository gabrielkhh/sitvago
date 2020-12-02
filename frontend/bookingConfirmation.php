<!DOCTYPE html>
<?php
session_start();


$data = $_SESSION['INFO'];
unset($_SESSION['INFO']);
?>
<html lang="en">

    <head>

        <title>Singapore Tourism Attraction </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

        <?php
        if (isset($_SESSION['username'])) {
            include "navbar_User.php";
        } else if (!isset($_SESSION['username'])) {
            include "navbar_nonUser.php";
        }

        $pass = true;
        ?>

<body>
    <link rel="stylesheet" href="css/booking.css">
    <div class="container my-card">
        <h2 id="card-h2">Thank you for using Sitvago</h2>
        <div class="card">
            <img class="card-img-top" src="images/logo_nobackground.png" alt="Card image" style="width:100%">
            <div class="card-body">
                <hr class="line"></hr>                    
                    <p class="card-text">
                        Congratulations! Your booking with <?= $data['hotelname'] ?> for <?= $data['duration'] ?> days is confirmed!<br>
                    <hr>
                    <strong>Transaction ID:</strong> <?= $data['stripeTxID'] ?><br>
                    <hr>
                    <strong>First Name:</strong> <?= $data['fname'] ?><br>
                    <hr>
                    <strong>Last Name:</strong> <?= $data['lname'] ?><br>
                    <hr>
                    <strong>Email Address:</strong> <?= $data['email'] ?><br>
                    <hr>
                    <strong>Room Type:</strong> <?= $data['roomtype'] ?><br>
                    <hr>                    
                    <strong>Amount paid:</strong> SGD$<?= $data['price'] ?><br>
                    <hr>  
                    Your booking details has been send to your email:<br><?= $data['email'] ?>
                </p>
            </div>
        </div>
		<?php
			include "footer.php";
		?>
</body>

</head>

</html>   

