<?php

namespace sitvago;

class GeoLocation extends DB
{
    public function getGeoLocations()
    {
        $results = [];
        $sql = "SELECT GeoLocation.id, GeoLocation.name FROM GeoLocation";
        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }
        return $results;
    }
}