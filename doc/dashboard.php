<?php
include_once("includes/dbconfig.php");
session_start();

// Check if the doctor_id session variable is not set
if (!isset($_SESSION['doctor_id'])) {
    // Redirect to the login page
    header('location: login.php');
    exit();
}

include_once("includes/header.php");
include_once("includes/sidebar.php");
?>