<?php
include("includes/dbconfig.php");

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $date_of_birth = $_POST['date_of_birth'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    // Handle image upload
    $image = $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../../assets/img/" . $_FILES["image"]["name"]);

    // Validate password and confirm password
    if ($password != $confirm_password) {
        echo "Password and Confirm Password do not match.";
        exit; // Stop further execution
    }

    // Hash the password
    $hashed_password = md5($password);

    $insert_patient = "INSERT INTO patients(first_name, last_name, email, password, date_of_birth, phone, address, gender, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stm = $conn->prepare($insert_patient);
    $stm->bind_param('sssssssss', $first_name, $last_name, $email, $hashed_password, $date_of_birth, $phone, $address, $gender, $image);

    if ($stm->execute()) {
        $msg = "Patient added successfully";
        header("location:patients.php?msg=$msg");
    } else {
        echo "Error: " . $stm->error;
    }
}
?>
<?php include("includes/header.php")?>
<?php include("includes/sidebar.php")?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Patient</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input name="first_name" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input name="last_name" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input name="email" class="form-control" type="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" class="form-control" type="password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input name="confirm-password" class="form-control" type="password">
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
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input name="address" type="text" class="form-control ">
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Phone </label>
                                                <input name="phone" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Avatar</label>
                                                <div class="profile-upload">
                                                    <div class="upload-img">
                                                        <img alt="" src="assets/img/user.jpg">
                                                    </div>
                                                    <div class="upload-input">
                                                        <input name="image" type="file" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-t-20 text-center">
                                        <button name="submit" class="btn btn-primary submit-btn">Create Patient</button>
                                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include("includes/script.php")?>
</body>


<!-- add-patient24:07-->

</html>