<?php

// 文件路径
$filePath = 'userInfos.json';

// 获取从前端发送的JSON数据
$checkInfo = json_decode(file_get_contents('php://input'), true);

// 读取现有数据
if (file_exists($filePath)) {
    $userInfos = json_decode(file_get_contents($filePath), true);
} else {
    $userInfos = [];
}

// 检查是否存在重复
$duplicateFound = false;
foreach ($userInfos as $userInfo) {
    if ($userInfo['ip'] === $checkInfo['ip'] || $userInfo['browser'] === $checkInfo['browser']) {
        $duplicateFound = true;
        break;
    }
}

// 返回检查结果
if ($duplicateFound) {
    echo 'duplicate';
} else {
    echo 'unique';
}
