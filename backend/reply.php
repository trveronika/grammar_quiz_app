<?php
session_start();

if (!isset($_SESSION['username'])) {
    exit("Unauthorized access");
}

if (isset($_POST['comment_id']) && is_numeric($_POST['comment_id']) && isset($_POST['reply'])) {
    $commentId = $_POST['comment_id'];
    $reply = $_POST['reply'];

    include_once "connect.php";

    $sql = "UPDATE comments SET reply = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $reply, $commentId);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid data provided";
}
?>
