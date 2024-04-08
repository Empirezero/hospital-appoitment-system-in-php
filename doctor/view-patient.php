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
            <div class="col-sm-4 col-6">
                <h4 class="page-title">Patients</h4>
            </div>
        </div>

        <div class="row doctor-grid">
            <?php
            $patient_id = $_GET['patient_id'];
            $query = "SELECT * FROM patients WHERE patient_id=?";
            $stm = $conn->prepare($query);
            $stm->bind_param('i', $patient_id);
            $stm->execute();
            $result = $stm->get_result();
            $row = $result->fetch_assoc();
            ?>
            <div class="col-md-6 col-sm-6 col-lg-6">
                <div class="profile-widget">
                    <div class="doctor-img">
                        <a class="avatar" href="profile.html">
                            <img alt="" src="assets/img/<?php echo $row['image']; ?>"">
                        </a>
                    </div>

                       <h4 class=" patient-name text-ellipsis">
                            <a href="profile.html"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></a>
                            </h4>

                            <div class="pat-prof"><?php echo $row['phone']; ?></div>
                            <div class="doc-prof"><?php echo $row['email']; ?></div>
                            <div class="user-country">
                                <i class="fa fa-map-marker"></i> <?php echo $row['Address']; ?>
                            </div>

                    </div>
                </div>


            </div>
        </div>
        <!-- Rest of your HTML and scripts -->
    </div>

</div>
</div>
<div class=" sidebar-overlay" data-reff="">
</div>
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
setTimeout(function() {
    document.getElementById('alert-msg').style.display = 'none';
}, 5000);
</script>
</body>


<!-- doctors23:17-->

</html>