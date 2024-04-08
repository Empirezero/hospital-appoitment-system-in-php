<?php
// <!-----------------dbconfig---------->
include('includes/dbconfig.php');

$id = $_GET['schedule_id'];
$query = "SELECT * FROM schedule WHERE schedule_id = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if (isset($_POST['update_schedule'])) {
    // Get schedule details from the form
    $day_of_week = $_POST['day_of_week'];
    $start_time= $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $message = $_POST['message'];
    $status = $_POST['status'];


    // Update schedule info in  the database
    $update_query = "UPDATE schedule SET  day_of_week = ?, start_time = ?, end_time =?,message=?, status=? WHERE schedule_id = '$id'";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('sssss',$day_of_week, $start_time, $end_time, $message ,$status);

    if ($stmt->execute()) {
        // Redirect with success message
        header('Location: schedule.php?msg=schedule updated successfully');
        exit();
    } else {
        // Redirect with error message
        header('Location: schedule.php?msg=Failed to update department');
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
                <h4 class="page-title">Edit Schedule</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="" method="post">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Doctor Name</label>
                                <input class="form-control" name="doctor_id" value="<?php echo $row['doctor_id']?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Available days</label>
                                <select name="day_of_week" class="form-control" required>
                                    <option value="<?php echo $row['day_of_week']?>"><?php echo $row['day_of_week']?>
                                    </option>
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
                                <div class="time-icon">
                                    <input type="text" name="start_time" value='<?php echo $row['start_time']?>'
                                        class="form-control" id="datetimepicker3">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Time</label>
                                <div class="time-icon">
                                    <input type="text" name="end_time" value="<?php echo $row['end_time']?>"
                                        class="form-control" id="datetimepicker4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea cols="30" rows="4" name="message"
                            class="form-control"><?php echo $row['message']?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Schedule Status</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>status</label>
                                <select name="status" class="form-control">
                                    <option value="active"
                                        <?php echo strtolower($row['status']) === 'active' ? 'selected' : ''; ?>>Active
                                    </option>
                                    <option value="inactive"
                                        <?php echo strtolower($row['status']) === 'inactive' ? 'selected' : ''; ?>>
                                        Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button name="update_schedule" class="btn btn-primary submit-btn">Update Department</button>
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
<script src="assets/js/app.js"></script>
<script>
$(function() {
    $('#datetimepicker3').datetimepicker({
        format: 'LT'

    });
});
</script>
<script>
$(function() {
    $('#datetimepicker4').datetimepicker({
        format: 'LT'

    });
});
</script>
</body>


</html>