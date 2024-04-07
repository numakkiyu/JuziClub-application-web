<?php
session_start();

// 确保用户已登录
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: paslogin.php');
    exit;
}

$mysqli = new mysqli('localhost', '', '', '');
if ($mysqli->connect_error) {
    die("连接失败: " . $mysqli->connect_error);
}

$error = '';
$success = '';

// 安全获取POST参数
function getPostParam($paramName) {
    return isset($_POST[$paramName]) ? trim($_POST[$paramName]) : '';
}

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = getPostParam('username');
    $password = getPostParam('password');
    $action = getPostParam('action');

    if (empty($username) || ($action !== 'delete' && empty($password))) {
        $error = '用户名和密码不能为空。';
    } else {
        switch ($action) {
            case 'add':
                addUser($mysqli, $username, $password);
                break;
            case 'update':
                updateUser($mysqli, $username, $password);
                break;
            case 'delete':
                deleteUser($mysqli, $username);
                break;
        }
    }
}

function addUser($mysqli, $username, $password) {
    global $error, $success;
    $stmt = $mysqli->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $error = "用户名已存在，不能重复添加。";
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $passwordHash);
        if ($stmt->execute()) {
            $success = "管理员账户成功添加。";
        } else {
            $error = "添加失败，请重试。";
        }
    }
}

function updateUser($mysqli, $username, $password) {
    global $error, $success;
    $newPasswordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("UPDATE admins SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $newPasswordHash, $username);
    if ($stmt->execute()) {
        $success = "密码成功更新。";
    } else {
        $error = "更新失败，请重试。";
    }
}

function deleteUser($mysqli, $username) {
    global $error, $success;
    $stmt = $mysqli->prepare("DELETE FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    if ($stmt->execute()) {
        $success = "管理员账户成功删除。";
    } else {
        $error = "删除失败，请重试。";
    }
}

function getAdmins($mysqli) {
    $admins = [];
    $result = $mysqli->query("SELECT username FROM admins");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $admins[] = $row;
        }
    }
    return $admins;
}

$admins = getAdmins($mysqli);
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员账户管理</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto py-10 px-4">
        <nav class="bg-gray-800 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="#" class="text-lg font-semibold">管理员面板</a>
                <div>
                    <a href="paslogout.php" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded">退出登录</a>
                </div>
            </div>
        </nav>
        <div class="space-y-6">
            <!-- 错误和成功消息 -->
            <?php if (!empty($error)): ?>
                <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <?= $error; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <?= $success; ?>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- 添加管理员 -->
                <div class="card bg-white shadow rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">添加管理员</h2>
                    <form action="" method="post" autocomplete="off">
                        <input type="hidden" name="action" value="add">
                        <div class="mb-4">
                            <label for="username-add" class="block text-sm font-medium text-gray-700">用户名</label>
                            <input type="text" id="username-add" name="username" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label for="password-add" class="block text-sm font-medium text-gray-700">密码</label>
                            <input type="password" id="password-add" name="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" autocomplete="off">
                        </div>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">添加</button>
                    </form>
                </div>

                <!-- 更新密码 -->
                <div class="card bg-white shadow rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">更新密码</h2>
                    <form action="" method="post" autocomplete="off">
                        <input type="hidden" name="action" value="update">
                        <div class="mb-4">
                            <label for="username-update" class="block text-sm font-medium text-gray-700">用户名</label>
                            <input type="text" id="username-update" name="username" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <label for="password-update" class="block text-sm font-medium text-gray-700">新密码</label>
                            <input type="password" id="password-update" name="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" autocomplete="off">
                        </div>
                        <button type="submit" class="w-full px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">更新</button>
                    </form>
                </div>

                <!-- 删除管理员 -->
                <div class="card bg-white shadow rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">删除管理员</h2>
                    <form action="" method="post" autocomplete="off">
                        <input type="hidden" name="action" value="delete">
                        <div class="mb-4">
                            <label for="username-delete" class="block text-sm font-medium text-gray-700">用户名</label>
                            <input type="text" id="username-delete" name="username" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" autocomplete="off">
                        </div>
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">删除</button>
                    </form>
                </div>
            </div>

            <!-- 管理员列表 -->
            <div class="mt-8 card bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">管理员列表</h2>
                <ul class="list-disc pl-5">
                    <?php foreach ($admins as $admin): ?>
                        <li><?= htmlspecialchars($admin['username']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>