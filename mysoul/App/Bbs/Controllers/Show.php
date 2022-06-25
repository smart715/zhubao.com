<?php namespace Soulcms\Controllers;

/**
 * 二次开发时可以修改本文件，不影响升级覆盖
 */

class Show extends \Soulcms\Home\Module
{

    public function index() {
        $this->_module_init();
        $this->_Show(
            (int)\Soulcms\Service::L('Input')->get('id'),
            [
                'field' => mys_safe_replace(\Soulcms\Service::L('Input')->get('field')),
                'value' => mys_safe_replace(\Soulcms\Service::L('Input')->get('value')),
            ],
            max(1, (int)\Soulcms\Service::L('Input')->get('page'))
        );
    }

    public function time() {
        $this->_module_init();
        $this->_MyShow(
            'time',
            (int)\Soulcms\Service::L('Input')->get('id'),
            max(1, (int)\Soulcms\Service::L('Input')->get('page'))
        );
    }

    public function recycle() {
        $this->_module_init();
        $this->_MyShow(
            'recycle',
            (int)\Soulcms\Service::L('Input')->get('id'),
            max(1, (int)\Soulcms\Service::L('Input')->get('page'))
        );
    }

    public function draft() {
        $this->_module_init();
        $this->_MyShow(
            'draft',
            (int)\Soulcms\Service::L('Input')->get('id'),
            max(1, (int)\Soulcms\Service::L('Input')->get('page'))
        );
    }

    public function verify() {
        $this->_module_init();
        $this->_MyShow(
            'verify',
            (int)\Soulcms\Service::L('Input')->get('id'),
            max(1, (int)\Soulcms\Service::L('Input')->get('page'))
        );
    }

}
