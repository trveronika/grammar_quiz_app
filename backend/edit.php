<?php
include 'connect.php';

if(isset($_GET['id'])) {
    $question_id = $_GET['id'];

    $sql = "SELECT * FROM questions WHERE question_id = '$question_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $question_text = $row["question_text"];
        $answer_a = $row["answer_a"];
        $answer_b = $row["answer_b"];
        $answer_c = $row["answer_c"];
        $answer_d = $row["answer_d"];
        $correct_answer = $row["correct_answer"];
        $level = $row["level"];
    } else {
        echo "Question not found.";
        exit;
    }
} else {
    echo "Question ID not provided.";
    exit; 
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question</title>
</head>
<body>
    <h2>Edit Question</h2>
    <form action="process_edit.php" method="post">
        <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
        <label for="question_text">Question:</label><br>
        <textarea id="question_text" name="question_text" rows="4" cols="50" required><?php echo $question_text; ?></textarea><br>
        <label for="answer_a">Answer A:</label><br>
        <input type="text" id="answer_a" name="answer_a" value="<?php echo $answer_a; ?>" required><br>
        <label for="answer_b">Answer B:</label><br>
        <input type="text" id="answer_b" name="answer_b" value="<?php echo $answer_b; ?>" required><br>
        <label for="answer_c">Answer C:</label><br>
        <input type="text" id="answer_c" name="answer_c" value="<?php echo $answer_c; ?>" required><br>
        <label for="answer_d">Answer D:</label><br>
        <input type="text" id="answer_d" name="answer_d" value="<?php echo $answer_d; ?>" required><br>
        <label for="correct_answer">Correct Answer:</label><br>
        <select id="correct_answer" name="correct_answer" required>
            <option value="A" <?php if ($correct_answer === 'A') echo 'selected'; ?>>A</option>
            <option value="B" <?php if ($correct_answer === 'B') echo 'selected'; ?>>B</option>
            <option value="C" <?php if ($correct_answer === 'C') echo 'selected'; ?>>C</option>
            <option value="D" <?php if ($correct_answer === 'D') echo 'selected'; ?>>D</option>
        </select><br>
        <label for="level">Level:</label><br>
        <select id="level" name="level" required>
            <option value="A2" <?php if ($level === 'A2') echo 'selected'; ?>>A2</option>
            <option value="B2" <?php if ($level === 'B2') echo 'selected'; ?>>B2</option>
            <option value="C1" <?php if ($level === 'C1') echo 'selected'; ?>>C1</option>
        </select><br><br>
        <input type="submit" value="Submit">
    </form>
    <a href="crud.php">Back</a>
</body>
</html>
