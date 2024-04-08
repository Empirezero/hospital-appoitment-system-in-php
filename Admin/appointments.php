<?php
session_start();
include('includes/dbconfig.php');

// Check if the doctor_id session variable is not set
if (!isset($_SESSION['admin_id'])) {
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
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-appointment.php" class="btn btn btn-primary btn-rounded float-right"><i
                        class="fa fa-plus"></i> Add Appointment</a>
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
                                <th>patient id</th>
                                <th>Deparment</th>
                                <th>Appointment Date</t>
                                <th>Appointment Time</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT * FROM appointment";
                            $stm = $conn->prepare($sql);
                            $stm->execute();
                            $results = $stm->get_result();
                            $cnt = 1;
                            while ($row = $results->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $cnt ?></td>
                                <td><?php echo $row['doctor_id'] ?></td>
                                <td><?php echo $row['patient_id'] ?></td>
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
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="edit-appointment.php?appointment_id=<?php echo $row['appointment_id'] ?>">
                                                <i class="fa fa-pencil m-r-5"></i> Edit
                                            </a>

                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_appointment_<?php echo $row['appointment_id']; ?>">
                                                <i class="fa fa-trash-o m-r-5"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div admin_id="delete_appointment_<?php echo $row['appointment_id']; ?>"
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