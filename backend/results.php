<?php
include 'connect.php';

if(isset($_GET['level'])) {
    $level = $_GET['level'];
} else {
    // Redirect to quiz page if level is not specified
    header("Location: quiz.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <!-- Include your CSS styles here -->
</head>
<body>

<h1>Quiz Results</h1>

<p>You have completed the <?php echo ucfirst($level); ?> quiz. Your results are:</p>

<!-- Display user's score or other relevant information -->

</body>
</html>
