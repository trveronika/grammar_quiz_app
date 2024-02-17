<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Questions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-btn, .delete-btn {
            padding: 6px 12px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP loop to populate table rows with questions -->
            <?php
            include 'db_connection.php'; // Include your database connection file

            // Fetch all questions from the database
            $sql = "SELECT * FROM questions";
            $result = $conn->query($sql);

            // Check if there are any questions
            if ($result->num_rows > 0) {
                // Loop through each row of the result set
                while ($row = $result->fetch_assoc()) {
                    // Output HTML table row for each question
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['question_text']}</td>";
                    echo "<td>{$row['answer_a']}</td>";
                    echo "<td>{$row['answer_b']}</td>";
                    echo "<td>{$row['answer_c']}</td>";
                    echo "<td>{$row['answer_d']}</td>";
                    echo "<td>";
                    echo "<a href='edit_question.php?id={$row['id']}' class='edit-btn'>Edit</a>";
                    echo "<a href='delete_question.php?id={$row['id']}' class='delete-btn'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No questions found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
