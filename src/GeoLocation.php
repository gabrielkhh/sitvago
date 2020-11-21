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
}