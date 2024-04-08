<?php
include_once("includes/dbconfig.php");
session_start();

//Check if the doctor_id session variable is not set
if (!isset($_SESSION['patient_id'])) {
    // Redirect to the login page
    header('location: login.php');
    exit();
}

include('includes/header.php');
include('includes/sidebar.php');

?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <?php
                        // Query to get the total number of doctor
                        $result = mysqli_query($conn, "SELECT count(*) as totalDoctors FROM doctor");
                        $data = mysqli_fetch_assoc($result);
                        ?>


                        <h3><?php echo $data['totalDoctors']; ?></h3>

                        <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                    <div class="dash-widget-info text-right">
                        <?php $result = mysqli_query($conn, "SELECT COUNT(*) AS totalAttended FROM appointment WHERE status =
                        'Approved'");
                        $data = mysqli_fetch_assoc($result);
                        $totalAttended = $data['totalAttended'];
                        ?>
                        <h3><?php echo $totalAttended; ?></h3>
                        <span class="widget-title2">Approved<i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <?php $result = mysqli_query($conn, "SELECT COUNT(*) AS totalAttended FROM appointment WHERE status =
                        'cancelled'");
                        $data = mysqli_fetch_assoc($result);
                        $totalAttended = $data['totalAttended'];
                        ?>
                        <h3><?php echo $totalAttended; ?></h3>
                        <span class="widget-title3">cancelled<i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <?php $result = mysqli_query($conn, "SELECT COUNT(*) AS totalAttended FROM appointment WHERE status =
                        'pending'");
                        $data = mysqli_fetch_assoc($result);
                        $totalAttended = $data['totalAttended'];
                        ?>
                        <h3><?php echo $totalAttended; ?></h3>
                        <span class="widget-title4">Pending <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-md-6 col-lg-10 col-xl-10">
                <div class="card member-panel">
                    <div class="card-header bg-white">
                        <h4 class="card-title mb-0">Doctors</h4>
                    </div>
                    <div class="card-body">
                        <ul class="contact-list">
                            <?php
                            $sqlDoctorsList = "SELECT * FROM doctor LIMIT 5";
                            $resultDoctorsList = mysqli_query($conn, $sqlDoctorsList);
                            while ($row = mysqli_fetch_assoc($resultDoctorsList)) {
                            ?>
                            <li>
                                <div class="contact-cont">
                                    <div class="float-left user-img m-r-10">
                                        <a href="profile.html"
                                            title="<_?php echo $row['first_name'] .''. $row['last_name']; ?>">
                                            <img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle">
                                            <span class="status online"></span>
                                        </a>
                                    </div>
                                    <div class="contact-info">
                                        <span class="contact-name text-ellipsis">
                                            <?php echo $row['first_name'] . '' .
                                                    $row['last_name']; ?>
                                        </span>
                                        <span class="contact-date"><?php echo $row['specialization']; ?></span>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="card-footer text-center bg-white">
                        <a href="doctors.php" class="text-muted">View all Doctors</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</div>
</div>
<div class="sidebar-overlay" data-reff=""></div>

<?php include('includes/script.php') ?>
</body>

</html>



<?php include_once("includes/script.php"); ?>