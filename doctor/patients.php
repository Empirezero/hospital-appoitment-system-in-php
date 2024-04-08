<?php include("includes/dbconfig.php") ?>
<?php include("includes/header.php") ?>
<?php include("includes/sidebar.php") ?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Patients</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-patient.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i>
                    Add Patient</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-border table-striped custom-table datatable mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM patients";
                            $stm = $conn->prepare($query);
                            $stm->execute();
                            $results = $stm->get_result();
                            $cnt = 1;
                            //fetch data from the database
                            while ($row = $results->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $cnt ?></td>
                                <td><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                <td><?php echo $row['Address'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['email'] ?></td>

                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="edit-patient.php?patient_id=<?php echo $row['patient_id'] ?>"><i
                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item"
                                                href="view-patient.php?patient_id=<?php echo $row['patient_id'] ?>">
                                                <i class="fa fa-eye m-r-5"></i>View</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#delete_patient_<?php echo $row['patient_id'] ?>"><i
                                                    class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div id="delete_patient_<?php echo $row['patient_id'] ?>" class="modal fade delete-modal"
                                role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                                            <h3>Are you sure want to delete this Patient?</h3>
                                            <div class="m-t-20">
                                                <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                                <a href="delete-patient.php?patient_id=<?php echo $row['patient_id']; ?>"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </tbody>
                        <?php $cnt = $cnt + 1;
                            } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php include("includes/script.php") ?>
</body>


<!-- patients23:19-->

</html>