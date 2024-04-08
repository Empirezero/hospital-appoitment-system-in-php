<?php
include('includes/dbconfig.php');

if (isset($_GET['specialization_id'])) {
    $specialization_id = $_GET['specialization_id'];

    // Delete doctor from the database
    $delete_query = "DELETE FROM specialization WHERE specialization_id = '$specialization_id'";
    $stmt = $conn->prepare($delete_query);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // If the doctor is deleted successfully, redirect to the same page with a success message
        header('Location:departments.php?msg=Doctor deleted successfully');
    } else {
        // If the doctor is not deleted, redirect to the same page with an error message
        header('Location: departments.php?msg=Failed to delete the doctor');
    }
}
?>