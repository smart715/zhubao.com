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



class Module_search extends \Soulcms\Common
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

            $data = \Soulcms\Service::L('input')->post('data', true);
            foreach ($data as $dir => $t) {
                $module[$dir]['setting']['search'] = $t;
                \Soulcms\Service::M()->db->table('module')->where('dirname', $dir)->update([
                    'setting' => mys_array2string($module[$dir]['setting']),
                ]);
            }

            $this->_json(1, '操作成功');

        }

        $data = $all[$dir];

        // 搜索字段
        $data['search_field'] = [
            'keyword' => mys_lang('关键词'),
            'order' => mys_lang('排序'),
            'page' => mys_lang('分页'),
        ];
        $field = \Soulcms\Service::M()->db->table('field')
            ->where('disabled', 0)
            ->where('ismain', 1)
            ->where('relatedname', 'module')
            ->where('relatedid', $data['id'])
            ->orderBy('displayorder ASC,id ASC')
            ->get()->getResultArray();
        foreach ($field as $f) {
            $data['search_field'][$f['fieldname']] = $f['name'];
        }

        \Soulcms\Service::V()->assign([
            'page' => $dir,
            'form' =>  mys_form_hidden(),
            'module' => [$dir => $data],
            'save_url' => mys_url(\Soulcms\Service::L('Router')->class.'/edit', ['dir' => $dir]),
            'site_name' => $this->site_info[SITE_ID]['SITE_NAME'],
        ]);
        \Soulcms\Service::V()->display('module_search.html');
    }

}
