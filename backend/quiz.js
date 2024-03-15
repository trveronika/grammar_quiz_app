function checkAnswer(selectedButton) {

    var isCorrect = true;

    if (isCorrect) {
        selectedButton.style.backgroundColor = "#4CAF50";
    } else {
        selectedButton.style.backgroundColor = "#FF0000";
    }

    var allButtons = document.getElementsByClassName("option");
    for (var i = 0; i < allButtons.length; i++) {
        allButtons[i].disabled = true;
    }
}