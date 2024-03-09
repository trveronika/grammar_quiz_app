<?php
include 'connect.php';

$level = 'All';
$sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 100";
$result = $conn->query($sql);
$questions = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include 'quiz.html'; ?>