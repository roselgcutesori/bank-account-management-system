<?php
include_once("connection.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_pass = password_hash(trim($_POST['new_password']), PASSWORD_DEFAULT);
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("UPDATE Users SET password = ? WHERE user_id = ?");
    $stmt->bind_param("si", $new_pass, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Password changed successfully.');</script>";
    } else {
        echo "<p style='color:red;'>Failed to update password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <style>
    /* Global Styles */
    body {
      font-family: 'Poppins', sans-serif;
      background: #fff0f5; /* Lavender Blush */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 100%;
      max-width: 380px;
      text-align: center;
    }

    h2 {
      color: #FFB7C5; /* Cherry Blossom Pink */
      margin-bottom: 20px;
      font-size: 24px;
    }

    label {
      font-size: 14px;
      color: #333;
      margin-bottom: 8px;
      display: block;
    }

    input {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 2px solid #FFB7C5;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s;
    }

    input:focus {
      border-color: #FF69B4; /* Hot Pink */
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #FFB7C5; /* Cherry Blossom Pink */
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #FF69B4; /* Hot Pink */
    }

    a {
      display: block;
      margin-top: 20px;
      color: #FFB7C5; /* Cherry Blossom Pink */
      text-decoration: none;
      font-size: 14px;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Change Password</h2>
    <form method="POST">
      <label for="new-password">New Password:</label>
      <input type="password" id="new-password" name="new_password" required>

      <button type="submit">Update Password</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
  </div>

</body>
</html>
