<?php

/**
 * 域名api
 */

header('Content-Type: text/html; charset=utf-8');

if (!is_file('../index.php')) {
    echo '当前服务器无法访问跨目录文件：';
    echo '';
    exit();
}

echo 'soulcms ok';exit;