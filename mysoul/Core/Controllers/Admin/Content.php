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



class Content extends \Soulcms\Admin\Content
{

	public function index() {

        if (\Soulcms\Service::L('input')->get('p')) {
            \Soulcms\Service::V()->assign('menu', \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '数据结构' => ['db/index', 'fa fa-database'],
                    '执行SQL' => ['content/index{p=1}', 'fa fa-code'],
                ]
            ));
        }

        $bm = [];
        $tables = \Soulcms\Service::M()->db->query('show table status')->getResultArray();
        foreach ($tables as $t) {
            $t['Name'] = str_replace('_data_0', '_data_[tableid]', $t['Name']);
            $bm[$t['Name']] = $t;
        }

        $page = intval(\Soulcms\Service::L('input')->get('page'));
        \Soulcms\Service::V()->assign([
            'page' => $page,
            'form' =>  mys_form_hidden(['page' => $page]),
            'tables' => $bm,
            'sql_cache' => \Soulcms\Service::L('File')->get_sql_cache(),
        ]);
		\Soulcms\Service::V()->display('content_index.html');
	}

	public function field_index() {

	    $table = mys_safe_replace(\Soulcms\Service::L('input')->get('table'));
        $table = str_replace('_data_[tableid]', '_data_0', $table);
	    if (!$table) {
            $this->_json(0, mys_lang('表参数不能为空'));
        } elseif (!\Soulcms\Service::M()->db->tableExists($table)) {
            $this->_json(0, mys_lang('表[%s]不存在', $table));
        }

        $fields = \Soulcms\Service::M()->db->query('SHOW FULL COLUMNS FROM `'.$table.'`')->getResultArray();
	    if (!$fields) {
	        $this->_json(0, mys_lang('表[%s]没有可用字段', $table));
        }

        $msg = '<select name="fd" class="form-control">';
        foreach ($fields as $t) {
            if ($t['Field'] != 'id') {
                $msg.= '<option value="'.$t['Field'].'">'.$t['Field'].($t['Comment'] ? '（'.$t['Comment'].'）' : '').'</option>';
            }
        }
        $msg.= '</select>';

        $this->_json(1, $msg);
    }

	public function replace_index() {
		$this->_Replace();
	}

	public function sql_index() {
		$this->_Sql();
	}

}
