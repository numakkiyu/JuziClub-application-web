<?php
// 开启会话
session_start();

// 检查Cookie是否存在且值为"true"
if (!isset($_COOKIE['visited_a']) || $_COOKIE['visited_a'] !== "true") {
    header('Location: ./index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员登录</title>
    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- 自定义样式 -->
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            margin: 20px;
            padding: 20px;
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h5 class="card-title center">管理员登录</h5>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="card-panel red lighten-4">
                    <?php echo $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); endif; ?>
            <form action="authenticate.php" method="post">
                <div class="input-field">
                    <input id="username" name="username" type="text" class="validate" required>
                    <label for="username">用户名</label>
                </div>
                <div class="input-field">
                    <input id="password" name="password" type="password" class="validate" required>
                    <label for="password">密码</label>
                </div>
                <button type="submit" class="btn waves-effect waves-light">登录</button>
                <a href="./index.php" class="btn waves-effect waves-light">返回</a>
            </form>
        </div>
    </div>
    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
