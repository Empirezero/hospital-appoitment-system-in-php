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
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-schedule.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Schedule</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-border table-striped custom-table mb-0">
                        <thead>
                            <tr>     
                                <th>#</th>
                                <th>Doctor ID</th>
                                <th>Available Days</th>
                                <th>Available Time</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT * FROM schedule";
                            $stm = mysqli_query($conn, $query);
                            $cnt = 1;
                            while ($row = mysqli_fetch_assoc($stm)) {
                            ?>
                                <tr>
                                   <td> <?php echo $cnt?></td>
                                    <td><?php echo $row['doctor_id']?></td>
                                    <td><?php echo $row['day_of_week']?></td>
                                    <td><?php echo $row['start_time'] ."
                                    - ". $row['end_time']?></td>
                                    
                                    <td> <span class="custom-badge <?php echo strtolower($row['status']) === 'inactive' ? 'status-red' : 'status-green'; ?>">
                                            <?php echo $row['status']; ?>
                                        </span></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="edit-schedule.php?schedule_id=<?php echo $row['schedule_id'] ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_schedule_<?php echo $row['schedule_id'] ?>""><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div id="delete_schedule_<?php echo $row['schedule_id'] ?>" class="modal fade delete-modal" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <img src="assets/img/sent.png" alt="" width="50" height="46">
                                                <h3>Are you sure want to delete this Schedule?</h3>
                                                <div class="m-t-20">
                                                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                    <a href="delete-schedule.php?schedule_id=<?php echo $row['schedule_id']; ?>" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </tbody>
                    <?php $cnt=$cnt+1;} ?>
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
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
</body>


<!-- schedule23:21-->

</html>