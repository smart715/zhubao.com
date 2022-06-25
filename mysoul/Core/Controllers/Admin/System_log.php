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



class System_log extends \Soulcms\Common
{
	public function index() {


		$time = (int)strtotime(\Soulcms\Service::L('input')->get('time'));
		!$time && $time = SYS_TIME;
		
		$file = WRITEPATH.'log/'.date('Ym', $time).'/'.date('d', $time).'.php';

		$list = [];
		$data = @explode(PHP_EOL, str_replace(array(chr(13), chr(10)), PHP_EOL, file_get_contents($file)));
		$data = @array_reverse($data);

		$page = max(1, (int)\Soulcms\Service::L('input')->get('page'));
        $total = max(0, mys_count($data) - 1);
		$limit = ($page - 1) * SYS_ADMIN_PAGESIZE;

		$i = $j = 0;

		foreach ($data as $v) {
			if ($v && $i >= $limit && $j < SYS_ADMIN_PAGESIZE) {
				$list[] = mys_string2array($v);
				$j ++;
			}
			$i ++;
		}

		$time = date('Y-m-d', $time);

		\Soulcms\Service::V()->assign(array(
			'list' => $list,
			'time' => $time,
			'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '操作日志' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-calendar'],
                ]
            ),
			'total' => $total,
			'mypages'	=> \Soulcms\Service::L('input')->page(\Soulcms\Service::L('Router')->url('system_log/index', ['time' => $time]), $total, 'admin')
		));
		\Soulcms\Service::V()->display('system_log.html');
	}
	

}
