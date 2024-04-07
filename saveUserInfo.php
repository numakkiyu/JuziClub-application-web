<?php

// 文件路径
$filePath = 'userInfos.json';

// 获取从前端发送的JSON数据
$userInfo = json_decode(file_get_contents('php://input'), true);

// 读取现有数据
if (file_exists($filePath)) {
    $currentData = json_decode(file_get_contents($filePath), true);
} else {
    $currentData = [];
}

// 添加新数据
$currentData[] = $userInfo;

// 保存更新后的数据
file_put_contents($filePath, json_encode($currentData, JSON_PRETTY_PRINT));

echo "用户信息保存成功";
