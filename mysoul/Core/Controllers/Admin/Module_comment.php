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



class Module_comment extends \Soulcms\Common
{

    public function index() {

        $module = \Soulcms\Service::L('cache')->get('module-'.SITE_ID.'-content');

        // 设置url
        if ($module) {
            foreach ($module as $dir => $t) {
                if ($t['hlist'] == 1) {
                    unset($module[$dir]);
                    continue;
                }
                $module[$dir]['url'] = mys_url(\Soulcms\Service::L('Router')->class.'/show_index', ['dir' => $dir]);
            }
        } else {
            $this->_admin_msg(0, mys_lang('系统没有安装内容模块'));
        }

        $one = reset($module);

        // 只存在一个项目
        mys_count($module) == 1 && mys_redirect($one['url']);

        $dirname = $one['dirname'];

        \Soulcms\Service::V()->assign([
            'url' => $one['url'],
            'menu' => \Soulcms\Service::M('auth')->_iframe_menu($module, $dirname),
            'module' => $module,
            'dirname' => $dirname,
        ]);
        \Soulcms\Service::V()->display('iframe_content.html');exit;
    }

    public function show_index() {

        $dir = \Soulcms\Service::L('input')->get('dir');
        $cache = \Soulcms\Service::L('cache')->get('module-'.SITE_ID.'-content');
        if (!$cache[$dir]) {
            $this->_admin_msg(0, mys_lang('模块#%s不存在', $dir));
        }

        $all = \Soulcms\Service::M('Module')->get_module_info();
        if (!$all[$dir]) {
            $this->_admin_msg(0, mys_lang('模块#%s不存在', $dir));
        }

        if (IS_POST) {

            $data = \Soulcms\Service::L('input')->post('data');
            foreach ($data as $dir => $t) {
                $module[$dir]['comment'] = $t;
                \Soulcms\Service::M()->db->table('module')->where('dirname', $dir)->update([
                    'comment' => mys_array2string($module[$dir]['comment']),
                ]);
            }

            $this->_json(1, '操作成功');

        }

        $data = $all[$dir];

        if (!isset($data['comment']['review'])) {
            // 默认点评
            $data['comment']['review']['use'] = 0;
            $data['comment']['review']['score'] = 10;
            $data['comment']['review']['option'] = [];
            // 点评选项
            for ($i = 1; $i <= 9; $i++) {
                $data['comment']['review']['option'][$i] = [
                    'use' => 0,
                    'name' => '选项'.$i,
                ];
            }
            // 点评值
            for ($i = 1; $i <= 5; $i++) {
                $data['comment']['review']['value'][$i] = [
                    'use' => 0,
                    'name' => $i.'星评价',
                ];
            }
        }

        \Soulcms\Service::V()->assign([
            'page' => $dir,
            'module' => [$dir => $data],
            'save_url' => mys_url(\Soulcms\Service::L('Router')->class.'/edit', ['dir' => $dir]),
            'site_name' => $this->site_info[SITE_ID]['SITE_NAME'],
        ]);
        \Soulcms\Service::V()->display('module_comment.html');
    }

}
