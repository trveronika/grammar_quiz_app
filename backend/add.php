<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css"></style>
    <title>Add Question</title>
</head>
<header></header>
<body>
    <form action="process_add.php" method="post">
        <h2>Add question</h2>

        <label for="question_text">Question:</label><br>
        <textarea id="question_text" name="question_text" rows="4" cols="50" required></textarea><br>

        <label for="answer_a">Answer A:</label><br>
        <input type="text" id="answer_a" name="answer_a" required><br>

        <label for="answer_b">Answer B:</label><br>
        <input type="text" id="answer_b" name="answer_b" required><br>

        <label for="answer_c">Answer C:</label><br>
        <input type="text" id="answer_c" name="answer_c" required><br>

        <label for="answer_d">Answer D:</label><br>
        <input type="text" id="answer_d" name="answer_d" required><br>

        <label for="correct_answer">Correct Answer:</label><br>
        <select id="correct_answer" name="correct_answer" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select><br>

        <label for="level">Level:</label><br>
        <select id="level" name="level" required>
            <option value="A2">A2</option>
            <option value="B2">B2</option>
            <option value="C1">C1</option>
        </select><br><br>

        <div>
        <input type="submit" value="Submit">
        <a href="crud.php">Back</a>
        </div>
    
    </form>
</body>
</html>
