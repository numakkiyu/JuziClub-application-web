<?php
$expireTime = time() + 86400;
// 默认情况下，当有按钮点击时，设置一个共同的 cookie，表示用户已访问过页面
setcookie("visited_a", "true", $expireTime, "/");

// 检查是否是 POST 请求并且提交的 secret_code 符合条件
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['secret_code'] === "juzicnlove") {
    // 如果符合条件，设置一个额外的 cookie，表示用户提交了正确的密钥
    setcookie("super_admin_logged_in", "true", $expireTime, "/");
}

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuziClub管理系统</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
    @keyframes popIn {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }
        60% {
            transform: scale(1.1);
            opacity: 1;
        }
        100% {
            transform: scale(1);
        }
    }
    .btn {
        display: inline-block;
        border: none;
        cursor: pointer;
        text-align: center;
        transition: transform 0.2s ease-in-out;
    }
    .btn-primary {
        background-color: #4f46e5;
        color: white;
        padding: 12px 24px; /* 调整按钮大小以提高可点击性 */
        border-radius: 8px;
        display: block; /* 使按钮块状化，更易点击 */
        width: 80%; /* 按钮宽度调整 */
        margin: 10px auto; /* 居中显示并增加间距 */
        box-shadow: 0 4px 14px 0 rgba(0,0,0,0.1); /* 添加阴影以增加层次感 */
    }
    .btn-primary:hover {
        animation: popIn 0.5s ease forwards;
    }
    .hidden-input {
        width: 100%;
        position: fixed;
        bottom: 0;
        left: 0;
    }
    .hidden-input input[type="text"] {
        width: 100%;
        border: none;
        padding: 10px 0;
        text-align: center;
        background-color: #f3f4f6; 
        color: #4b5563;
    }
    .content {
        max-width: 800px; /* 调整最大宽度以适应更大的屏幕 */
        margin: auto;
        text-align: center;
        padding: 40px; /* 增加填充以提供更多空间 */
        box-sizing: border-box;
    }
    
    </style>
</head>
    <body class="bg-gray-100 flex flex-col justify-between min-h-screen">
        
    <div class="content">
        <h4 class="text-4xl font-bold text-gray-800 mb-10">欢迎来到 加入我们 的管理系统</h4>
        <div class="space-y-4">
            <a href="./admin.php" class="btn btn-primary">JuziClub审核管理员登录</a>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['secret_code'] === "ps"): ?>
                <a href="./pasadmin.php" class="btn btn-primary">JuziClub超级管理员登录</a>
                <a href="./log.php" class="btn btn-primary">JuziClub管理日志</a>
            <?php endif; ?>
        </div>
    </div>


<div class="hidden-input">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="secret_code" placeholder="SYSTEM JCLY TEAM" autocomplete="off">
        <input type="submit" value="Submit" style="position:absolute; top:-9999px; left:-9999px;">
    </form>
</div>
<script>console['\x6c\x6f\x67'](`\n-----------\n\x43\x6f\x70\x79\x72\x69\x67\x68\x74\xa9\x32\x30\x32\x34\u5317\u6d77\u7684\u4f70\u5ddd\x55\x49\xa9\x32\x30\x32\x33-2024 Juzi\n\n\u7248\u6743\u548c\u7cfb\u7edf\u5236\u4f5c\u8457\u4f5c\u6743\u4e3a\u5317\u6d77\u7684\u4f70\u5ddd\u3001\x4a\x75\x7a\x69\x43\x6c\x75\x62\u6240\u6709\u3001\u975e\u6cd5\u76d7\u7528\u5c06\u4f1a\u53d7\u5230\u6cd5\u5f8b\u8ffd\u7a76\uff01\n\n\u672c\x55\x49\u754c\u9762\u90e8\u5206\u91c7\u7528\x4d\x61\x74\x65\x72\x69\x61\x6c\x69\x7a\x65\u7b2c\u4e09\u65b9\u5f15\u7528\u5e93\uff0c\u4f46\u5176\u4ed6\u5e03\u5c40\u540e\u53f0\u7cfb\u7edf\u5747\u4e3a\u5317\u6d77\u7684\u4f70\u5ddd\u5236\u4f5c\n\n\u7f51\u7ad9\u9875\u9762\u6700\u7ec8\u7248\u6743\u6240\u6709\u8005\uff08\u7ec4\u7ec7\uff09\u4e3a\x4a\x75\x7a\x69\x43\x6c\x75\x62\u6240\u6709\n\n\u6ce8\u610f\uff0c\u8bf7\u4f60\u5728\u4f7f\u7528\u5f00\u53d1\u8005\u63a7\u5236\u53f0\u7684\u65f6\u5019\uff0c\u8bf7\u4e0d\u8981\u5f80\u91cc\u9762\u6ce8\u5165\u975e\u6cd5\u4ee3\u7801\uff0c\u672c\u9875\u9762\u5c06\u4f1a\u8bb0\u5f55\u975e\u6cd5\u4fe1\u606f\n-----------`);</script>
</body>
</html>

