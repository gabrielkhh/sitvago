<?php 
require '../../vendor/autoload.php';
 
//Namespace
use sitvago\Hotel;
 
$dataFromClient = json_decode(file_get_contents("php://input"), true);
 
if ($dataFromClient['option'] === 'createHotel')
{
    $hotel = new Hotel();
 
    $hotelName = $dataFromClient['name'];
    $hotelGeoLocation = $dataFromClient['geoLocation'];
    $hotelDescription = $dataFromClient['description'];
    $rating = 5.00;
    $userID = 1;
 
    $result = $hotel->addHotel($hotelName, $hotelDescription, $rating, $userID, $hotelGeoLocation);
    echo json_encode($result);
}
else if ($dataFromClient['option'] === 'updateHotel')
{
    $hotel = new Hotel();
 
    $hotelID = $dataFromClient['id'];
    $hotelName = $dataFromClient['name'];
    $hotelGeoLocation = $dataFromClient['geoLocation'];
    $hotelDescription = $dataFromClient['description'];
    $rating = 5.00;
    $userID = 1;
 
    $result = $hotel->updateHotel($hotelID, $hotelName, $hotelDescription, $hotelGeoLocation, $rating, $userID);
    echo json_encode($result);
}
else if ($dataFromClient['option'] === 'deleteHotel')
{
    $hotel = new Hotel();
 
    $hotelID = $dataFromClient['id'];
    $hotelName = $dataFromClient['name'];
 
    $result = $hotel->deleteHotel($hotelID, $hotelName);
    echo json_encode($result);
}

 
 
?>