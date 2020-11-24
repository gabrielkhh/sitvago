<?php

namespace sitvago;

class Overview extends DB
{
    public function getCount()
    {
        $results = [];
        $sqlHotel = "SELECT COUNT(id) AS 'HotelCount' FROM Hotel;";
        $sqlUser = "SELECT COUNT(id) AS 'UserCount' FROM User;";
        $sqlGeo = "SELECT COUNT(id) AS 'GeoCount' FROM GeoLocation;";
        
        $resultHotel = mysqli_query($this->conn, $sqlHotel);
        $resultUser = mysqli_query($this->conn, $sqlUser);
        $resultGeo = mysqli_query($this->conn, $sqlGeo);

        $rowHotel = mysqli_fetch_assoc($resultHotel);
        $rowUser = mysqli_fetch_assoc($resultUser);
        $rowGeo = mysqli_fetch_assoc($resultGeo);

        $results[] = $rowHotel;
        $results[] = $rowUser;
        $results[] = $rowGeo;

        return $results;
    }




}