<?php

namespace sitvago;

class Overview extends DB
{
    public function getCount()
    {
        $results = [];
        $sqlHotel = "SELECT COUNT(id) AS 'HotelCount' FROM Hotel;";
        $sqlFAQ = "SELECT COUNT(id) AS 'FAQCount' FROM FAQ;";
        $sqlGeo = "SELECT COUNT(id) AS 'GeoCount' FROM GeoLocation;";
        $sqlBooking = "SELECT COUNT(id) AS 'BookingCount' FROM Booking;";
        $sqlReview = "SELECT COUNT(id) AS 'ReviewCount' FROM Review;";

        $resultHotel = mysqli_query($this->conn, $sqlHotel);
        $resultFAQ = mysqli_query($this->conn, $sqlFAQ);
        $resultGeo = mysqli_query($this->conn, $sqlGeo);
        $resultBooking = mysqli_query($this->conn, $sqlBooking);
        $resultReview = mysqli_query($this->conn, $sqlReview);

        $rowHotel = mysqli_fetch_assoc($resultHotel);
        $rowFAQ = mysqli_fetch_assoc($resultFAQ);
        $rowGeo = mysqli_fetch_assoc($resultGeo);
        $rowBooking = mysqli_fetch_assoc($resultBooking);
        $rowReview = mysqli_fetch_assoc($resultReview);

        $results[] = $rowHotel;
        $results[] = $rowFAQ;
        $results[] = $rowGeo;
        $results[] = $rowBooking;
        $results[] = $rowReview;

        return $results;
    }




}