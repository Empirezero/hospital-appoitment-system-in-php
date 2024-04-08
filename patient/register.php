<?php
include("includes/dbconfig.php");
if (isset($_POST['submit'])) {
    // Handle form data here
    $first_name = $_POST['last_name'];
    $last_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $date = $_POST['date_of_birth'];

    //validate user input
    if (!preg_match("/^[a-zA-Z]+$/", $first_name) || !preg_match("/^[a-zA-Z]+$/", $last_name)) {
        echo "First name and last name must contain only alphabets.";
        exit;
    }

    // validation checks...
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }


    // Validate password and confirm password
    if ($password != $confirm_password) {
        echo "Password and Confirm Password do not match.";
        exit; // Stop further execution
    }

    $hashed_password = md5($password);

    // Insert the data into the database
    $query = "INSERT INTO patients (first_name,last_name,email, gender,date_of_birth,password,phone) 
              VALUES (?,?, ?,?,?,?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssss', $first_name, $last_name, $email, $gender, $date, $hashed_password, $phone);

    if ($stmt->execute()) {
        // Patient successfully registered
        echo "<script>alert('Patient registered successfully.'); window.location.href = 'login.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>




<!DOCTYPE html>
<html lang="en">


<!-- register24:03-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form action="" method="post" class="form-signin">
                        <div class="account-logo">
                            <a href="index-2.html"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>first name</label>
                            <input name="first_name" id="first_name" type=" text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>last name</label>
                            <input name="last_name" id="last_name" type=" text" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="col-lg-12 col-12">
                                    <input type="date" name="date_of_birth" id="date" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input name="confirm_password" type="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input name="phone" type="text" class="form-control" required>
                        </div>
                        <div class="form-group checkbox">
                            <label>
                                <input type="checkbox" required> I have read and agree the Terms & Conditions
                            </label>
                        </div>
                        <div class="form-group text-center">
                            <button name="submit" class="btn btn-primary account-btn" type="submit">Signup</button>
                        </div>
                        <div class="text-center login-link">
                            Already have an account? <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
    function validateForm() {
        var firstName = document.getElementById("first_name").value;
        var lastName = document.getElementById("last_name").value;
        var letters = /^[A-Za-z]+$/;

        if (!firstName.match(letters) || !lastName.match(letters)) {
            alert("First name and last name must contain only alphabets.");
            return false;
        }

        return true;
    }
    </script>


</body>


<!-- register24:03-->

</html>