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



class Member_menu extends \Soulcms\Common
{
	private $form; // 表单验证配置

	public function __construct(...$params) {
		parent::__construct(...$params);
		\Soulcms\Service::V()->assign('menu', \Soulcms\Service::M('auth')->_admin_menu(
			[
				'用户中心菜单' => ['member_menu/index', 'fa fa-list-alt'],
				'初始化菜单' => ['ajax:member_menu/init', 'fa fa-refresh'],
                'help' => [381],
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

		// 用户组
		$group = $color = [];
		$data = \Soulcms\Service::M()->db->table('member_group')->orderBy('displayorder ASC,id ASC')->get()->getResultArray();
		if ($data) {
			foreach ($data as $i => $t) {
				$group[$t['id']] = $t;
			}
		}

		\Soulcms\Service::V()->assign([
			'data' => \Soulcms\Service::M('Menu')->gets('member'),
			'group' => $group,
			'color' => ['blue', 'red', 'green', 'dark', 'yellow'],
		]);
		\Soulcms\Service::V()->display('member_menu_list.html');
	}

	public function group_add() {

		$ids = \Soulcms\Service::L('input')->get_post_ids();
		!$ids && $this->_json(0, mys_lang('你还没有选择呢'));

		$gid = (int)\Soulcms\Service::L('input')->post('groupid');
		!$gid && $this->_json(0, mys_lang('你还没有选择用户组'));

		$data = \Soulcms\Service::M()->db->table('member_menu')->whereIN('id', $ids)->get()->getResultArray();
		!$data && $this->_json(0, mys_lang('无可用菜单'));

		foreach ($data as $t) {
			$value = mys_string2array($t['group']);
			$value[$gid] = $gid;
			\Soulcms\Service::M()->db->table('member_menu')->where('id', $t['id'])->update([
				'group' => mys_array2string($value)
			]);
		}

        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		$this->_json(1, mys_lang('划分成功'));
	}

	public function group_del() {

		$id = (int)\Soulcms\Service::L('input')->get('id');
		$data = \Soulcms\Service::M('Menu')->getRowData('member', $id);
		!$data && $this->_json(0, mys_lang('菜单不存在'));

		$gid = (int)\Soulcms\Service::L('input')->get('gid');
		!$gid && $this->_json(0, mys_lang('用户组id不存在'));

		$value = mys_string2array($data['group']);
		unset($value[$gid]);

		\Soulcms\Service::M()->db->table('member_menu')->where('id', $id)->update([
			'group' => mys_array2string($value)
		]);

        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		$this->_json(1, mys_lang('删除成功'));
	}

	public function site_add() {

		$ids = \Soulcms\Service::L('input')->get_post_ids();
		!$ids && $this->_json(0, mys_lang('你还没有选择呢'));

		$sid = (int)\Soulcms\Service::L('input')->post('siteid');
		!$sid && $this->_json(0, mys_lang('你还没有选择站点'));

		$data = \Soulcms\Service::M()->db->table('member_menu')->whereIN('id', $ids)->get()->getResultArray();
		!$data && $this->_json(0, mys_lang('无可用菜单'));

		foreach ($data as $t) {
			$value = mys_string2array($t['site']);
			$value[$sid] = $sid;
			\Soulcms\Service::M()->db->table('member_menu')->where('id', $t['id'])->update([
				'site' => mys_array2string($value)
			]);
		}

        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		$this->_json(1, mys_lang('划分成功'));
	}

	public function site_del() {

		$id = (int)\Soulcms\Service::L('input')->get('id');
		$data = \Soulcms\Service::M('Menu')->getRowData('member', $id);
		!$data && $this->_json(0, mys_lang('菜单不存在'));

        $sid = (int)\Soulcms\Service::L('input')->get('sid');
		!$sid && $this->_json(0, mys_lang('站点id不存在'));

		$value = mys_string2array($data['site']);
		unset($value[$sid]);

		\Soulcms\Service::M()->db->table('member_menu')->where('id', $id)->update([
			'site' => mys_array2string($value)
		]);

        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		$this->_json(1, mys_lang('删除成功'));
	}


	public function add() {

		$pid = intval(\Soulcms\Service::L('input')->get('pid'));
		$top = \Soulcms\Service::M('Menu')->get_top('member');

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data');
			$this->_validation($data);
			\Soulcms\Service::L('input')->system_log('添加用户中心菜单: '.$data['name']);
            if (\Soulcms\Service::M('Menu')->_add('member', $pid, $data)) {
                \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
                $this->_json(1, mys_lang('操作成功'));
            } else {
                $this->_json(0, mys_lang('操作失败'));
            }
		}

		\Soulcms\Service::V()->assign([
			'top' => $top,
			'type' => $pid,
			'form' => mys_form_hidden()
		]);
		\Soulcms\Service::V()->display('member_menu_add.html');
		exit;
	}

	public function edit() {

		$id = intval(\Soulcms\Service::L('input')->get('id'));
		$data = \Soulcms\Service::M('Menu')->getRowData('member', $id);
		!$data && $this->_json(0, mys_lang('数据#%s不存在', $id));

		$top = \Soulcms\Service::M('Menu')->get_top('member');

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data');
			$this->_validation($data);
			\Soulcms\Service::M('Menu')->_update('member', $id, $data);
			\Soulcms\Service::L('input')->system_log('修改用户中心菜单: '.$data['name']);

            \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
			exit($this->_json(1, mys_lang('操作成功')));
		}

		\Soulcms\Service::V()->assign([
			'top' => $top,
			'type' => $data['pid'],
			'data' => $data,
			'form' => mys_form_hidden(),
		]);
		\Soulcms\Service::V()->display('member_menu_add.html');
		exit;
	}

	public function del() {

		$ids = \Soulcms\Service::L('input')->get_post_ids();
		!$ids && exit($this->_json(0, mys_lang('你还没有选择呢')));

		\Soulcms\Service::M('Menu')->_delete('member', $ids);
        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		\Soulcms\Service::L('input')->system_log('批量删除用户中心菜单: '. @implode(',', $ids));
		exit($this->_json(1, mys_lang('操作成功'), ['ids' => $ids]));
	}


	// 初始化
	public function init() {

		\Soulcms\Service::M('Menu')->init('member');
		\Soulcms\Service::L('input')->system_log('初始化用户中心菜单');
		exit($this->_json(1, mys_lang('初始化菜单成功，请按F5刷新整个页面')));
	}

	// 隐藏或者启用
	public function use_edit() {

		$i = intval(\Soulcms\Service::L('input')->get('id'));
		$v = \Soulcms\Service::M('Menu')->_uesd('member', $i);
		$v == -1 && exit($this->_json(0, mys_lang('数据#%s不存在', $i), ['value' => $v]));
		\Soulcms\Service::L('input')->system_log('修改用户中心菜单状态: '. $i);
        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		exit($this->_json(1, mys_lang($v ? '此菜单已被隐藏' : '此菜单已被启用'), ['value' => $v]));

	}

	// 保存数据
	public function save_edit() {

		$i = intval(\Soulcms\Service::L('input')->get('id'));
		\Soulcms\Service::M('Menu')->_save(
			'member',
			$i,
			mys_safe_replace(\Soulcms\Service::L('input')->get('name')),
			mys_safe_replace(\Soulcms\Service::L('input')->get('value'))
		);

        \Soulcms\Service::M('cache')->sync_cache(''); // 自动更新缓存
		\Soulcms\Service::L('input')->system_log('修改用户中心菜单信息: '. $i);
		exit($this->_json(1, mys_lang('更改成功')));
	}


	// 验证数据
	private function _validation($data) {

		if ($data['type'] != 3) {
			// 非链接菜单时不录入url和uri
			unset($this->form['url'], $this->form['uri']);
		} else {
			// url和uri 只验证一个
			if ($data['url']) unset($this->form['uri']);
			if ($data['uri']) unset($this->form['url']);
		}
		list($data, $return) = \Soulcms\Service::L('form')->validation($data, $this->form);
		$return && exit($this->_json(0, $return['error'], ['field' => $return['name']]));

	}

}
