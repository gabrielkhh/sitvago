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
    $amounts = json_decode($dataFromClient['amounts'], true);
    $rating = 5.00;
    $userID = 1;
 
    $result = $hotel->addHotel($hotelName, $hotelDescription, $rating, $userID, $hotelGeoLocation, $amounts);
    echo json_encode($result);
}
else if ($dataFromClient['option'] === 'updateHotel')
{
    $hotel = new Hotel();
 
    $hotelID = $dataFromClient['id'];
    $hotelName = $dataFromClient['name'];
    $hotelGeoLocation = $dataFromClient['geoLocation'];
    $hotelDescription = $dataFromClient['description'];
    $amounts = json_decode($dataFromClient['amounts'], true);
    $rating = 5.00;
    $userID = 1;
 
    $result = $hotel->updateHotel($hotelID, $hotelName, $hotelDescription, $hotelGeoLocation, $rating, $userID, $amounts);
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
else if ($dataFromClient['option'] === 'deleteHotelImage')
{
    $hotel = new Hotel();
 
    $imageID = $dataFromClient['id'];
 
    $result = $hotel->deleteHotelImage($imageID);
    echo json_encode($result);
}

 
 
?>