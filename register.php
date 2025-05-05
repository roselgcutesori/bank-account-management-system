<?php
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $phone = htmlspecialchars(trim($_POST['phone']));

    if (!empty($name) && !empty($email) && !empty($_POST['password'])) {
        $stmt = $conn->prepare("INSERT INTO Users (name, email, password, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $phone);
        
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";
        } else {
            echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Please fill in all required fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fff0f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
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
            box-shadow: 0 8px 16px rgba(255, 192, 203, 0.2);
            width: 320px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #c71585;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ffb6c1;
            border-radius: 10px;
            background-color: #fff8fb;
            font-size: 1rem;
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
            display: inline-block;
            margin-top: 20px;
            color: #d63384;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h2>🌸 User Registration</h2>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Phone:</label>
        <input type="text" name="phone">

        <button type="submit">✨ Register</button>
    </form>

    <a href="login.php">← Back to Login</a>

</body>
</html>
