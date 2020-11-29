<?php
require '../../vendor/autoload.php';

use sitvago\GeoLocation;
use sitvago\Hotel;

$geo = new GeoLocation();
$roomCat = new Hotel();
$results = $geo->getGeoLocations();
$resultsRoomCat = $roomCat->getRoomCategories();
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
    <title>Hotel Sitvago CMS - Create Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS Sources-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="../css/fileinput.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <!--JS Sources-->
    <script src="https://kit.fontawesome.com/ebd40a1317.js" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script src="../js/plugins/piexif.min.js"></script>
    <script src="../js/plugins/sortable.min.js"></script>
    <script defer src="../js/fileinput.min.js"></script>
    <script defer src="../js/theme.min.js"></script>
    <script defer src="/js/main.js"></script>
</head>

<body style="padding-top: 70px;">
    <?php
    include "../navbar_Admin.php";
    ?>
    <main class="container main-content mt-2">
        <h1>Add a New Hotel</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="row mb-2">

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputHotelName">Hotel Name</label>
                                                <input class="form-control" id="inputHotelName" placeholder="Hotel Name">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="selectArea">Region</label>
                                                <select class="form-control" id="selectArea">
                                                    <option value="" selected disabled>Choose a region</option>
                                                    <?php foreach ($results as $row) : ?>
                                                        <option value="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hotelDescription">Hotel Description</label>
                                        <textarea class="form-control" id="hotelDescription"></textarea>
                                        <script>
                                            CKEDITOR.replace('hotelDescription');
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="hotelImages">Hotel Photos</label>
                                        <div class="forFileUploads">
                                            <input id="fileInput" name="fileInput[]" type="file" class="file input-group-lg" multiple />
                                        </div>
                                    </div>
                                    <div class="form-group price-room-category">
                                        <?php foreach ($resultsRoomCat as $rowRoomCat) : ?>
                                            <div class="row col-md-4">
                                                <label for="hotelImages">Set price per night for <?= $rowRoomCat['category_name'] ?></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input class="amount-class" type="number" step=".01" name="<?= $rowRoomCat['category_name'] ?>" class="form-control" aria-label="Amount">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </form>
                                <div class="float-right">
                                    <button id="btnCancel" class="btn btn-danger">Cancel</button>
                                    <button id="btnSave" class="btn btn-primary">Add Hotel</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end of div element with class="panel-body" -->
                </div><!-- end of div element with class="panel" -->
            </div> <!-- end of div element with  class="col-md-offset-2  col-md-8"-->
        </div><!-- end of div element with class="row"-->

    </main>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var insertedHotelId;
        var insertedHotelName;

        var buttonSave = document.getElementById("btnSave");
        var buttonCancel = document.getElementById("btnCancel");

        function WebFormInfo(hotelName, hotelArea, hotelDescription, amounts) {
            this.option = "createHotel";
            this.name = hotelName;
            this.geoLocation = hotelArea;
            this.description = hotelDescription;
            this.amounts = amounts;
        }

        window.$hotelImageInputElement = $('#fileInput');

        var footerTemplate = '<div class="file-thumbnail-footer" style ="height:94px">\n' +
            '  <input class="kv-input kv-new form-control input-sm form-control-sm text-center {TAG_CSS_NEW}" value="{caption}" placeholder="Enter caption..." readonly>\n' +
            '  <input class="kv-input kv-init form-control input-sm form-control-sm text-center {TAG_CSS_INIT}" value="{TAG_VALUE}" placeholder="Enter Citation Source URL">\n' +
            '   <div class="small" style="margin:15px 0 2px 0">{size}</div> {progress}\n{indicator}\n{actions}\n' +
            '</div>';

        $('#fileInput').fileinput({
            theme: 'fas',
            previewFileType: 'image',
            allowedFileTypes: ['image'],
            uploadUrl: 'hotel_image_handler.php',
            validateInitialCount: true,
            uploadAsync: false,
            maxFileCount: 20,
            layoutTemplates: {
                footer: footerTemplate
            },
            previewThumbTags: {
                '{TAG_VALUE}': '', // no value
                '{TAG_CSS_NEW}': '', // new thumbnail input
            },
            // layoutTemplates: { footer: footerTemplate, actions: actionTemplate },
            msgInvalidFileType: 'Invalid type for file "{name}". Only "{types}" files are supported.',
            autoReplace: true,
            /*http://plugins.krajee.com/file-auto-replace-demo*/
            overwriteInitial: false,
            showUploadedThumbs: false,
            showUpload: false,
            showRemove: false,
            browseClass: 'btn btn-primary btn-md pull-right',
            previewFileIcon: '<i class="glyphicon glyphicon-king"></i>',
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif', 'tiff'],
            ajaxSettings: {
                // dataType: 'jsonp',
                type: 'post',
                contentType: false,
                crossDomain: true
            },
            uploadExtraData: function() { // callback example
                var obj = {};

                $('.kv-init:visible').each(function(i) {
                    var val = $(this).val();
                    obj[i] = val;
                });
                obj["id"] = insertedHotelId;
                obj["hotelName"] = insertedHotelName;
                console.log(obj);
                return obj;
                // return out;
            }
        })
        window.$hotelImageInputElement.on('filebatchuploadsuccess',
            function(event, data, previewId, index) {
                console.log(data);

                swal({
                    title: "Saved Hotel",
                    text: data.message,
                    icon: "success"
                }).then(function() {
                    window.location = "index.php";
                });
            });
        // window.$hotelImageInputElement.on('filebatchuploaderror',
        //     function(event, data, msg) {
        //         console.log("lmfao");
        //         console.log(data);
        //         console.log(msg);
        //     });

        var saveHotel = function(e) {
            var collectedHotelName = $("#inputHotelName").val();
            var collectedArea = $("#selectArea").val();
            var collectedHotelDescription = encodeURI(CKEDITOR.instances.hotelDescription.getData());

            var collectedAmt = {};

            $('.amount-class').each(function(i) {
                var nameType = $(this).attr('name');
                var val = $(this).val();
                collectedAmt[nameType] = val;
            });
            console.log(collectedAmt);


            var webFormData = new WebFormInfo(collectedHotelName, collectedArea, collectedHotelDescription, JSON.stringify(collectedAmt));
            var webFormDataInString = JSON.stringify(webFormData);
            console.log(webFormDataInString);

            // CKEDITOR.instances['hotelDescription'].dataProcessor.toHtml("<p>Something just like this</p>");

            // If statement for future validation checks.
            if (true) {
                $saveHotelHandler = jQuery.ajax({
                    type: 'POST',
                    url: 'hotel_handler.php',
                    dataType: 'json',
                    contentType: 'application/json;',
                    data: webFormDataInString
                })

                $saveHotelHandler.done(function(data) {
                    //Upload photos after saving basic entries about the hotel.
                    insertedHotelId = data.insertedID;
                    insertedHotelName = data.insertedName;
                    window.$hotelImageInputElement.fileinput('upload');


                });
                $saveHotelHandler.fail(function(jqXHR, textStatus, error) {
                    swal({
                        title: "Something Went Wrong :(",
                        text: "Test",
                        icon: "error"
                    });
                    console.log(error);
                    console.log(textStatus);
                    console.log(jqXHR);
                });
            }
        }

        var cancelHotel = function(e) {
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

        buttonSave.addEventListener('click', saveHotel, false);
        buttonCancel.addEventListener('click', cancelHotel, false);
    });
</script>