<?php
include('includes/dbconfig.php');
session_start();

// Check if the patient_id session variable is not set
if (!isset($_SESSION['patient_id'])) {
    // Redirect to the login page
    header('location: login.php');
    exit();
}
include('includes/header.php');
include('includes/sidebar.php');

// Check if the form is submitted
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Appointments</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor id</th>
                                <th>Deparment</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Status</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $patient_id = $_SESSION['patient_id'];
                            $sql = "SELECT * FROM appointment WHERE status ='pending' && patient_id=?";
                            $stm = $conn->prepare($sql);
                            $stm->bind_param("i", $patient_id);
                            $stm->execute();
                            $results = $stm->get_result();
                            $cnt = 1;
                            while ($row = $results->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $cnt ?></td>
                                <td><?php echo $row['doctor_id'] ?></td>
                                <td><?php echo $row['specialization'] ?></td>
                                <td><?php echo $row['appointment_date'] ?></td>
                                <td><?php echo $row['appointment_time'] ?></td>
                                <td>
                                    <?php
                                        $status = $row['status'];
                                        $badgeClass = $status === 'approved' ? 'status-green' : ($status === 'pending' ? 'status-purple' : 'status-red');
                                        ?>

                                    <span class="custom-badge <?php echo $badgeClass; ?>">
                                        <?php echo $status; ?>
                                    </span>

                                </td>
                                <td><?php echo $row['message'] ?></td>

                            </tr>
                            <div id="delete_appointment_<?php echo $row['appointment_id']; ?>"
                                class="modal fade delete-modal" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                                            <h3>Are you sure want to delete this Appointment?</h3>
                                            <div class="m-t-20">
                                                <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                <a href="delete-appointment.php?appointment_id=<?php echo $row['appointment_id']; ?>"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $cnt = $cnt + 1;
                            } ?>
                        </tbody>
                    </table>
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
<!-- appointments23:20-->

</html>