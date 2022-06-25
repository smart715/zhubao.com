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



class System extends \Soulcms\Common
{
	public function index() {

        if (is_file(WRITEPATH.'config/system.php')) {
            $data = require WRITEPATH.'config/system.php'; // 加载网站系统配置文件
        } else {
            $data = [];
        }

		if (IS_AJAX_POST) {
		    $post = \Soulcms\Service::L('input')->post('data', true);
            $save = [
                'SYS_DEBUG' => (int)$post['SYS_DEBUG'],
                'SYS_THEME_ROOT' => (int)$post['SYS_THEME_ROOT'],
                'SYS_AUTO_FORM' => (int)$post['SYS_AUTO_FORM'],

                'SYS_CAT_RNAME' => (int)$post['SYS_CAT_RNAME'],
                'SYS_PAGE_RNAME' => (int)$post['SYS_PAGE_RNAME'],

                'SYS_EMAIL' => $post['SYS_EMAIL'],
                'SYS_ADMIN_LOG' => intval($post['SYS_ADMIN_LOG']),
                'SYS_ADMIN_CODE' => intval($post['SYS_ADMIN_CODE']),
                'SYS_ADMIN_LOGINS' => intval($post['SYS_ADMIN_LOGINS']),
                'SYS_ADMIN_LOGIN_TIME' => intval($post['SYS_ADMIN_LOGIN_TIME']),
                'SYS_ADMIN_PAGESIZE' => intval($post['SYS_ADMIN_PAGESIZE']),

                'SYS_KEY' => $post['SYS_KEY'] == '***' ? $data['SYS_KEY'] : $post['SYS_KEY'],
                'SYS_HTTPS' => (int)$post['SYS_HTTPS'],
                'SYS_CSRF' => (int)$post['SYS_CSRF'],
                'SYS_BDMAP_API' => $post['SYS_BDMAP_API'],
            ];
            foreach ($data as $name => $value) {
                strpos($name, 'SYS_CACHE') === 0 && $save[$name] = intval($post[$name]);
            }
			\Soulcms\Service::M('System')->save_config($data, $save);
			\Soulcms\Service::L('input')->system_log('设置系统配置参数');
			exit($this->_json(1, mys_lang('操作成功')));
		}

		$page = (int)\Soulcms\Service::L('input')->get('page');
		\Soulcms\Service::V()->assign([
			'data' => $data,
			'page' => $page,
			'form' => mys_form_hidden(['page' => $page]),
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '系统参数' => ['system/index', 'fa fa-cog'],
                    'help' => [503],
                ]
            ),
            'config' => \Soulcms\Service::M('System')->config,
		]);
		\Soulcms\Service::V()->display('system_index.html');
	}

}
