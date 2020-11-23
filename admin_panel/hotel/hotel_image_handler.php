<?php
require '../../vendor/autoload.php';
require_once '../../CloudinaryAPI.php';

use sitvago\Hotel;

\Cloudinary::config(array(
    "cloud_name" => "redacted",
    "api_key" => "redacted",
    "api_secret" => "tRyHaRdErNeXtTiMe",
    "secure" => true
));

$hotelName = $_POST['hotelName'];
$hotelID = $_POST['id'];
$results = [];
$files = array();

if (empty($_FILES['fileInput'])) {
    //Sibei jialat, got no image coming from the frontend.
    echo "sibei jialat";
} else {
    $totalFiles = count($_FILES['fileInput']['name']); // multiple files

    for ($i = 0; $i < $totalFiles; $i++) {
        // $tmpFilePath = $_FILES[$input]['tmp_name'][$i]; // the temp file path
        // $fileName = $_FILES[$input]['name'][$i]; // the file name
        // $fileSize = $_FILES[$input]['size'][$i]; // the file size

        $pathOfImage = "sitvago/hotels/" . $hotelName . "/". $hotelID . "/" . $_FILES['fileInput']['name'][$i];

        $files['imgCloudinaryData'] = \Cloudinary\Uploader::upload($_FILES['fileInput']['tmp_name'][$i], array("public_id" => $pathOfImage));
        // echo $files['imgCloudinaryData']['secure_url'];
        // echo $files['imgCloudinaryData']['bytes'];
        $secure_url = $files['imgCloudinaryData']['secure_url'];
        $width = $files['imgCloudinaryData']['width'];
        $height = $files['imgCloudinaryData']['height'];
        $imgExtension = $files['imgCloudinaryData']['format'];

        //Save the information into HotelImages Table
        $hotel = new Hotel();
        $results = $hotel->addHotelImage($hotelID, $secure_url, $width, $height, $imgExtension);
    }
}
echo "{}";
return '{}';
