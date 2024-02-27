<?php
include 'connect.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $question_text = $_POST['question_text'];
    $answer_a = $_POST['answer_a'];
    $answer_b = $_POST['answer_b'];
    $answer_c = $_POST['answer_c'];
    $answer_d = $_POST['answer_d'];
    $correct_answer = $_POST['correct_answer'];
    $level = $_POST['level'];


    $sql = "INSERT INTO questions (question_text, answer_a, answer_b, answer_c, answer_d, correct_answer, level) 
            VALUES ('$question_text', '$answer_a', '$answer_b', '$answer_c', '$answer_d', '$correct_answer', '$level')";


    if ($conn->query($sql) === TRUE) {
        header("Location: crud.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
