<?php
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!empty($email) && !empty($password)) {
        $result = $conn->query("SELECT user_id, name, password, role FROM Users WHERE email = '$email'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION["user_id"] = $row['user_id'];
                $_SESSION["role"] = $row['role'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No user found with that email.";
        }
    } else {
        echo "<p>Please fill in all fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #fff0f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        h2 {
            color: #d63384;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffeaf4;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 6px 12px rgba(255, 182, 193, 0.2);
            text-align: left;
            width: 300px;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #c71585;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ffb6c1;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #fff8fb;
        }

        button {
            margin-top: 20px;
            width: 100%;
            background-color: #ff8fab;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #ff5d8f;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #d63384;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: #ff4d6d;
            background-color: #ffe6eb;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>🌸 Login</h2>
    
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">✨ Login</button>
    </form>

    <a href="register.php">Don't have an account? Register 💖</a>

</body>
</html>
