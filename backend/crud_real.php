<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question CRUD</title>
    <style>
         table {
            width: 100%; 
            border-collapse: collapse; 
        }

        th, td {
            padding: 8px; 
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .edit-btn, .delete-btn {
            padding: 6px 10px;
            margin-right: 5px;
            border: none;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
        }

        .edit-btn:hover, .delete-btn:hover {
            background-color: #0056b3;
        }

        .btn-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="btn-container">
        <button id="homepage-btn">Homepage</button>
        <button id="add-question-btn">Add Question</button>
    </div>
    <h2>Questions List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer A</th>
                <th>Answer B</th>
                <th>Answer C</th>
                <th>Answer D</th>
                <th>Correct Answer</th>
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
        // JavaScript functions for editing and deleting questions
        function editQuestion(question_id) {
        // Redirect to the edit_question.php page with the question_id as a query parameter
        window.location.href = "edit_question.php?id=" + question_id;
    }
    </script>
</body>
</html>
