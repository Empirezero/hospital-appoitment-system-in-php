<?php
session_start();
include('includes/dbconfig.php');

// Check if the admin_id session variable is not set
if (!isset($_SESSION['admin_id'])) {
    // Redirect to the login page
    header('location: login.php');
    exit();
}

include('includes/header.php');
include('includes/sidebar.php');
// Function to generate a random invoice number
function generateRandomInvoiceNumber()
{
    return 'INV-' . rand(1, 1000);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $status = $_POST['status'];

    $query = "SELECT * FROM invoices WHERE invoice_date BETWEEN ? AND ? AND status = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $from_date, $to_date, $status);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Fetch all invoices if no date range is specified
    $query = "SELECT * FROM invoices";
    $result = mysqli_query($conn, $query);
}
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-5 col-4">
                <h4 class="page-title">Invoices</h4>
            </div>
            <div class="col-sm-7 col-8 text-right m-b-30">
                <a href="create-invoice.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i>
                    Create New Invoice</a>
            </div>
        </div>
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">From</label>
                    <div class="cal-icon">
                        <form method="POST" action="">
                            <input type="date" name="from_date" id="from_date" value="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">To</label>
                    <div class="cal-icon">
                        <input type="date" name="to_date" id="to_date" value="" class="form-control">
                    </div>
                </div>
            </div>
            <div class=" col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <label class="focus-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Paid">Paid</option>
                        <option value="Partially Paid">Partially Paid</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block" name="search">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice number</th>
                                <th>Patient ID</th>
                                <th>Created Date</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><a href="invoice-view.php"><?php echo generateRandomInvoiceNumber(); ?></a></td>
                                <td><?php echo $row['patient_id']; ?></td>
                                <td><?php echo $row['invoice_date']; ?></td>
                                <td><?php echo $row['due_date']; ?></td>
                                <td>Ksh <?php echo $row['amount']; ?></td>
                                <td>
                                    <?php
                                            $status = $row['status'];
                                            $badgeClass = $status === 'paid' ? 'status-green' : ($status === 'pending' ? 'status-purple' : 'status-red');
                                            ?>
                                    <span class="custom-badge <?php echo $badgeClass; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="edit-invoice.php?id=<?php echo $row['id']; ?>"><i
                                                    class="fa fa-pencil m-r-5"></i>Edit</a>
                                            <a class="dropdown-item"
                                                href="invoice-view.php? patient_id=<?php echo $row['patient_id'] ?>"><i
                                                    class="fa fa-eye m-r-5"></i>View</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fa fa-file-pdf-o m-r-5"></i>Download</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_invoice_<?php echo $row['id']; ?>"><i
                                                    class="fa fa-trash-o m-r-5"></i>Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php }
                            } else { ?>
                            <tr>
                                <td colspan="8" class="text-center">No records found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<?php if (mysqli_num_rows($result) > 0) {
    mysqli_data_seek($result, 0); // Reset result pointer
    while ($row = mysqli_fetch_assoc($result)) { ?>
<div id="delete_invoice_<?php echo $row['id']; ?>" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="assets/img/sent.png" alt="" width="50" height="46">
                <h3>Are you sure you want to delete this Invoice?</h3>
                <div class="m-t-20">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <a href="delete-invoice.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
} ?>

<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
</body>

</html>