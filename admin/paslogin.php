<?php
session_start();

// 检查是否有名为 "super_admin_logged_in" 的 cookie
if(!isset($_COOKIE['super_admin_logged_in'])) {
    // 如果 super_admin_logged_in cookie 不存在，直接显示无权访问消息
    echo "<p class='text-red-500 text-center mt-5'>您无权访问此页面，请你联系Juzi_CN获取访问权限指令</p>";
    exit;
}

// 数据库连接设置
$dbHost = 'localhost';
$dbUsername = '';
$dbPassword = '';
$dbName = '';

// 连接数据库
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}

// 定义默认的管理员凭据
const ADMIN_USERNAME = '';
const ADMIN_PASSWORD = '';

// 检查是否已经登录
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // 验证登录凭据
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
        if ($_POST['username'] === ADMIN_USERNAME && $_POST['password'] === ADMIN_PASSWORD) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: pasadmin.php'); // 重定向到管理员管理页面
            exit;
        } else {
            echo '<p>登录失败，请检查您的用户名和密码</p>';
        }
    }

    // 显示登录表单
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>超级管理员登录</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="block text-gray-700 text-xl font-bold mb-2">超级管理员登录</h2>
            <form action="" method="post" class="space-y-4">
                <div>
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">用户名:</label>
                    <input type="text" id="username" name="username" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">密码:</label>
                    <input type="password" id="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        登录
                    </button>
                    <a href="./index.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        返回
                    </a>
                </div>
            </form>
        </div>
        <script>
        // 显示错误消息
        function showError() {
            document.getElementById('errorMessage').classList.add('show');
            
            // 5秒后自动隐藏
            setTimeout(() => {
                document.getElementById('errorMessage').classList.remove('show');
            }, 5000);
        }
        
        // 页面加载完毕时显示错误消息
        window.onload = function() {
            showError();
        };
        
        // 点击错误消息时隐藏
        document.getElementById('errorMessage').onclick = function() {
            this.classList.remove('show');
        };
    </script>
    </body>
    </html>
    <?php
    exit;
}
$conn->close();
?>
