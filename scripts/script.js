document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners for form submissions
    const registrationForm = document.getElementById('registrationForm');
    const loginForm = document.getElementById('loginForm');
    const updateForm = document.getElementById('updateForm');

    if (registrationForm) {
        registrationForm.addEventListener('submit', function(event) {
            if (!validateRegistrationForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            if (!validateLoginForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }

    if (updateForm) {
        updateForm.addEventListener('submit', function(event) {
            if (!validateUpdateForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }
});

// Function to validate the registration form
function validateRegistrationForm() {
    clearErrors();
    let valid = true;

    // Get form values
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const age = document.getElementById('age').value;
    const weight = document.getElementById('weight').value;
    const height = document.getElementById('height').value;
    const lifestyle = document.getElementById('lifestyle').value;
    const gender = document.getElementById('gender').value;
    const bloodGroup = document.getElementById('blood_group').value;

    // Username validation
    if (username.trim() === '') {
        setError('usernameError', 'Username is required.');
        valid = false;
    }

    // Password validation
    if (password.length < 6) {
        setError('passwordError', 'Password must be at least 6 characters long.');
        valid = false;
    }

    // Age validation
    if (age <= 0 || age > 120) {
        setError('ageError', 'Please enter a valid age.');
        valid = false;
    }

    // Weight validation
    if (weight <= 0) {
        setError('weightError', 'Weight must be a positive number.');
        valid = false;
    }

    // Height validation
    if (height <= 0) {
        setError('heightError', 'Height must be a positive number.');
        valid = false;
    }

    // Lifestyle validation
    if (!['Sedentary', 'Lightly active', 'Moderately active', 'Very active', 'Extra active'].includes(lifestyle)) {
        setError('lifestyleError', 'Please select a valid lifestyle.');
        valid = false;
    }

    // Gender validation
    if (!['Male', 'Female'].includes(gender)) {
        setError('genderError', 'Please select a valid gender.');
        valid = false;
    }

    // Blood Group validation
    if (!['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'].includes(bloodGroup)) {
        setError('bloodGroupError', 'Please select a valid blood group.');
        valid = false;
    }

    return valid;
}

// Function to validate the login form
function validateLoginForm() {
    clearErrors();
    let valid = true;

    // Get form values
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Username validation
    if (username.trim() === '') {
        setError('loginUsernameError', 'Username is required.');
        valid = false;
    }

    // Password validation
    if (password.length < 6) {
        setError('loginPasswordError', 'Password must be at least 6 characters long.');
        valid = false;
    }

    return valid;
}

// Function to validate the update form
function validateUpdateForm() {
    clearErrors();
    let valid = true;

    // Get form values
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const age = document.getElementById('age').value;
    const weight = document.getElementById('weight').value;
    const height = document.getElementById('height').value;
    const lifestyle = document.getElementById('lifestyle').value;
    const gender = document.getElementById('gender').value;
    const bloodGroup = document.getElementById('blood_group').value;

    // Username validation
    if (username.trim() === '') {
        setError('usernameError', 'Username is required.');
        valid = false;
    }

    // Password validation
    if (password.length < 6) {
        setError('passwordError', 'Password must be at least 6 characters long.');
        valid = false;
    }

    // Age validation
    if (age <= 0 || age > 120) {
        setError('ageError', 'Please enter a valid age.');
        valid = false;
    }

    // Weight validation
    if (weight <= 0) {
        setError('weightError', 'Weight must be a positive number.');
        valid = false;
    }

    // Height validation
    if (height <= 0) {
        setError('heightError', 'Height must be a positive number.');
        valid = false;
    }

    // Lifestyle validation
    if (!['Sedentary', 'Lightly active', 'Moderately active', 'Very active', 'Extra active'].includes(lifestyle)) {
        setError('lifestyleError', 'Please select a valid lifestyle.');
        valid = false;
    }

    // Gender validation
    if (!['Male', 'Female'].includes(gender)) {
        setError('genderError', 'Please select a valid gender.');
        valid = false;
    }

    // Blood Group validation
    if (!['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'].includes(bloodGroup)) {
        setError('bloodGroupError', 'Please select a valid blood group.');
        valid = false;
    }

    return valid;
}

// Function to display error messages
function setError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
}

// Function to clear all error messages
function clearErrors() {
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach(error => {
        error.textContent = '';
        error.style.display = 'none';
    });
}
