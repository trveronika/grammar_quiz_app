<?php
include 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['username'], $_GET['time'], $_GET['score'], $_GET['level'])) {
    $username = $_GET['username'];
    $time = $_GET['time'];
    $score = $_GET['score'];
    $level = $_GET['level'];

    $sql = "INSERT INTO leaderboard (username, time, points, level) VALUES ('$username', '$time', '$score', '$level')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Required data is missing";
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
            <p>Congratulations! You've successfully completed the quiz.</p>
        </div>
        <div id="actions">
            <button id="home" onclick="window.location.href = 'index.php';">Go to Home</button>
            <button id="contact" onclick="window.location.href = 'contact.php';">Contact a Teacher</button>
            <button id="leaderboard" onclick="window.location.href = 'leaderboard.php';">Leaderboard</button>
        </div>
    </main>
    <script src="result.js"></script>
</body>
</html>
