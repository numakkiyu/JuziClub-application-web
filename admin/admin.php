<?php
session_start();

// 检查用户是否已登录，未登录则重定向到登录页面
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
} else {
  // 用户已登录，记录登录行为
  logAction($_SESSION['username'], '登录&刷新（第一次显示为登录状态，之后显示为刷新状态）');
}

$timeout = 60 * 60; // 设置超时时间为3600秒
// 检查是否超时
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
  // 如果超时，则记录用户自动登出的行为，清空session，并重定向到登录页面
  logAction($_SESSION['username'], '自动登出');
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit();
}

// 更新最后活动时间
$_SESSION['last_activity'] = time();

function logAction($user, $action)
{
  $logFile = 'user_actions.log'; // 修改为纯文本日志文件
  $timestamp = date('Y-m-d H:i:s');

  // 获取用户IP地址
  $userIP = $_SERVER['REMOTE_ADDR'];

  // 使用cURL调用外部API获取用户IP信息
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://tenapi.cn/v2/getip");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "ip={$userIP}");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($ch);
  curl_close($ch);

  // 解析API返回的数据
  $ipInfo = json_decode($response, true);

  if ($ipInfo && $ipInfo['code'] == 200) {
    $data = $ipInfo['data'];
    // 构造日志条目，包括用户信息
    $logEntry = "{$timestamp}/{$action}/{$user}/{$data['ip']}/{$data['country']}/{$data['province']}/{$data['city']}/{$data['area']}/{$data['isp']}/{$data['os']}/{$data['browser']}\n";
  } else {
    // 如果API调用失败，则只记录基础信息
    $logEntry = "{$timestamp}/{$action}/{$user}/API调用失败，无法获取IP信息\n";
  }

  file_put_contents($logFile, $logEntry, FILE_APPEND);
}


// 数据库连接配置
$loginDBHost = 'localhost';
$loginDBUser = '';
$loginDBPassword = '';
$loginDBName = '';

$conn_login = new mysqli($loginDBHost, $loginDBUser, $loginDBPassword, $loginDBName);
if ($conn_login->connect_error) {
  die("登录数据库连接失败: " . $conn_login->connect_error);
}

$adminDBHost = 'localhost';
$adminDBUser = '';
$adminDBPassword = '';
$adminDBName = '';

$conn_admin = new mysqli($adminDBHost, $adminDBUser, $adminDBPassword, $adminDBName);
if ($conn_admin->connect_error) {
  die("后台数据库连接失败: " . $conn_admin->connect_error);
}

if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $status = $_POST['status'];
  $jieguo = $_POST['jieguo'];
  $hftime = ($status == '已同意' || $status == '已拒绝') ? date('Y-m-d H:i:s') : null;
  $stmt = $conn_admin->prepare("UPDATE applications SET status = ?, jieguo = ?, hftime = ?, handler = ? WHERE id = ?");
  $handler = $_SESSION['username']; 
  $stmt->bind_param("ssssi", $status, $jieguo, $hftime, $handler, $id);

  if ($stmt->execute()) {
    $_SESSION['notification'] = ['type' => 'success', 'message' => '更新成功！'];
  } else {
    $_SESSION['notification'] = ['type' => 'error', 'message' => '更新失败：' . $conn_admin->error];
  }
  $stmt->close();
  logAction($_SESSION['username'], '修改');
  
  header("Location: ".$_SERVER['PHP_SELF']);
  exit();
}

if (isset($_GET['logout'])) {
  logAction($_SESSION['username'], '退出'); // 记录退出行为
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit();
}

$query = "SELECT * FROM applications ORDER BY CASE status WHEN '未处理' THEN 1 WHEN '已同意' THEN 2 WHEN '已拒绝' THEN 3 END";
$result = $conn_admin->query($query);

if (!$result) {
  die("查询失败：" . $conn_admin->error);
}

?>

