<?php
/*
Assignment 2,
Team: Devansh Shah(041132970), Armaan Singh(041130409), Rudra Tailor(041140251)
File Name: delete_user.php
Subject: CST8285
Topic: Fitness Tracker Website
Description: Script for deleting a user from the database and redirecting to the index page.
*/

// Start session management
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../pages/login.html");
    exit();
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "fitness_tracker";

// Establish connection to the database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// SQL query to delete the user record from the database
$sql = "DELETE FROM `users` WHERE `username` = '$username'";

// Execute the query and handle the result
if (mysqli_query($conn, $sql)) {
    // Destroy the session and redirect to the index page
    session_destroy();
    header("Location: ../pages/index.html");
} else {
    // Display an error message if the query fails
    echo "Error deleting record: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
