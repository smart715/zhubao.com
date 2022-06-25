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



class Seo_search extends \Soulcms\Common
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
            'menu' => \Soulcms\Service::M('auth')->_iframe_menu($module, $one['dirname'], 497),
            'module' => $module,
            'dirname' => $dirname,
        ]);
        \Soulcms\Service::V()->display('iframe_content.html');exit;
    }

    public function show_index() {

        $dir = \Soulcms\Service::L('input')->get('dir');
        $data = \Soulcms\Service::M()->table('module')->where('dirname', $dir)->getRow();
        !$data && $this->_admin_msg(0, mys_lang('模块#%s不存在', $dir));
        $data['site'] = mys_string2array($data['site']);

        \Soulcms\Service::V()->assign([
            'data' => $data,
            'site' => $data['site'][SITE_ID],
            'save_url' => mys_url(\Soulcms\Service::L('Router')->class.'/edit', ['dir' => $dir]),
            'site_name' => $this->site_info[SITE_ID]['SITE_NAME'],
        ]);
        \Soulcms\Service::V()->display('seo_search.html');
    }

    public function edit() {

        $dir = \Soulcms\Service::L('input')->get('dir');
        $data = \Soulcms\Service::M()->table('module')->where('dirname', $dir)->getRow();
        !$data && $this->_admin_msg(0, mys_lang('模块#%s不存在', $dir));
        $data['site'] = mys_string2array($data['site']);

        if (IS_AJAX_POST) {
            $site = \Soulcms\Service::L('input')->post('site', true);
            foreach (['urlrule', 'search_title', 'search_keywords', 'search_description'] as $name) {
                $data['site'][SITE_ID][$name] = $site[$name];
            }
            \Soulcms\Service::M()->db->table('module')->where('dirname', $dir)->update([
                'site' => mys_array2string($data['site'])
            ]);
            \Soulcms\Service::M('cache')->sync_cache('');
            $this->_json(1, '操作成功');
        }
    }

}
