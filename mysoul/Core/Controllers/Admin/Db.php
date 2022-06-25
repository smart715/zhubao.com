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



class Db extends \Soulcms\Common
{

	public function __construct(...$params) {
		parent::__construct(...$params);
		\Soulcms\Service::V()->assign('menu', \Soulcms\Service::M('auth')->_admin_menu(
			[
				'数据结构' => ['db/index', 'fa fa-database'],
				'执行SQL' => ['content/index{p=1}', 'fa fa-code'],
			]
		));
	}

	public function index() {

	    $list = \Soulcms\Service::M()->db->query('show table status')->getResultArray();

		\Soulcms\Service::V()->assign([
			'list' => $list,
            'uriprefix' => 'db'
		]);
		\Soulcms\Service::V()->display('db_index.html');
	}

	public function check_index() {
        $table = mys_safe_replace(\Soulcms\Service::L('input')->get('id'));
        !$table && $this->_json(0, mys_lang('表错误'));
        $data = \Soulcms\Service::M()->db->query('CHECK TABLE `'.$table.'`')->getRowArray();
        !$data && $this->_json(0, mys_lang('表信息读取失败'));
        $this->_json(1, $data['Msg_text']);
    }

	public function show_index() {

	    $table = mys_safe_replace(\Soulcms\Service::L('input')->get('id'));
        $list = \Soulcms\Service::M()->db->query('SHOW FULL COLUMNS FROM `'.$table.'`')->getResultArray();

		\Soulcms\Service::V()->assign([
			'list' => $list,
			'table' => $table,
		]);
		\Soulcms\Service::V()->display('db_show.html');exit;
	}

	// 批量操作
	public function all() {

	    $at = \Soulcms\Service::L('input')->get('at');
        $ids = \Soulcms\Service::L('input')->get_post_ids();
        !$ids && $this->_json(0, mys_lang('没有选择表'));

        foreach ($ids as $table) {

            if (!$table) {
                continue;
            }

            switch ($at) {

                case 'x':
                    \Soulcms\Service::M()->db->query('REPAIR TABLE `'.$table.'`');
                    break;

                case 'y':
                    \Soulcms\Service::M()->db->query('OPTIMIZE TABLE `'.$table.'`');
                    break;

                case 's':
                    \Soulcms\Service::M()->db->query('FLUSH TABLE `'.$table.'`');
                    break;

            }

        }

        $this->_json(1, mys_lang('操作成功'));
    }

}
