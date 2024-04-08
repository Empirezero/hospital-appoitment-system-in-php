<?php
include('includes/dbconfig.php');

if (isset($_GET['patient_id']) && is_numeric($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    
    // Use prepared statement to prevent SQL injection
    $delete_query = "DELETE FROM patients WHERE patient_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // If the patients is deleted successfully, redirect to the same page with a success message
        header('Location: patients.php?msg=Patient deleted successfully');
        exit(); // Terminate script after redirection
    } else {
        // If the patients is not deleted, redirect to the same page with an error message
        header('Location: patients.php?msg=Failed to delete the patients');
        exit(); // Terminate script after redirection
    }
} else {
    // If patient_id is not set or is not a valid numeric value, redirect with an error message
    header('Location: patients.php?msg=Invalid patients ID');
    exit(); // Terminate script after redirection
}
?>