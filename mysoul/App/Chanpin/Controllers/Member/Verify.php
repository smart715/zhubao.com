<?php namespace Soulcms\Controllers\Member;

class Verify extends \Soulcms\Member\Module
{

	// 内容列表
	public function index() {
		$this->_Member_Verify_List();
	}

	public function edit() {
		$this->_Member_Verify_Edit();
	}

	public function del() {
		$this->_Member_Verify_Del();
	}
}
