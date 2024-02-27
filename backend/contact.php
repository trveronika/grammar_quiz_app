<?php
include 'connect.php';

$sql = "SELECT email FROM users";
$result = $conn->query($sql);
$emails = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>Contact</title>
</head>
<body>
    <header>
        <h1>Contact</h1>
    </header>
    <main>
        <div id="contact-form">
            <h2>Do you need help?</h2>
            <p>Do you have a remark about one of the questions?</p>
            <p>Do you have an idea that you would like to see here?</p>
        </div>
        <div id="teachers-list">
            <h2>Please, feel free to contact the following:</h2>
            <ul>
                <?php foreach ($emails as $email): ?>
                    <li><?php echo $email['email']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="actions">
            <button id="home" onclick="window.location.href = 'index.php';">Go to Home</button>
        </div>
    </main>
</body>
</html>
