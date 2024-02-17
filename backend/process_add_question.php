<?php
include 'db_connection.php'; // Include your database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $question_text = $_POST['question_text'];
    $answer_a = $_POST['answer_a'];
    $answer_b = $_POST['answer_b'];
    $answer_c = $_POST['answer_c'];
    $answer_d = $_POST['answer_d'];
    $correct_answer = $_POST['correct_answer'];
    $level = $_POST['level'];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO questions (question_text, answer_a, answer_b, answer_c, answer_d, correct_answer, level) 
            VALUES ('$question_text', '$answer_a', '$answer_b', '$answer_c', '$answer_d', '$correct_answer', '$level')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Question added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
