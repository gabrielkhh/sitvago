<?php

namespace sitvago;

class User extends DB
{
    public function registerUser($first_name, $last_name, $username, $email, $phone_number, $country, $password, $billing_address)
    {

        $stmt = $this->conn->prepare("INSERT INTO User (first_name, last_name, username, email, phone_number, country, password, billing_address, role_id, is_confirmed, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, 1, now(), now())");
        $stmt->bind_param("ssssssss", $first_name, $last_name, $username, $email, $phone_number, $country, $password, $billing_address);

        $stmt->execute();

        return "";
    }

    public function loginUser($username, $password)
    {
        $query = "SELECT * FROM user WHERE username=? AND password=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function userNameEmail($username, $email)
    {
        $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
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
        $sqlQuery = "UPDATE user SET first_name=?, last_name=?, email=?, phone_number=?, country=?, billing_address=?, updated_at=now() WHERE username=?";
        $stmt = $this->conn->prepare($sqlQuery);
        //$stmt = $db->prepare("UPDATE user SET first_name=?, last_name=?, email=?, phone_number=?, country=?, billing_address=?, updated_at=now() WHERE username=?");

        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone_number, $country, $billing_address, $username);

        $stmt->execute();

        return "";
    }

    public function updateUserPassword($password_new, $username)
    {
        $stmt = $this->conn->prepare("UPDATE user SET password=? where username =?");
        $stmt->bind_param("ss", $password_new, $username);
        $stmt->execute();

        return "";
    }
}
