<?php
include 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if level is set in the URL
if (isset($_GET['level'])) {
    $level = $_GET['level'];
} else {
    // Default to 'A2' if level is not specified
    $level = 'A2';
}

// Fetch questions for the specified level
$sql = "SELECT * FROM questions WHERE level = '$level' ORDER BY RAND()";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <!-- Include your CSS styles here -->
    <style>
        .quiz-container {
            width: 70%;
            margin: auto;
        }
    </style>
</head>
<body>

<div class="quiz-container">
    <h1><?php echo ucfirst($level); ?> Quiz</h1>

    <form action="process_quiz.php" method="post" id="quiz-form">
        <?php $questionCount = $result->num_rows; ?>
        <?php $currentQuestion = 1; ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <fieldset class="quiz-question" data-question-id="<?php echo $row['question_id']; ?>" style="display: <?php echo ($currentQuestion === 1) ? 'block' : 'none'; ?>">
                <legend><?php echo $row['question_text']; ?></legend>

                <label>
                    <input type="radio" name="answers[<?php echo $row['question_id']; ?>]" value="A">
                    <?php echo $row['answer_a']; ?>
                </label><br>

                <label>
                    <input type="radio" name="answers[<?php echo $row['question_id']; ?>]" value="B">
                    <?php echo $row['answer_b']; ?>
                </label><br>

                <label>
                    <input type="radio" name="answers[<?php echo $row['question_id']; ?>]" value="C">
                    <?php echo $row['answer_c']; ?>
                </label><br>

                <label>
                    <input type="radio" name="answers[<?php echo $row['question_id']; ?>]" value="D">
                    <?php echo $row['answer_d']; ?>
                </label><br>

                <button type="button" class="next-button">Next</button>
            </fieldset>
            <?php $currentQuestion++; ?>
        <?php endwhile; ?>

        <input type="hidden" name="level" value="<?php echo $level; ?>">
        <input type="submit" value="Submit" style="display: none;">
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const quizForm = document.getElementById("quiz-form");
        const fieldsets = document.querySelectorAll(".quiz-question");
        let currentQuestion = 0;

        function showQuestion(index) {
            fieldsets.forEach((fieldset, i) => {
                fieldset.style.display = (i === index) ? 'block' : 'none';
            });
        }

        function nextQuestion() {
            currentQuestion++;
            if (currentQuestion < fieldsets.length) {
                showQuestion(currentQuestion);
            } else {
                alert('Quiz completed!'); // Replace with your logic for quiz completion
            }
        }

        quizForm.addEventListener("click", function (event) {
            if (event.target.classList.contains("next-button")) {
                nextQuestion();
            }
        });
    });
</script>

</body>
</html>

