<?php
include('includes/dbconfig.php');

if (isset($_GET['doctor_id'])) {
    $doctor_id = $_GET['doctor_id'];

    // Delete doctor from the database
    $delete_query = "DELETE FROM doctor WHERE doctor_id = '$doctor_id'";
    $stmt = $conn->prepare($delete_query);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // If the doctor is deleted successfully, redirect to the same page with a success message
        header('Location:doctors.php?msg=Doctor deleted successfully');
    } else {
        // If the doctor is not deleted, redirect to the same page with an error message
        header('Location: doctors.php?msg=Failed to delete the doctor');
    }
}
?>