<?php
include 'connect.php';

$username = $email = $password = "";
$username_err = $email_err = $password_err = $password_confirm_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $email_err = "This email is already registered.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";     
    } elseif (strlen(trim($_POST["password"])) < 12) {
        $password_err = "Password must have at least 12 characters.";
    } elseif (!preg_match("/[A-Z]/", $_POST["password"])) {
        $password_err = "Password must include at least one uppercase letter.";
    } elseif (!preg_match("/\d/", $_POST["password"])) {
        $password_err = "Password must include at least one number.";
    } elseif (!preg_match("/\W/", $_POST["password"])) {
        $password_err = "Password must include at least one special character.";
    } else {
        $password = trim($_POST["password"]);
    }

    if ($_POST["password"] !== $_POST["password_confirm"]) {
        $password_confirm_err = "Password confirmation does not match.";
    }

    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($password_confirm_err)) {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
         
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $param_username, $param_email, $param_password);

            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            if ($stmt->execute()) {
                echo "<script>window.location.href = 'login.php';</script>";
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>User Registration</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Teacher Registration</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
                    <span class="error"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                    <span class="error"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{12,}" title="Password must contain at least 12 characters, including at least one number, one capital letter, and one special character" required>
                    <span class="error"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirm Password:</label>
                    <input type="password" id="password_confirm" name="password_confirm" required>
                    <span class="error"><?php echo $password_confirm_err; ?></span>
                </div>
                <button type="submit">Register</button>
                <p><a href="index.php">Home</a></p>
            </form>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'password_mismatch') {
                    echo "<p class='error'>Password confirmation does not match.</p>";
                } elseif ($_GET['error'] == 'username_taken') {
                    echo "<p class='error'>This username is already taken.</p>";
                } elseif ($_GET['error'] == 'email_taken') {
                    echo "<p class='error'>This email is already registered.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
