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



class Member_setting_notice extends \Soulcms\Common
{

    public function index() {

        $local = mys_dir_map(mys_get_app_list(), 1);
        $notice['member'] = [
            'value' => require CMSPATH.'Config/Notice.php',
        ];

        if (is_file(MYPATH.'Config/Notice.php')) {
            $notice['my'] = [
                'value' => require MYPATH.'Config/Notice.php',
            ];
        }

        foreach ($local as $dir) {
            $path = mys_get_app_dir($dir);
            if (is_file($path.'/Config/Notice.php')
                && is_file($path.'/Config/App.php')) {
                $app = require $path.'/Config/App.php';
                $cfg = require $path.'/Config/Notice.php';
                $app && $cfg && $notice[strtolower($dir)] = [
                    'name' => $app['name'],
                    'value' => $cfg
                ];
            }
        }

        foreach ($notice as $i => $t) {
            if ($t['value']) {
                foreach ($t['value'] as $ii => $v) {
                    $path = \Soulcms\Service::L('html')->get_webpath(SITE_ID, 'site', '');
                    $notice[$i]['value'][$ii] = [
                        'name' => $v,
                    ];
                    $notice[$i]['value'][$ii]['file'] = [
                        'mobile' => is_file($path.'config/notice/mobile/'.$ii.'.html') ? 1 : 0,
                        'notice' => is_file($path.'config/notice/mobile/'.$ii.'.html') ? 1 : 0,
                        'email' => is_file($path.'config/notice/email/'.$ii.'.html') ? 1 : 0,
                        'weixin' => is_file($path.'config/notice/weixin/'.$ii.'.html') ? 1 : 0,
                    ];
                }
            }
        }

        $data = \Soulcms\Service::M()->db->table('member_setting')->where('name', 'notice')->get()->getRowArray();

        \Soulcms\Service::V()->assign([
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '通知设置' => ['member_setting_notice/index', 'fa fa-volume-up'],
                ]
            ),
            'value' => mys_string2array($data['value']),
            'notice_config' => $notice,
        ]);
        \Soulcms\Service::V()->display('member_setting_notice.html');
    }

    // 保存配置
    public function add() {

        if (IS_AJAX_POST) {
            \Soulcms\Service::M()->db->table('member_setting')->replace([
                'name' => 'notice',
                'value' => mys_array2string(\Soulcms\Service::L('input')->post('data', true))
            ]);
            \Soulcms\Service::M('cache')->sync_cache('member'); // 自动更新缓存
            $this->_json(1, mys_lang('操作成功'));
        } else {
            $this->_json(0, mys_lang('异常请求'));
        }
    }

    // 修改模板
    public function edit() {

        $file = mys_safe_filename($_GET['file']);
        $list = [];
        foreach ($this->site_info as $sid => $t) {
            $path = \Soulcms\Service::L('html')->get_webpath($sid, 'site', '');
            $list[$sid] = [
                'name' => $t['SITE_NAME'],
                'data' => [
                    'mobile' => [
                        'name' => mys_lang('短信和消息'),
                        'code' => htmlentities(file_get_contents($path.'config/notice/mobile/'.$file.'.html'),ENT_COMPAT,'UTF-8'),
                        'file' => '/config/notice/mobile/'.$file.'.html',
                        'help' => 'javascript:mys_help(479);', 
                    ],
                    'email' => [
                        'name' => mys_lang('邮件'),
                        'code' => htmlentities(file_get_contents($path.'config/notice/email/'.$file.'.html'),ENT_COMPAT,'UTF-8'),
                        'file' => '/config/notice/email/'.$file.'.html',
                        'help' => 'javascript:mys_help(480);', 
                    ],
                    'weixin' => [
                        'name' => mys_lang('微信'),
                        'code' => htmlentities(file_get_contents($path.'config/notice/weixin/'.$file.'.html'),ENT_COMPAT,'UTF-8'),
                        'file' => '/config/notice/weixin/'.$file.'.html',
                        'help' => 'javascript:mys_help(481);', 
                    ],
                ]
            ];
        }

        \Soulcms\Service::V()->assign([
            'list' => $list,
        ]);
        \Soulcms\Service::V()->display('member_setting_notice_edit.html');exit;
    }

}
