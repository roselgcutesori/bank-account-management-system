<?php
include_once("connection.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $file = $_FILES["profile_picture"];
    $filename = basename($file["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("UPDATE Users SET profile_picture = ? WHERE user_id = ?");
        $stmt->bind_param("si", $filename, $user_id);
        $stmt->execute();
        echo "<p>Profile picture updated!</p>";
    } else {
        echo "<p>Upload failed.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Picture</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fce4ec;
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
            color: #ec407a;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #ec407a;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="file"]:focus {
            border-color: #d81b60;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ec407a;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #d81b60;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #ec407a;
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
        <h2>Change Profile Picture</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="profile_picture">Upload Profile Picture:</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
            <button type="submit">Upload</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>
