<?php
include 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT * FROM leaderboard ORDER BY points DESC, time ASC LIMIT 10";
$result = $conn->query($sql);
$leaderboard = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="leaderboard.css">
    <title>Leaderboard</title>
</head>
<body>
    <header>
        <h1>Leaderboard</h1>
        <a href="index.php"><button>Homepage</button></a>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Points</th>
                    <th>Time</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php $rank = 1; ?>
                <?php foreach ($leaderboard as $entry): ?>
                    <tr>
                        <td><?php echo $rank; ?></td>
                        <td><?php echo $entry['username']; ?></td>
                        <td><?php echo $entry['points']; ?></td>
                        <td><?php echo $entry['time']; ?></td>
                        <td><?php echo $entry['level']; ?></td>
                    </tr>
                    <?php $rank++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
