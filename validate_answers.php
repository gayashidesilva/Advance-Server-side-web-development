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
            'correctOption' => $row['correct_option']
        );
        array_push($quizData, $questionObj);
    }
}


$conn->close();


$userAnswers = $_POST['answers'];


$score = 0;
foreach ($userAnswers as $index => $answer) {
    if ($answer == $quizData[$index]['correctOption']) {
        $score++;
    }
}


echo "Your score is: " . $score;
?>
