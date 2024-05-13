<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizmaster";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['submit'])) {
    
    $feedback = $_POST['feedback'];
    

    $sql = "INSERT INTO feedback (feedback) VALUES ('$feedback')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Feedback saved successfully'); window.location.href = 'feedback.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
