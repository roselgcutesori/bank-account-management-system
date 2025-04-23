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
<html>
<head>
    <title>Dashboard</title>
</head>
<body style="text-align:center;">
    <h2>Welcome, <?php echo $user['name']; ?>!</h2>
    <nav>
        <a href="library.php">Library</a> |
        <?php if (isAdmin()): ?>
    | <a href="manage_users.php">Manage Users</a>
    <?php endif; ?>
        <a href="changepassword.php">Change Password</a> |
        <a href="update_profile.php">Update Profile</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <div style="background-color:purplegit push; padding:10px;">
        <h1>Bank Account Management System</h1>
        <h3>Welcome Panel</h3>
        <p>This is a standard dashboard for our website project. You can manage your projects, view the library, and change your password.</p>
    </div>
</body>
</html>