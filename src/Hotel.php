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

    public function retrieveHotelsForHomePage()
    {
        $results = [];
        $sql = "SELECT Hotel.id, Hotel.name, Hotel.description, Hotel.rating, GeoLocation.name AS area_name, HotelImage.secure_url, HotelImage.original_src
        FROM Hotel LEFT JOIN GeoLocation ON Hotel.geo_id = GeoLocation.id LEFT JOIN HotelImage ON HotelImage.hotel_id = Hotel.id 
        AND HotelImage.is_thumbnail = 1";

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

    public function getHotelInfoForBooking($hotelID)
    {
        $results = [];
        $success = true;
        $SQL = "SELECT Hotel.id, Hotel.name, Hotel.description, Hotel.rating, Hotel.geo_id, GeoLocation.name AS geo_name 
        FROM Hotel LEFT JOIN GeoLocation ON Hotel.geo_id = GeoLocation.id WHERE Hotel.id=" . $hotelID . ";";

        $resultHotel = mysqli_query($this->conn, $SQL);
        $rowHotel = mysqli_fetch_assoc($resultHotel);

        return $rowHotel;
    }

    public function getHotelImagesForBooking($hotelID)
    {
        $results = [];
        $success = true;
        $SQL = "SELECT HotelImage.secure_url, HotelImage.original_src, HotelImage.width, HotelImage.height, HotelImage.is_thumbnail 
        FROM Hotel LEFT JOIN HotelImage ON HotelImage.hotel_id = Hotel.id WHERE Hotel.id=" . $hotelID . ";";

        $resultsSQL = mysqli_query($this->conn, $SQL);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        return $results;
    }

    public function getHotelPricesForBooking($hotelID)
    {
        $results = [];
        $success = true;
        $SQL = "SELECT HotelRoomCategory.price_per_night, HotelRoomCategory.room_category_id 
        FROM Hotel LEFT JOIN HotelRoomCategory ON HotelRoomCategory.hotel_id = Hotel.id WHERE Hotel.id=" . $hotelID . ";";

        $resultsSQL = mysqli_query($this->conn, $SQL);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        return $results;
    }

    public function addHotel($hotelName, $hotelDescription, $rating, $userID, $hotelGeoLocation, $amounts)
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
                $newHotelID = mysqli_insert_id($this->conn);
                $response['success'] = $success;
                $response['message'] = $hotelName . " has been successfully added into the database!!";
                $response['error'] = "";
                $response['insertedID'] = $newHotelID;
                $response['insertedName'] = $hotelName;
                foreach ($amounts as $key => $val) {
                    $sql = "INSERT INTO HotelRoomCategory (hotel_id, room_category_id, availability, price_per_night, created_at, created_by, updated_at, updated_by)
                    VALUES (" . $newHotelID . ", (SELECT rc.id FROM RoomCategory rc WHERE rc.category_name='" . $key . "'), 1, " . $val . ", now(), " . $userID . ", now(), " . $userID . ")";
                    mysqli_query($this->conn, $sql)
                        or die(mysqli_error($this->conn));
                }
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    public function updateHotel($hotelID, $hotelName, $hotelDescription, $hotelGeoLocation, $rating, $userID, $amounts)
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
                foreach ($amounts as $key => $val) {
                    $sql = "UPDATE HotelRoomCategory SET availability=1, price_per_night=" . $val . ", updated_at=now(),
                    updated_by=" . $userID . " WHERE HotelRoomCategory.room_category_id = (SELECT rc.id FROM RoomCategory rc WHERE rc.category_name='" . $key . "')
                    AND HotelRoomCategory.hotel_id = " . $hotelID;
                    mysqli_query($this->conn, $sql)
                        or die(mysqli_error($this->conn));
                }
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

    public function addHotelImage($hotelID, $url, $secureUrl, $width, $height, $extension, $isThumbnail, $originalSrc)
    {
        $response = [];
        $success = true;
        $preparedSQL = "INSERT INTO HotelImage (url, secure_url, original_src, hotel_id, is_thumbnail, image_extension, width, height) SELECT ?, ?, ?, Hotel.id,
        ?, ?, ?, ? FROM Hotel WHERE Hotel.id=?";


        if ($this->conn->connect_error) {
            $errorMsg = "Connection failed: " . $this->conn->connect_error;
            $success = false;
            $response['success'] = $success;
            $response['message'] = "Conn Failed";
            $response['error'] = $errorMsg;
        } else {
            $stmt = $this->conn->prepare($preparedSQL);
            $stmt->bind_param("sssisiii", $url, $secureUrl, $originalSrc, $isThumbnail, $extension, $width, $height, $hotelID);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
                $response['success'] = $success;
                $response['message'] = "Execute Failed.";
                $response['error'] = $errorMsg;
            } else {
                $newHotelID = mysqli_insert_id($this->conn);
                $response['success'] = $success;
                $response['message'] = "Image saved successfully.";
                $response['error'] = "";
            }
            $stmt->close();
        }
        $this->conn->close();
        return $response;
    }

    public function getRoomCategoryRate($hotelName, $roomCategoryName)
    {
        $results = [];
        $success = true;
        $SQL = "SELECT price_per_night AS rate FROM HotelRoomCategory WHERE (SELECT h.id FROM Hotel h WHERE h.name = ?) = hotel_id 
        AND (SELECT rc.id FROM RoomCategory rc WHERE rc.category_name = ?) = room_category_id;";

        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param("ss", $hotelName, $roomCategoryName);

        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ")" . $stmt->error;
            $response['success'] = $success;
            $response['message'] = "There was an issue retrieving the rate.";
            $response['error'] = $errorMsg;
        } else {
            $response['success'] = $success;
            $response['message'] = "Rate has been received";
            $response['error'] = "";
        }
        $rowRate = $stmt->get_result();

        $stmt->close();

        return $rowRate->fetch_array(MYSQLI_ASSOC);
    }

    public function getRoomCategories()
    {
        $results = [];
        $sql = "SELECT RoomCategory.id, RoomCategory.category_name FROM RoomCategory;";

        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        return $results;
    }

    public function getExistingHotelRoomCategories($hotelID)
    {
        $results = [];
        $sql = "SELECT HotelRoomCategory.price_per_night, RoomCategory.category_name, HotelRoomCategory.created_at, HotelRoomCategory.updated_at 
        FROM HotelRoomCategory LEFT JOIN RoomCategory ON HotelRoomCategory.room_category_id = RoomCategory.id 
        WHERE HotelRoomCategory.hotel_id = " . $hotelID . ";";

        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        return $results;
    }

    //INSERT INTO HotelRoomCategory (hotel_id, room_category_id, availability, price_per_night, created_at) VALUES (2, 1, 1, 210.00, now());
}
