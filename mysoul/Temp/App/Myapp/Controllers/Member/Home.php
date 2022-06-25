<?php namespace Soulcms\Controllers\Member;

class Home extends \Soulcms\App
{

    public function index() {

        $name = 'hello word';

        // 将变量传入模板
        \Soulcms\Service::V()->assign([
            'testname' => $name,
        ]);
        // 选择输出模板 用户中心位于 /template/pc/defaul/membert/myapp/test.html 这个文件要自己手动创建
        \Soulcms\Service::V()->display('test.html');
    }

}
