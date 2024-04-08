<?php
// <!-----------------dbconfig---------->
include('includes/dbconfig.php');

if (isset($_POST['add_specialization'])) {
    // Get specialization details from the form
    $specialization_name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];

       // Check if the specialization already exists
       $check_query = "SELECT * FROM specialization WHERE name = ?";
       $check_stmt = $conn->prepare($check_query);
       $check_stmt->bind_param('s', $specialization_name);
       $check_stmt->execute();
       $check_result = $check_stmt->get_result();
   
       if ($check_result->num_rows > 0) {
           // Specialization already exists, redirect with an error message
           header('Location: departments.php?msg=Specialization already exists');
           exit();
       }

    // Insert specialization into the database
    $insert_query = "INSERT INTO specialization (name, description, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param('sss', $specialization_name, $description, $status);

    if ($stmt->execute()) {
        // Redirect with success message
        header('Location: departments.php?msg=Specialization added successfully');
        exit();
    } else {
        // Redirect with error message
        header('Location: departments.php?msg=Failed to add specialization');
        exit();
    }
}

include('includes/header.php');
include('includes/sidebar.php');

?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Specialization</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST">
                    <div class="form-group">
                        <label>Specialization Name</label>
                        <input name="name" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Specialization Status</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button name="add_specialization" class="btn btn-primary submit-btn">Create Specialization</button>
                    </div>
                </form>
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
</body>
<!-- add-specialization24:07-->
</html>
