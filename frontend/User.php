<?php

session_start();

// initializing variables
$first_name = "";
$last_name = "";
$username = "";
$email = "";
$country = "";
$billing_address = "";
$phone_number = "";
$role_id = "";
$redirect = "";
$password = "";
$errors = array();


// connect to the database
$db = new mysqli('localhost', 'root', 'Password123!', 'sitvago_db');
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// REGISTER USER
if (isset($_POST['reg_user'])) {

    // prepare and bind for register
    $stmt = $db->prepare("INSERT INTO user (first_name, last_name, username, email, phone_number, country, password, billing_address, role_id, is_confirmed, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?,'1', 1, now(), now())");
    $stmt->bind_param("ssssssss", $first_name, $last_name, $username, $email, $phone_number, $country, $password, $billing_address);

    // receive all input values from the form
    $first_name = mysqli_real_escape_string($db, $_POST['fname']);
    $last_name = mysqli_real_escape_string($db, $_POST['lname']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $billing_address = mysqli_real_escape_string($db, $_POST['billing_address']);
    $password_1 = mysqli_real_escape_string($db, $_POST['pwd']);
    $password_2 = mysqli_real_escape_string($db, $_POST['pwd_confirm']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($first_name)) {
        array_push($errors, "First name is required");
    } else {
        //$fname = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
        $fname = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["fname"]);
    }
    if (empty($last_name)) {
        array_push($errors, "Last name is required");
    } else {
        $lname = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["lname"]);
    }
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    } else {
        $email = sanitize_input($_POST["email"]);
        // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.";
            $success = false;
        }
    }
    if (empty($phone_number)) {
        array_push($errors, "Phone number is required");
    }
    if (empty($country)) {
        array_push($errors, "Country is required");
    }
    if (empty($billing_address)) {
        array_push($errors, "Billing address is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Passwords do not match");
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database
      
        $stmt->execute();
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: home.php');
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username=? AND password=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;

            $role_id = $db->query("SELECT role_id FROM user WHERE username = '$username'")->fetch_object()->role_id;
            $first_name = $db->query("SELECT first_name FROM user WHERE username = '$username'")->fetch_object()->first_name;
            $last_name = $db->query("SELECT last_name FROM user WHERE username = '$username'")->fetch_object()->last_name;
            $email = $db->query("SELECT email FROM user WHERE username = '$username'")->fetch_object()->email;
            $phone_number = $db->query("SELECT phone_number FROM user WHERE username = '$username'")->fetch_object()->phone_number;
            $country = $db->query("SELECT country FROM user WHERE username = '$username'")->fetch_object()->country;
            $billing_address = $db->query("SELECT billing_address FROM user WHERE username = '$username'")->fetch_object()->billing_address;

            $_SESSION['role_id'] = $role_id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['country'] = $country;
            $_SESSION['billing_address'] = $billing_address;

            $_SESSION['success'] = "You are now logged in";
            if ($role_id == 1) {
                $redirect = 'home.php';
            } else if ($role_id == 2) {

                $redirect = 'home.php';
            }
            header('location:' . $redirect);
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}



//UPDATE USER
if (isset($_POST['update_user'])) {



    // receive all input values from the form
    $first_name = mysqli_real_escape_string($db, $_POST['fname']);
    $last_name = mysqli_real_escape_string($db, $_POST['lname']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $billing_address = mysqli_real_escape_string($db, $_POST['billing_address']);

    // prepare and bind for register
    $stmt = $db->prepare("UPDATE user SET first_name=?, last_name=?, email=?, phone_number=?, country=?, billing_address=?, updated_at=now() WHERE username=?");
    //$stmt = $db->prepare("UPDATE user SET first_name=?, last_name=?, email=?, phone_number=?, country=?, billing_address=?, updated_at=now() WHERE username=?");
    if ($stmt === false) {
        trigger_error($db->mysqli->error, E_USER_ERROR);
        return;
    }
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone_number, $country, $billing_address, $username);

// form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($first_name)) {
        array_push($errors, "First name is required");
    } else {
        //$fname = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
        $fname = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["fname"]);
    }
    if (empty($last_name)) {
        array_push($errors, "Last name is required");
    } else {
        $lname = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["lname"]);
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    } else {
        $email = sanitize_input($_POST["email"]);
        // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.";
            $success = false;
        }
    }
    if (empty($phone_number)) {
        array_push($errors, "Phone number is required");
    }
    if (empty($country)) {
        array_push($errors, "Country is required");
    }
    if (empty($billing_address)) {
        array_push($errors, "Billing address is required");
    }


    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {

        $stmt->execute();
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header("location: home.php?logout='1'");
    }
}


// LOGIN USER
if (isset($_POST['update_password'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password2 = mysqli_real_escape_string($db, $_POST['new_password']);
    $password3 = mysqli_real_escape_string($db, $_POST['confirmed_password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (empty($password2)) {
        array_push($errors, "New Password is required");
    }
    if (empty($password3)) {
        array_push($errors, "Confirmed Password is required");
    }
    if ($password2 != $password3) {
        array_push($errors, "Passwords do not match");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username=? AND password=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $password_new = md5($password2);
            $stmt = $db->prepare("UPDATE user SET password=? where username =?");
            $stmt->bind_param("ss", $password_new, $username);
            $stmt->execute();
   
            header("location: home.php?logout='1'");
        } else {
            array_push($errors, "Invalid Password");
        }
    }
}
?>