<?php namespace Soulcms\Controllers;

/**
 * 二次开发时可以修改本文件，不影响升级覆盖
 */

class $NAME$ extends \Soulcms\Home\Form
{

    public function index() {
        $this->_Home_List();
    }

    public function show() {
        $this->_Home_Show();
    }

    public function post() {
        $this->_Home_Post();
    }

}
