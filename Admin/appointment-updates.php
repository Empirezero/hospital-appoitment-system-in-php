<?php
include('includes/dbconfig.php');
include('includes/header.php');
include('includes/sidebar.php');

if (isset($_POST['search'])) {
  // Get the dates from the form
  $from_date = $_POST['from_date'];
  $to_date = $_POST['to_date'];

  // SQL query to select appointments between the provided dates
  $query = "SELECT * FROM appointment WHERE appointment_date BETWEEN ? AND ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('ss', $from_date, $to_date);
  $stmt->execute();
  $result = $stmt->get_result();
} else {
  // If dates are not provided, fetch all appointments
  $query = "SELECT * FROM appointment";
  $result = $conn->query($query);
}

?>

<div class="page-wrapper">
  <div class="content">
    <div class="row">
      <div class="col-sm-12">
        <h4 class="page-title">Appointment Report</h4>
      </div>
    </div>

    <form method="POST">
      <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
          <div class="form-group form-focus">
            <label class="focus-label">From</label>
            <div>
              <input type="date" name="from_date" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="form-group form-focus">
            <label class="focus-label">To</label>
            <div>
              <input type="date" name="to_date" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <button type="submit" name="search" class="btn btn-success btn-block">Search</button>
        </div>
    </form>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-striped custom-table mb-0 datatable">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Appointment Number</th>
              <th>Patient id</th>
              <th>Mobile Number</th>
              <th>Email</th>
              <th>Status</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $serial_number = 1;
            while ($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td><?php echo $serial_number++; ?></td>
                <td><a href="invoice-view.php">#<?php echo $row['appointment_id']; ?></a></td>
                <td><?php echo $row['patient_id']; ?></td>
                <td><?php echo $row['phone_no']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><span class="custom-badge status-green"><?php echo $row['status']; ?></span></td>
                <td class="text-right">
                  <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="edit-invoice.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                      <a class="dropdown-item" href="invoice-view.php"><i class="fa fa-eye m-r-5"></i>
                        View</a>
                      <a class="dropdown-item" href="#"><i class="fa fa-file-pdf-o m-r-5"></i>
                        Download</a>
                      <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i>
                        Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
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

</html>