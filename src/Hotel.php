<?php

namespace sitvago;

class Hotel extends DB
{
    public function getHotels()
    {
        $results = [];
        $sql = "SELECT Hotel.id, Hotel.name, Hotel.description, Hotel.rating, Hotel.created_at, 
        c.first_name AS created_by, Hotel.updated_at, u.first_name AS updated_by, GeoLocation.name AS area_name 
        FROM Hotel LEFT JOIN GeoLocation ON Hotel.geo_id = GeoLocation.id LEFT JOIN User c ON Hotel.created_by = c.id 
        LEFT JOIN User u ON Hotel.updated_by = u.id;";

        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        return $results;
    }

    public function getSingleHotel($hotelID)
    {
        $results = [];
        $success = true;
        $SQL = "SELECT Hotel.id, Hotel.name, Hotel.description, Hotel.rating, Hotel.geo_id, GeoLocation.name AS geo_name 
        FROM Hotel LEFT JOIN GeoLocation ON Hotel.geo_id = GeoLocation.id WHERE Hotel.id=" . $hotelID . ";";

        $resultHotel = mysqli_query($this->conn, $SQL);
        $rowHotel = mysqli_fetch_assoc($resultHotel);

        return $rowHotel;
    }

    public function addHotel($hotelName, $hotelDescription, $rating, $userID, $hotelGeoLocation)
    {
        $response = [];
        $success = true;
        $preparedSQL = "INSERT INTO Hotel (name, description, rating, geo_id, created_at, created_by, updated_at, updated_by) SELECT ?, ?,
        ?, GeoLocation.id, now(), ?, now(), ? FROM GeoLocation WHERE GeoLocation.name=?";


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
                $response['message'] = $hotelName . " has been successfully added into the database!!";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    public function updateHotel($hotelID, $hotelName, $hotelDescription, $hotelGeoLocation, $rating, $userID)
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

    public function deleteHotel($hotelID, $hotelName)
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
