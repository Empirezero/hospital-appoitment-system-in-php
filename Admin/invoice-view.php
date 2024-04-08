<!DOCTYPE html>
<html lang="en">

<head>


    <style>
    @media print {
        .sidebar {
            display: none;
        }

        .header {
            display: none;
        }
    }
    </style>
</head>

<body>
    <?php
    include('includes/dbconfig.php');
    include('includes/header.php');
    include('includes/sidebar.php');
    // Get the patient ID from the URL parameter
    $patient_id = $_GET['patient_id'];

    // Prepare and execute the SQL query
    $sql = "SELECT invoices.*, patients.first_name, patients.last_name, patients.Address,patients.email FROM invoices
            INNER JOIN patients ON invoices.patient_id = patients.patient_id 
            WHERE invoices.patient_id=?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("i", $patient_id);
    $stm->execute();
    $results = $stm->get_result();

    // Check if there are any results
    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc(); // Fetch the first row

    ?>

    <div class="page-wrapper">

        <div class="content">
            <div class="row">
                <div class="col-sm-5 col-4">
                    <h4 class="page-title">Invoice</h4>
                </div>
                <div class="col-sm-7 col-6 text-right m-b-30">
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-white">CSV</button>
                        <button class="btn btn-white">PDF</button>
                        <button class="btn btn-white" id="printBtn"><i class="fa fa-print fa-lg"></i> Print</button>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row custom-invoice">
                                <div class="col-3 col-sm-6 m-b-20">
                                    <img src="assets/img/logo-dark.png" class="inv-logo" alt="">
                                    <ul class="list-unstyled">
                                        <li>Plainsview</li>
                                        <li>Kiambu</li>
                                        <li>Thika Road</li>

                                    </ul>
                                </div>
                                <div class="col-6 col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Invoice #INV-0001</h3>
                                        <ul class="list-unstyled">
                                            <li> Invoice Date: <span>
                                                    <?php echo $row['invoice_date'] ?>
                                                </span></li>
                                            <li>Due date: <span> <?php echo $row['due_date'] ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>Invoice to:</h5>
                                    <ul class="list-unstyled">
                                        <li>
                                            <h5><strong>
                                                    <?php echo $row['first_name'] . ' ' . $row['last_name'] ?></strong>
                                            </h5>
                                        </li>
                                        <li><a href="#">
                                                <?php echo $row['email'] ?>
                                            </a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-lg-6 m-b-10">
                                    <div class="invoices-view">
                                        <span class="text-muted">Payment Details:</span>
                                        <ul class="list-unstyled invoice-payment-details">
                                            <li>
                                                <h5>Total Due: <span class="text-right">
                                                        Ksh <?php echo $row['amount'] ?></span></h5>
                                            </li>

                                            <li>Address: <span> <?php echo $row['Address'] ?></span></li>
                                            <li>Address: <span> <?php echo $row['billing_address'] ?></span></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ITEM</th>
                                            <th>DESCRIPTION</th>
                                            <th>UNIT COST</th>
                                            <th>QUANTITY</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <?php echo $row['item'] ?>
                                            </td>
                                            <td> <?php echo $row['description'] ?></td>
                                            <td>Ksh <?php echo $row['unit_cost'] ?></td>
                                            <td> <?php echo $row['qty'] ?></td>
                                            <td>Ksh <?php echo $row['amount'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <div class="row invoice-payment">
                                    <div class="col-sm-7">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="m-b-20">
                                            <h6>Total due</h6>
                                            <div class="table-responsive no-border">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th>Subtotal:</th>
                                                            <td class="text-right">Ksh 262</td>
                                                        </tr>

                                                        <tr>
                                                            <th>Total:</th>
                                                            <td class="text-right text-primary">
                                                                <h5>Ksh
                                                                    <?php echo $row['amount']?>
                                                                </h5>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right d-print-none mr-4">
                                        <a href="javascript:window.print()"
                                            class="btn btn-primary waves-effect waves-light"><i
                                                class="fa fa-printer mr-1"></i> Print</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            </d<iv>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include any other JavaScript files you need -->
        <script>
        document.getElementById("printBtn").addEventListener("click", function() {
            window.print();
        });
        </script>
</body>

</html>