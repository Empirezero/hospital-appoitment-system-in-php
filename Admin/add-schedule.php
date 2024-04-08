<?php
// <!-----------------dbconfig---------->
include('includes/dbconfig.php');

if (isset($_POST['submit'])) {
    $doctor_id = $_POST['name'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $message = $_POST['message'];
    $status = $_POST['status'];

    $query = "INSERT INTO  schedule (doctor_id, day_of_week, start_time, end_time,message, status) VALUES (?,?,?,?,?,?)";
    $stm = $conn->prepare($query);
    $stm->bind_param('ssssss', $doctor_id, $day_of_week, $start_time, $end_time, $message, $status);
    if ($stm->execute()) {
        header('location: schedule.php?msg=schedule added successfully');
        exit();
    } else {
        header('location: schedule.php?msg= Failed to add schedule');
        exit();
    }
}


include('includes/header.php');
include('includes/sidebar.php');

// Check if the form is submitted
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Schedule</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Doctor Name</label>
                                <select name="name" class="form-control" required >
                                    <option value="">Select doctor</option>
                                    <?php
                                    $get_doctor_info = "SELECT * FROM doctor";
                                    $stm = mysqli_query($conn, $get_doctor_info);
                                    while ($row = mysqli_fetch_assoc($stm)) {
                                    ?>
                                        <option value="<?php echo $row['doctor_id'] ?>"><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Available days</label>
                                <select name="day_of_week" class="form-control" required>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wendsday">Wendsday</option>
                                    <option value="Wendsday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Time</label>
                                <div class="col-lg-12 col-12">
                                    <input type="time" name="start_time" id="time" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Time</label>
                                <div class="col-lg-12 col-12">
                                    <input type="time" name="end_time" id="time" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Schedule Status</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="m-t-20 text-center">
                            <a href=""><button type="submit" name="submit" class="btn btn-primary submit-btn">Create Schedule</button></a>
                        </div>
                </form>
            </div>
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
<script>
    $(function() {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
        $('#datetimepicker4').datetimepicker({
            format: 'LT'
        });
    });
</script>
</body>


<!-- add-schedule24:07-->

</html>