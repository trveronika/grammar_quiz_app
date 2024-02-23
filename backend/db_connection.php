<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "english_quiz";
$table = "questions";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM " . $table;
$result = $conn->query($sql);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

echo "<h2>Data from " . $table . " table:</h2>";
if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["column1"] . " - " . $row["column2"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No data found.";
}

$conn->close();
?>