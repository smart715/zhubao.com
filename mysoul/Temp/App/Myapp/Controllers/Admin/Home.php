<?php namespace Soulcms\Controllers\Admin;

class Home extends \Soulcms\App
{

	public function index() {

	    $name = 'hello word';

        // 将变量传入模板
        \Soulcms\Service::V()->assign([
            'testname' => $name,
        ]);
        // 选择输出模板 后台位于 ./Views/test.html 此文件已经创建好了
        \Soulcms\Service::V()->display('test.html');
    }

}
