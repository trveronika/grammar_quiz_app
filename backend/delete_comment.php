<?php
session_start();

if (!isset($_SESSION['username'])) {
    exit("Unauthorized access");
}

if (isset($_POST['comment_id']) && is_numeric($_POST['comment_id'])) {
    $commentId = $_POST['comment_id'];

    include_once "connect.php";

    $sql = "DELETE FROM comments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $commentId);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid comment ID";
}
?>
