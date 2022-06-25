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



class Form extends \Soulcms\Common
{

	private $form; // 表单验证配置

	public function __construct(...$params) {
		parent::__construct(...$params);
		\Soulcms\Service::V()->assign('menu', \Soulcms\Service::M('auth')->_admin_menu(
			[
				'网站表单' => ['form/index', 'fa fa-table'],
				'添加' => ['add:form/add', 'fa fa-plus', '500px', '310px'],
				'导入' => ['add:form/import_add', 'fa fa-sign-in', '60%', '70%'],
				'重建表单' => ['ajax:form/init_index', 'fa fa-refresh'],
				'修改' => ['hide:form/edit', 'fa fa-edit'],
                'help' => [54],
			]
		));
		// 表单验证配置
		$this->form = [
			'name' => [
				'name' => '表单名称',
				'rule' => [
					'empty' => mys_lang('表单名称不能为空')
				],
				'filter' => [],
				'length' => '200'
			],
			'table' => [
				'name' => '数据表名称',
				'rule' => [
					'empty' => mys_lang('数据表名称不能为空'),
					'table' => mys_lang('数据表名称格式不正确'),
				],
				'filter' => [],
				'length' => '200'
			],
		];
	}

	public function index() {

		\Soulcms\Service::V()->assign([
			'list' => \Soulcms\Service::M('Form')->getAll(),
		]);
		\Soulcms\Service::V()->display('form_list.html');
	}

	public function init_index() {

		$data = \Soulcms\Service::M('Form')->getAll();
		!$data && $this->_json(0, mys_lang('没有任何可用表单'));

		$ok = 0;
		foreach ($data as $t) {
            $cg = mys_string2array($t['setting']);
            if ($cg['dev']) {
                continue;
            }
			$rt = \Soulcms\Service::M('Form')->create_file($t['table'], 1);
			!$rt['code'] && $this->_json(0, $rt['msg']);
			$ok+= (int)$rt['msg'];
		}

		$this->_json(1, mys_lang('重建表单（%s）个', $ok));
	}


	public function add() {

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data', true);
			$this->_validation(0, $data);
			\Soulcms\Service::L('input')->system_log('创建网站表单('.$data['name'].')');
			$rt = \Soulcms\Service::M('Form')->create($data);
			!$rt['code'] && $this->_json(0, $rt['msg']);
            \Soulcms\Service::M('cache')->sync_cache('form', '', 1); // 自动更新缓存
			exit($this->_json(1, mys_lang('操作成功，请刷新后台页面')));
		}

