<?php
include_once("connection.php");
include_once("function.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$result = $conn->query("SELECT name, profile_picture FROM Users WHERE user_id = $user_id");
$user = $result->fetch_assoc();
echo "<img src='uploads/" . $user['profile_picture'] . "' width='100' height='100'><br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fff6fa;
            margin: 0;
            padding: 0;
            text-align: center;
            color: #444;
        }

        header {
            background-color: #ffd1dc;
            padding: 30px 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
            color: #d63384;
        }

        nav {
            margin-top: 10px;
            background-color: #ffe6f0;
            padding: 15px 10px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        nav a {
            text-decoration: none;
            background-color: #ff8fab;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            transition: background 0.3s;
        }

        nav a:hover {
            background-color: #ff6f91;
        }

        .container {
            margin: 30px auto;
            max-width: 700px;
            background-color: #ffeaf6;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(255, 182, 193, 0.2);
        }

        h2 {
            color: #e75480;
        }

        h3 {
            color: #d63384;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        footer {
            margin-top: 30px;
            padding: 20px;
            font-size: 0.9rem;
            color: #aaa;
        }
    </style>
</head>
<body>

<header>
    <h1>Bank Account Management System 💖</h1>
</header>

<nav>
    <a href="library.php">📚 Library</a>
    <?php if (isAdmin()): ?>
        <a href="manage_users.php">👑 Manage Users</a>
    <?php endif; ?>
    <a href="changepassword.php">🔒 Change Password</a>
    <a href="update_profile.php">🧸 Update Profile</a>
    <a href="logout.php">🚪 Logout</a>
</nav>

<div class="container">
    <h2>Welcome, <?php echo $user['name']; ?>! 🌼</h2>
    <h3>Welcome Panel</h3>
    <p>This is a standard dashboard for our website project.</p>
    <p>You can manage your projects, view the library, and change your password.</p>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> Bank Account Management System. Made with 💕
</footer>

</body>
</html>
