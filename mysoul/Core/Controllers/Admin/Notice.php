<?php namespace Soulcms\Controllers\Admin;

/* *
 *
 * Copyright [2019]
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 *
 *
 * 本文件是框架系统文件，二次开发时不建议修改本文件
 *
 * */



class Notice extends \Soulcms\Common
{
	
	private $field;
	
	public function __construct(...$params) {
		parent::__construct(...$params);
		$this->field = [
			'msg' => [
				'name' => mys_lang('内容'),
				'ismain' => 1,
				'fieldname' => 'msg',
				'fieldtype' => 'Text',
			],
			'username' => [
				'name' => mys_lang('申请人'),
				'ismain' => 1,
				'fieldname' => 'username',
				'fieldtype' => 'Text',
			],
			'op_username' => [
				'name' => mys_lang('处理人'),
				'ismain' => 1,
				'fieldname' => 'op_username',
				'fieldtype' => 'Text',
			]
		];
		\Soulcms\Service::V()->assign([
			'menu' => \Soulcms\Service::M('auth')->_admin_menu(
				[
					'处理记录' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-bell-slash'],
					'待处理' => [\Soulcms\Service::L('Router')->class.'/my_index', 'fa fa-bell-o'],
					'全部' => [\Soulcms\Service::L('Router')->class.'/all_index', 'fa fa-bell'],
				]
			),
			'field' => $this->field,
		]);
	}

	// 处理记录
	public function index() {

		list($list, $total, $param) = \Soulcms\Service::M()->init([
			'table' => 'admin_notice',
			'where_list' => 'op_uid='. $this->uid . ' and (site=0 or site='.SITE_ID.')',
			'field' => $this->field,
			'date_field' => 'inputtime',
			'order' => 'inputtime desc'
		])->limit_page();

		\Soulcms\Service::V()->assign([
			'list' => $list,
			'total' => $total,
			'param' => $param,
			'mypages'	=> \Soulcms\Service::L('input')->page(\Soulcms\Service::L('Router')->url(\Soulcms\Service::L('Router')->class.'/'.\Soulcms\Service::L('Router')->method), $total, 'admin')
		]);
		\Soulcms\Service::V()->display('notice_index.html');
	}

	// 待处理
	public function my_index() {

		list($list, $total, $param) = \Soulcms\Service::M()->init([
			'table' => 'admin_notice',
			'where_list' => '((`to_uid`='.$this->uid.') '.($this->admin['roleid'] ? ' or (`to_rid` IN ('.implode(',', $this->admin['roleid']).'))' : '').' or (`to_uid`=0 and `to_rid`=0)) and `status`<>3 and (site=0 or site='.SITE_ID.')',
			'field' => $this->field,
			'date_field' => 'inputtime',
			'order' => 'inputtime desc'
		])->limit_page();

		\Soulcms\Service::V()->assign([
			'list' => $list,
			'total' => $total,
			'param' => $param,
			'mypages'	=> \Soulcms\Service::L('input')->page(\Soulcms\Service::L('Router')->url(\Soulcms\Service::L('Router')->class.'/'.\Soulcms\Service::L('Router')->method), $total, 'admin')
		]);
		\Soulcms\Service::V()->display('notice_index.html');
	}

	// 全部
	public function all_index() {

		list($list, $total, $param) = \Soulcms\Service::M()->init([
			'table' => 'admin_notice',
			'field' => $this->field,
			'date_field' => 'inputtime',
			'where_list' =>  '(site=0 or site='.SITE_ID.')',
			'order' => 'inputtime desc'
		])->limit_page();

		\Soulcms\Service::V()->assign([
			'list' => $list,
			'total' => $total,
			'param' => $param,
			'mypages'	=> \Soulcms\Service::L('input')->page(\Soulcms\Service::L('Router')->url(\Soulcms\Service::L('Router')->class.'/'.\Soulcms\Service::L('Router')->method, $param), $total, 'admin')
		]);
		\Soulcms\Service::V()->display('notice_index.html');
	}



	public function del() {

		$ids = \Soulcms\Service::L('input')->get_post_ids();
		!$ids && $this->_json(0, mys_lang('所选数据不存在'));

        \Soulcms\Service::M()->db->table('admin_notice')->whereIn('id', $ids)->delete();

		$this->_json(1, mys_lang('操作成功'));
	}
	

}
