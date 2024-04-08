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

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $invoice_id = $_GET['id'];
    $patient = $_POST['patient_id']; // Corrected field name
    $department = $_POST['department'];
    $tax = $_POST['tax'];
    $billing_address = $_POST['billing_address'];
    $invoice_date = $_POST['invoice_date'];
    $due_date = $_POST['due_date'];
    $item = $_POST['item'];
    $description = $_POST['description'];
    $unit_cost = $_POST['unit_cost'];
    $qty = $_POST['qty'];
    $message = $_POST['message'];
    $status = $_POST['status']; // Added status field
    $amount = $unit_cost * $qty;
    $update_query = "UPDATE invoices SET patient_id=?, department=?, tax=?, billing_address=?, invoice_date=?, due_date=?, item=?, description=?, unit_cost=?, qty=?, amount=?, message=?, status=? WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param(
        'sssssssssssssi',
        $patient,
        $department,
        $tax,
        $billing_address,
        $invoice_date,
        $due_date,
        $item,
        $description,
        $unit_cost,
        $qty,
        $amount,
        $message,
        $status,
        $invoice_id
    );

    if ($stmt->execute()) {
        // Redirect with success message
        header("location:invoices.php");
        $success = "invoice Updated ";
        // Ensure to exit after header redirection
    } else {
        // Redirect with error message
        header('Location: invoices.php?msg=Failed to update department');
    }
}
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Create Invoice</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="">
                    <?php
                    $id = $_GET['id'];
                    $query = "SELECT * FROM invoices WHERE id=?";
                    $stm = $conn->prepare($query);
                    $stm->bind_param('i', $id);
                    $stm->execute();
                    $result = $stm->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient id <span class="text-danger">*</span></label>
                                <input name="patient_id" class="form-control" type="text"
                                    value="<?php echo $row['patient_id']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Department</label>
                                <select name="department" class="form-control">
                                    <option value="<?php echo $row['department']; ?>" selected>
                                        <?php echo $row['department']; ?>
                                    </option>
                                    <?php
                                            $get_department = "SELECT * FROM doctor";
                                            $stm_dept = mysqli_query($conn, $get_department);
                                            while ($dept_row = mysqli_fetch_assoc($stm_dept)) {
                                                echo '<option value="' . $dept_row['specialization'] . '">' . $dept_row['specialization'] . '</option>';
                                            }
                                            ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tax</label>
                                <select name="tax" class="form-control">
                                    <option value="">Select Tax</option>
                                    <option value="VAT" <?php if ($row['tax'] == "VAT") echo "selected"; ?>>VAT</option>
                                    <option value="GST" <?php if ($row['tax'] == "GST") echo "selected"; ?>>GST</option>
                                    <option value="No Tax" <?php if ($row['tax'] == "No Tax") echo "selected"; ?>>No Tax
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Billing Address</label>
                                <input name="billing_address" class="form-control" type="text"
                                    value="<?php echo $row['billing_address']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Invoice Date</label>
                                <input type="date" name="invoice_date" id="invoice_date" class="form-control"
                                    value="<?php echo $row['invoice_date']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" value="<?php echo $row['due_date']; ?>" name="due_date" id="due_date"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="pending" <?php if ($row['status'] == "pending") echo "selected"; ?>>
                                        Pending
                                    </option>
                                    <option value="paid" <?php if ($row['status'] == "paid") echo "selected"; ?>>
                                        Paid
                                    </option>
                                    <option value="partially_paid"
                                        <?php if ($row['status'] == "partially_paid") echo "selected"; ?>>
                                        Partially Paid
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-white">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th>Unit Cost</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><input name="item" class="form-control" type="text"
                                                    value="<?php echo $row['item']; ?>"></td>
                                            <td><input name="description" class="form-control" type="text"
                                                    value="<?php echo $row['description']; ?>"></td>
                                            <td><input name="unit_cost" class="form-control" type="text"
                                                    value="<?php echo $row['unit_cost']; ?>"></td>
                                            <td><input name="qty" class="form-control" type="text"
                                                    value="<?php echo $row['qty']; ?>"></td>
                                            <td><input name="amount" class="form-control" type="text"
                                                    value="<?php echo $row['amount']; ?>" readonly></td>
                                            <td><button type="button" class="btn btn-success">Add</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Other Information</label>
                                <textarea name="message" class="form-control"><?php echo $row['message']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center m-t-20">
                        <button name="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>

                </form>
                <?php
                        }
                    } else {
                        echo "No invoices found for the given ID.";
                    }
        ?>
            </div>
        </div>
    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
<script>
// Calculate amount when unit cost or qty changes
$('[name="unit_cost"], [name="qty"]').change(function() {
    var unitCost = parseFloat($('[name="unit_cost"]').val());
    var qty = parseInt($('[name="qty"]').val());
    var amount = unitCost * qty;
    $('[name="amount"]').val(amount.toFixed(2));
});
</script>
</body>

<!-- create-invoice24:07-->

</html>