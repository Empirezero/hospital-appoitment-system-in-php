<?php
// Include necessary files and configurations
include("../../includes/dbconfig.php"); // Adjust the path as needed

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Handle form data here
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $date_joined= $_POST['date_joined'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    $specialization = $_POST['specialization'];// Add this line to retrieve the status

    // Validate password and confirm password
    if ($password != $confirm_password) {
        echo "Password and Confirm Password do not match.";
        exit; // Stop further execution
    }
    
    // Handle image upload
    $image_path = $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../../assets/img" . $_FILES["image"]["name"]);

    // Hash the password
    $hashed_password = md5($password);

    // Insert the data into the database
    $query = "INSERT INTO doctor (first_name, last_name, email, password, date_joined, address, phone, status,specialization,image) 
              VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssssssss', $first_name, $last_name, $email, $hashed_password, $date_of_birth, $address, $phone, $status,$specialization, $image_path);

    if ($stmt->execute()) {
        $msg = "Doctor added successfully!";
        header('location: ../../doctors.php?msg='.$msg);
    } else {
        echo "Error: " . $stmt->error;
    }

   
}



if (isset($_POST['delete_doctor'])) {
    $doctor_id_to_delete = $_POST['doctor_id'];
    
    // Use prepared statement to prevent SQL injection
    $delete_query = "DELETE FROM doctor WHERE doctor_id=?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param('i', $doctor_id_to_delete);

    if ($stmt->execute()) {
        echo '<script>alert("Doctor deleted successfully.");</script>';
    } else {
        echo '<script>alert("Failed to delete doctor.");</script>';
    }
}
?>