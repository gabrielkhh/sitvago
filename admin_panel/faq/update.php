<?php
$id = $_GET['key'];

require '../../vendor/autoload.php';

use sitvago\FAQ;

$faq = new FAQ();
$rowFAQ = $faq->getSingleFAQ($id);
$rowCategories = $faq->getFAQCategories();

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
    <title>Hotel Sitvago CMS - Update FAQ</title>
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
        <h1>Update FAQ details</h1>

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
                                                <?php
                                                echo "<input class='form-control' id='inputQuestion' placeholder='Why Choose Sitvago?' value='" . $rowFAQ['question'] . "'>";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="selectCategory">Category</label>
                                                <select class="form-control" id="selectCategory">
                                                    <option value="" disabled>Choose a category</option>
                                                    <?php
                                                    foreach ($rowCategories as $row) {
                                                        if ($row['id'] === $rowFAQ['category_id']) {
                                                            echo "<option value='" . $row['id'] . "' selected>";
                                                            echo $row['category_name'];
                                                            echo "</option>";
                                                        } else {
                                                            echo "<option value='" . $row['id'] . "'>";
                                                            echo $row['category_name'];
                                                            echo "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="answer">Answer</label>
                                        <textarea class="form-control" id="answer"></textarea>
                                        <script>
                                            CKEDITOR.replace('answer');
                                            <?php
                                            echo "var encodedDataDescription = '" . $rowFAQ['answer'] . "';";
                                            echo "var decodedDataDescription = decodeURI(encodedDataDescription);";
                                            ?>
                                            CKEDITOR.instances['answer'].setData(decodedDataDescription);
                                        </script>
                                    </div>
                                </form>
                                <div class="float-right">
                                    <?php echo "<button id='btnDelete' class='btn btn-danger' value='" . $id . "'>Delete</button>"; ?>
                                    <button id="btnCancel" class="btn btn-warning">Cancel</button>
                                    <?php echo "<button id='btnSave' class='btn btn-primary' value='" . $id . "'>Save Changes</button>"; ?>
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
<script type="text/javascript">
    var faqID = <?= $id; ?>;
    var userID = <?= $_SESSION['user_id'] ?>;
</script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var buttonSave = document.getElementById("btnSave");
        var buttonDelete = document.getElementById("btnDelete");
        var buttonCancel = document.getElementById("btnCancel");

        function WebFormInfo(faqQuestion, faqCategory, faqAnswer, userID, faqID) {
            this.option = "updateFAQ";
            this.question = faqQuestion;
            this.category = faqCategory;
            this.answer = faqAnswer;
            this.user_id = userID;
            this.faq_id = faqID
        }

        var saveFAQ = function(e) {
            var collectedQuestion = $("#inputQuestion").val();
            var collectedCategory = $("#selectCategory").val();
            var collectedAnswer = encodeURI(CKEDITOR.instances.answer.getData());

            var webFormData = new WebFormInfo(collectedQuestion, collectedCategory, collectedAnswer, userID, faqID);
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
                    type: 'PUT',
                    url: 'faq_handler.php',
                    dataType: 'json',
                    contentType: 'application/json;',
                    data: webFormDataInString
                })

                $saveFAQHandler.done(function(data) {
                    swal({
                        title: "Updated FAQ Information",
                        text: data.message,
                        icon: "success"
                    }).then(function() {
                        window.location = "index.php";
                    });
                });
                $saveFAQHandler.fail(function(jqXHR, textStatus, error) {
                    swal({
                        title: "Something Went Wrong :(",
                        text: textStatus,
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

        var deleteFAQ = function(e) {
            function WebFormDelete(faqID) {
                this.option = "deleteFAQ";
                this.faq_id = faqID
            }

            var webFormData = new WebFormDelete(faqID);
            var webFormDataInString = JSON.stringify(webFormData);

            swal({
                    title: "Are You Sure?",
                    text: "You are about to remove this FAQ from existence.",
                    icon: "warning",
                    buttons: ["Nope", "I'm very sure"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $saveHotelHandler = jQuery.ajax({
                            type: 'DELETE',
                            url: 'faq_handler.php',
                            dataType: 'json',
                            contentType: 'application/json;',
                            data: webFormDataInString
                        })

                        $saveHotelHandler.done(function(data) {
                            swal({
                                title: "Deleted!",
                                text: data.message,
                                icon: "success"
                            }).then(function() {
                                window.location = "index.php";
                            });
                            console.log(data);
                        });
                        $saveHotelHandler.fail(function(jqXHR, textStatus, error) {
                            swal({
                                title: "Something Went Wrong :(",
                                text: "There seems to be a problem with deletion.",
                                icon: "error"
                            });
                            console.log(error);
                            console.log(textStatus);
                            console.log(jqXHR);
                        });
                    }
                });
        }

        var cancelFAQ = function(e) {
            swal({
                    title: "Are You Sure?",
                    text: "You are about to discard any changes made and return back to the hotel lists page.",
                    icon: "warning",
                    buttons: ["Nope", "Confirm Plus Chop"],
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
        buttonDelete.addEventListener('click', deleteFAQ, false);
    });


    // Your code to save "data", usually through Ajax.
</script>