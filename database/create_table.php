<?php
include 'connection.php';

$sql = "CREATE DATABASE IF NOT EXISTS grammar_quiz";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->select_db("grammar_quiz");

$sql = "CREATE TABLE quiz_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT,
    answer_a TEXT
    answer_b TEXT
    answer_c TEXT
    answer_d TEXT
    correct_answer char(1)
    difficulty enum('A2', 'B2', 'C1')
)";

if ($conn->query($sql) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $conn->error;
}

$conn->close();
