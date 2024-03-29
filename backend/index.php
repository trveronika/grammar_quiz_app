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
            <button id="all" onclick="startQuiz('All')">Mixed</button>
        </div>
        <div class="additional">
            <button id="summary">Grammar Guide</button>
            <button id="leaderboard">Leaderboard</button>
        </div>
        <div class="admin">
            <button id="admin">Admin</button>
            <button id="contact">Contact</button>
        </div>
        <hr>
        <button onclick="toggleHelp()" class="help-button">Help</button>
        <div class="help" id="help" style="display: none;">
            <p>Are you here to learn grammar? Start with the Grammar Guide</p>
            <p>Would you like to test your grammar knowledge? Choose a level and answer 25 random questions</p>
            <p>Are you interested in the top results? Check out the leaderboard</p>
            <p>Are you a teacher? Register as an admin and edit the questions after logging in</p>
        </div>
    </main>    
    <script src="index.js"></script>
    <footer>
        <p>Developed by Veronika Tári</p>
        <p>2024</p>
    </footer>
</body>
</html>
