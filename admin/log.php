<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>日志查看器</title>
  <!-- 引入Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
  <div class="container mx-auto px-4">
    <?php
    // 检查是否有名为 "super_admin_logged_in" 的 cookie
    if (!isset($_COOKIE['super_admin_logged_in'])) {
      echo "<p class='text-red-500 text-center mt-5'>您无权访问此页面，请你联系Juzi_CN获取访问权限指令</p>";
      exit;
    }

    // 用户名和密码设置
    $username = '';
    $password = '';

    if (isset($_POST['submit'])) {
      if ($_POST['username'] == $username && $_POST['password'] == $password) {
        showLogs();
      } else {
        echo '<div class="alert alert-danger" role="alert">用户名或密码错误！</div>';
        showLoginForm();
      }
    } else {
      showLoginForm();
    }

    function showLoginForm()
    {
      echo '<div class="w-full max-w-xs mx-auto mt-5">
                    <h2 class="text-lg font-bold mb-4">登录</h2>
                    <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">用户名:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" required>
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">密码:</label>
                            <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="submit">提交</button>
                            <a href="./index.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">返回</a>
                        </div>
                    </form>
                  </div>';
    }

    function showLogs()
{
  echo '<div class="mt-5 space-y-4">';
  $logfile = 'user_actions.log';
  if (file_exists($logfile)) {
    $logs = file($logfile);

    // 将日志按时间排序，假设每条日志的第一个字段是时间
    usort($logs, function($a, $b) {
      $timeA = explode('/', $a)[0];
      $timeB = explode('/', $b)[0];
      return strtotime($timeB) - strtotime($timeA); // 降序排序
    });

    foreach ($logs as $log) {
      $data = explode('/', $log);
      echo '<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
              <div class="md:flex">
                <div class="p-8">
                  <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">日志详情</div>
                  <p class="block mt-1 text-lg leading-tight font-medium text-black">时间: ' . htmlspecialchars($data[0]) . '</p>
                  <p class="mt-2 text-gray-500">事件: ' . htmlspecialchars($data[1]) . '</p>
                  <p class="mt-2 text-gray-500">用户: ' . htmlspecialchars($data[2]) . '</p>
                  <p class="mt-2 text-gray-500">IP地址: ' . htmlspecialchars($data[3]) . '</p>
                  <p class="mt-2 text-gray-500">地点: ' . htmlspecialchars($data[4]) . ' ' . htmlspecialchars($data[5]) . ' ' . htmlspecialchars($data[6]) . '</p>
                  <p class="mt-2 text-gray-500">网络: ' . htmlspecialchars($data[7]) . '</p>
                  <p class="mt-2 text-gray-500">运营商: ' . htmlspecialchars($data[8]) . '</p>
                  <p class="mt-2 text-gray-500">操作系统: ' . htmlspecialchars($data[9]) . '</p>
                </div>
              </div>
            </div>';
        }
      } else {
        echo '<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                  <div class="p-8">
                    <p class="text-center text-sm text-gray-500">日志文件不存在</p>
                  </div>
                </div>
              </div>';
      }
      echo '</div>';
    }
    ?>
  </div>
</body>
</html>