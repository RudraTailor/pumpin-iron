<?php
/*
Assignment 2,
Team: Devansh Shah(041132970), Armaan Singh(041130409), Rudra Tailor(041140251)
File Name: login.php
Subject: CST8285
Topic: Fitness Tracker Website
Description: Handles user login by verifying username and password.
*/

// Start the session
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness_tracker";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from POST request
$user = $_POST['username'];
$pass = $_POST['password'];

// Prepare and execute SQL query to fetch user details
$sql = "SELECT * FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify the password
    if (password_verify($pass, $row['password'])) {
        // Set session variable and redirect to home page
        $_SESSION['username'] = $user;
        header("Location: home.php");
        exit();
    } else {
        // Redirect to error page with an error message
        header("Location: ../pages/error.html?error=invalid_password");
        exit();
    }
} else {
    // Redirect to error page with an error message
    header("Location: ../pages/error.html?error=user_not_found");
    exit();
}

// Close the statement and database connection
$conn->close();
?>
