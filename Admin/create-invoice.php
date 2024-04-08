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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $patient = $_POST['patient'];
    $department = $_POST['department']; // changed from 'specialization'
    $tax = $_POST['tax'];
    $billing_address = $_POST['billing_address'];
    $invoice_date = $_POST['invoice_date'];
    $due_date = $_POST['due_date'];
    $item = $_POST['item'];
    $description = $_POST['description'];
    $unit_cost = $_POST['unit_cost'];
    $qty = $_POST['qty'];
    $message = $_POST['message'];
    $status = 'pending'; 
    $amount = $unit_cost * $qty; // Calculate the amount

    // Insert data into the database using prepared statement
    $insert_query = "INSERT INTO invoices (patient_id, department, tax, billing_address, invoice_date, due_date, item, description, unit_cost, qty, amount,status,message) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    // Bind parameters
    $stmt->bind_param('sssssssssssss', $patient, $department, $tax, $billing_address, $invoice_date, $due_date,$status, $item, $description, $unit_cost, $qty, $amount, $message);

    if ($stmt->execute()) {
        echo "Invoices added";
    } else {
        echo "Error: " . $stmt->error;
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
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="row">
                        <!-- Include additional fields in the form -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Patient</label>
                                <select name="patient" id="" class="form-control">
                                    <option value="">Select patient</option>
                                    <?php
                                    $get_patient = "SELECT * FROM patients";
                                    $stm = mysqli_query($conn, $get_patient);
                                    while ($row = mysqli_fetch_assoc($stm)) {
                                        echo '<option value="' . $row['patient_id'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Department</label>
                                <select name="department" id="" class="form-control">
                                    <option value="">Select department</option>
                                    <?php
                                    $get_department = "SELECT * FROM doctor";
                                    $stm = mysqli_query($conn, $get_department);
                                    while ($row = mysqli_fetch_assoc($stm)) {
                                        echo '<option value="' . $row['specialization'] . '">' . $row['specialization'] . '</option>';
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
                                    <option value="VAT">VAT</option>
                                    <option value="GST">GST</option>
                                    <option value="No Tax">No Tax</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Billing Address</label>
                                <textarea name="billing_address" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Invoice Date</label>
                                <input type="date" name="invoice_date" id="invoice_date" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" name="due_date" id="due_date" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 d-none">
                            <div class="form-group">
                                <label> status</label>
                                <select name="status" class="form-control">
                                    <option value="pending">Select status</option>
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
                                            <td><input name="item" class="form-control" type="text"></td>
                                            <td><input name="description" class="form-control" type="text"></td>
                                            <td><input name="unit_cost" class="form-control" type="text"></td>
                                            <td><input name="qty" class="form-control" type="text"></td>
                                            <td><input name="amount" class="form-control" type="text" readonly></td>
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
                                <textarea name="message" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center m-t-20">
                        <button name="submit" class="btn btn-primary submit-btn">Save</button>
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