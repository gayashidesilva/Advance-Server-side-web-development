<?php
// Database connection parameters
$host = "localhost";
$username = "root"; 
$password = "";
$database = "quizmaster"; 

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form fields are empty
if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
    $response = array(
        'status' => 'error',
        'message' => 'All fields are required'
    );
    echo json_encode($response);
    exit;
}


$username = sanitizeInput($_POST['username']);
$email = sanitizeInput($_POST['email']);
$password = sanitizeInput($_POST['password']);


$sql_check_user = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
$result_check_user = $conn->query($sql_check_user);

if ($result_check_user->num_rows > 0) {
    $response = array(
        'status' => 'error',
        'message' => 'User already exists'
    );
    echo json_encode($response);
    exit;
}


$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql_insert_user = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

if ($conn->query($sql_insert_user) === TRUE) {
    $response = array(
        'status' => 'success',
        'message' => 'Registered successfully'
    );
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Error: ' . $conn->error
    );
    echo json_encode($response);
}

$conn->close();
?>