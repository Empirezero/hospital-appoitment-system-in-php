<?php
include('includes/dbconfig.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete  from the database
    $delete_query = "DELETE FROM invoices WHERE id = '$id'";
    $stmt = $conn->prepare($delete_query);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // is deleted successfully, redirect to the same page with a success message
        header('Location:invoice.php?msg=Doctor deleted successfully');
    } else {
        // not deleted, redirect to the same page with an error message
        header('Location:invoice.php?msg=Failed to delete the doctor');
    }
}