<?php
/**
 * 初始化安装数据，如果不要安装数据请删除本文件
 */

\Soulcms\Service::M('module')->install('news');
$sql = file_get_contents(MYPATH.'Config/demo.sql');
if ($sql) {
    $sql = str_replace('{dbprefix}', \Soulcms\Service::M()->prefix, $sql);
    \Soulcms\Service::M()->query_all($sql);
}