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



class Site_config extends \Soulcms\Common
{
	public function index() {

        $data = \Soulcms\Service::M('Site')->config(SITE_ID);
        $field = [
            'logo' => [
                'ismain' => 1,
                'fieldtype' => 'File',
                'fieldname' => 'logo',
                'setting' => ['option' => ['ext' => 'jpg,gif,png,jpeg', 'size' => 10, 'input' => 1]]
            ]
        ];

		if (IS_AJAX_POST) {

		    $tj = $_POST['data']['SITE_TONGJI'];
            $post = \Soulcms\Service::L('input')->post('data', true);
            $post['SITE_TONGJI'] = $tj;
            if ($_POST['theme']) {
                // 远程资源
                $post['SITE_THEME'] = $post['SITE_THEME2'];
            } else {
                // 本地资源
            }

            $rt = \Soulcms\Service::M('Site')->config(SITE_ID, 'config', $post);
			!is_array($rt) && $this->_json(0, mys_lang('网站信息(#%s)不存在', SITE_ID));

			\Soulcms\Service::L('input')->system_log('设置网站参数');

            // 附件归档
            if (SYS_ATTACHMENT_DB) {
                list($post, $return, $attach) = \Soulcms\Service::L('form')->validation($post, null, $field);
                $attach && \Soulcms\Service::M('Attachment')->handle($this->member['id'], \Soulcms\Service::M()->dbprefix('site'), $attach);
            }

            \Soulcms\Service::M('cache')->sync_cache('');
            $this->_json(1, mys_lang('操作成功'));
		}

		$page = intval(\Soulcms\Service::L('input')->get('page'));

		\Soulcms\Service::V()->assign([
			'page' => $page,
			'data' => $data['config'],
			'form' => mys_form_hidden(['page' => $page]),
			'lang' => mys_dir_map(ROOTPATH.'config/language/', 1),
			'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '网站设置' => ['site_config/index', 'fa fa-cog'],
                    'help' => [505],
                ]
            ),
			'theme' => mys_get_theme(),
			'is_theme' => strpos($data['config']['SITE_THEME'], '/') !== false ? 1 : 0,
            'logofield' => mys_fieldform($field['logo'], $data['config']['logo']),
			'template_path' => mys_dir_map(TPLPATH.'pc/', 1),
		]);
		\Soulcms\Service::V()->display('site_config.html');
	}

}
