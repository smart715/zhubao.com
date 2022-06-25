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



class System_cache extends \Soulcms\Common
{

    public function index() {

        $file = WRITEPATH.'config/cache.php';
        $module = \Soulcms\Service::M('Module')->All(1); // 库中已安装模块

        if (IS_AJAX_POST) {

            !\Soulcms\Service::L('Config')->file($file, '缓存配置文件')->to_require_one(\Soulcms\Service::L('input')->post('data', true))
            && $this->_json(0, mys_lang('配置文件写入失败'));

            $site = \Soulcms\Service::L('input')->post('site', true);
            foreach ($this->site_info as $sid => $t) {
                \Soulcms\Service::M('Site')->config_value($sid, 'config', [
                    'SITE_INDEX_HTML' => intval($site[$sid]['SITE_INDEX_HTML'])
                ]);
            }

            $module_value = \Soulcms\Service::L('input')->post('module', true);
            foreach ($module as $t) {
                $setting = mys_string2array($t['setting']);
                $setting['module_index_html'] = $module_value[$t['id']]['module_index_html'];
                \Soulcms\Service::M()->table('module')->update($t['id'], [
                    'setting' => mys_array2string($setting),
                ]);
            }

            \Soulcms\Service::L('input')->system_log('配置缓存参数'); // 记录日志
            $this->_json(1, mys_lang('操作成功'));
        }

        $page = intval(\Soulcms\Service::L('input')->get('page'));
        \Soulcms\Service::V()->assign([
            'page' => $page,
            'form' => mys_form_hidden(['page' => $page]),
            'data' => is_file($file) ? require $file : [],
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '缓存设置' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-clock-o'],
                    'help' => [504],
                ]
            ),
            'module' => $module,
            'cache_var' => [
                'SHOW' => '模块内容',
                'ATTACH' => '网站附件',
                'LIST' => '查询标签',
                'SEARCH' => '内容搜索',
            ],
        ]);
        \Soulcms\Service::V()->display('system_cache.html');
    }


}
