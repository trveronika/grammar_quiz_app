<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="opening.css">
    <title>English Grammar Quiz</title>
</head>
<body>
    <header>
        <h1>Welcome to the English Grammar Quiz!</h1>
    </header>
    <main>
        <div class="level_select">
            <h2>Select quiz level:</h2>
            <button id="beginner" onclick="startQuiz('A2')">Beginner</button>
            <button id="intermediate" onclick="startQuiz('B2')">Intermediate</button>
            <button id="advanced" onclick="startQuiz('C1')">Advanced</button>
        </div>
        <div class="additional">
            <button id="admin">Admin</button>
            <button id="leaderboard">Leaderboard</button>
        </div>
    </main>
    
    <script>
        function startQuiz(level) {
            window.location.href = 'quiz.php?level=' + level;
        }

        document.getElementById('admin').addEventListener('click', function() {
            window.location.href = 'login.php';
        });

        document.getElementById('leaderboard').addEventListener('click', function() {
            window.location.href = 'leaderboard.php';
        });
        
    </script>
</body>
<footer></footer>
</html>
