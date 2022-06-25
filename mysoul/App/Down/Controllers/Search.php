<?php namespace Soulcms\Controllers;

/**
 * 二次开发时可以修改本文件，不影响升级覆盖
 */

class Search extends \Soulcms\Home\Module
{

	public function index() {
		// 初始化模块
		$this->_module_init();
		// 调用搜索方法
		$this->_Search();
	}

}
