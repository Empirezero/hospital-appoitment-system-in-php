<?php
include('includes/dbconfig.php');

if (isset($_POST['submit'])) {
    // Get appointment details from the form
    $id = $_GET['appointment_id'];
    $appointment_date = $_POST['date'];
    $appointment_time = $_POST['time'];
    $status = $_POST['status'];
    $message = $_POST['message'];

    // Update appointment info in the database
    $update_query = "UPDATE appointment SET appointment_date = ?, appointment_time = ?, message = ?, status = ? WHERE appointment_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('ssssi', $appointment_date, $appointment_time, $message, $status, $id);

    if ($stmt->execute()) {
        // Redirect with success message
        header('Location: appointments.php?msg=appointment updated successfully');
        exit();
    } else {
        // Redirect with error message
        header('Location: appointments.php?msg=Failed to update department');
        exit();
    }
}

include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Edit Appointment</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="" method="POST">
                    <?php
                    $appointment_id = $_GET['appointment_id'];
                    $query = "SELECT * FROM appointment WHERE appointment_id=?";
                    $stm = $conn->prepare($query);
                    $stm->bind_param('i', $appointment_id);
                    $stm->execute();
                    $result = $stm->get_result();
                    $row = $result->fetch_assoc();
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Doctor id <span class="text-danger">*</span></label>
                                <input name="first_name" class="form-control" type="text"
                                    value="<?php echo $row['doctor_id']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="department" class="form-control" type="text"
                                    value="<?php echo $row['specialization']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" id="date" value="<?php echo $row['appointment_date']; ?>"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <input type="time" name="time" id="time" value="<?php echo $row['appointment_time']; ?>"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Email</label>
                                <input name="email" value="<?php echo $row['email'] ?>" class="form-control"
                                    type="email" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Phone Number</label>
                                <input name="phone_no" value="<?php echo $row['phone_no'] ?>" class="form-control"
                                    type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" cols="30" rows="4"
                            class="form-control"><?php echo $row['message']; ?></textarea>
                    </div>
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label>Appointment status</label>
                            <select name="status" class="form-control">
                                <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>
                                    Pending</option>
                                <option value="approved" <?php if ($row['status'] == 'approved') echo 'selected'; ?>>
                                    approved</option>
                                <option value="cancelled" <?php if ($row['status'] == 'cancelled') echo 'selected'; ?>>
                                    Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button name="submit" class="btn btn-primary submit-btn">Edit Appointment</button>
                    </div>
                </form>
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