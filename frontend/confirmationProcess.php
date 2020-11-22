<?php

$errors ="";
 
 
      
if(empty($_POST["name"]) || empty($_POST["email"]))
{
        $errors .= "\n Error: all fields are required";   
}

$name = $_POST["name"];
$email_address = $_POST["email"];


// the message
$msg = "$name\n Your booking is confirmed";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($email_address,"Booking Confirmed",$msg);


/*
 *$myemail = "jingxuan-trinity@hotmail.com";//Put Your email address here.
if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address))
{
    $errors .= "\n Error: Invalid email address";
}
 */
/*
if(empty($errors))
{
    $to = $myemail;

    $email_subject = "Contact form submission: $name";

    $email_body = "You have received a new message. ". "Here are the details:\n Name: $name \n ". "Email: $email_address\n Message";

    $headers = "From: $myemail\n";

    $headers .= "Reply-To: $email_address";

    mail($to,$email_subject,$email_body,$headers);
}
*/

?>