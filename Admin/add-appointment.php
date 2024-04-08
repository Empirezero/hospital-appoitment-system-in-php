<?php
include('includes/dbconfig.php');
session_start();

// Check if the patient_id session variable is not set
if (!isset($_SESSION['admin_id'])) {
    // Redirect to the login page
    header('location: login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_POST['patient_id'];
    $department = $_POST['specialization'];
    $appointment_date = $_POST['date'];
    $appointment_time = $_POST['time'];
    $status = 'pending';  // Use a default value for status
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $message = $_POST['message'];

    // Check if the patient already has an appointment at the chosen date and time
    $check_appointment_query = "SELECT * FROM appointment WHERE doctor_id = ? AND appointment_date = ? AND appointment_time = ?";
    $check_appointment_stm = $conn->prepare($check_appointment_query);
    $check_appointment_stm->bind_param('iss', $doctor_id, $appointment_date, $appointment_time);
    $check_appointment_stm->execute();
    $appointment_result = $check_appointment_stm->get_result();

    if ($appointment_result->num_rows == 0) {
        // Insert the new appointment
        $insert_appointment_query = "INSERT INTO appointment (patient_id, doctor_id,specialization,appointment_date, appointment_time, phone_no, email,message,status) VALUES (?,?, ?,?,?, ?, ?, ?, ?)";
        $insert_appointment_stm = $conn->prepare($insert_appointment_query);
        $insert_appointment_stm->bind_param('iisssssss', $patient_id, $doctor_id, $department, $appointment_date, $appointment_time, $phone_no, $email, $message, $status);

        if ($insert_appointment_stm->execute()) {
            header('location: appointments.php?msg=Appointment booked successfully');
            exit();
        } else {
            header('location: appointments.php?msg=Failed to book appointment');
            exit();
        }
    } else {
        header('location: appointments.php?msg=Patient already has an appointment at this time');
        exit();
    }
}
?>



<!-----------------header---------->
<?php include('includes/header.php') ?>
<!-----------------end of header---------->

<!-----------------sidebar-menu---------->
<?php include('includes/sidebar.php') ?>
<!-----------------end of sidebar-menu---------->
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Book Appointment</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Doctor Name</label>
                                <select name="doctor_id" class="form-control">
                                    <option value="">Select doctor</option>
                                    <?php
                                    $get_doctor_info = "SELECT * FROM doctor";
                                    $stm = mysqli_query($conn, $get_doctor_info);
                                    while ($row = mysqli_fetch_assoc($stm)) {
                                    ?>
                                    <option value="<?php echo
                                                        $row['doctor_id'] ?>">
                                        <?php echo $row['doctor_id'] . ' : ' . $row['first_name'] . ' ' . $row['last_name'] . ' : ' . $row['specialization'] ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Name</label>
                                <select name="patient_id" class="form-control">
                                    <option value="">Select Patients</option>
                                    <?php
                                    $get_patient_info = "SELECT * FROM patients";
                                    $stm = mysqli_query($conn, $get_patient_info);
                                    while ($row = mysqli_fetch_assoc($stm)) {
                                    ?>
                                    <option value="<?php echo
                                                        $row['patient_id'] ?>">
                                        <?php echo $row['patient_id'] . ' : ' . $row['first_name'] . ' ' . $row['last_name'] ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Department</label>
                                    <select name="specialization" id="" class="form-control">
                                        <option value="">Select department</option>
                                        <?php
                                        $get_department = "SELECT * FROM  doctor";
                                        $stm = mysqli_query($conn, $get_department);
                                        while ($row = mysqli_fetch_assoc($stm)) {
                                        ?>

                                        <option value="<?php echo $row['specialization'] ?>">
                                            <?php echo $row['specialization'] ?></option> <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <div class="col-lg-12 col-12">
                                        <input type="date" name="date" id="date" value="" class="form-control">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time</label>
                                    <div class="col-lg-12 col-12">
                                        <input type="time" name="time" id="time" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Patient Email</label>
                                    <input name="email" class="form-control" type="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Patient Phone Number</label>
                                    <input name="phone_no" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6 d-none">
                            <div class="form-group">
                                <label>Appointment status</label>
                                <select name="status" class="form-control">
                                    <option value="pending">Select status</option>
                                </select>
                            </div>
                        </div>
                        <div class="m-t-20 text-center">
                            <button name="submit" class="btn btn-primary submit-btn">Create Appointment</button>
                        </div>
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

</html>