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



class Site_param extends \Soulcms\Common
{
	public function index() {

		if (IS_AJAX_POST) {
			$rt = \Soulcms\Service::M('Site')->config(
			    SITE_ID,
                'param',
                \Soulcms\Service::L('input')->post('data', true)
            );
            !is_array($rt) && $this->_json(0, mys_lang('网站信息(#%s)不存在', SITE_ID));
			\Soulcms\Service::L('input')->system_log('设置网站自定义参数');
            \Soulcms\Service::M('cache')->sync_cache('');
			exit($this->_json(1, mys_lang('操作成功')));
		}

		$page = intval(\Soulcms\Service::L('input')->get('page'));
		$data = \Soulcms\Service::M('Site')->config(SITE_ID);

		\Soulcms\Service::V()->assign([
			'page' => $page,
			'data' => $data['param'],
			'form' => mys_form_hidden(['page' => $page]),
			'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '网站参数' => ['site_param/index', 'fa fa-cog'],
                ]
            ),
		]);
		\Soulcms\Service::V()->display('site_param.html');
	}

	
}
