document.addEventListener('DOMContentLoaded', function () {
    var userName = prompt("Please enter your name:");
    if (userName != null && userName != "") {
        document.getElementById("username").innerHTML = "User: " + userName;
    }
});