<?php
// <!-----------------dbconfig---------->
include('includes/dbconfig.php');

$id = $_GET['specialization_id'];
$query = "SELECT * FROM specialization WHERE specialization_id = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if (isset($_POST['update_department'])) {
    // Get department details from the form
    $department_name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Update department into the database
    $update_query = "UPDATE specialization SET name = ?, description = ?, status = ? WHERE specialization_id = '$id'";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('sss', $department_name, $description, $status);

    if ($stmt->execute()) {
        // Redirect with success message
        header('Location: departments.php?msg=Department updated successfully');
        exit();
    } else {
        // Redirect with error message
        header('Location: departments.php?msg=Failed to update department');
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
                <h4 class="page-title">Edit Department</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">
                    <div class="form-group">
                        <label>Department Name</label>
                        <input name="name" class="form-control" type="text" value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" cols="30" rows="4" class="form-control"><?php echo $row['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Department Status</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>status</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?php echo strtolower($row['status']) === 'active' ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo strtolower($row['status']) === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button name="update_department" class="btn btn-primary submit-btn">Update Department</button>
                    </div>
                </form>
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
</body>

</html>