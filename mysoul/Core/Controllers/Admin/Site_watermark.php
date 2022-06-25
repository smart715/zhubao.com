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



class Site_watermark extends \Soulcms\Common
{

	public function index() {

        if (IS_AJAX_POST) {
            \Soulcms\Service::M('Site')->config(
                SITE_ID,
                'watermark',
                \Soulcms\Service::L('input')->post('data', true)
            );
            \Soulcms\Service::M('cache')->sync_cache('');
            \Soulcms\Service::L('input')->system_log('设置网站图片水印参数');
            $this->_json(1, mys_lang('操作成功'));
        }

        $page = intval(\Soulcms\Service::L('input')->get('page'));
        $data = \Soulcms\Service::M('Site')->config(SITE_ID);

        $locate = [

            'left-top' => '左上',
            'center-top' => '中上',
            'right-top' => '右上',

            'left-middle' => '左中',
            'center-middle' => '正中',
            'right-middle' => '右中',

            'left-bottom' => '左下',
            'center-bottom' => '中下',
            'right-bottom' => '右下',

        ];

        \Soulcms\Service::V()->assign([
            'page' => $page,
            'data' => $data['watermark'],
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '图片水印' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-photo'],
                    'help' => [507],
                ]
            ),
            'form' => mys_form_hidden(['page' => $page]),
            'locate' => $locate,
            'waterfont' => mys_file_map(WEBPATH.'config/font/', 1),
            'waterfile' => mys_file_map(WEBPATH.'config/watermark/', 1),
        ]);
        \Soulcms\Service::V()->display('site_watermark.html');
	}

	
}
