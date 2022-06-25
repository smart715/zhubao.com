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



class Member_payapi extends \Soulcms\Common
{

    public function index() {

        $data = \Soulcms\Service::M()->db->table('member_setting')->where('name', 'payapi')->get()->getRowArray();
        $data = mys_string2array($data['value']);

        if (IS_AJAX_POST) {
            $post = \Soulcms\Service::L('input')->post('data', true);
            \Soulcms\Service::M()->db->table('member_setting')->replace([
                'name' => 'payapi',
                'value' => mys_array2string($post)
            ]);
            \Soulcms\Service::M('cache')->sync_cache('member'); // 自动更新缓存
            $this->_json(1, mys_lang('操作成功'));
        }

        $pay = [];
        $local = mys_dir_map(ROOTPATH.'api/pay/', 1);
        foreach ($local as $dir) {
            $dir != 'finecms' && is_file(ROOTPATH.'api/pay/'.$dir.'/config.php') && $pay[$dir] = require ROOTPATH.'api/pay/'.$dir.'/config.php';
        }

        \Soulcms\Service::V()->assign([
            'pay' => $pay,
            'data' => $data,
            'form' => mys_form_hidden(),
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '支付接口' => ['member_payapi/index', 'fa fa-code'],
                    'help' => [387]
                ]
            ),
        ]);
        \Soulcms\Service::V()->display('member_payapi.html');
    }


}
