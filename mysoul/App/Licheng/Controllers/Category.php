<?php namespace Soulcms\Controllers;

/**
 * 二次开发时可以修改本文件，不影响升级覆盖
 */

class Category extends \Soulcms\Home\Module
{

	public function index() {
		// 初始化模块
		$this->_module_init();
		// 调用栏目方法
		$this->_Category(
			(int)\Soulcms\Service::L('Input')->get('id'), 
			mys_safe_replace(\Soulcms\Service::L('Input')->get('dir')), 
			max(1, (int)\Soulcms\Service::L('Input')->get('page'))
		);
	}

}
