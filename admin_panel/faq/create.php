<?php
require '../../vendor/autoload.php';

use sitvago\FAQ;

$faqCat = new FAQ();
$results = $faqCat->getFAQCategories();

if (isset($_COOKIE['session_id']))
    session_id($_COOKIE['session_id']);
session_start();
if (!isset($_COOKIE['session_id']))
    setcookie('session_id', session_id(), 0, '/', '.sitvago.com');

if (!isset($_SESSION['username'])) {
	$Message = "Please log in as Admin to view this page";
    header("location: https://sitvago.com/loginpage.php?Message=" .urlencode($Message));
}
else if($_SESSION['role_name']!= "Administrator"){
    header("location: https://sitvago.com/forbidden.php");
}

$userID = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Hotel Sitvago CMS - Create FAQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS Sources-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">

    <!--JS Sources-->
    <script src="https://kit.fontawesome.com/ebd40a1317.js" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script defer src="/js/main.js"></script>
</head>

<body style="padding-top: 70px;">
    <?php
    include "../navbar_Admin.php";
    ?>
    <main class="container main-content mt-2">
        <h1>Add a New FAQ</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="row mb-2">

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputQuestion">Question</label>
                                                <input class="form-control" id="inputQuestion" placeholder="Why Choose Sitvago?">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="selectCategory">Category</label>
                                                <select class="form-control" id="selectCategory">
                                                    <option value="" selected disabled>Choose a category</option>
                                                    <?php foreach ($results as $row) : ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="answer">Answer</label>
                                        <textarea class="form-control" id="answer"></textarea>
                                        <script>
                                            CKEDITOR.replace('answer');
                                        </script>
                                    </div>
                                </form>
                                <div class="float-right">
                                    <button id="btnCancel" class="btn btn-danger">Cancel</button>
                                    <button id="btnSave" class="btn btn-primary">Save FAQ</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end of div element with class="panel-body" -->
                </div><!-- end of div element with class="panel" -->
            </div> <!-- end of div element with  class="col-md-offset-2  col-md-8"-->
        </div><!-- end of div element with class="row"-->

    </main>
    <?php
    include "../footer.php";
    ?>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var userId = <?= $userID ?>;
        var buttonSave = document.getElementById("btnSave");
        var buttonCancel = document.getElementById("btnCancel");

        function WebFormInfo(faqQuestion, faqCategory, faqAnswer, userID) {
            this.option = "createFAQ";
            this.question = faqQuestion;
            this.category = faqCategory;
            this.answer = faqAnswer;
            this.user_id = userID
        }

        var saveFAQ = function(e) {
            var collectedQuestion = $("#inputQuestion").val();
            var collectedCategory = $("#selectCategory").val();
            var collectedAnswer = encodeURI(CKEDITOR.instances.answer.getData());


            var webFormData = new WebFormInfo(collectedQuestion, collectedCategory, collectedAnswer, userId);
            var webFormDataInString = JSON.stringify(webFormData);
            console.log(webFormDataInString);

            var isValid = false;

            if ((collectedQuestion !== "") && (collectedCategory !== "" && collectedCategory !== null) && (collectedAnswer !== ""))
            {
                //Inputs are not empty
                isValid = true;
            }

            if (isValid) {
                $saveFAQHandler = jQuery.ajax({
                    type: 'POST',
                    url: 'faq_handler.php',
                    dataType: 'json',
                    contentType: 'application/json;',
                    data: webFormDataInString
                })

                $saveFAQHandler.done(function(data) {
                    swal({
                        title: "Saved FAQ",
                        text: data.message,
                        icon: "success"
                    }).then(function() {
                        window.location = "index.php";
                    });
                    console.log(data);
                });
                $saveFAQHandler.fail(function(jqXHR, textStatus, error) {
                    swal({
                        title: "Something Went Wrong :(",
                        text: "There was an error saving the FAQ into the Database.",
                        icon: "error"
                    });
                });
            }
            else
            {
                swal({
                        title: "Invalid Fields",
                        text: "Please make sure that all fields are filled up.",
                        icon: "error"
                    });
            }
        }

        var cancelFAQ = function(e) {
            swal({
                    title: "Are You Sure?",
                    text: "Leave this page and return to the previous page?",
                    icon: "warning",
                    buttons: ["Nope", "Yes Of Course!"],
                    dangerMode: false,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location = "index.php";
                    }
                });
        }

        buttonSave.addEventListener('click', saveFAQ, false);
        buttonCancel.addEventListener('click', cancelFAQ, false);
    });
</script>