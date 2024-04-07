<?php
session_start();
include 'db.php'; // 引入数据库连接文件

// 检查是否通过POST方法接收到了数据
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // 防止SQL注入
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // 准备查询
    $query = "SELECT * FROM admins WHERE username=?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // 假设密码是使用password_hash()函数加密的
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                // 登录成功后重定向到 admin.php
                header("Location: admin.php");
                exit();
            } else {
                $_SESSION['error'] = '密码错误！';
            }
        } else {
            $_SESSION['error'] = '用户名不存在！';
        }
        $stmt->close();
    } else {
        // 准备语句失败，可能是SQL查询语句问题
        $_SESSION['error'] = '登录失败，请稍后再试。';
    }
    $conn->close();

    // 如果登录失败，重定向回登录页面
    header("Location: login.php");
    exit();
} else {
    // 如果不是POST方法，直接重定向到登录页面
    header("Location: login.php");
    exit();
}
?>
