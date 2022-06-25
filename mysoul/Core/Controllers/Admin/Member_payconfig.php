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



class Member_payconfig extends \Soulcms\Common
{

    public function index() {

        $data = \Soulcms\Service::M()->db->table('member_setting')->where('name', 'pay')->get()->getRowArray();
        $data = mys_string2array($data['value']);

        if (IS_AJAX_POST) {
            $post = \Soulcms\Service::L('input')->post('data', true);
            \Soulcms\Service::M()->db->table('member_setting')->replace([
                'name' => 'pay',
                'value' => mys_array2string($post)
            ]);
            \Soulcms\Service::M('cache')->sync_cache('member'); // 自动更新缓存
            $this->_json(1, mys_lang('操作成功'));
        }

        $page = intval(\Soulcms\Service::L('input')->get('page'));

        \Soulcms\Service::V()->assign([
            'data' => $data,
            'page' => $page,
            'form' => mys_form_hidden(['page' => $page]),
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '支付设置' => ['member_payconfig/index', 'fa fa-cog'],
                    'help' => [625],
                ]
            )
        ]);
        \Soulcms\Service::V()->display('member_payconfig.html');
    }


}
