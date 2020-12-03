<?php 
require '../../vendor/autoload.php';

//Namespace
use sitvago\FAQ;
 
$dataFromClient = json_decode(file_get_contents("php://input"), true);
 
if ($dataFromClient['option'] === 'createFAQ')
{
    $faq = new FAQ();
 
    $faqQuestion = $dataFromClient['question'];
    $faqAnswer = $dataFromClient['answer'];
    $faqCategory = $dataFromClient['category'];
    $userID = $dataFromClient['user_id'];
 
    $result = $faq->addFAQ($faqQuestion, $faqAnswer, $faqCategory, $userID);
    echo json_encode($result);
}
else if ($dataFromClient['option'] === 'updateFAQ')
{
    // $hotel = new Hotel();
 
    // $hotelID = $dataFromClient['id'];
    // $hotelName = $dataFromClient['name'];
    // $hotelGeoLocation = $dataFromClient['geoLocation'];
    // $hotelDescription = $dataFromClient['description'];
    // $amounts = json_decode($dataFromClient['amounts'], true);
    // $rating = 5.00;
    // $userID = 1;
 
    // $result = $hotel->updateHotel($hotelID, $hotelName, $hotelDescription, $hotelGeoLocation, $rating, $userID, $amounts);
    // echo json_encode($result);
}
else if ($dataFromClient['option'] === 'deleteFAQ')
{
    // $hotel = new Hotel();
 
    // $hotelID = $dataFromClient['id'];
    // $hotelName = $dataFromClient['name'];
 
    // $result = $hotel->deleteHotel($hotelID, $hotelName);
    // echo json_encode($result);
}


?>