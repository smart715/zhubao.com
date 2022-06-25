<?php namespace Soulcms\Controllers;

class Home extends \Soulcms\App
{

    public function index() {

        $name = 'hello word';

        // 将变量传入模板
        \Soulcms\Service::V()->assign([
            'testname' => $name,
        ]);

        // 选择输出模板 前台位于 /template/pc/default/home/myapp/test.html  这个文件要自己手动创建
        \Soulcms\Service::V()->display('test.html');
    }

}
