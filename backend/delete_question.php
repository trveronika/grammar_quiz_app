<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = $_POST['question_id'];

    $sql_delete = "DELETE FROM questions WHERE question_id = '$question_id'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Question deleted successfully";

        $sql_update_ids = "SET @num := 0;
            UPDATE questions SET question_id = @num := (@num+1);
            ALTER TABLE questions AUTO_INCREMENT = 1;";
        $conn->multi_query($sql_update_ids);
    } else {
        echo "Error deleting question: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
