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
        $sqlBooking = "SELECT COUNT(id) AS 'BookingCount' FROM Booking;";
        $sqlReview = "SELECT COUNT(id) AS 'ReviewCount' FROM Review;";

        $resultHotel = mysqli_query($this->conn, $sqlHotel);
        $resultUser = mysqli_query($this->conn, $sqlUser);
        $resultGeo = mysqli_query($this->conn, $sqlGeo);
        $resultBooking = mysqli_query($this->conn, $sqlBooking);
        $resultReview = mysqli_query($this->conn, $sqlReview);

        $rowHotel = mysqli_fetch_assoc($resultHotel);
        $rowUser = mysqli_fetch_assoc($resultUser);
        $rowGeo = mysqli_fetch_assoc($resultGeo);
        $rowBooking = mysqli_fetch_assoc($resultBooking);
        $rowReview = mysqli_fetch_assoc($resultReview);

        $results[] = $rowHotel;
        $results[] = $rowUser;
        $results[] = $rowGeo;
        $results[] = $rowBooking;
        $results[] = $rowReview;

        return $results;
    }




}