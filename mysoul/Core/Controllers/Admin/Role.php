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



class Role extends \Soulcms\Common
{
	private $form; // 表单验证配置
	
	public function __construct(...$params) {
		parent::__construct(...$params);
		\Soulcms\Service::V()->assign('menu', \Soulcms\Service::M('auth')->_admin_menu(
			[
				'角色权限' => ['role/index', 'fa fa-users'],
				'添加' => ['add:role/add', 'fa fa-plus', '430px', '200px'],
				'权限划分' => ['hide:role/edit_auth', 'fa fa-user-md'],
			]
		));
		// 表单验证配置
		$this->form = [
			'name' => [
				'name' => '角色名称',
				'rule' => [
					'empty' => mys_lang('角色名称不能为空')
				],
				'filter' => [],
				'length' => '200'
			],
		];
	}

	public function index() {

		\Soulcms\Service::V()->assign([
			'data' => \Soulcms\Service::M('auth')->get_role_all(),
		]);
		\Soulcms\Service::V()->display('role_index.html');
	}
	
	
	public function add() {

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data');
			$this->_validation($data);
			\Soulcms\Service::L('input')->system_log('添加角色组('.$data['name'].')');
			if (\Soulcms\Service::M('auth')->add_role($data)) {
                \Soulcms\Service::M('cache')->sync_cache('auth');
			    exit($this->_json(1, mys_lang('操作成功')));
            } else {
			    exit($this->_json(0, mys_lang('操作失败')));
            }
		}

		\Soulcms\Service::V()->assign([
			'form' => mys_form_hidden()
		]);
		\Soulcms\Service::V()->display('role_add.html');
		exit;
	}

	public function edit() {

		$id = intval(\Soulcms\Service::L('input')->get('id'));
		$data = \Soulcms\Service::M('auth')->get_role($id);
		!$data && exit($this->_json(0, mys_lang('数据#%s不存在', $id)));

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data');
			$this->_validation($data);
			\Soulcms\Service::M('auth')->update_role($id, $data);
            \Soulcms\Service::M('cache')->sync_cache('auth');
			\Soulcms\Service::L('input')->system_log('修改角色组('.$data['name'].')');
			exit($this->_json(1, mys_lang('操作成功')));
		}

		\Soulcms\Service::V()->assign([
			'data' => $data,
			'form' => mys_form_hidden(),
		]);
		\Soulcms\Service::V()->display('role_add.html');
		exit;
	}

	public function edit_auth() {

		$id = intval(\Soulcms\Service::L('input')->get('id'));
		$data = \Soulcms\Service::M('auth')->get_role($id);
		!$data && $this->_admin_msg(0, mys_lang('角色组（%s）不存在', $id));
		
		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data');
			$module = \Soulcms\Service::L('input')->post('module');
			\Soulcms\Service::M('auth')->table('admin_role')->update($id, [
			    'system' => mys_array2string($data),
			    'module' => mys_array2string($module),
            ]);
            \Soulcms\Service::M('cache')->sync_cache('auth');
			\Soulcms\Service::L('input')->system_log('设置角色组('.$data['name'].')权限');
			exit($this->_json(1, mys_lang('操作成功')));
		}
		//print_r($data);
		#print_r($this->_M('Menu')->gets('admin'));

		$page = intval(\Soulcms\Service::L('input')->get('page'));
        $module = \Soulcms\Service::M()->db->table('module')->get()->getResultArray();
        $module_auth = [];
        if ($module) {
            foreach ($module as $t) {
                $mdir = $t['dirname'];
                if (!is_file(APPSPATH.ucfirst($mdir).'/Config/App.php')) {
                    continue;
                }
                $config = require APPSPATH.ucfirst($mdir).'/Config/App.php';
                $module_auth[$mdir] = [
                    'name' => mys_lang($config['name']),
                    'auth' => [
                        $mdir.'/comment/' => mys_lang('评论'),
                    ],
                ];
                if ($config['system']) {
                    // 内容模块
                    $module_auth[$mdir]['auth'][$mdir.'/draft/'] = mys_lang('草稿箱');
                    $module_auth[$mdir]['auth'][$mdir.'/recycle/'] = mys_lang('回收站');
                    $module_auth[$mdir]['auth'][$mdir.'/time/'] = mys_lang('定时发布');
                } else {
                    // 自定义模块
                }
                $mform = \Soulcms\Service::M()->db->table('module_form')->where('module', $mdir)->get()->getResultArray();
                if ($mform) {
                    foreach ($mform as $c) {
                        $module_auth[$mdir]['auth'][$mdir.'/'.$c['table'].'/'] = mys_lang($c['name']);
                    }
                }
            }
        }

		\Soulcms\Service::V()->assign([
			'data' => $data,
			'page' => $page,
			'form' => mys_form_hidden(['page' => $page]),
			'menu_data' => \Soulcms\Service::M('Menu')->gets('admin'),
			'module_auth' => $module_auth,
		]);
		\Soulcms\Service::V()->display('role_auth.html');
	}
	
	public function edit_site() {

		$id = intval(\Soulcms\Service::L('input')->get('id'));
		$data = \Soulcms\Service::M('auth')->get_role($id);
		!$data && $this->_admin_msg(0, mys_lang('角色组（%s）不存在', $id));
		
		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data');
			\Soulcms\Service::M('auth')->table('admin_role')->update($id, ['site' => mys_array2string($data)]);
            \Soulcms\Service::M('cache')->sync_cache('auth');
			\Soulcms\Service::L('input')->system_log('设置角色组('.$data['name'].')站点权限');
			exit($this->_json(1, mys_lang('操作成功')));
		}

		\Soulcms\Service::V()->assign([
			'data' => $data,
			'form' => mys_form_hidden(),
		]);
		\Soulcms\Service::V()->display('role_site.html');exit;
	}

	public function del() {

		$ids = \Soulcms\Service::L('input')->get_post_ids();
		!$ids && exit($this->_json(0, mys_lang('你还没有选择呢')));
		in_array(1, $ids) && exit($this->_json(0, mys_lang('超级管理员角色组不能删除')));

		\Soulcms\Service::M('auth')->delete_role($ids);
        \Soulcms\Service::M('cache')->sync_cache('auth');
		\Soulcms\Service::L('input')->system_log('批量删除角色组: '. @implode(',', $ids));

		exit($this->_json(1, mys_lang('操作成功'), ['ids' => $ids]));
	}
	
	// 验证数据
	private function _validation($data) {

		list($data, $return) = \Soulcms\Service::L('Form')->validation($data, $this->form);
		$return && exit($this->_json(0, $return['error'], ['field' => $return['name']]));

	}

}
