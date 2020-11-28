<?php

namespace sitvago;

error_reporting(E_ALL); ini_set('display_errors', 1);

class User extends DB
{
    public function registerUser($first_name, $last_name, $username, $email, $phone_number, $country, $password, $billing_address)
    {

        $stmt = $this->conn->prepare("INSERT INTO User (first_name, last_name, username, email, phone_number, country, password, billing_address, role_id, is_confirmed, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, 1, now(), now())");
        $stmt->bind_param("ssssssss", $first_name, $last_name, $username, $email, $phone_number, $country, $password, $billing_address);

        $stmt->execute();

        return "";
    }

    public function getAllUsers()
    {
        $results = [];
        $sql = "SELECT * FROM Users";

        $resultsSQL = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($resultsSQL) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSQL)) {
                $results[] = $row;
            }
        }

        return $results;

    }

    public function loginUser($username, $password)
    {
        $query = "SELECT * FROM User WHERE username=? AND password=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function userNameEmail($username, $email)
    {
        $user_check_query = "SELECT * FROM User WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($this->conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        return $user;
    }

    public function checkUserNameExists($username)
    {
        $user_check_query = "SELECT User.username FROM User WHERE username='$username'";
        $result = mysqli_query($this->conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        return $user;
    }

    public function checkEmailExists($email)
    {
        $user_check_query = "SELECT User.email FROM User WHERE email='$email'";
        $result = mysqli_query($this->conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        return $user;
    }

    public function getUserDataForSession($username)
    {
        $sqlQuery = "SELECT User.id, User.username, User.role_id, User.first_name, User.last_name, User.email, User.phone_number, User.country, User.billing_address FROM User WHERE User.username='" . $username . "';";

        $resultUser = mysqli_query($this->conn, $sqlQuery);
        $rowUser = mysqli_fetch_assoc($resultUser);

        return $rowUser;
    }

    public function updateUser($first_name, $last_name, $email, $phone_number, $country, $billing_address, $username)
    {
        $sqlQuery = "UPDATE User SET first_name=?, last_name=?, email=?, phone_number=?, country=?, billing_address=?, updated_at=now() WHERE username=?";
        $stmt = $this->conn->prepare($sqlQuery);
        //$stmt = $db->prepare("UPDATE user SET first_name=?, last_name=?, email=?, phone_number=?, country=?, billing_address=?, updated_at=now() WHERE username=?");

        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone_number, $country, $billing_address, $username);

        $stmt->execute();

        return "";
    }

    public function updateUserPassword($password_new, $username)
    {
        $sqlStatement = "UPDATE User SET password=? where username=?";
        $stmt = $this->conn->prepare($sqlStatement);
        $stmt->bind_param("ss", $password_new, $username);
        $stmt->execute();

        return "";
    }

    public function getStripeCustID($userID)
    {
        $status = false;
        $sql = "SELECT stripe_customer_id FROM User WHERE id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);

        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function saveStripeCustID($userID, $stripeCustomerID)
    {
        $response = [];
        $sql = "UPDATE User SET stripe_customer_id = '" . $stripeCustomerID . "' WHERE User.id = " . $userID;

        if (mysqli_query($this->conn, $sql))
        {
            $response['message'] = "Updated Stripe CustID successfully";
        }
        else
        {
            $response['message'] = "Stripe CustID failed to update";
        }
        return $response;
    }
}
