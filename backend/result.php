<?php
include 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = '';

if ($_GET['level'] == "All"){
    $totalQuestions = 100;
} else {
    $totalQuestions = 25;
}

$score = isset($_GET['score']) ? $_GET['score'] : 0;
$percentage = ($score / $totalQuestions) * 100;

if ($percentage == 100) {
    $percentageMessage = "Perfect, perfect, perfect!";
} elseif ($percentage >= 75) {
    $percentageMessage = "Amazing, marvelous!";
} elseif ($percentage >= 50) {
    $percentageMessage = "How nice!";
} elseif ($percentage >= 25) {
    $percentageMessage = "Progress is progress!";
} else {
    $percentageMessage = "Practice makes perfect!";
}

if ($_GET['level'] != "All"){
if (isset($_GET['username'], $_GET['time'], $_GET['score'], $_GET['level'])){
    $username = $_GET['username'];
    $time = $_GET['time'];
    $score = $_GET['score'];
    $level = $_GET['level'];

    $checkSql = "SELECT * FROM leaderboard WHERE username = '$username' AND time = '$time' AND points = '$score' AND level = '$level'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows == 0) {
        $sql = "INSERT INTO leaderboard (username, time, points, level) VALUES ('$username', '$time', '$score', '$level')";

        if ($conn->query($sql) === TRUE) {
            $message = "Congratulations! :) Check out the leaderboard!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Congratulations! :) Look at the leaderboard!";
    }
} else {
    $message = "Required data is missing";
}
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="result.css">
    <title>Quiz Results</title>
</head>
<body>
    <header>
        <h1>Quiz Results</h1>
    </header>
    <main>
        <div id="result-info">
            <p id="points">Points: <?php echo isset($_GET['score']) ? $_GET['score'] : ''; ?></p>
            <p id="time">Time: <?php echo isset($_GET['time']) ? $_GET['time'] : ''; ?></p>
        </div>
        <div id="message">
            <p><?php echo $message; ?></p>
            <p id="percentage"> <?php echo round($percentage, 2); ?>%</p>
            <p id="percentage-message"><?php echo $percentageMessage; ?></p>
        </div>
        <div id="actions">
            <button id="home" onclick="window.location.href = 'index.php';">New quiz</button>
            <!-- <button id="contact" onclick="window.location.href = 'contact.php';">Contact a Teacher</button> -->
            <button id="leaderboard" onclick="window.location.href = 'leaderboard.php';">Leaderboard</button>
        </div>
    </main>
</body>
</html>
