-- Create database
CREATE DATABASE fitness_tracker;

-- Use the database
USE fitness_tracker;

-- Create table for users with gender and blood group
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    weight DECIMAL(5, 2) NOT NULL,
    height DECIMAL(5, 2) NOT NULL,
    lifestyle ENUM('Sedentary', 'Lightly active', 'Moderately active', 'Very active', 'Extra active') NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    blood_group ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NOT NULL
);
