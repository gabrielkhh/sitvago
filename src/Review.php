<?php

namespace sitvago;

class Review extends DB
{
    public function getReviews()
    {
        $results = [];
        $sql = "SELECT Review.id, Review.title, Review.user_id, Review.hotel_id, Review.rating, Review.content,
            Review.created_at FROM Review LEFT JOIN Hotel ON Review.hotel_id = Hotel.id  
            WHERE Review.user_id=?";

        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        return $results;
    }

    public function getSingleHotelReview($hotelID)
    {
        $results = [];
        $success = true;
        $SQL = "SELECT Review.id, Review.title, User.username, Review.rating, Review.content,
            Review.created_at FROM Review LEFT JOIN User ON Review.user_id = User.id  
            WHERE Review.hotel_id=?";

        $resultReview = mysqli_query($this->conn, $SQL);
        $rowReview = mysqli_fetch_assoc($resultReview);

        return $rowHotel;
    }

    public function addReview($userID, $hotelID, $title, $rating, $content)
    {
        $response = [];
        $success = true;
        $preparedSQL = "INSERT INTO Review (user_id, hotel_id, title, rating, content, created_at) VALUES ( ?, ?,
        ?, ?, ?, now())";


        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = "Failed to connect";
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("iisds", $userID, $hotelID, $title, $rating, $content);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = "Failed to execute";
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = "Review has been successfully added into the database!!";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    public function updateReview($hotelID, $hotelName, $hotelDescription, $hotelGeoLocation, $rating, $userID)
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

    public function deleteReview($hotelID, $hotelName)
    {
        $results = [];
        $success = true;
        $preparedSQL = "DELETE FROM Hotel WHERE id=?";


        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = "Connection Error";
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("i", $hotelID);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = "Hotel Hellll";
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = $hotelName . " has been successfully deleted from the database.";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

}
