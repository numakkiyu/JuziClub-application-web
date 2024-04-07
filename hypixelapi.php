<?php
$apiKey = 'hypixel key';
$playerName = isset($_GET['playerName']) ? $_GET['playerName'] : '';
$ipAddress = $_SERVER['REMOTE_ADDR']; // 获取客户端IP地址
$rateLimitDirectory = __DIR__ . '/rate_limit';
$rateLimitFile = "{$rateLimitDirectory}/{$ipAddress}.json"; // 指定计数器文件的路径

header('Content-Type: application/json');

// 确保 rate_limit 目录存在
if (!file_exists($rateLimitDirectory)) {
    mkdir($rateLimitDirectory, 0700, true);
}

// 限速检查
if (!checkRateLimit($rateLimitFile)) {
    echo json_encode(['error' => 'Rate limit exceeded. Please try again later.']);
    exit;
}

if (empty($playerName)) {
    echo json_encode(['error' => 'Player name not provided']);
    exit;
}

$uuid = getUuid($playerName);
if ($uuid) {
    $playerData = getHypixelPlayerData($apiKey, $uuid);
    $guildData = getHypixelGuildData($apiKey, $uuid);

    $networkLevel = null;
    $hasGuild = false;

    if (isset($playerData['player']['networkExp'])) {
        $networkExp = $playerData['player']['networkExp'];
        $networkLevel = hypixelLevel($networkExp);
    }

    if (isset($guildData['guild'])) {
        $hasGuild = true;
    }

    echo json_encode([
        'networkLevel' => $networkLevel,
        'hasGuild' => $hasGuild
    ]);
} else {
    echo json_encode(['error' => 'Could not retrieve player UUID']);
}

// 获取玩家UUID的函数
function getUuid($playerName) {
    $url = "https://api.mojang.com/users/profiles/minecraft/" . $playerName;
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    return $data['id'] ?? false;
}

// 获取玩家Hypixel数据的函数
function getHypixelPlayerData($apiKey, $uuid) {
    $url = "https://api.hypixel.net/player?key=" . $apiKey . "&uuid=" . $uuid;
    $response = file_get_contents($url);
    return json_decode($response, true);
}

// 计算Hypixel等级的函数
function hypixelLevel($xp) {
    $prefix = -3.5;
    $const = 12.25;
    $divides = 0.0008;
    return sqrt($xp * $divides + $const) + $prefix + 1;
}

// 获取玩家Guild信息的函数
function getHypixelGuildData($apiKey, $uuid) {
    $url = "https://api.hypixel.net/guild?key=" . $apiKey . "&player=" . $uuid;
    $response = file_get_contents($url);
    return json_decode($response, true);
}

// 添加checkRateLimit函数
function checkRateLimit($file) {
    $currentTime = time();
    $window = 300; // 时间窗口，单位为秒
    $limit = 200; // 5分钟内的请求限制

    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        // 清除时间窗口之外的请求
        $requests = array_filter($data['requests'], function ($timestamp) use ($currentTime, $window) {
            return $currentTime - $timestamp < $window;
        });

        if (count($requests) < $limit) {
            $requests[] = $currentTime;
            file_put_contents($file, json_encode(['requests' => $requests]));
            return true;
        } else {
            return false;
        }
    } else {
        // 对于首次请求，创建计数器文件
        file_put_contents($file, json_encode(['requests' => [$currentTime]]));
        return true;
    }
}
?>
