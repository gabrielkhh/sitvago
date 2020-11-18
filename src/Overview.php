<?php

namespace sitvago;

class Overview extends DB
{
    public function getCount()
    {
        $results = [];
        $sqlHotel = "SELECT COUNT(id) AS 'HotelCount' FROM Hotel;";
        $sqlUser = "SELECT COUNT(id) AS 'UserCount' FROM User;";
        
        $resultHotel = mysqli_query($this->conn, $sqlHotel);
        $resultUser = mysqli_query($this->conn, $sqlUser);

        $rowHotel = mysqli_fetch_assoc($resultHotel);
        $rowUser = mysqli_fetch_assoc($resultUser);

        $results[] = $rowHotel;
        $results[] = $rowUser;

        return $results;
    }




}