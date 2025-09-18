<?php
/*
Assignment 2,
Team: Devansh Shah(041132970), Armaan Singh(041130409), Rudra Tailor(041140251)
File Name: filtered_exercises.php
Subject: CST8285
Topic: Fitness Tracker Website
Description: Retrieves and displays exercises based on the selected category.
*/

// Start the session
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "fitness_tracker";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ensure category is set and valid
if (isset($_POST['category']) && in_array($_POST['category'], ['Push', 'Pull', 'Legs', 'Cardio', 'Crossfit'])) {
    $category = $_POST['category'];
} else {
    die("Invalid category.");
}

// Prepare the SQL statement based on the category
$sql = "SELECT exercise_name FROM exercise WHERE $category IS NOT NULL LIMIT 5";
$stmt = mysqli_prepare($conn, $sql);

// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Start HTML output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Exercises</title>
    <link rel="stylesheet" href="../styles/style.css"> <!-- Link to the CSS stylesheet -->
</head>
<body>
    <h1>Exercises for Category: <?php echo htmlspecialchars($category); ?></h1> <!-- Display selected category -->

    <?php
    // Fetch and display the exercises
    if (mysqli_num_rows($result) > 0) {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . htmlspecialchars($row['exercise_name']) . "</li>"; // Display each exercise name
        }
        echo "</ul>";
    } else {
        echo "<p>No exercises found for the selected category.</p>"; // Message if no exercises found
    }

    // Close the prepared statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>
</body>
</html>
