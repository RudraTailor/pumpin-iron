<?php
/*
Assignment 2,
Team: Devansh Shah(041132970), Armaan Singh(041130409), Rudra Tailor(041140251)
File Name: plannedworkout.php
Subject: CST8285
Topic: Fitness Tracker Website
Description: Handles filtering and displaying exercises based on user-selected category.
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

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$exercises = [];
$category = "";

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure category is set and valid
    if (isset($_POST['category']) && in_array($_POST['category'], ['Push', 'Pull', 'Legs', 'Cardio', 'Crossfit'])) {
        $category = $_POST['category'];
        
        // Prepare the SQL statement based on the category
        $sql = "SELECT exercise_name, sets, reps FROM exercise WHERE $category IS NOT NULL";
        $stmt = mysqli_prepare($conn, $sql);
        
        // Execute the query
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        // Fetch the exercises
        while ($row = mysqli_fetch_assoc($result)) {
            $exercises[] = [
                'name' => $row['exercise_name'],
                'sets' => $row['sets'],
                'reps' => $row['reps']
            ];
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        die("Invalid category.");
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planned Workout</title>
    <link rel="stylesheet" href="../styles/plannedworkout.css">
    <script src="../scripts/script.js" defer></script>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../images/LOGOCS1.png" alt="Logo" class="logo">
                <span>Pumpin.fit</span>
            </a>
            <ul class="navbar-nav">
                <li><a class="nav-link" href="home.php">Home</a></li>
                <li><a class="nav-link" href="../pages/team.html">Teams</a></li>
                <li><a class="nav-link" href="../pages/about.html">About</a></li>
            </ul>
        </div>
    </nav>

    <header class="hero">
        <p class="hero-title">Planned Workouts</p>
    </header>

    <div class="main-content">
        <div class="image-holder">
            <img class="image-holder" src="../images/LOGOWHITE.png" alt="Logo">
        </div>
        <div class="navigation-buttons">
            <a class="nav-button" href="home.php">Home</a>
            <a class="nav-button" href="../pages/personalizedworkout.html">Personalized Workouts</a>
        </div>
    </div>

    <section class="filter-section">
        <h1>Filter Exercises by Category</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="category">Select Category:</label>
            <select name="category" id="category">
                <option value="Push">Push</option>
                <option value="Pull">Pull</option>
                <option value="Legs">Legs</option>
                <option value="Cardio">Cardio</option>
                <option value="Crossfit">Crossfit</option>
            </select>
            <button type="submit">Show Exercises</button>
        </form>

        <?php if (!empty($category)): ?>
            <h1>Exercises for Category: <?php echo htmlspecialchars($category); ?></h1>
            <?php if (!empty($exercises)): ?>
                <ul>
                    <?php foreach ($exercises as $exercise): ?>
                        <li>
                            <?php echo htmlspecialchars($exercise['name']); ?> 
                            - Sets: <?php echo htmlspecialchars($exercise['sets']); ?> 
                            - Reps: <?php echo htmlspecialchars($exercise['reps']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No exercises found for the selected category.</p>
            <?php endif; ?>
        <?php endif; ?>
    </section>

    <footer>
        &copy; Wolves@2024 - Armaan, Devansh & Rudra - All Rights Reserved
    </footer>
</body>
</html>
