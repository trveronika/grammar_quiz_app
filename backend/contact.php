<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $timestamp = date("Y-m-d H:i:s");

    $sql = "INSERT INTO comments (name, email, comment, created_at) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $comment, $timestamp);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "<script>window.location.href = 'contact.php';</script>";
    exit();
}

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
        <h1>Leave a comment</h1>
    </header>
    <main>
        <div id="contact-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>

                <label for="comment">Comment:</label><br>
                <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br>

                <button type="submit">Submit</button>
            </form>

        </div>
        <div id="comment-list">
            <?php
            $sql = "SELECT id, name, email, comment, created_at, reply FROM comments ORDER BY created_at DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='comment'>";
                    echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
                    echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                    echo "<p><strong>Comment:</strong><br>" . $row["comment"] . "</p>";
                    echo "<p><strong>Time:</strong> " . $row["created_at"] . "</p>";
                    echo "<p><strong>Reply:</strong> " . $row["reply"] . "</p>";

                    if (isset($_SESSION['username'])) {
                        echo "<button onclick='deleteComment(" . $row['id'] . ")'>Delete</button>";
                    }
                    
                    if (isset($_SESSION['username'])) {
                        echo "<button onclick='replyToComment(" . $row['id'] . ")'>Reply</button>";
                    }

                    echo "</div>";
                }
            } else {
                echo "No comments yet.";
            }
            ?>
        </div>
        <div id="actions">
            <button id="home" onclick="window.location.href = 'index.php';">Home</button>
        </div>
        </main>

</body>
<script>
    function deleteComment(commentId) {
        if (confirm("Are you sure you want to delete this comment?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_comment.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText.trim() === "success") {
                        location.reload();
                    } else {
                        alert("Error deleting comment.");
                    }
                }
            };
            xhr.send("comment_id=" + commentId);
        }
    }

    function replyToComment(commentId) {
        var reply = prompt("Enter your reply:");
        if (reply !== null && reply.trim() !== "") {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "reply.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText.trim() === "success") {
                        location.reload();
                    } else {
                        alert("Error adding reply.");
                    }
                }
            };
            xhr.send("comment_id=" + commentId + "&reply=" + encodeURIComponent(reply));
        }
    }
</script>

</html>
