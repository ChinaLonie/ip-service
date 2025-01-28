<?php
return [
    'api_key' => '设置你的API KEY',
    'allowed_origins' => [
        '*', // 允许所有来源
        'http://*.baidu.com' // 允许的来源
    ],
    'rate_limit' => [  // 访问频率限制配置
        'enabled' => true,
        'max_requests' => 100,   // 每分钟最大请求次数
        'time_window' => 60      // 时间窗口（秒）
    ]
];