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



class Member_setting extends \Soulcms\Common
{

    public function index() {

        $page = intval(\Soulcms\Service::L('input')->get('page'));

        // 获取会员全部配置信息
        $data = [];
        $result = \Soulcms\Service::M()->db->table('member_setting')->get()->getResultArray();
        if ($result) {
            foreach ($result as $t) {
                $data[$t['name']] = mys_string2array($t['value']);
            }
        }

        if (IS_AJAX_POST) {
            $save = ['register', 'login', 'oauth', 'config'];
            $post = \Soulcms\Service::L('input')->post('data', true);
            foreach ($save as $name) {
                \Soulcms\Service::M()->db->table('member_setting')->replace([
                    'name' => $name,
                    'value' => mys_array2string($post[$name])
                ]);
            }
            \Soulcms\Service::M('cache')->sync_cache('member'); // 自动更新缓存
            $this->_json(1, mys_lang('操作成功'));
        }

        \Soulcms\Service::V()->assign([
            'data' => $data,
            'page' => $page,
            'form' => mys_form_hidden(['page' => $page]),
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '用户设置' => ['member_setting/index', 'fa fa-cog'],
                ]
            ),
            'group' => \Soulcms\Service::M()->table('member_group')->getAll(),
            'synurl' => \Soulcms\Service::M('member')->get_sso_url(),
        ]);
        \Soulcms\Service::V()->display('member_setting.html');
    }


}