<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理员仪表板</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/forms/dist/forms.min.css" rel="stylesheet">
  <style>
    @keyframes slideDown {
      0% {
        transform: translateY(-100%);
        opacity: 0;
      }

      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .animate-slideDown {
      animation: slideDown 0.5s ease-out forwards, fadeOut 0.5s 9s forwards;
    }

    @keyframes fadeOut {
      from {
        opacity: 1;
      }

      to {
        opacity: 0;
      }
    }
  </style>

</head>
<body class="bg-gray-100">
    <?php if (isset($_SESSION['notification'])) : ?>
      <div id="notification" class="fixed top-5 left-1/2 transform -translate-x-1/2 px-4 py-2 rounded shadow-lg text-white <?php echo $_SESSION['notification']['type'] === 'success' ? 'bg-green-500' : 'bg-red-500'; ?> animate-slideDown" style="animation-duration: 0.5s, 4.5s; animation-delay: 0, 5s;">
        <?php echo htmlspecialchars($_SESSION['notification']['message']); ?>
      </div>
      <script>
        setTimeout(() => {
          document.getElementById('notification').style.display = 'none';
        }, 9500);
      </script>
      <?php
      unset($_SESSION['notification']);
      ?>
    <?php endif; ?>
  <div class="max-w-6xl mx-auto px-4 py-6">
    <nav class="bg-white shadow-lg rounded-lg">
      <div class="py-4 px-6 flex flex-col md:flex-row justify-between items-center text-center md:text-left">
        <h1 class="text-xl font-semibold text-gray-700 mb-4 md:mb-0">管理员仪表板</h1>
        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
          <span class="text-gray-900 text-lg">Hello，<?php echo htmlspecialchars($_SESSION['username']); ?> 管理员！</span>
          <form action="logout.php" method="post">
            <button type="submit" name="logout" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold rounded-lg focus:outline-none focus:shadow-outline">退出登录</button>
          </form>
        </div>
      </div>
    </nav>
  </div>
  <div class="space-y-4">
    <?php
    if ($result && $result->num_rows > 0) {
      $applications = [];
      while ($row = $result->fetch_assoc()) {
        array_push($applications, $row);
      }
      usort($applications, function ($item1, $item2) {
        $statusPriority = [
          '未处理' => 1,
          '已同意' => 2,
          '已拒绝' => 3
        ];
        $status1Priority = $statusPriority[$item1['status']] ?? 99;
        $status2Priority = $statusPriority[$item2['status']] ?? 99;

        return $status1Priority <=> $status2Priority;
      });

      echo "<div class='grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6'>";
      foreach ($applications as $row) {
        $statusColor = 'bg-gray-200'; // Default color
        if ($row['status'] === '未处理') {
          $statusColor = 'bg-red-500';
        } elseif ($row['status'] === '已同意') {
          $statusColor = 'bg-green-500';
        } elseif ($row['status'] === '已拒绝') {
          $statusColor = 'bg-gray-500';
        } elseif ($row['status'] === '管理员测试') {
          $statusColor = 'bg-red-900';
        }

        echo "<div class='overflow-hidden rounded-lg shadow-lg'>"; 
        echo "<div class='{$statusColor} text-white text-lg px-6 py-3 rounded-t-lg'>" . htmlspecialchars($row['status']) . "</div>"; 
        echo "<div class='bg-white p-6'>"; 
        echo "<div class='mb-4'><h2 class='text-xl font-semibold mb-2'>申请档案名称：" . htmlspecialchars($row['name']) . "</h2>";
        echo "<p class='text-gray-700'>申请邮箱：" . htmlspecialchars($row['email']) . "</p></div>";
        echo "<div class='p-4 max-w-xl mx-auto bg-gray-100 rounded-xl shadow-md space-y-2 sm:p-6 lg:p-8 my-4'>";
        echo "<p class='text-md text-gray-500'>申请理由：</p>";
        echo "<div class='space-y-0.5'>";
        echo "<p class='text-lg font-medium text-gray-900'>" . htmlspecialchars($row['reason']) . "</p>";
        echo "</div>";
        echo "</div>";
        echo "<p class='text-sm text-gray-500'>提交时间: " . htmlspecialchars($row['submitted_at']) . "</p>"; 
        echo "<p class='text-sm text-gray-500 mb-4'>回复时间: " . htmlspecialchars($row['hftime'] ?? '未回复') . "</p>"; 
        $handlerDisplay = !empty($row['handler']) ? htmlspecialchars($row['handler']) : '暂无处理人';
        echo "<p class='text-sm text-gray-500'>处理人: " . $handlerDisplay . "</p>";
        echo "<form action='admin.php' method='post' class='space-y-4'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<select name='status' class='block w-full bg-white border border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'>";
        foreach (['未处理', '已同意', '已拒绝'] as $status) {
          $selected = $row['status'] === $status ? 'selected' : '';
          echo "<option value='$status' $selected>$status</option>";
        }
        echo "</select>";
        echo "<input type='text' name='jieguo' value='" . htmlspecialchars($row['jieguo']) . "' class='block w-full border border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'>";
        echo "<button type='submit' name='update' class='w-full text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 rounded-lg py-2'>更新</button>";
        echo "</form>";
        echo "</div>"; 
        echo "</div>"; 
      }
      echo "</div>"; 
    } else {
      echo "<p class='text-gray-600 text-center mt-4'>没有找到记录。</p>";
    }
    ?>
  </div>
  <footer class="bg-white shadow mt-8">
    <div class="max-w-6xl mx-auto px-4 py-6">
      <div class="text-center text-gray-600">
        <p>JuziClub 管理员申请页面 制作 by 北海的佰川</p>
        <p>版权归属 © 2024 JCLY TEAM. All rights reserved.</p>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>

</body>

</html>