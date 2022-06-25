<?php namespace Soulcms\Controllers\Admin;

/**
 * 二次开发时可以修改本文件，不影响升级覆盖
 */

class Flag extends \Soulcms\Admin\Module
{

	public function index() {
		$this->_Admin_Flag_List();
	}
	
	public function edit() {
		$this->_Admin_Edit();
	}
}
