<?php
include 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['level'])) {
    $level = $_GET['level'];
} else {
    $level = 'A2';
}

$sql = "SELECT * FROM questions WHERE level = '$level' ORDER BY question_id";
$result = $conn->query($sql);
$questions = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quiz.css">
    <title>English Grammar Quiz</title>
</head>
<body>

<script>
   document.addEventListener('DOMContentLoaded', function () {
        var userName = prompt("Please enter your name:");
        if (userName != null && userName != "") {
            document.getElementById("username").innerHTML = "User: " + userName;
        }
    });
</script>

<script>
    var questions = <?php echo json_encode($questions); ?>;
    var currentQuestionIndex = 0;
    var userScore = 0;
    var timerInterval;

    function displayQuestion(index) {
        var question = questions[index];
        document.getElementById('question').innerHTML = '<p>Question ' + (index + 1) + ': ' + question.question_text + '</p>';
        var options = document.getElementById('options');
        options.innerHTML = '';
        options.innerHTML += '<button class="option" onclick="checkAnswer(this, \'' + question.correct_answer + '\', ' + index + ')" value="A">' + question.answer_a + '</button>';
        options.innerHTML += '<button class="option" onclick="checkAnswer(this, \'' + question.correct_answer + '\', ' + index + ')" value="B">' + question.answer_b + '</button>';
        options.innerHTML += '<button class="option" onclick="checkAnswer(this, \'' + question.correct_answer + '\', ' + index + ')" value="C">' + question.answer_c + '</button>';
        options.innerHTML += '<button class="option" onclick="checkAnswer(this, \'' + question.correct_answer + '\', ' + index + ')" value="D">' + question.answer_d + '</button>';
    }

    function startTimer() {
        var timerDisplay = document.getElementById('timer');
        var timeInSeconds = 0;

        timerInterval = setInterval(function() {
            var hours = Math.floor(timeInSeconds / 3600);
            var minutes = Math.floor((timeInSeconds % 3600) / 60);
            var seconds = timeInSeconds % 60;

            var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);
            timerDisplay.textContent = 'Time: ' + formattedTime;

            timeInSeconds++;
        }, 1000);
    }

    function checkAnswer(selectedButton, correctAnswer, questionIndex) {
        var isCorrect = selectedButton.value === correctAnswer;

        if (isCorrect) {
            selectedButton.style.backgroundColor = "#4CAF50";
            userScore++;
            updateScore();
        } else {
            selectedButton.style.backgroundColor = "#FF0000";
            var correctButton = document.querySelector('button[value="' + correctAnswer + '"]');
            correctButton.style.outline = "2px solid #4CAF50";
            correctButton.style.backgroundColor = "#CCCCCC";
            correctButton.style.color = "#000000"
        }

        var allButtons = document.getElementsByClassName("option");
        for (var i = 0; i < allButtons.length; i++) {
            allButtons[i].disabled = true;
        }

        setTimeout(function () {
            nextQuestion(questionIndex);
        }, 3000);
    }

    function nextQuestion(questionIndex) {
    currentQuestionIndex++;

    if (currentQuestionIndex < questions.length) {
        displayQuestion(currentQuestionIndex);
    } else {
        clearInterval(timerInterval); // Stop the timer
        var username = document.getElementById('username').textContent.split(': ')[1]; // Get the username
        var time = document.getElementById('timer').textContent.split(': ')[1]; // Get the timer state

        var level = "<?php echo $level; ?>";
        
        // Redirect to the result page with all necessary parameters
        window.location.href = 'result.php?score=' + userScore + '&username=' + encodeURIComponent(username) + '&time=' + encodeURIComponent(time) + '&level=' + encodeURIComponent(level);
    }
}

    function updateScore() {
        document.getElementById('score').innerHTML = 'Score: ' + userScore;
    }

    document.addEventListener('DOMContentLoaded', function () {
        displayQuestion(currentQuestionIndex);
        updateScore();
        startTimer(); // Start the timer when the page loads
    });
</script>

<header>
    <h1>English Grammar Quiz</h1>
    <div id="quiz-info">
        <p id="level">Level: <?php echo ucfirst($level); ?></p>
        <p id="username">User: John Doe</p>
        <p id="timer">Time: 00:00:00</p>
        <p id="score">Score: 0</p>
    </div>
</header>
<main>
    <div id="question"></div>
    <div id="options"></div>
</main>
<footer>
    <div id="navigation">
        <!-- <button id="previous" disabled>Previous</button> -->
        <button id="pause">Pause</button>
        <button id="next" onclick="nextQuestion(currentQuestionIndex)">Next</button>
        <button id="stop">Stop</button>
    </div>
</footer>
</body>
</html>
