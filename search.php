<?php
session_start(); // 启动会话

// 连接到数据库
$servername = "localhost";
$username = ""; // 数据库用户名
$password = ""; // 数据库密码
$dbname = "";

// 初始化和更新会话中的查找次数
if (!isset($_SESSION['last_search_time'])) {
    $_SESSION['last_search_time'] = time();
    $_SESSION['search_count'] = 0;
}

// 检查是否在1分钟内超过了10次查找
if (time() - $_SESSION['last_search_time'] < 60) {
    // 在1分钟内
    if ($_SESSION['search_count'] >= 5) {
        // 如果查找次数超过10次
        die("查找次数过多，请在1分钟后再试。If there are too many lookups, try again in 1 minute.");
    } else {
        // 更新查找次数
        $_SESSION['search_count']++;
    }
} else {
    // 超过1分钟，重置计时
    $_SESSION['last_search_time'] = time();
    $_SESSION['search_count'] = 1;
}

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 获取查询姓名
$searchName = $_GET["name"];

// 查询数据库
$sql = "SELECT * FROM applications WHERE name = '$searchName'";
$result = $conn->query($sql);

// 处理查询结果
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        echo "IGN: " . $row["name"]. " |  邮箱: " . $row["email"]. " |  申请理由: " . $row["reason"]. " |  状态: " . $row["status"] . " |  结果: " . $row["jieguo"] . " |  提交时间: " . $row["submitted_at"] . " |  回复时间: " . $row["hftime"] . " |  处理人: " . $row["handler"] . "<br>";
    }
} else {
    echo "未提交申请或IGN输入错误";
}

// 关闭数据库连接
$conn->close();
?>
