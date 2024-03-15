function startQuiz(level) {
    window.location.href = 'quiz.php?level=' + level; 
}

document.getElementById('admin').addEventListener('click', function() {
    window.location.href = 'crud.php';
});

document.getElementById('contact').addEventListener('click', function() {
    window.location.href = 'contact.php';
});

document.getElementById('leaderboard').addEventListener('click', function() {
    window.location.href = 'leaderboard.php';
});

document.getElementById('summary').addEventListener('click', function() {
    window.location.href = 'grammar_guide.php';
});

document.getElementById('all').addEventListener('click', function() {
    window.location.href = 'quiz_all.php';
});

function toggleHelp() {
    var helpDiv = document.getElementById('help');
    if (helpDiv.style.display === 'none') {
        helpDiv.style.display = 'block';
    } else {
        helpDiv.style.display = 'none';
    }
}