<?php
include('includes/dbconfig.php');
include('includes/header.php') ?>

<!-- bradcam_area_start  -->
<div class="bradcam_area breadcam_bg_2 bradcam_overlay">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Doctors</h3>
                    <p><a href="index.html">Home /</a> Doctors</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bradcam_area_end  -->

<!-- expert_doctors_area_start -->
<div class="expert_doctors_area doctor_page">
    <div class="container">
        <div class="row">

            <?php
            $get_doctor_info = "SELECT * FROM doctor";
            $stm = $conn->prepare($get_doctor_info);
            $stm->execute();
            $results = $stm->get_result();
            while ($row = $results->fetch_assoc()) {

            ?>
            <div class="col-md-6 col-lg-3">
                <div class="single_expert mb-40">
                    <div class="expert_thumb">
                        <img src="admin/assets/img/<?php echo $row['image']; ?>" alt="no image found"
                            style="height: 250px">
                    </div>
                    <div class="experts_name text-center">
                        <h3><?php echo $row['first_name'] . '  ' .  $row['last_name'] ?></h3>
                        <h5><?php echo $row['phone'] ?></h5>
                        <span><?php echo $row['specialization'] ?></span>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- expert_doctors_area_end -->



<!-- footer start -->
<?php include("footer.php") ?>