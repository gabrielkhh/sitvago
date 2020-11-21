<?php 
require '../../vendor/autoload.php';
require_once '../../CloudinaryAPI.php';
 
//Namespace
use sitvago\GeoLocation;
 
$dataFromClient = json_decode(file_get_contents("php://input"), true);
 
if ($dataFromClient['option'] === 'createRegion')
{
    $geoLocation = new GeoLocation();
 
    $geoName = $dataFromClient['name'];
    $userID = $dataFromClient['id'];
    $result = $geoLocation->addGeoLocation($userID, $geoName);
    echo json_encode($result);
}
else if ($dataFromClient['option'] === 'updateHotel')
{
    // $hotel = new Hotel();
 
    // $hotelID = $dataFromClient['id'];
    // $hotelName = $dataFromClient['name'];
    // $hotelGeoLocation = $dataFromClient['geoLocation'];
    // $hotelDescription = $dataFromClient['description'];
    // $rating = 5.00;
    // $userID = 1;
 
    // $result = $hotel->updateHotel($hotelID, $hotelName, $hotelDescription, $hotelGeoLocation, $rating, $userID);
    // echo json_encode($result);
}
else if ($dataFromClient['option'] === 'deleteHotel')
{
    // $hotel = new Hotel();
 
    // $hotelID = $dataFromClient['id'];
    // $hotelName = $dataFromClient['name'];
 
    // $result = $hotel->deleteHotel($hotelID, $hotelName);
    // echo json_encode($result);
}
 
 
 
 
 
 
 
?>