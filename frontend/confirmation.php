<html>
    <head>

        <title>Singapore Tourism Attraction </title>
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
        
        
        <!-- For Calender --> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <!--<script src='https://kit.fontawesome.com/a076d05399.js'></script>-->
         <!-- Own Script -->
        <script defer src="js/confirmation.js"></script>
        <script defer src="js/booking.js"></script>
        
 <?php
 
 $cout_date = $cin_date = $type = $price ="";
 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //$cout_date = $_GET['checkin'];
    //$cin_date = $_GET['checkout'];
    $type = $_GET['TypeOfRooms'];
    //echo "cout". $cout_date . "and" . $cin_date;
}


 
 ?>

 <?php
    include "navbar.php"
     /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    

     /* 
     * User must able to search the calender start and end date.
     * If there's no hotel avaliable, it wil be grey out
     * When user press the view button it will go to this booking page 
     * All hotels have the same booking page but the details will be fetched from db by hotel_ID
     * Images of room available in booking page 
     * Must shows date so that user can change without going back 
     * Book now = processBooking it will show all the hotel details and auto fill or manual entry
     * Payment pass, send email to user 
     */
     ?>
</head>
<body>

<div class="row">
  <div class="col-75">
    <div class="container">
    <form action="confirmationProcess.php" method ="post" id="booking_form" autocomplete="on">
        <link rel="stylesheet" href="css/confirmation.css">     
        <h1 class="book_confirm">Booking Confirmation</h1>
        <div class="row">
          <div class="col-50">
            <label for="name"><i class="fa fa-user"></i> Full Name</label>
            <input class="confirm_input" type="text" id="name" name="name" placeholder="Auto-Fill">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input class="confirm_input" type="text" id="email" name="email" placeholder="Auto-Fill" required name="email">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input class="confirm_input" type="text" id="adr" name="address" placeholder="Auto-Fill">
            <label for="city"><i class="fa fa-institution"></i> Country</label>
            <input class="confirm_input" type="text" id="city" name="city" placeholder="Auto-Fill">
          </div>

          <div class="col-50">
            <label for="check-in-confirm"><i class="fa fa-calendar-check-o"></i> Check In Date</label>
                <input class="confirm_input" type="text" id="ci_date" name="check-in-confirm" value="">
            <label for="check-out-confirm"><i class="fa fa-calendar-check-o"></i> Check Out Date</label>
                <input class="confirm_input" type="text" id="co_date" name="check-out-confirm" value="">
            <label for="room-type"><i class="fa fa-bed"></i> Room Type</label>
                <input class="confirm_input" type="text" id="room-type" name="room-type" value="<?php echo $type;?>">
            <label for="room-type"><i class="fa fa-exclamation-circle"></i> Notice</label>
                 <p>Do take not that we are only reserving the room for you!<br> Availability is up to the hotel. Have a nice day :) </p>
          </div>
          
        </div>
        <label>
            <input type="checkbox" name="accDetails" id="details_check_box"> Confirm Details
        </label>
        <input type="submit" value="Confirm Booking" class="btn" id="confirm_book_btn">
    </form>
    </div>
  </div>
    
  <div class="col-25">
    <div class="container">
      <p>Room Fee<span class="price">$99.9</span></p>
      <p>Booking Fee<span class="price">$0.01</span></p>
      <p>Total <span class="price" style="color:black"><b>$100</b></span></p>
    </div>
  </div>
</div>

</body>
</html>