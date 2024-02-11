<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "english_quiz";
$table = "questions";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_errno . " - " . $conn->connect_error);
}

// Select data from the table
$sql = "SELECT * FROM " . $table;
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Display the data
echo "<h2>Data from " . $table . " table:</h2>";
if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        // Display each row
        echo "<li>" . $row["question_id"] . " - " . $row["question_text"] . "</li>";
        // Adjust column names as needed
    }
    echo "</ul>";
} else {
    echo "No data found.";
}

// Close the connection
$conn->close();
?>
