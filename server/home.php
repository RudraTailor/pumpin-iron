<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../styles/home.css"> <!-- Link to the CSS stylesheet -->
    <script src="../scripts/script.js" defer></script> <!-- Link to the JavaScript file -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet"> <!-- Import custom fonts -->

    <?php
    /*
    Assignment 2,
    Team: Devansh Shah(041132970), Armaan Singh(041130409), Rudra Tailor(041140251)
    File Name: home.php
    Subject: CST8285
    Topic: Fitness Tracker Website
    Description: Displays the home page with user-specific data and navigation.
    */

    // Start the session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

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

    // Fetch user data
    $username = $_SESSION['username']; // Use the username from the session
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $res = mysqli_fetch_assoc($result);
    } else {
        die("Query failed: " . mysqli_error($conn));
    }

    // Close the connection
    mysqli_close($conn);
    ?>
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../images/LOGOCS1.png" alt="Logo"> <!-- Placeholder for logo image -->
            Pumpin.fit
        </a>
        <ul class="navbar-nav">
            <li><a class="nav-link" href="home.php">Home</a></li>
            <li><a class="nav-link" href="../pages/team.html">Teams</a></li>
            <li><a class="nav-link" href="../pages/about.html">About</a></li>
            <li>
                <select class="nav-select" onchange="location = this.value;">
                    <option value="#" selected>Workouts</option>
                    <option value="../server/plannedworkout.php">Planned Workouts</option>
                    <option value="../pages/personalizedworkout.html">Personalized Workouts</option>
                </select>
            </li>
        </ul>
    </div>
</nav>

<div class="profile-image-holder">
    <img src="../images/HOME/VECTORCOMPONENTS/GRINDAYS.png" alt="Profile Image"> <!-- Placeholder for profile image -->
</div>

<div class="container">
    <h1>Welcome <?php echo htmlspecialchars($res['username']); ?>!</h1> <!-- Display logged-in username -->
    <div class="dashboard">
        <div class="dashboard-item">
            <img src="../images/HOME/HOMEUPDELFG.jpg" alt="Current Physique"> <!-- Placeholder for image -->
            <h2>Current Physique:</h2>
            <p class="physique-level" data-tooltip="Less than 6 months of experience.">Beginner</p>
            <p class="physique-level" data-tooltip="More than 6 months, less than 2 year of experience">Intermediate</p>
            <p class="physique-level" data-tooltip="More than 2 years of experience.">Advanced</p>
        </div>
    
        <div class="dashboard-item">
            <img src="../images/HOME/VECTORCOMPONENTS/BMI.png" alt="BMI"> <!-- Placeholder for image -->
            <h2>BMI</h2>
            <p id="bmi-display"><?php echo htmlspecialchars($res['bmi']); ?></p> <!-- Display BMI -->
        </div>
        <div class="dashboard-item">
            <img src="../images/HOME/VECTORCOMPONENTS/BMR.png" alt="BMR"> <!-- Placeholder for image -->
            <h2>BMR</h2>
            <p id="bmr-display"><?php echo htmlspecialchars($res['bmr']); ?></p> <!-- Display BMR -->
        </div>
        <div class="dashboard-item">
            <img src="../images/HOME/VECTORCOMPONENTS/CalorieIntake.png" alt="Calorie Intake"> <!-- Placeholder for image -->
            <h2>Calorie Intake</h2>
            <p id="calorie-display"><?php echo htmlspecialchars($res['calorie_intake']); ?></p> <!-- Display Calorie Intake -->
        </div>
       
        <!-- New logo image holder div -->
        <div class="dashboard-item logo-holder">
            <img src="../images/LOGOCS1.png" alt="Logo">
        </div>
    </div>
    <div class="dashboard">
        <div class="dashboard-item" style="grid-column: span 2;">
            <h2>Plan Workout:</h2>
            <button class="workout-button" onclick="window.location.href='../pages/workout.html'">Plan Workout</button>
            <img src="../images/HOME/HOMEPLANEXERFG.jpg" alt="Plan Workout"> <!-- Placeholder for image -->
        </div>
    </div>
    <div class="dashboard-item" style="grid-column: span 2; text-align: left;">
        <p>Don't forget to hydrate!</p>
    </div>
    
    <!-- New buttons for update and delete -->
    <div class="dashboard-item" style="grid-column: span 2; text-align: left;">
        <button class="data-button" onclick="window.location.href='../pages/update.html'">Update Record</button>
        <button class="data-button" onclick="window.location.href='../pages/delete.html'">Delete Record</button>
    </div>
</div>
<footer>
    &copy; 2024 Pumpin.Fit. All rights reserved.
</footer>
</body>
</html>
