<?php

namespace sitvago;

class Booking extends DB
{
    //get all bookings
    public function getBookingsAdmin()
    {
        $results = [];
        $sql = "SELECT Booking.id, User.username, User.email, Booking.stripe_payment_id, Hotel.name AS hotel_name, RoomCategory.category_name AS room_type, 
            Booking.price, Booking.check_in, Booking.check_out, Booking.created_at FROM Booking 
            LEFT JOIN Hotel ON Booking.hotel_id = Hotel.id LEFT JOIN RoomCategory
            ON Booking.room_category_id = RoomCategory.id LEFT JOIN User ON Booking.user_id = User.id";

        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        return $results;
    }

    public function getBookings($userID)
    {
        $results = [];
        $sql = "SELECT Booking.id, Booking.stripe_payment_id, Hotel.name AS hotel_name, RoomCategory.category_name AS room_type, 
            Booking.price, Booking.check_in, Booking.check_out, Booking.created_at FROM Booking 
            LEFT JOIN Hotel ON Booking.hotel_id = Hotel.id LEFT JOIN RoomCategory
            ON Booking.room_category_id = RoomCategory.id WHERE Booking.user_id=" . $userID . ";";

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
        $SQL = "SELECT Booking.id, Booking.stripe_payment_id, Hotel.name AS hotel_name, RoomCategory.category_name AS room_type, 
            Booking.price, Booking.check_in, Booking.check_out, Booking.created_at FROM Booking 
            LEFT JOIN Hotel ON Booking.hotel_id = Hotel.id LEFT JOIN RoomCategory
            ON Booking.room_category_id = RoomCategory.id WHERE Booking.id=" . $bookingID . ";";

        $resultBooking = mysqli_query($this->conn, $SQL);
        $rowBooking = mysqli_fetch_assoc($resultBooking);

        return $rowBooking;
    }

    public function getSingleBookingAdmin($bookingID)
    {
        $results = [];
        $success = true;
        $SQL = "SELECT Booking.id, Booking.stripe_payment_id, User.first_name, User.last_name, User.username, User.email, User.stripe_customer_id,
            User.password, User.phone_number, User.billing_address, Hotel.name AS hotel_name, RoomCategory.category_name AS room_type, 
            Booking.price, Booking.check_in, Booking.check_out, Booking.created_at FROM Booking 
            LEFT JOIN Hotel ON Booking.hotel_id = Hotel.id LEFT JOIN RoomCategory
            ON Booking.room_category_id = RoomCategory.id LEFT JOIN User ON Booking.user_id = User.id WHERE Booking.id=" . $bookingID . ";";

        $resultBooking = mysqli_query($this->conn, $SQL);
        $rowBooking = mysqli_fetch_assoc($resultBooking);

        return $rowBooking;
    }

    //user make a new booking
    public function addBooking($userID, $hotelName, $roomCategoryName, $price, $check_in, $check_out)
    {
        $response = [];
        $success = true;
        $preparedSQL = "INSERT INTO Booking (hotel_id, user_id, room_category_id, price, check_in, check_out, created_at)
        VALUES ((SELECT h.id FROM Hotel h WHERE h.name=?), ?, (SELECT rc.id FROM RoomCategory rc WHERE rc.category_name=?), ?, ?, ?, now())";

        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = "Something went wrong while connecting..";
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("sisdss", $hotelName, $userID, $roomCategoryName, $price, $check_in, $check_out);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = "There was an issue saving the information to the database.";
                $response['error'] = $errorMsg;
            } else {
                $newBookingID = mysqli_insert_id($this->conn);
                $response['success'] = $success;
                $response['message'] = "Your booking has been successfully added into the database!!";
                $response['insertedID'] = $newBookingID;
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
    public function deleteBooking($bookingID)
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
                $response['message'] = "There was an error when trying to cancel the booking.";
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = "Booking has been successfully deleted from the database.";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    public function updateBookingWithStripeTxID($bookingID, $stripePaymentID)
    {
        $response = [];
        $success = true;
        $preparedSQL = "UPDATE Booking SET stripe_payment_id=? WHERE id=?";

        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = $errorMsg;
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("si", $stripePaymentID, $bookingID);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = $errorMsg;
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = "Stripe Info has been updated into the Booking.";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }
}
