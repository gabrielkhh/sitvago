<?php
$id = $_GET['key'];

require '../../vendor/autoload.php';

if (isset($_COOKIE['session_id']))
    session_id($_COOKIE['session_id']);
session_start();
if (!isset($_COOKIE['session_id']))
    setcookie('session_id', session_id(), 0, '/', '.sitvago.com');

if (!isset($_SESSION['username'])) {
    $Message = "Please log in as Admin to view this page";
    header("location: https://sitvago.com/loginpage.php?Message=" . urlencode($Message));
} else if ($_SESSION['role_name'] != "Administrator") {
    header("location: https://sitvago.com/forbidden.php");
}

use sitvago\Hotel;
use sitvago\GeoLocation;

$hotel = new Hotel();
$geo = new GeoLocation();
$resultsGeo = $geo->getGeoLocations();
$rowHotel = $hotel->getSingleHotel($id);
$resultsRoomCat = $hotel->getExistingHotelRoomCategories($id);
$hotelImages = $hotel->getHotelImagesForBooking($id);
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
    <title>Hotel Sitvago CMS - Update Hotel</title>
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
        <?php echo "<h1>Update details for " . $rowHotel['name'] . "</h1>"; ?>

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
                                                <label for="inputHotelName">Hotel Name</label>
                                                <?php
                                                echo "<input class='form-control' id='inputHotelName' placeholder='Hotel Name' value='" . $rowHotel['name'] . "'>";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="selectArea">Region</label>
                                                <select class="form-control" id="selectArea">
                                                    <option value="" disabled>Choose a region</option>
                                                    <?php
                                                    foreach ($resultsGeo as $row) {
                                                        if ($row['id'] === $rowHotel['geo_id']) {
                                                            echo "<option value='" . $row['name'] . "' selected>";
                                                            echo $row['name'];
                                                            echo "</option>";
                                                        } else {
                                                            echo "<option value='" . $row['name'] . "'>";
                                                            echo $row['name'];
                                                            echo "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hotelDescription">Hotel Description</label>
                                        <textarea class="form-control" id="hotelDescription"></textarea>
                                        <script>
                                            CKEDITOR.replace('hotelDescription');
                                            <?php
                                            echo "var encodedDataDescription = '" . $rowHotel['description'] . "';";
                                            echo "var decodedDataDescription = decodeURI(encodedDataDescription);";
                                            ?>
                                            CKEDITOR.instances['hotelDescription'].setData(decodedDataDescription);
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="hotelImages">Hotel Photos</label>
                                        <div class="row">
                                            <?php foreach ($hotelImages as $image) : ?>
                                                <div class="col-md-4" id="hotelImage<?= $image['id'] ?>">
                                                    <div class="card mb-4">
                                                        <img class="card-img-top" src="<?= $image['secure_url'] ?>" width="400" height="200" alt="Current Hotel Image">
                                                        <div class="card-body">
                                                            <h6 class="card-title">Citation Source URL:</h6>
                                                            <p class="card-text"><?= $image['original_src'] ?></p>
                                                            <div class="text-center">
                                                                <button type="button" value="<?= $image['id'] ?>" class="btn btn-danger text-center delete-img">Delete Image</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
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
                                                    <input class="amount-class" type="number" step=".01" name="<?= $rowRoomCat['category_name'] ?>" value="<?= $rowRoomCat['price_per_night'] ?>" class="form-control" aria-label="Amount">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
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
    var hotelID = <?= $id; ?>;
    var hotelName = "<?= $rowHotel['name']; ?>";
</script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var buttonSave = document.getElementById("btnSave");
        var buttonsDeleteImage = document.getElementsByClassName("delete-img");
        var buttonDelete = document.getElementById("btnDelete");
        var buttonCancel = document.getElementById("btnCancel");

        function WebFormInfo(inOption, hotelID, hotelName, hotelGeoLocation, hotelDescription, amounts) {
            this.option = inOption;
            this.id = hotelID;
            this.name = hotelName;
            this.geoLocation = hotelGeoLocation;
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
                obj["id"] = hotelID;
                obj["hotelName"] = hotelName;
                obj["option"] = "updateHotel";
                console.log(obj);
                return obj;
                // return out;
            }
        })
        window.$hotelImageInputElement.on('filebatchuploadsuccess',
            function(event, data, previewId, index) {
                swal({
                    title: "Updated Hotel Information",
                    text: data.message,
                    icon: "success"
                }).then(function() {
                    window.location = "index.php";
                });
            });

        var saveHotel = function(e) {
            hotelName = $("#inputHotelName").val();
            var collectedHotelName = $("#inputHotelName").val();
            var collectedGeoLocation = $("#selectArea").val();
            var collectedHotelDescription = encodeURI(CKEDITOR.instances.hotelDescription.getData());
            var id = $(this).attr("value");

            var collectedAmt = {};

            var amtIsValid = true;

            $('.amount-class').each(function(i) {
                var nameType = $(this).attr('name');
                var val = $(this).val();
                if (val === null || val === "")
                {
                    amtIsValid = false;
                }
                collectedAmt[nameType] = val;
            });
            console.log(collectedAmt);

            var webFormData = new WebFormInfo("updateHotel", id, collectedHotelName, collectedGeoLocation, collectedHotelDescription, JSON.stringify(collectedAmt));
            var webFormDataInString = JSON.stringify(webFormData);
            console.log(webFormDataInString);

            var isValid = false;

            if ((collectedHotelName !== "") && (collectedGeoLocation !== "" && collectedGeoLocation !== null) && (collectedHotelDescription !== "")) {
                //Inputs are not empty
                isValid = true;
            }

            // If statement for future validation checks.
            if (isValid && amtIsValid) {
                $saveHotelHandler = jQuery.ajax({
                    type: 'PUT',
                    url: 'hotel_handler.php',
                    dataType: 'json',
                    contentType: 'application/json;',
                    data: webFormDataInString
                })

                $saveHotelHandler.done(function(data) {

                    window.$hotelImageInputElement.fileinput('upload');

                });
                $saveHotelHandler.fail(function(jqXHR, textStatus, error) {
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

        var deleteHotel = function(e) {
            var webFormData = new WebFormInfo("deleteHotel", hotelID, hotelName, "", "");
            var webFormDataInString = JSON.stringify(webFormData);

            swal({
                    title: "Are You Sure?",
                    text: "You are about to remove " + hotelName + " from existence.",
                    icon: "warning",
                    buttons: ["Nope", "Confirm Plus Chop"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $saveHotelHandler = jQuery.ajax({
                            type: 'DELETE',
                            url: 'hotel_handler.php',
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

        var cancelHotel = function(e) {
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

        var deleteHotelImage = function(e) {
            var imgId = $(this).attr("value");

            function deleteImgObj(inOption, imageID) {
                this.option = inOption;
                this.id = imageID;
            }

            var deleteImgData = new deleteImgObj("deleteHotelImage", imgId);
            var deleteImgDataInString = JSON.stringify(deleteImgData);

            $deleteImageHandler = jQuery.ajax({
                type: 'DELETE',
                url: 'hotel_handler.php',
                dataType: 'json',
                contentType: 'application/json;',
                data: deleteImgDataInString
            })

            $deleteImageHandler.done(function(data) {
                //Remove the card from view.
                document.getElementById("hotelImage" + imgId).style.display = "none";

            });
            $deleteImageHandler.fail(function(jqXHR, textStatus, error) {
                swal({
                    title: "Something Went Wrong :(",
                    text: textStatus,
                    icon: "error"
                });
            });
            console.log(imgId);
        }

        buttonSave.addEventListener('click', saveHotel, false);
        buttonCancel.addEventListener('click', cancelHotel, false);
        buttonDelete.addEventListener('click', deleteHotel, false);

        for (var i = 0; i < buttonsDeleteImage.length; i++) {
            buttonsDeleteImage[i].addEventListener('click', deleteHotelImage, false);
        }
    });


    // Your code to save "data", usually through Ajax.
</script>