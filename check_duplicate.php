<?php
// 数据库连接信息
$host = 'localhost';
$username = '';
$password = '';
$database = '';

// 连接数据库
$conn = new mysqli($host, $username, $password, $database);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 获取IGN
$playerName = isset($_GET['name']) ? $_GET['name'] : '';

// 准备SQL语句
$stmt = $conn->prepare("SELECT * FROM applications WHERE name = ?");
$stmt->bind_param("s", $playerName);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 如果找到了记录，表示重复提交
    echo "duplicate";
} else {
    // 没有找到记录，表示没有重复
    echo "no_duplicate";
}

// 关闭连接
$stmt->close();
$conn->close();
?>
