<?php
// 数据库文件 URL
$dbUrl = 'https://github.com/lionsoul2014/ip2region/raw/master/data/ip2region.xdb';
$localPath = __DIR__ . '/../data/ip2region.xdb';
$backupPath = $localPath . '.bak';

try {
    // 下载新数据库文件
    $newContent = file_get_contents($dbUrl);
    if ($newContent === false) {
        throw new Exception("Failed to download database file");
    }

    // 备份当前数据库
    if (file_exists($localPath)) {
        copy($localPath, $backupPath);
    }

    // 写入新数据库
    if (file_put_contents($localPath, $newContent) === false) {
        throw new Exception("Failed to write database file");
    }

    // 设置正确的权限
    chmod($localPath, 0644);

    echo "Database updated successfully\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    // 如果更新失败，恢复备份
    if (file_exists($backupPath)) {
        copy($backupPath, $localPath);
        echo "Restored from backup\n";
    }
    exit(1);
} 