<?php

namespace sitvago;

class GeoLocation extends DB
{
    public function getGeoLocations()
    {
        $results = [];
        $sql = "SELECT * FROM GeoLocation";
        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }
        return $results;
    }

    public function getSingleGeoLocation($id)
    {
        $SQL = "SELECT GeoLocation.id, GeoLocation.name FROM GeoLocation WHERE GeoLocation.id=" . $id . ";";

        $resultGeoLocation = mysqli_query($this->conn, $SQL);
        $result = mysqli_fetch_assoc($resultGeoLocation);

        return $result;
    }

    public function addGeoLocation($userID, $geoName)
    {
        $response = [];
        $success = true;
        $preparedSQL = "INSERT INTO GeoLocation (name, created_at, created_by, updated_at, updated_by) SELECT ?, now(),
        User.id, now(), User.id FROM User WHERE User.id=?";

        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = $errorMsg;
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("si", $geoName, $userID);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = $errorMsg;
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = $geoName . " has been successfully added into the database!!";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    public function updateGeoLocation($geoID, $geoName, $userID)
    {
        $response = [];
        $success = true;
        $preparedSQL = "UPDATE GeoLocation SET name=?, updated_at=now(), updated_by=? WHERE GeoLocation.id=?;";

        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = $errorMsg;
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("sii", $geoName, $userID, $geoID);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = $errorMsg;
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = $geoName . " has been successfully updated!!";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    public function deleteGeoLocation($geoID, $geoName)
    {
        $results = [];
        $success = true;
        $preparedSQL = "DELETE FROM GeoLocation WHERE id=?";


        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = "Connection Error";
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("i", $geoID);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = $errorMsg;
                $response['error'] = $errorMsg;
            } else {
                $response['success'] = $success;
                $response['message'] = $geoName . " has been successfully deleted from the database.";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }
}