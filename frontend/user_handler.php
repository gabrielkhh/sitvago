<?php
require '../vendor/autoload.php';

use sitvago\User;
use Mailgun\Mailgun;

// $some_name = session_name("sitvago_session");
// session_set_cookie_params(0, '/', '.sitvago.com');
// session_start();
if (isset($_COOKIE['session_id']))
    session_id($_COOKIE['session_id']);
session_start();
if (!isset($_COOKIE['session_id']))
    setcookie('session_id', session_id(), 0, '/', '.sitvago.com');

// // initializing variables
// $first_name = "";
// $last_name = "";
// $username = "";
// $email = "";
// $country = "";
// $billing_address = "";
// $phone_number = "";
// $role_name = "";
$redirect = "";
// $password = "";
$errors = array();
$errorsDetails = array();
$errorsPW = array();




//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // prepare and bind for register

    // receive all input values from the form
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $country = $_POST['country'];
    $billing_address = $_POST['billing_address'];
    $password_1 = $_POST['pwd'];
    $password_2 = $_POST['pwd_confirm'];

    $uppercase = preg_match('@[A-Z]@', $password_1);
    $lowercase = preg_match('@[a-z]@', $password_1);
    $number    = preg_match('@[0-9]@', $password_1);
    $space = preg_match("/\\s/", $password_1);

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
    } else if (!$uppercase || !$lowercase || !$number || strlen($password_1) < 8 || $space) {
        array_push($errors, "Your password must contain at least 8 characters, 1 uppercase letter, 1 lowercase letter, 1 number, and should not contain whitespaces.");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Passwords do not match");
    }

    // // first check the database to make sure 
    // // a user does not already exist with the same username and/or email
    $checkUserNameAndEmail = new User();
    $user = $checkUserNameAndEmail->userNameEmail($username, $email);

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

        $saveUser = new User();
        $saveUserResult = $saveUser->registerUser($first_name, $last_name, $username, $email, $phone_number, $country, $password, $billing_address);
        $_SESSION['username'] = $username;

        # Instantiate the client.
        /*$mg = Mailgun::create($_SERVER['mailgun_api_key']);
        // Now, compose and send your message.
        // $mg->messages()->send($domain, $params);
        $mg->messages()->send('mg.sitvago.com', [
            'from'    => 'Sitvago noreply@sitvago.com',
            'to'      => 'freezingheat97@gmail.com',
            'subject' => 'Thank you for signing up with us!',
            'html'    => 'We hope you will have a great time!'
        ]);*/
        $Message = "Registration successful! Please login from the home page.";

        header("location: home.php?Message=" . urlencode($Message));
    } else {

        $_SESSION['errMsgreg'] = $errors;
        header('location: register.php');
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);

        $loginUser = new User();
        $result = $loginUser->loginUser($username, $password);

        if ($result->num_rows > 0) {
            $retrieveUserData = new User();
            $UserData = $retrieveUserData->getUserDataForSession($username);

            $_SESSION['username'] = $UserData['username'];
            $_SESSION['userID'] = $UserData['id'];
            $_SESSION['role_name'] = $UserData['role_name'];
            $_SESSION['first_name'] = $UserData['first_name'];
            $_SESSION['last_name'] = $UserData['last_name'];
            $_SESSION['email'] = $UserData['email'];
            $_SESSION['phone_number'] = $UserData['phone_number'];
            $_SESSION['country'] = $UserData['country'];
            $_SESSION['billing_address'] = $UserData['billing_address'];

            if ($UserData['role_name'] === "Administrator") {
                $redirect = 'https://admin.sitvago.com';
                // $redirect = 'home.php';
            } else if ($UserData['role_name'] === "User") {

                $redirect = 'home.php';
            }
            header('location:' . $redirect);
        } else {
            array_push($errors, "Wrong username/password combination");
            $_SESSION['errMsg'] = "Invalid username or password";
            header('location: loginpage.php');
        }
    }
}


//UPDATE USER
if (isset($_POST['update_user'])) {
    $userObj = new User();

    // receive all input values from the form
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $country = $_POST['country'];
    $billing_address = $_POST['billing_address'];
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errorsDetails array
    if (empty($first_name)) {
        array_push($errorsDetails, "First name is required");
    } else {
        //$fname = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
        $fname = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["fname"]);
    }
    if (empty($last_name)) {
        array_push($errorsDetails, "Last name is required");
    } else {
        $lname = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST["lname"]);
    }
    if (empty($email)) {
        array_push($errorsDetails, "Email is required");
    } else {
        $email = sanitize_input($_POST["email"]);
        // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.";
            $success = false;
        }
    }
    if (empty($phone_number)) {
        array_push($errorsDetails, "Phone number is required");
    }
    if (empty($country)) {
        array_push($errorsDetails, "Country is required");
    }
    if (empty($billing_address)) {
        array_push($errorsDetails, "Billing address is required");
    }


    // first check the database to make sure 
    // a user does not already exist with the same email


    if ($_SESSION['email'] != $email) {
        $checkEmail = new User();
        $userRes = $checkEmail->checkEmailExists($email);
        if ($userRes) {
            if ($userRes['email'] === $email) {
                array_push($errorsDetails, "email already exists");
            }
        }
    }

    // Finally, update user if there are no errors in the form
    if (count($errorsDetails) == 0) {

        $updateUserResult = $userObj->updateUser($first_name, $last_name, $email, $phone_number, $country, $billing_address, $username);
        $_SESSION['username'] = $username;
        $Message = "Account details updated successfully! Please login again.";

        header("location: home.php?Message=" . urlencode($Message));
    } else {
        header("location: user_profile.php");
        $_SESSION['errorsDetails'] = $errorsDetails;
    }
}


// UPDATE USER PASSWORD
if (isset($_POST['update_password'])) {
    $userObj = new User();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['new_password'];
    $password3 = $_POST['confirmed_password'];
    $uppercase = preg_match('@[A-Z]@', $password2);
    $lowercase = preg_match('@[a-z]@', $password2);
    $number    = preg_match('@[0-9]@', $password2);
    $space = preg_match("/\\s/", $password2);

    if (empty($username)) {
        array_push($errorsPW, "Username is required");
    }
    if (empty($password)) {
        array_push($errorsPW, "Password is required");
    }
    if (empty($password2)) {
        array_push($errorsPW, "New Password is required");
    } else if (!$uppercase || !$lowercase || !$number || strlen($password_1) < 8 || $space) {
        array_push($errorsPW, "Your password must contain at least 8 characters, 1 uppercase letter, 1 lowercase letter, 1 number, and should not contain whitespaces.");
    }
    if (empty($password3)) {
        array_push($errorsPW, "Confirmed Password is required");
    }
    if ($password2 != $password3) {
        array_push($errorsPW, "Passwords do not match");
    }

    if (count($errorsPW) == 0) {
        $password = md5($password);
        $checkPasswordResult = $userObj->loginUser($username, $password);

        if (count($checkPasswordResult) > 0) {
            $password_new = md5($password2);
            $updatePasswordQuery = $userObj->updateUserPassword($password_new, $username);
            $Message = "Password changed successfully! Please login again.";

            header("location: home.php?Message=" . urlencode($Message));
        } else {
            array_push($errorsPW, "Invalid Password");
        }
    } else {
        header("location: user_profile.php");
        $_SESSION['errorsPW'] = $errorsPW;
    }
}
