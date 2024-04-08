<?php
// <!-----------------dbconfig---------->
include('includes/dbconfig.php');

$id = $_GET['patient_id'];
$query = "SELECT * FROM patients  WHERE patient_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    // Get schedule details from the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $date = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Check if a new image is uploaded
    if ($_FILES["image"]["name"]) {
        $image_path = $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "assets/img/" . $_FILES["image"]["name"]);
    } else {
        // No new image uploaded, retain the existing image path
        $image_path = $row['image'];
    }
    // Update patient info in the database
    // Use prepared statement to prevent SQL injection
    $query = "UPDATE patients SET first_name=?, last_name=?, email=?, password=?, gender=?, date_of_birth=?, address=?, phone=?, image=? WHERE patient_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssssssi', $first_name, $last_name, $email, $password, $gender, $date, $address, $phone, $image_path, $id);

    if ($stmt->execute()) {
        // Redirect with success message
        header('Location: patients.php?msg=patient details updated successfully');
        exit();
    } else {
        // Redirect with error message
        header('Location: patients.php?msg=Failed to update department');
        exit();
    }
}
include("includes/header.php");
include("includes/sidebar.php")

?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title"> Edit Patient</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input name="first_name" value="<?php echo $row['first_name']?>" class="form-control"
                                    type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input name="last_name" value="<?php echo $row['last_name']?>" class="form-control"
                                    type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input name="email" value="<?php echo $row['email']?>" class="form-control"
                                    type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone </label>
                                <input name="phone" value="<?php echo $row['phone']?>" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="col-lg-12 col-12">
                                    <input type="date" name="date_of_birth" id="date"
                                        value="<?php echo $row['date_of_birth']?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="<?php echo $row['gender']?>" <?php echo $row['gender']?>"</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input name="address" value="<?php echo $row['Address']?>" type="text"
                                        class="form-control ">
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label>Avatar</label>
                                            <div class="profile-upload">
                                                <div class="upload-img">
                                                    <img alt="" src="assets/img/<?php echo $row['image']?>">
                                                </div>
                                                <div class="upload-input">
                                                    <input name="image" type="file" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button name="submit" class="btn btn-primary submit-btn">Edit Patient</button>
                                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include("includes/script.php") ?>
</body>


<!-- add-patient24:07-->

</html>