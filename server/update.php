<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "fitness_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_username = $_SESSION['username'];
$new_username = $_POST['username'];
$new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$age = $_POST['age'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$lifestyle = $_POST['lifestyle'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];

// Calculate BMR
$heightInCm = $height;
$weightInKg = $weight;
$ageInYears = $age;

$bmr = 10 * $weightInKg + 6.25 * $heightInCm - 5 * $ageInYears + ($gender == 'Male' ? 5 : -161);

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

// Calculate BMI
$heightInMeters = $heightInCm / 100;
$bmi = $weightInKg / ($heightInMeters * $heightInMeters);

// Prepare SQL statement
$sql = "UPDATE users 
        SET username = ?, 
            password = ?, 
            age = ?, 
            weight = ?, 
            height = ?, 
            lifestyle = ?, 
            gender = ?, 
            blood_group = ?, 
            bmi = ?, 
            bmr = ?
        WHERE username = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters
    $stmt->bind_param("ssddssssdds", $new_username, $new_password, $age, $weight, $height, $lifestyle, $gender, $blood_group, $bmi, $bmr, $current_username);

    // Execute query
    if ($stmt->execute()) {
        $_SESSION['username'] = $new_username; // Update session username
        header("Location: home.php");
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    // Redirect to error page with an error message
    header("Location: ../pages/error.html?error=invalid_password");
    exit();
}

// Close connection
$conn->close();
?>