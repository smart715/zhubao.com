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



class Menu extends \Soulcms\Common
{
	private $form; // 表单验证配置
	
	public function __construct(...$params) {
		parent::__construct(...$params);
		\Soulcms\Service::V()->assign('menu', \Soulcms\Service::M('auth')->_admin_menu(
			[
				'后台菜单' => ['menu/index', 'fa fa-list-alt'],
				'初始化菜单' => ['ajax:menu/init', 'fa fa-refresh'],
			]
		));
		// 表单验证配置
		$this->form = [
			'name' => [
				'name' => '菜单名称',
				'rule' => [
					'empty' => mys_lang('菜单名称不能为空')
				],
				'filter' => [],
				'length' => '200'
			],
			'icon' => [
				'name' => '菜单图标',
				'rule' => [
					'empty' => mys_lang('菜单图标不能为空')
				],
				'filter' => [],
				'length' => '30'
			],
			'uri' => [
				'name' => '系统路径',
				'rule' => [
					'empty' => mys_lang('系统路径不能为空')
				],
				'filter' => [],
				'length' => '200'
			],
			'url' => [
				'name' => '实际地址',
				'rule' => [
					'empty' => mys_lang('实际地址不能为空')
				],
				'filter' => [
					'url'
				],
				'length' => '200'
			],
		];
	}

	public function index() {

		\Soulcms\Service::V()->assign([
			'data' => \Soulcms\Service::M('Menu')->gets('admin'),
		]);
		\Soulcms\Service::V()->display('menu_index.html');
	}
	
	
	public function add() {

		$pid = intval(\Soulcms\Service::L('input')->get('pid'));
		$top = \Soulcms\Service::M('Menu')->get_top('admin');
		$type = $pid ? (isset($top[$pid]) ? 2 : 3) : 1;

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data');
			$this->_validation($type, $data);
            \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
			\Soulcms\Service::L('input')->system_log('添加后台菜单: '.$data['name']);
			\Soulcms\Service::M('Menu')->_add('admin', $pid, $data) ? exit($this->_json(1, mys_lang('操作成功'))) : exit($this->_json(0, mys_lang('操作失败')));
		}

		\Soulcms\Service::V()->assign([
			'type' => $type,
			'form' => mys_form_hidden()
		]);
		\Soulcms\Service::V()->display('menu_add.html');
		exit;
	}

	public function edit() {

		$id = intval(\Soulcms\Service::L('input')->get('id'));
		$data = \Soulcms\Service::M('Menu')->getRowData('admin', $id);
		!$data && exit($this->_json(0, mys_lang('数据#%s不存在', $id)));

		$pid = intval($data['pid']);
		$top = \Soulcms\Service::M('Menu')->get_top('admin');
		$type = $pid ? (isset($top[$pid]) ? 2 : 3) : 1;

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data');
			$this->_validation($type, $data);
			\Soulcms\Service::M('Menu')->_update('admin', $id, $data);
            \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
			\Soulcms\Service::L('input')->system_log('修改后台菜单: '.$data['name']);
			exit($this->_json(1, mys_lang('操作成功')));
		}

		\Soulcms\Service::V()->assign([
			'type' => $type,
			'data' => $data,
			'form' => mys_form_hidden(),
			'select' => \Soulcms\Service::M('Menu')->parent_select('admin', $type, $pid)
		]);
		\Soulcms\Service::V()->display('menu_add.html');
		exit;
	}

	public function del() {

		$ids = \Soulcms\Service::L('input')->get_post_ids();
		!$ids && exit($this->_json(0, mys_lang('你还没有选择呢')));

		\Soulcms\Service::M('Menu')->_delete('admin', $ids);
        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		\Soulcms\Service::L('input')->system_log('批量删除后台菜单: '. @implode(',', $ids));
		exit($this->_json(1, mys_lang('操作成功'), ['ids' => $ids]));
	}
	

	// 初始化
	public function init() {

		\Soulcms\Service::M('Menu')->init('admin');

		\Soulcms\Service::L('input')->system_log('初始化后台菜单');
        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		exit($this->_json(1, mys_lang('初始化菜单成功，请按F5刷新整个页面')));
	}

	// 隐藏或者启用
	public function use_edit() {

		$i = intval(\Soulcms\Service::L('input')->get('id'));
		$v = \Soulcms\Service::M('Menu')->_uesd('admin', $i);
		$v == -1 && exit($this->_json(0, mys_lang('数据#%s不存在', $i), ['value' => $v]));
        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		\Soulcms\Service::L('input')->system_log('修改后台菜单状态: '. $i);
		exit($this->_json(1, mys_lang($v ? '此菜单已被隐藏' : '此菜单已被启用'), ['value' => $v]));

	}

	// 保存数据
	public function save_edit() {

		$i = intval(\Soulcms\Service::L('input')->get('id'));
		\Soulcms\Service::M('Menu')->_save(
			'admin',
			$i,
			mys_safe_replace(\Soulcms\Service::L('input')->get('name')),
			mys_safe_replace(\Soulcms\Service::L('input')->get('value'))
		);

        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		\Soulcms\Service::L('input')->system_log('修改后台菜单信息: '. $i);
		exit($this->_json(1, mys_lang('更改成功')));
	}


	// 验证数据
	private function _validation($type, $data) {

		if ($type != 3) {
			// 非链接菜单时不录入url和uri
			unset($this->form['url'], $this->form['uri']);
		} else {
			// url和uri 只验证一个
			if ($data['url']) unset($this->form['uri']);
			if ($data['uri']) unset($this->form['url']);
		}

		//$type是菜单级别 1 2 3
        if (in_array($type, [2, 1])) {
            !$data['mark'] && $this->_json(0, mys_lang('标识字符不能为空'), ['field' => 'mark']);
        }

		list($data, $return) = \Soulcms\Service::L('form')->validation($data, $this->form);

        $return && exit($this->_json(0, $return['error'], ['field' => $return['name']]));
	}

}
