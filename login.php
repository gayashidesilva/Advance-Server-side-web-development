<?php

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


if (empty($_POST['username']) || empty($_POST['password'])) {
    $response = array(
        'status' => 'error',
        'message' => 'Username and password are required'
    );
    echo json_encode($response);
    exit;
}


$username = sanitizeInput($_POST['username']);
$password = sanitizeInput($_POST['password']);


$sql_select_user = "SELECT * FROM users WHERE username = '$username'";
$result_select_user = $conn->query($sql_select_user);

if ($result_select_user->num_rows > 0) {
    $row = $result_select_user->fetch_assoc();
    // Verify password
    if (password_verify($password, $row['password'])) {
        $response = array(
            'status' => 'success',
            'message' => 'Login successful'
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Incorrect password'
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'status' => 'error',
        'message' => 'User not found'
    );
    echo json_encode($response);
}


$conn->close();
?>
