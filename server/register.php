<?php
/*
Assignment 2,
Team: Devansh Shah(041132970), Armaan Singh(041130409), Rudra Tailor(041140251)
File Name: register.php
Subject: CST8285
Topic: Fitness Tracker Website
Description: Handles user registration including BMR, BMI, and Calorie Intake calculations and inserts the data into the database.
*/

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness_tracker";

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data from the registration form
$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security
$age = $_POST['age'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$lifestyle = $_POST['lifestyle'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];

// Calculate BMR (Basal Metabolic Rate)
$heightInCm = $height; // Height is assumed to be in cm
$weightInKg = $weight; // Weight is assumed to be in kg
$ageInYears = $age; // Age in years

// Basic formula for BMR (males). For females, the formula would differ.
$bmr = 10 * $weightInKg + 6.25 * $heightInCm - 5 * $ageInYears + 5;

// Adjust BMR based on lifestyle activity level
switch ($lifestyle) {
    case 'Sedentary':
        $bmr *= 1.2;
        break;
    case 'Lightly active':
        $bmr *= 1.375;
        break;
    case 'Moderately active':
        $bmr *= 1.55;
        break;
    case 'Very active':
        $bmr *= 1.725;
        break;
    case 'Extra active':
        $bmr *= 1.9;
        break;
}

// Calculate BMI (Body Mass Index)
$heightInMeters = $heightInCm / 100; // Convert height to meters
$bmi = $weightInKg / ($heightInMeters * $heightInMeters);

// Calculate Calorie Intake with a 25% deficit for weight loss
$calorieIntake = $bmr * 0.75; 

// Prepare SQL query to insert user data including BMI, BMR, and Calorie Intake
$sql = "INSERT INTO users (username, password, age, weight, height, lifestyle, gender, blood_group, bmi, bmr, calorie_intake) 
        VALUES ('$user', '$pass', $ageInYears, $weightInKg, $heightInCm, '$lifestyle', '$gender', '$blood_group', 
                $bmi, $bmr, $calorieIntake)";

// Execute SQL query and handle the result
if ($conn->query($sql) === TRUE) {
    // Redirect to login page upon successful registration
    header("Location: ../pages/login.html");
    exit();
} else {
    // Redirect to error page with an error message if the query fails
    header("Location: ../pages/error.html?error=registration_failed");
    exit();
}

// Close the database connection
$conn->close();
?>
