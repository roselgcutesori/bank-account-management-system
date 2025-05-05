<?php
include_once("connection.php");
include_once("function.php");

if (!isAdmin()) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE Users SET role = ? WHERE user_id = ?");
    $stmt->bind_param("si", $new_role, $user_id);
    logAction($conn, $_SESSION['user_id'], "Logged in");
    $stmt->execute();
}

$users = $conn->query("SELECT user_id, name, email, role FROM Users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fff0f5;
            color: #444;
            margin: 0;
            padding: 40px;
            text-align: center;
        }

        h2 {
            color: #d63384;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #ffeaf4;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(255, 182, 193, 0.2);
            width: 90%;
            max-width: 800px;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #ffbfd8;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #fff5fa;
        }

        select {
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid #ffb6c1;
            background-color: #fff;
            font-size: 0.95rem;
        }

        button {
            background-color: #ff8fab;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 20px;
            cursor: pointer;
            margin-left: 10px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #ff5d8f;
        }

        a {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            color: #d63384;
            font-weight: 600;
            background-color: #ffe0ec;
            padding: 10px 18px;
            border-radius: 20px;
            transition: background 0.3s;
        }

        a:hover {
            background-color: #ffc0d6;
        }
    </style>
</head>
<body>

    <h2>🌸 User Role Management</h2>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change Role</th>
        </tr>
        <?php while ($user = $users->fetch_assoc()): ?>
            <tr>
                <form method="POST">
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <select name="role">
                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <button type="submit">Update</button>
                    </td>
                </form>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="dashboard.php">← Back to Dashboard</a>

</body>
</html>
