<!-----------------dbconfig---------->

<?php include('includes/dbconfig.php');
session_start();
include('includes/dbconfig.php');

// Check if the admin_id session variable is not set
if (!isset($_SESSION['doctor_id'])) {
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
                        <?php
                        // Query to get the total number of doctor
                        $result = mysqli_query($conn, "SELECT count(*) as totalPatients FROM patients");
                        $data = mysqli_fetch_assoc($result);
                        ?>


                        <h3><?php echo $data['totalPatients']; ?></h3>
                        <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <?php $result = mysqli_query($conn, "SELECT COUNT(*) AS totalAttended FROM appointment WHERE status =
                        'Approved'");
                        $data = mysqli_fetch_assoc($result);
                        $totalAttended = $data['totalAttended'];
                        ?>
                        <h3><?php echo $totalAttended; ?></h3>
                        <span class="widget-title3">Completed<i class="fa fa-check" aria-hidden="true"></i></span>
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
            <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="appointments.html"
                            class="btn btn-primary float-right">View all</a>
                    </div>
                    <div class="card-body p-0">
                        <?php
                        $sql = "SELECT appointment.*, patients.first_name, patients.last_name,patients.Address,doctor.first_name,doctor.last_name
                        FROM appointment
                        INNER JOIN patients ON appointment.patient_id = patients.patient_id
                        INNER JOIN doctor ON appointment.doctor_id = doctor.doctor_id WHERE appointment.status='pending'
                       ";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="d-none">
                                    <tr>
                                        <th>
                                            patient name
                                        </th>
                                        <th>Doctor Name</th>
                                        <th>Timing</th>
                                        <th class="text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="min-width: 200px;">
                                            <a class="avatar" href="profile.html">B</a>
                                            <h2><a href="profile.html"><?php echo $row['first_name'] . ' ' . $row['last_name'] ?>
                                                    <span>
                                                        <?php echo $row['Address'] ?>
                                                    </span></a>
                                            </h2>
                                        </td>
                                        <td>
                                            <h5 class="time-title p-0">Appointment With</h5>
                                            <p>
                                                <?php echo $row['first_name'] . ' ' . $row['last_name'] ?>
                                            </p>
                                        </td>
                                        <td>
                                            <h5 class="time-title p-0">Timing</h5>
                                            <p>7.00 PM</p>
                                        </td>
                                        <td class="text-right">
                                            <a href="appointments.html" class="btn btn-outline-primary take-btn">Take
                                                up</a>
                                        </td>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4">
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