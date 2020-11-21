<?php
require '../../vendor/autoload.php';

use sitvago\GeoLocation;

$geolocation = new GeoLocation();
$results = $geolocation->getGeoLocations();
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
    <title>Hotel Sitvago CMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS Sources-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">

    <!--JS Sources-->
    <script src="https://kit.fontawesome.com/ebd40a1317.js" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script defer src="/js/main.js"></script>
</head>

<body>
    <!-- <?php
            include "../../nav.inc.php";
            ?> -->
    <main class="container main-content">
        <h1>Viewing All Geo-Locations</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="row mb-2">
                        <div class="col-md-10">
                            <h3>Manage Geo-Locations (Regions)</h3>
                        </div>
                        <div class="col-md-2">
                            <a role="button" class="float-right btn btn-info" href="create.php">Add Geo-Location</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-dark">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Region Name</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Updated By</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody id="regionTableBody" class="">
                                        <?php foreach ($results as $row) : ?>
                                            <tr>
                                                <td><?= $row['name'] ?></td>
                                                <td>TEST</td>
                                                <td><?= $row['created_by'] ?></td>
                                                <td><?= $row['updated_by'] ?></td>
                                                <td><a role="button" class="btn btn-primary updateBtn" href="update.php?key=<?= $row['id'] ?>" value="<?= $row['id'] ?>">Update</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- <?php
        include "../../footer.inc.php";
    ?> -->
</body>


</html>