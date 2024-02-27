<?php
include 'connect.php';

if (isset($_GET['level'])) {
    $level = $_GET['level'];
} else {
    $level = 'A2';
}

$sql = "SELECT * FROM questions WHERE level = '$level' ORDER BY RAND() LIMIT 25";
$result = $conn->query($sql);
$questions = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include 'quiz.html'; ?>