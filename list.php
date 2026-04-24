<?php
// ===== 1. Database Config =====
$host = "localhost";
$user = "root";
$pass = "";
$db   = "student_db";

// ===== 2. Connect Database =====
$conn = new mysqli($host, $user, $pass, $db);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตั้งค่าให้อ่านภาษาไทยได้ (กรณีมีชื่อไทย)
$conn->set_charset("utf8mb4");

// ===== 3. Fetch Data =====
// ตรวจสอบว่า SQL Query มี email และ phone ตามที่โจทย์สั่ง
$sql = "SELECT id, name, email, phone FROM students ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 40px; background-color: #f4f7f6; }
        h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; background: white; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; }
        a { text-decoration: none; color: #007bff; }
        .btn { 
            display: inline-block;
            padding: 10px 15px; 
            border: none; 
            background: #28a745; 
            color: white; 
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .btn:hover { background: #218838; }
        .action-links a { margin-right: 10px; }
    </style>
</head>
<body>

<h2>📋 Student Management System</h2>

<a href="add.php" class="btn">+ Add New Student</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th> <th>Phone</th> <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td> <td><?= htmlspecialchars($row['phone']) ?></td> <td class="action-links">
                        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" 
                           style="color:red;" 
                           onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">No data found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>