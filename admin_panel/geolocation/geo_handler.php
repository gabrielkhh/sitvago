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
else if ($dataFromClient['option'] === 'updateRegion')
{
    $geoLocation = new GeoLocation();

    $geoID = $dataFromClient['geoID'];
    $geoName = $dataFromClient['name'];
    $userID = $dataFromClient['userID'];
 
    $result = $geoLocation->updateGeoLocation($geoID, $geoName, $userID);
    echo json_encode($result);
}
else if ($dataFromClient['option'] === 'deleteRegion')
{
    $geoLocation = new GeoLocation();
 
    $geoID = $dataFromClient['geoID'];
    $regionName = $dataFromClient['name'];
 
    $result = $hotel->deleteGeoLocation($geoID, $regionName);
    echo json_encode($result);
}
 
 
 
 
 
 
 
?>