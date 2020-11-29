<?php
require '../../vendor/autoload.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

use sitvago\Hotel;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

\Cloudinary::config(array(
    "cloud_name" => $_SERVER['cloud_name'],
    "api_key" => $_SERVER['cloudinary_api_key'],
    "api_secret" => $_SERVER['cloudinary_secret_key'],
    "secure" => true
));

$hotelName = $_POST['hotelName'];
$hotelID = $_POST['id'];
$results = [];
$files = array();

if (empty($_FILES['fileInput'])) {
    //User did not add any files to upload
} else {
    $totalFiles = count($_FILES['fileInput']['name']); // multiple files

    for ($i = 0; $i < $totalFiles; $i++) {
        $imgIsThumbnail = 0;
        $pathOfImage = "sitvago/hotels/" . $hotelName . "/". $hotelID . "/" . $_FILES['fileInput']['name'][$i];
        $originalSrc = $_POST[$i];

        $files['imgCloudinaryData'] = \Cloudinary\Uploader::upload($_FILES['fileInput']['tmp_name'][$i], array("public_id" => $pathOfImage));
        $secure_url = $files['imgCloudinaryData']['secure_url'];
        $url = $files['imgCloudinaryData']['url'];
        $width = $files['imgCloudinaryData']['width'];
        $height = $files['imgCloudinaryData']['height'];
        $imgExtension = $files['imgCloudinaryData']['format'];

        if ($i === 0)
        {
            $imgIsThumbnail = 1;
        }

        //Save the information into HotelImages Table
        $hotel = new Hotel();
        $results = $hotel->addHotelImage($hotelID, $url, $secure_url, $width, $height, $imgExtension, $imgIsThumbnail, $originalSrc);
    }
}
echo "{}";
return '{}';
