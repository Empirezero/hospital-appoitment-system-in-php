<?php
// <!-----------------dbconfig---------->
 include('includes/dbconfig.php');
include('includes/header.php');
include('includes/sidebar.php');

// Check if the form is submitted
?>

<div class="page-wrapper">
    <div class="content">
    <?php if (!empty($_GET['msg'])) {
    $msg = $_GET['msg'];
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>' . $msg . '</strong>
          </div>';
}
?>
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Doctors</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-doctor.php" class="btn btn-primary btn-rounded float-right">
                    <i class="fa fa-plus"></i> Add Doctor
                </a>
            </div>
        </div>

        <div class="row doctor-grid">
            <?php
            // Get doctor details from the database
            $get_info = "SELECT * FROM doctor ORDER BY RAND()";
            $stmt = $conn->prepare($get_info);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4 col-sm-4 col-lg-3">
                    <div class="profile-widget">
                        <div class="doctor-img">
                            <a class="avatar" href="profile.html">
                                <img alt="" src="assets/img/<?php echo $row['image']; ?>">
                            </a>
                        </div>
                        <div class="dropdown profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item"   <a class="dropdown-item" href="edit-doctor.php?doctor_id=<?php echo $row['doctor_id']; ?>">
                                    <i class="fa fa-pencil m-r-5"></i> Edit
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor<?php echo $row['doctor_id']; ?>">
                                    <i class="fa fa-trash-o m-r-5"></i> Delete
                                </a>
                            </div>
                        </div>
                        <h4 class="doctor-name text-ellipsis">
                            <a href="profile.html"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></a>
                        </h4>
                        <div class="doc-prof"><?php echo $row['specialization']; ?></div>
                        <div class="user-country">
                            <i class="fa fa-map-marker"></i> <?php echo $row['address']; ?>
                        </div>
                    </div>
                </div>

                <!-- Delete Doctor Modal -->
                <div id="delete_doctor<?php echo $row['doctor_id']; ?>" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="assets/img/sent.png" alt="" width="50" height="46">
                                <h3>Are you sure want to delete this Doctor?</h3>
                                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <a href="delete-doctor.php?doctor_id=<?php echo $row['doctor_id']; ?>" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Delete Doctor Modal -->

            <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="see-all">
                    <a class="see-all-btn" href="javascript:void(0);">Load More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Rest of your HTML and scripts -->
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
// Automatically close the alert after 5 seconds (5000 milliseconds)
setTimeout(function(){
    document.getElementById('alert-msg').style.display = 'none';
}, 5000);</script>
</body>


<!-- doctors23:17-->
</html>