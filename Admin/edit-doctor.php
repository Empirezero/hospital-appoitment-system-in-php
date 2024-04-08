<?php include('includes/dbconfig.php');

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $date_joined = $_POST['date_joined'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];
    $status = $_POST['status'];
    $doctor_id = $_GET['doctor_id'];
    $image_path = $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "assets/img/" . $_FILES["image"]["name"]);

    // Validate password and confirm password
    if ($password != $confirm_password) {
        echo "Password and Confirm Password do not match.";
        exit; // Stop further execution
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to prevent SQL injection
    $query = "UPDATE doctor SET first_name=?, last_name=?, email=?, password=?, date_joined=?, address=?, phone=?, image=?, specialization=?, status=? WHERE doctor_id=?";
    $stm = $conn->prepare($query);
    $stm->bind_param('ssssssssssi', $first_name, $last_name, $email, $hashed_password, $date_joined, $address, $phone, $image_path, $specialization, $status, $doctor_id);

    if ($stm->execute()) {
        // Image upload handling
        if ($_FILES["image"]["error"] == 0) {
            $image_path = "assets/img/" . $_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
            // Update the database with the image path if needed
        }

        // Success message or redirection
        echo "<script>alert('Doctor information updated successfully.');</script>";
    } else {
        // Error handling
        echo "<script>alert('Failed to update doctor information.');</script>";
    }
}

?>


<!-----------------header---------->
<?php include('includes/header.php') ?>
<!-----------------end of header---------->

<!-----------------sidebar-menu---------->
<?php include('includes/sidebar.php') ?>
<!-----------------end of sidebar-menu--------->
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Edit Doctor</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="" enctype="multipart/form-data">
                    <?php
                    $doctor_id = $_GET['doctor_id'];
                    $query = "SELECT * FROM  doctor where doctor_id=?";
                    $stm = $conn->prepare($query);
                    $stm->bind_param('i', $doctor_id);
                    $stm->execute();
                    $results = $stm->get_result();
                    while ($row = $results->fetch_assoc()) {
                    ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>First Name<span class="text-danger">*</span></label>
                                    <input name="first_name" class="form-control" type="text" value="<?php echo $row['first_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input name="last_name" class="form-control" type="text" value="<?php echo $row['last_name']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input name="email" class="form-control" type="email" value="<?php echo $row['email']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" class="form-control" type="password" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input name="confirm_password" class="form-control" type="password" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date joined</label>
                                    <div class="cal-icon">
                                        <input name="date_joined" type="text" class="form-control" value="<?php echo $row['date_joined']; ?>" datetimepicker>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input name="address" type="text" class="form-control" value="<?php echo $row['address'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone </label>
                                    <input value="<?php echo $row['phone']; ?>" name="phone" class="form-control" type="text">
                                </div>
                            </div>
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
                        <div class="form-group">
                            <label>Specialization</label>

                            <?php
                            $get_specialization_info = "SELECT * FROM `specialization`";
                            $get_info = mysqli_query($conn, $get_specialization_info);

                            ?>
                            <select name="specialization" class="form-control" required>
                                <option value="<?php echo $row['specialization']; ?>"><?php echo $row['specialization'] ?></option>
                                <?php
                                while ($specialization_info = mysqli_fetch_assoc($get_info)) {
                                ?>
                                    <option value="<?php echo $specialization_info['name']; ?>">
                                        <?php echo $specialization_info['specialization_id'] ?> :<?php echo $specialization_info['name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Active"><?php echo $row['Status'] ?></option>
                                    <option value="inactive">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class=" m-t-20 text-center">
                            <button name="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>

                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
</body>


<!-- edit-doctor24:06-->

</html>
