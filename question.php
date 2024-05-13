<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "quizmaster"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function sanitizeInput($data) {
    return htmlspecialchars(strip_tags($data));
}


$topic = sanitizeInput($_POST['topic']);
$question = sanitizeInput($_POST['question']);
$option1 = sanitizeInput($_POST['option1']);
$option2 = sanitizeInput($_POST['option2']);
$option3 = sanitizeInput($_POST['option3']);
$option4 = sanitizeInput($_POST['option4']);
$correct_option = sanitizeInput($_POST['correct_option']);


$sql = "INSERT INTO questions (topic, question, option1, option2, option3, option4, correct_option) VALUES ('$topic', '$question', '$option1', '$option2', '$option3', '$option4', '$correct_option')";

if ($conn->query($sql) === TRUE) {
    echo "Quiz created successfully";
    
    header("Location: play.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>