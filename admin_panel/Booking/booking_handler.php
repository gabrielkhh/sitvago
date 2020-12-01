<?php 
require '../../vendor/autoload.php';
 
//Namespace
use sitvago\Booking;
 
$dataFromClient = json_decode(file_get_contents("php://input"), true);

if ($dataFromClient['option'] === 'deleteBooking')
{
    $booking = new Booking();
 
    $bookingID = $dataFromClient['id'];
 
    $result = $booking->deleteBooking($bookingID);
    echo json_encode($result);
}
?>