<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "quizmaster"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

$quizData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questionObj = array(
            'question' => $row['question'],
            'options' => array($row['option1'], $row['option2'], $row['option3'], $row['option4']),
            'correctOption' => $row['correct_option']
        );
        array_push($quizData, $questionObj);
    }
}


$conn->close();


header('Content-Type: application/json');
echo json_encode($quizData);
?>
