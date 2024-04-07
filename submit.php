<?php
session_start();

header('Content-Type: application/json');
// 允许跨域的域名列表
$allowed_domains = ['https://abc.abc.com', 'http://abc.abc.com'];

// 检查请求的来源是否在白名单内
if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_domains)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
} else {
    // 如果来源不在白名单内，终止脚本
    exit('CORS requests not allowed from this origin.');
}

// 连接数据库
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 初始化和更新会话中的提交次数
if (!isset($_SESSION['last_submit_time'])) {
    $_SESSION['last_submit_time'] = time();
    $_SESSION['submit_count'] = 0;
}

if (time() - $_SESSION['last_submit_time'] < 60) {
    if ($_SESSION['submit_count'] >= 5) {
        echo json_encode(["message" => "提交次数过多，请在60分钟后再试。", "success" => false]);
        exit; 
    } else {
        $_SESSION['submit_count']++;
    }
} else {
    $_SESSION['last_submit_time'] = time();
    $_SESSION['submit_count'] = 1;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // hCaptcha验证
    $captcha = $_POST['h-captcha-response'];
    $secretKey = "hcaptcha key";
    $response = file_get_contents("https://hcaptcha.com/siteverify?secret=" . $secretKey . "&response=" . $captcha);
    $responseKeys = json_decode($response, true);
    if (intval($responseKeys["success"]) !== 1) {
        echo json_encode(["message" => "人机验证失败，请重试。", "success" => false]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO applications (name, email, reason, status, jieguo) VALUES (?, ?, ?, '未处理', '暂无')");
    $stmt->bind_param("sss", $name, $email, $reason);

    $name = $_POST["name"];
    $email = $_POST["email"];
    $reason = $_POST["reason"];

    if ($stmt->execute()) {
        echo json_encode(["message" => "申请提交成功！", "success" => true]);
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error, "success" => false]);
    }

    $stmt->close();
    $conn->close();
}
?>