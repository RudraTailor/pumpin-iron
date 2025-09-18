<?php
/*
Assignment 2,
Team: Devansh Shah(041132970), Armaan Singh(041130409), Rudra Tailor(041140251)
File Name: fetch_user_data.php
Subject: CST8285
Topic: Fitness Tracker Website
Description: Fetches user data (BMR, BMI, and calorie intake) from the database based on the provided username and returns it in JSON format.
*/

// Set content type to JSON
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";  // Change if your server is different
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "fitness_tracker";   // Your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    // Return a JSON error message if connection fails
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Fetch username from query parameter
$requestedUsername = $_GET['username'] ?? '';
if (empty($requestedUsername)) {
    // Return a JSON error message if username is not provided
    echo json_encode(["error" => "Username is required"]);
    exit();
}

// Prepare and execute SQL query
$sql = "SELECT bmr, bmi, calorie_intake FROM user_data WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $requestedUsername);
$stmt->execute();
$result = $stmt->get_result();

// Check if any data is returned
if ($result->num_rows > 0) {
    // Fetch the data and return it as JSON
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    // Return a JSON error message if no user is found
    echo json_encode(["error" => "User not found"]);
}

// Close the prepared statement and connection
$stmt->close();
$conn->close();
?>
