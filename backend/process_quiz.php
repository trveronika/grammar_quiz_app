<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $level = $_POST['level'];
    $userAnswers = $_POST['answers'];

    header("Location: results.php?level=$level");
    exit();
}
?>