		\Soulcms\Service::V()->assign([
			'form' => mys_form_hidden()
		]);
		\Soulcms\Service::V()->display('form_add.html');
		exit;
	}

	public function edit() {

		$id = intval(\Soulcms\Service::L('input')->get('id'));
		$data = \Soulcms\Service::M('Form')->get($id);
		!$data && $this->_admin_msg(0, mys_lang('网站表单（%s）不存在', $id));
		$data['setting'] = mys_string2array($data['setting']);
		!$data['setting']['list_field'] && $data['setting']['list_field'] = [
			'title' => [
				'use' => 1,
				'name' => mys_lang('主题'),
				'func' => 'title',
				'width' => 0,
				'order' => 1,
			],
			'author' => [
				'use' => 1,
				'name' => mys_lang('作者'),
				'func' => 'author',
				'width' => 100,
				'order' => 2,
			],
			'inputtime' => [
				'use' => 1,
				'name' => mys_lang('录入时间'),
				'func' => 'datetime',
				'width' => 160,
				'order' => 3,
			],
		];

		if (IS_AJAX_POST) {
			$data = \Soulcms\Service::L('input')->post('data', true);
			\Soulcms\Service::M('Form')->update($id,
				[
					'name' => $data['name'],
					'setting' => mys_array2string($data['setting'])
				]
			);
            \Soulcms\Service::M('cache')->sync_cache('form', '', 1); // 自动更新缓存
			\Soulcms\Service::L('input')->system_log('修改网站表单('.$data['name'].')配置');
			exit($this->_json(1, mys_lang('操作成功')));
		}

		// 主表字段
		$field = \Soulcms\Service::M()->db->table('field')
						->where('disabled', 0)
						->where('ismain', 1)
						->where('relatedname', 'form-'.SITE_ID)
						->where('relatedid', $id)
						->orderBy('displayorder ASC,id ASC')
						->get()->getResultArray();
		$sys_field = \Soulcms\Service::L('field')->sys_field(['id', 'author', 'inputtime']);
		sort($sys_field);
        $page = intval(\Soulcms\Service::L('input')->get('page'));

		\Soulcms\Service::V()->assign([
			'data' => $data,
			'page' => $page,
			'form' => mys_form_hidden(['page' => $page]),
			'field' => mys_array2array($sys_field, $field),
            'diy_tpl' => is_file(APPSPATH.'Form/Views/diy_'.$data['table'].'.html') ? APPSPATH.'Form/Views/diy_'.$data['table'].'.html' : '',
		]);
		\Soulcms\Service::V()->display('form_edit.html');
	}

	public function del() {

		$ids = \Soulcms\Service::L('input')->get_post_ids();
		!$ids && exit($this->_json(0, mys_lang('你还没有选择呢')));

		$rt = \Soulcms\Service::M('Form')->delete_form($ids);
		!$rt['code'] && exit($this->_json(0, $rt['msg']));

        \Soulcms\Service::M('cache')->sync_cache('form', '', 1); // 自动更新缓存
		\Soulcms\Service::L('input')->system_log('批量删除网站表单: '. @implode(',', $ids));

		exit($this->_json(1, mys_lang('操作成功'), ['ids' => $ids]));
	}

	// 验证数据
	private function _validation($id, $data) {

		list($data, $return) = \Soulcms\Service::L('form')->validation($data, $this->form);
		$return && exit($this->_json(0, $return['error'], ['field' => $return['name']]));
		\Soulcms\Service::M('Form')->table('form')->is_exists($id, 'table', $data['table']) && exit($this->_json(0, mys_lang('数据表名称已经存在'), ['field' => 'table']));
	}

	// 导出
    public function export() {

        $id = intval(\Soulcms\Service::L('input')->get('id'));
        $data = \Soulcms\Service::M('Form')->get($id);
        !$data && $this->_admin_msg(0, mys_lang('网站表单（%s）不存在', $id));

        // 字段
        $data['field'] = \Soulcms\Service::M()->db->table('field')->where('relatedname', 'form-'.SITE_ID)->where('relatedid', $id)->orderBy('displayorder ASC,id ASC')->get()->getResultArray();

        $data['setting'] = mys_string2array($data['setting']);

        // 数据结构
        $data['sql'] = '';

        $table = \Soulcms\Service::M()->dbprefix(SITE_ID.'_form_'.$data['table']);
        $sql = \Soulcms\Service::M()->db->query("SHOW CREATE TABLE `".$table."`")->getRowArray();
        $sql = 'DROP TABLE IF EXISTS `'.$table.'`;'.PHP_EOL.str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $sql['Create Table']).';';
        $data['sql'].= str_replace($table, '{table}', $sql).PHP_EOL;

        $table = \Soulcms\Service::M()->dbprefix(SITE_ID.'_form_'.$data['table'].'_data_0');
        $sql = \Soulcms\Service::M()->db->query("SHOW CREATE TABLE `".$table."`")->getRowArray();
        $sql = 'DROP TABLE IF EXISTS `'.$table.'`;'.PHP_EOL.str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $sql['Create Table']).';';
        $data['sql'].= str_replace($table, '{table}_data_0', $sql).PHP_EOL;

        \Soulcms\Service::V()->assign([
            'data' => mys_array2string($data),
        ]);
        \Soulcms\Service::V()->display('form_export.html');exit;
    }

    // 导入
    public function import_add() {

        if (IS_AJAX_POST) {
            $data = \Soulcms\Service::L('input')->post('code', true);
            $data = mys_string2array($data);
            if (!is_array($data)) {
                $this->_json(0, mys_lang('导入信息验证失败'));
            } elseif (!$data['table']) {
                $this->_json(0, mys_lang('导入信息不完整'));
            } elseif (!$data['field']) {
                $this->_json(0, mys_lang('字段信息不完整'));
            } elseif (!$data['sql']) {
                $this->_json(0, mys_lang('数据结构不完整'));
            }
            $rt = \Soulcms\Service::M('Form')->import($data);
            !$rt['code'] && $this->_json(0, $rt['msg']);
            \Soulcms\Service::M('cache')->sync_cache('form', '', 1); // 自动更新缓存
            \Soulcms\Service::L('input')->system_log('导入网站表单('.$data['name'].')');
            exit($this->_json(1, mys_lang('操作成功')));
        }

        \Soulcms\Service::V()->assign([
            'form' => mys_form_hidden()
        ]);
        \Soulcms\Service::V()->display('form_import.html');
        exit;
    }

}
