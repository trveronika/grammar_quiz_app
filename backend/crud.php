<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crud.css">
    <title>Question CRUD</title>
</head>
<body>
    <h2> Quiz Questions</h2>
    <div class="btn-container">
        <button id="homepage-btn">Homepage</button>
        <button id="add-question-btn">Add Question</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>Solution</th>
                <th>Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="questions-table">
            <?php
            include 'connect.php'; 
            $sql = "SELECT * FROM questions ORDER BY question_id ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["question_id"] . "</td>";
                    echo "<td>" . $row["question_text"] . "</td>";
                    echo "<td>" . $row["answer_a"] . "</td>";
                    echo "<td>" . $row["answer_b"] . "</td>";
                    echo "<td>" . $row["answer_c"] . "</td>";
                    echo "<td>" . $row["answer_d"] . "</td>";
                    echo "<td>" . $row["correct_answer"] . "</td>";
                    echo "<td>" . $row["level"] . "</td>";
                    echo "<td>
                        <button class='edit-btn' onclick='editQuestion(" . $row["question_id"] . ")'>Edit</button>
                        <button class='delete-btn' onclick='deleteQuestion(" . $row["question_id"] . ")'>Delete</button>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No questions found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function editQuestion(question_id) {
            window.location.href = "edit.php?id=" + question_id;
        }

        function deleteQuestion(question_id) {
            if (confirm("Are you sure you want to delete this question?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        window.location.reload();
                    }
                };
                xhttp.open("POST", "delete.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("question_id=" + question_id);
            }
        }

        document.getElementById("homepage-btn").addEventListener("click", function() {
            window.location.href = "index.php";
        });

        document.getElementById("add-question-btn").addEventListener("click", function() {
            window.location.href = "add.php";
        });
    </script>
</body>
</html>

