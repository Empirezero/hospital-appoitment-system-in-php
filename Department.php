<?php
include('includes/dbconfig.php');
include('includes/header.php') ?>
<!-- bradcam_area_start  -->
<div class="bradcam_area breadcam_bg bradcam_overlay">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Services</h3>
                    <p><a href="index.html">Home /</a> Services</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bradcam_area_end  -->

<!-- service_area_start -->
<div class="service_area">
    <div class="container p-0">
        <div class="row no-gutters">
            <div class="col-xl-4 col-md-4">
                <div class="single_service">
                    <div class="icon">
                        <i class="flaticon-electrocardiogram"></i>
                    </div>
                    <h3>Hospitality</h3>
                    <p>Clinical excellence must be the priority for any health care service provider.</p>
                    <a href="#" class="boxed-btn3-white">Apply For a Bed</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="single_service">
                    <div class="icon">
                        <i class="flaticon-emergency-call"></i>
                    </div>
                    <h3>Emergency Care</h3>
                    <p>Clinical excellence must be the priority for any health care service provider.</p>
                    <a href="#" class="boxed-btn3-white">+254745900479</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="single_service">
                    <div class="icon">
                        <i class="flaticon-first-aid-kit"></i>
                    </div>
                    <h3>Chamber Service</h3>
                    <p>Clinical excellence must be the priority for any health care service provider.</p>
                    <a href="#" class="boxed-btn3-white">Make an Appointment</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- service_area_end -->

<!-- offers_area_start -->
<?php include("Departments.php")?>
<!-- offers_area_end -->


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

< <?php include("footer.php") ?>