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


class Email extends \Soulcms\Common
{
	private $form; // 表单验证配置
	
	public function __construct(...$params) {
		parent::__construct(...$params);
		\Soulcms\Service::V()->assign('menu', \Soulcms\Service::M('auth')->_admin_menu(
			[
				'SMTP服务器' => ['email/index', 'fa fa-envelope'],
				'添加' => ['add:email/add', 'fa fa-plus'],
                //'help' => [361],
			]
		));
		// 表单验证配置
		$this->form = [
			'host' => [
				'name' => '服务器',
				'rule' => [
					'empty' => mys_lang('服务器不能为空')
				],
				'filter' => [],
				'length' => '200'
			],
			'port' => [
				'name' => '端口号',
				'rule' => [
					'empty' => mys_lang('端口号不能为空')
				],
				'filter' => ['intval'],
				'length' => '30'
			],
			'user' => [
				'name' => '邮箱账号',
				'rule' => [
					'empty' => mys_lang('邮箱账号不能为空')
				],
				'filter' => [],
				'length' => '200'
			],
			'pass' => [
				'name' => '邮箱密码',
				'rule' => [
					'empty' => mys_lang('邮箱密码不能为空')
				],
				'filter' => [],
				'length' => '200'
			],
		];
		
	}

	public function index() {

		\Soulcms\Service::V()->assign([
			'list' => \Soulcms\Service::M()->table('mail_smtp')->getAll(),
		]);
		\Soulcms\Service::V()->display('email_index.html');
	}

	public function add() {

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data', true);
			$this->_validation($data);
			\Soulcms\Service::L('input')->system_log('添加SMTP服务器: '.$data['name']);
			$data['displayorder'] = intval($data['displayorder']);
			\Soulcms\Service::M()->table('mail_smtp')->insert($data);
            // 自动更新缓存
            \Soulcms\Service::M('cache')->sync_cache('email');
			exit($this->_json(1, mys_lang('操作成功')));
		}

		\Soulcms\Service::V()->assign([
			'form' => mys_form_hidden()
		]);
		\Soulcms\Service::V()->display('email_add.html');
		exit;
	}


	public function edit() {

		$id = intval(\Soulcms\Service::L('input')->get('id'));
		$data = \Soulcms\Service::M()->table('mail_smtp')->get($id);
		!$data && exit($this->_json(0, mys_lang('数据#%s不存在', $id)));

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data', true);
			$this->_validation($data);
			\Soulcms\Service::M()->table('mail_smtp')->update($id, $data);
			\Soulcms\Service::L('input')->system_log('修改SMTP服务器: '.$data['name']);

            \Soulcms\Service::M('cache')->sync_cache('email'); // 自动更新缓存
			exit($this->_json(1, mys_lang('操作成功')));
		}

		\Soulcms\Service::V()->assign([
			'data' => $data,
			'form' => mys_form_hidden(),
		]);
		\Soulcms\Service::V()->display('email_add.html');
		exit;
	}

	// 保存数据
	public function save_edit() {

		$i = intval(\Soulcms\Service::L('input')->get('id'));
		\Soulcms\Service::M()->table('mail_smtp')->save(
			$i,
			mys_safe_replace(\Soulcms\Service::L('input')->get('name')),
			mys_safe_replace(\Soulcms\Service::L('input')->get('value'))
		);

		\Soulcms\Service::L('input')->system_log('修改SMTP服务器排序值: '. $i);
        \Soulcms\Service::M('cache')->sync_cache('email'); // 自动更新缓存
		exit($this->_json(1, mys_lang('更改成功')));
	}

	public function del() {

		$ids = \Soulcms\Service::L('input')->get_post_ids();
		!$ids && exit($this->_json(0, mys_lang('你还没有选择呢')));

		\Soulcms\Service::M()->table('mail_smtp')->deleteAll($ids);
        \Soulcms\Service::M('cache')->sync_cache('email'); // 自动更新缓存
		\Soulcms\Service::L('input')->system_log('批量删除SMTP服务器: '. @implode(',', $ids));
		exit($this->_json(1, mys_lang('操作成功'), ['ids' => $ids]));
	}


	// 验证数据
	private function _validation($data) {

		list($data, $return) = \Soulcms\Service::L('Form')->validation($data, $this->form);
		$return && exit($this->_json(0, $return['error'], ['field' => $return['name']]));

	}
}
