<?php
// <!-----------------dbconfig---------->
include('includes/dbconfig.php');
include('includes/header.php');
include('includes/sidebar.php');

// Check if the form is submitted
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Schedule</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-border table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor ID</th>
                                <th>Doctor name</th>
                                <th>Available Days</th>
                                <th>Available Time</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT schedule.*, doctor.first_name, doctor.last_name FROM schedule INNER JOIN doctor ON schedule.doctor_id = doctor.doctor_id";
                            $stm = mysqli_query($conn, $query);
                            $cnt = 1;
                            while ($row = mysqli_fetch_assoc($stm)) {
                            ?>
                            <tr>
                                <td> <?php echo $cnt ?></td>
                                <td><?php echo $row['doctor_id'] ?></td>
                                <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
                                <td><?php echo $row['day_of_week'] ?></td>
                                <td><?php echo $row['start_time'] . "
                                    - " . $row['end_time'] ?></td>

                                <td> <span
                                        class="custom-badge <?php echo strtolower($row['status']) === 'inactive' ? 'status-red' : 'status-green'; ?>">
                                        <?php echo $row['status']; ?>
                                    </span></td>
                                <td class="text-right">

                                </td>
                            </tr>
                            <div id="delete_schedule_<?php echo $row['schedule_id'] ?>" class="modal fade delete-modal"
                                role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                                            <h3>Are you sure want to delete this Schedule?</h3>
                                            <div class="m-t-20">
                                                <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                <a href="delete-schedule.php?schedule_id=<?php echo $row['schedule_id']; ?>"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                        <?php $cnt = $cnt + 1;
                            } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
</body>


<!-- schedule23:21-->

</html>