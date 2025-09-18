<?php
/*
 * Database Connection Script
 * 
 * This script connects to a MySQL database and checks the connection status.
 * Modify the connection parameters according to your server configuration.
 */

// Database connection parameters
$servername = "localhost";  // Change if your server is different
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "fitness_tracker"; // Your database name

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    // If connection fails, display an error message
    die("Connection failed: " . $conn->connect_error);
}

// If connection is successful, display a success message
echo "Connected successfully";
?>
