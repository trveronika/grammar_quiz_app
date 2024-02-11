<?php
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Question ID: " . $row["question_id"] . "<br>";
        echo "Question Text: " . $row["question_text"] . "<br>";
        // Display other fields as needed
        echo "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
