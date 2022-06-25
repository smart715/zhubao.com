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



class Sms_log extends \Soulcms\Common
{
	
	public function __construct(...$params) {
		parent::__construct(...$params);
		\Soulcms\Service::V()->assign('menu', \Soulcms\Service::M('auth')->_admin_menu(
			[
				'短信记录' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-envelope'],
			]
		));
	}

	
	
	public function index() {

		$data = $list = [];
		$file = file_get_contents(WRITEPATH.'sms_log.php');
		if ($file) {
			$data = explode(PHP_EOL, str_replace(array(chr(13), chr(10)), PHP_EOL, $file));
			$data = $data ? array_reverse($data) : [];
			unset($data[0]);
			$page = max(1, (int)\Soulcms\Service::L('input')->get('page'));
			$limit = ($page - 1) * SYS_ADMIN_PAGESIZE;
			$i = $j = 0;
			foreach ($data as $v) {
				if ($i >= $limit && $j < SYS_ADMIN_PAGESIZE) {
					$list[] = $v;
					$j ++;
				}
				$i ++;
			}
		}

        $total = max(0, mys_count($data) - 1);
		
		\Soulcms\Service::V()->assign(array(
			'list' => $list,
			'total' => $total,
			'mypages'	=> \Soulcms\Service::L('input')->page(\Soulcms\Service::L('Router')->url('sms_log/lindex'), $total, 'admin')
		));
		\Soulcms\Service::V()->display('sms_log.html');
	}

	public function del() {



		@unlink(WRITEPATH.'sms_log.php');

		exit($this->_json(1, mys_lang('操作成功')));
	}
	

}
