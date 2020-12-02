<?php
require '../vendor/autoload.php';

//Namespace
use sitvago\Review;

$dataFromClient = json_decode(file_get_contents("php://input"), true);

if ($dataFromClient['option'] === "postReview") {
    $geoLocation = new Review();

    $userID = $dataFromClient['user_id'];
    $hotelID = $dataFromClient['hotel_id'];
    $reviewTitle = $dataFromClient['title'];
    $reviewContent = $dataFromClient['content'];
    $reviewRating = $dataFromClient['rating'];

    $result = $geoLocation->addReview($userID, $hotelID, $reviewTitle, $reviewRating, $reviewContent);
    echo json_encode($result);
}
