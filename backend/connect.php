<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "english_quiz";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_errno . " - " . $conn->connect_error);
}
?>
