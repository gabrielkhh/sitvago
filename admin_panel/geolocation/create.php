<?php
require '../../vendor/autoload.php';

session_start();

if (!isset($_SESSION['username'])) {
    $Message = "Please log in as Admin to view this page";
    header("location: ../frontend/loginpage.php?Message=" . urlencode($Message));
} else if ($_SESSION['role_name'] != "Administrator") {
    $Message = "You do not have permission to view this page";
    header("location: ../frontend/home.php?Message=" . urlencode($Message));
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
    <title>Hotel Sitvago CMS - Create Geo Location</title>
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
        <h1>Add a New Geo Location</h1>

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
                                                <label for="inputRegionName">Region Name</label>
                                                <input class="form-control" id="inputRegionName" placeholder="Region Name">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="float-right">
                                    <button id="btnCancel" class="btn btn-danger">Cancel</button>
                                    <button id="btnSave" class="btn btn-primary">Add Region</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end of div element with class="panel-body" -->
                </div><!-- end of div element with class="panel" -->
            </div> <!-- end of div element with  class="col-md-offset-2  col-md-8"-->
        </div><!-- end of div element with class="row"-->

    </main>
    <!-- <?php
            include "../../footer.inc.php";
            ?> -->
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var buttonSave = document.getElementById("btnSave");
        var buttonCancel = document.getElementById("btnCancel");

        function WebFormInfo(geoName, id) {
            this.option = "createRegion";
            this.name = geoName;
            this.id = id;
        }

        var saveRegion = function(e) {
            var collectedRegionName = $("#inputRegionName").val();

            var webFormData = new WebFormInfo(collectedRegionName, 1);
            var webFormDataInString = JSON.stringify(webFormData);

            // If statement for future validation checks.
            if (true) {
                $saveHotelHandler = jQuery.ajax({
                    type: 'POST',
                    url: 'geo_handler.php',
                    dataType: 'json',
                    contentType: 'application/json;',
                    data: webFormDataInString
                })

                $saveHotelHandler.done(function(data) {
                    swal({
                        title: "Saved Geo-Location!",
                        text: data.message,
                        icon: "success"
                    }).then(function() {
                        window.location = "index.php";
                    });
                });
                $saveHotelHandler.fail(function(jqXHR, textStatus, error) {
                    swal({
                        title: "Something Went Wrong :(",
                        text: "Test",
                        icon: "error"
                    });
                });
            }
        }

        var cancelGeo = function(e) {
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

        buttonSave.addEventListener('click', saveRegion, false);
        buttonCancel.addEventListener('click', cancelGeo, false);
    });
</script>