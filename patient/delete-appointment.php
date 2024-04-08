<?php
include('includes/dbconfig.php');

if (isset($_GET['appointment_id'])) {
    $appoitment_id = $_GET['appointment_id'];

    // Delete doctor from the database
    $delete_query = "DELETE FROM appointment WHERE appointment_id = '$appoitment_id'";
    $stmt = $conn->prepare($delete_query);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // If the doctor is deleted successfully, redirect to the same page with a success message
        header('Location:appointments.php?msg=Appoitment deleted successfully');
    } else {
        // If the doctor is not deleted, redirect to the same page with an error message
        header('Location: appointments.php?msg=Failed to delete the appoitment');
    }
}
?>