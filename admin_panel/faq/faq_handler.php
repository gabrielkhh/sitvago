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
    $faq = new FAQ();
 
    $faqQuestion = $dataFromClient['question'];
    $faqAnswer = $dataFromClient['answer'];
    $faqCategory = $dataFromClient['category'];
    $userID = $dataFromClient['user_id'];
    $faqID = $dataFromClient['faq_id'];
 
    $result = $faq->updateFAQ($faqID, $faqQuestion, $faqAnswer, $userID, $faqCategory);
    echo json_encode($result);
}
else if ($dataFromClient['option'] === 'deleteFAQ')
{
    $faq = new FAQ();
 
    $faqID = $dataFromClient['faq_id'];
 
    $result = $faq->deleteFAQ($faqID);
    echo json_encode($result);
}


?>