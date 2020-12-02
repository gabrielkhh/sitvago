
<?php include('user_handler.php') ?>
<?php
if (isset($_SESSION['errMsgreg'])) {
    $errors = ($_SESSION['errMsgreg']);
} else {
    $errors = "";
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <title>Singapore Tourism Attraction Registration Page </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS only -->

        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
              integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
              crossorigin="anonymous">

        <!-- Font and Icons CSS -->
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!--jQuery-->
        <script defer
                src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                crossorigin="anonymous">
        </script>

        <!-- Bootstrap -->
        <script defer
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
                integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
                crossorigin="anonymous">
        </script>



        <!-- Custom styles for this template -->
        <link href="css/cover.css" rel="stylesheet">
        <link href='css/register.css' rel="stylesheet">


        <style>
            * {
                box-sizing: border-box;
            }

            body {
                background-color: #f1f1f1;
            }

            #regForm {
                background-color: #ffffff;
                margin: 100px auto;
                font-family: Raleway;
                padding: 40px;
                width: 70%;
                min-width: 300px;
            }

            h1 {
                text-align: center;  
            }

            input {
                padding: 10px;
                width: 100%;
                font-size: 17px;
                font-family: Raleway;
                border: 1px solid #aaaaaa;
            }

            /* Mark input boxes that gets an error on validation: */
            input.invalid {
                background-color: #ffdddd;
            }

            /* Hide all steps by default: */
            .tab {
                display: none;
            }

            button {
                background-color: #4CAF50;
                color: #ffffff;
                border: none;
                padding: 10px 20px;
                font-size: 17px;
                font-family: Raleway;
                cursor: pointer;
            }

            button:hover {
                opacity: 0.8;
            }

            #prevBtn {
                background-color: #bbbbbb;
            }

            /* Make circles that indicate the steps of the form: */
            .step {
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbbbbb;
                border: none;  
                border-radius: 50%;
                display: inline-block;
                opacity: 0.5;
            }

            .step.active {
                opacity: 1;
            }

            /* Mark the steps that are finished and valid: */
            .step.finish {
                background-color: #4CAF50;
            }
        </style>
    </head>
    <body>
        <div class="signup-form">
            <form action="user_handler.php" method="post">

                <?php if (is_array($errors)): ?>
                    <?php echo "<h2>Warning(s)</h2>"; ?>
                    <?php foreach ($errors as $error): ?>
                        <p><strong><?php echo $error ?></strong></p>
                    <?php endforeach ?>
                    <?php unset($_SESSION['errMsgreg']); ?>
                <?php endif ?>

                <!-- One "tab" for each step in the form: -->
                <div class="tab">
                    <h2>Register</h2>
                    <p class="hint-text">Create your account to book hotels. 
                        <br>Already have an account? <a href="loginpage.php">Sign in</a></p>
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" name="fname" placeholder="eg: John" id="fname" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" name="lname" placeholder="eg: Tan" required id="lname"  maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="eg: johntan@gmail.com" required id="email"  maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="email">Phone number:</label>
                        <input type="tel" class="form-control" name="phone_number" placeholder="eg: 93173710" required id="phone_number" maxlength="8">
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" class="form-control" name="country" placeholder="eg: Singapore" required id="country" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="billing_address">Billing Address:</label>
                        <input type="text" class="form-control" name="billing_address" placeholder="eg: Bukit Timah Hill 67" required id="billing_address" maxlength="200">
                    </div>
                </div>

                <div class="tab">Login Information
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" required id="username" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="pwd" placeholder="Password" required id="pwd" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="pwd_confirm">Confirm Password:</label>
                        <input type="password" class="form-control" name="pwd_confirm" placeholder="Confirm Password" required id="pwd_confirm" maxlength="50">
                    </div> 
                </div>

                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        <button type="submit" id="submitBtn" name="reg_user" >Register</button>

                    </div>
                </div>
                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
            </form>
            <footer class="container">
                <div style="text-align:center;">
                    <p>&copy; Sitvago 2020</p>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Learn more about Sitvago and the team behind it.</a>
                </div>
                <br>
                <br>
            </footer>
        </div>


        <script>
            var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab

            function showTab(n) {
                // This function will display the specified tab of the form...
                var x = document.getElementsByClassName("tab");
                x[n].style.display = "block";
                //... and fix the Previous/Next buttons:
                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                    document.getElementById("submitBtn").style.display = "none";
                    document.getElementById("nextBtn").style.display = "inline";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }
                if (n == (x.length - 1)) {
                    document.getElementById("nextBtn").style.display = "none";
                    document.getElementById("submitBtn").style.display = "inline";
                } else {
                    document.getElementById("nextBtn").innerHTML = "Next";
                }

                //... and run a function that will display the correct step indicator:
                fixStepIndicator(n)
            }

            function nextPrev(n) {
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("tab");
                // Exit the function if any field in the current tab is invalid:
                if (n == 1 && !validateForm())
                    return false;
                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                //if (n >3)
                currentTab = currentTab + n;
                // if you have reached the end of the form...
                if (currentTab >= x.length) {
                    // ... the form gets submitted:
                    //document.getElementById("signup-form").submit();
                    document.getElementById("element").style.display = "block";
                    // return false;
                }
                // Otherwise, display the correct tab:
                showTab(currentTab);
            }

            function validateForm() {
                // This function deals with validation of the form fields
                var x, y, i, valid = true;
                x = document.getElementsByClassName("tab");
                y = x[currentTab].getElementsByTagName("input");
                // A loop that checks every input field in the current tab:
                for (i = 0; i < y.length; i++) {
                    // If a field is empty...
                    if (y[i].value == "") {
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                }
                // If the valid status is true, mark the step as finished and valid:
                if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }
                return valid; // return the valid status
            }

            function submitFunction() {
                document.getElementById("submitBtn").style.display = "block";
            }

            function fixStepIndicator(n) {
                // This function removes the "active" class of all steps...
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }
                //... and adds the "active" class on the current step:
                x[n].className += " active";
            }

        </script>

    </body>
</html>
