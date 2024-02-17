<?php
include 'connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $question_id = $_POST['question_id'];
    $question_text = $_POST['question_text'];
    $answer_a = $_POST['answer_a'];
    $answer_b = $_POST['answer_b'];
    $answer_c = $_POST['answer_c'];
    $answer_d = $_POST['answer_d'];
    $correct_answer = $_POST['correct_answer'];
    $level = $_POST['level'];


    $sql = "UPDATE questions SET 
            question_text = '$question_text', 
            answer_a = '$answer_a', 
            answer_b = '$answer_b', 
            answer_c = '$answer_c', 
            answer_d = '$answer_d', 
            correct_answer = '$correct_answer', 
            level = '$level' 
            WHERE question_id = '$question_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Question updated successfully";
    } else {
        echo "Error updating question: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
