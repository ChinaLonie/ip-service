<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/zoujingli/ip2region/XdbSearcher.php';

// 加载配置
$config = require __DIR__ . '/../config/config.php';

// 获取请求来源
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

// 检查是否允许该来源访问
$allowed = false;
foreach ($config['allowed_origins'] as $pattern) {
    $pattern = str_replace('*', '.*', $pattern);
    if (preg_match('#^' . $pattern . '$#', $origin)) {
        $allowed = true;
        break;
    }
}

// 设置跨域头
header('Content-Type: application/json');
if ($allowed) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: X-API-KEY');
}

// API key 验证
$api_key = $_SERVER['HTTP_X_API_KEY'] ?? '';
if ($api_key !== $config['api_key']) {
    echo json_encode([
        'code' => 401,
        'msg' => 'Invalid API key',
        'data' => null
    ]);
    exit;
}

// 获取查询参数
$ip = $_GET['ip'] ?? '';

if (empty($ip)) {
    echo json_encode([
        'code' => 400,
        'msg' => 'IP parameter is required',
        'data' => null
    ]);
    exit;
}

try {
    // 初始化 ip2region 搜索器
    $dbPath = __DIR__ . '/../data/ip2region.xdb';
    $searcher = \XdbSearcher::newWithFileOnly($dbPath);
    
    // 查询 IP 信息
    $region = $searcher->search($ip);
    
    // 解析地理位置信息
    $regionParts = explode('|', $region);
    echo json_encode([
        'code' => 0,
        'msg' => 'success',
        'data' => [
            'ip' => $ip,
            'region' => [
                'country' => $regionParts[0] ?: '未知',
                'region' => $regionParts[1] ?: '未知',
                'province' => $regionParts[2] ?: '未知',
                'city' => $regionParts[3] ?: '未知',
                'isp' => $regionParts[4] ?: '未知'
            ]
        ]
    ], JSON_UNESCAPED_UNICODE);
} catch (\Exception $e) {
    echo json_encode([
        'code' => 500,
        'msg' => $e->getMessage(),
        'data' => null
    ]);
}