// Updated: 2026-04-24
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

// ตั้งค่าให้อ่านภาษาไทยได้
$conn->set_charset("utf8mb4");

// ===== 3. Fetch Data =====
// โจทย์: ดึงข้อมูล email และ phone มาแสดงผลด้วย
$sql = "SELECT id, name, email, phone FROM students ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; background-color: #f4f7f6; }
        h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #007bff; color: white; text-transform: uppercase; letter-spacing: 0.03em; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; }
        a { text-decoration: none; color: #007bff; font-weight: bold; }
        .btn { 
            display: inline-block;
            padding: 10px 20px; 
            border: none; 
            background: #28a745; 
            color: white; 
            border-radius: 5px;
            margin-bottom: 20px;
            transition: background 0.3s;
        }
        .btn:hover { background: #218838; }
        .action-links a { margin-right: 10px; }
        .delete-btn { color: #dc3545; }
        .delete-btn:hover { color: #a71d2a; }
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
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td class="action-links">
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" 
                               class="delete-btn" 
                               onclick="return confirm('ยืนยันการลบข้อมูล?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center; padding: 20px; color: #888;">
                        --- No data found ---
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>

<?php
// ปิดการเชื่อมต่อ
$conn->close();
?>