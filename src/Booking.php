<?php

namespace sitvago;

class Booking extends DB
{
    //get all bookings
    public function getBookings()
    {
        $results = [];
        $sql = "SELECT Booking.id, Hotel.name AS hotel_name, RoomCategory.name AS room_type, 
            Booking.price, Booking.check_in, Booking.check_out, Booking.created_at FROM Booking 
            LEFT JOIN Hotel ON Booking.hotel_id = Hotel.id LEFT JOIN RoomCategory
            ON Booking.room_category_id = RoomCategory.id WHERE Booking.user_id=?;";

        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        return $results;
    }

    // each booking details that user can see
    public function getSingleBooking($bookingID)
    {
        $results = [];
        $success = true;
        $SQL = "SELECT Booking.id, Hotel.name AS hotel_name, RoomCategory.name AS room_type, 
            Booking.price, Booking.check_in, Booking.check_out, FROM Booking 
            LEFT JOIN Hotel ON Booking.hotel_id = Hotel.id LEFT JOIN RoomCategory
            ON Booking.room_category_id = RoomCategory.id WHERE Booking.id=" . $bookingID . ";";

        $resultBooking = mysqli_query($this->conn, $SQL);
        $rowBooking = mysqli_fetch_assoc($resultBooking);

        return $rowBooking;
    }
    //user make a new booking
    public function addBooking($hotelID, $userID, $roomcategoryID, $price, $check_in,$check_out)
    {
        $response = [];
        $success = true;
        $preparedSQL = "INSERT INTO Booking (hotel_id, user_id, room_category_id, price, check_in, check_out, created_at) SELECT Hotel.id, User.id,
        RoomCategory.id, ?, ?, ?,now() FROM LEFT JOIN Hotel ON Booking.hotel_id = Hotel.id LEFT JOIN RoomCategory
            ON Booking.room_category_id = RoomCategory.id WHERE Booking.user_id=?";


        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = "Hotel Hellll";
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("ssdiis", $hotelName, $hotelDescription, $rating, $userID, $userID, $hotelGeoLocation);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = "Hotel Hellll";
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = $bookingID . " has been successfully added into the database!!";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    public function updateBooking($hotelID, $hotelName, $hotelDescription, $hotelGeoLocation, $rating, $userID)
    {
        $response = [];
        $success = true;
        $preparedSQL = "UPDATE Hotel SET name=?, description=?, rating=?, geo_id=(SELECT GeoLocation.id FROM GeoLocation WHERE GeoLocation.name=?), updated_at=now(), updated_by=? WHERE Hotel.id=?;";

        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = "Hotel Hellll";
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("ssdsii", $hotelName, $hotelDescription, $rating, $hotelGeoLocation, $userID, $hotelID);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = "Hotel Hellll";
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = $hotelName . " has been successfully updated!!";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    //user delete booking if he/she dont want
    public function deleteBooking($bookingID, $hotelID)
    {
        $results = [];
        $success = true;
        $preparedSQL = "DELETE FROM Booking WHERE id=?";


        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = "Connection Error";
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("i", $bookingID);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = "Hotel Hellll";
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = $bookingID . " has been successfully deleted from the database.";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }
}


