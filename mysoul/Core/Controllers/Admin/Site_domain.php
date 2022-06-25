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



class Site_domain extends \Soulcms\Common
{


    public function index() {

        if (IS_AJAX_POST) {
            $data = $post = \Soulcms\Service::L('input')->post('data', true);
            foreach ($post as $name => $value) {
                unset($data[$name]);
                if ($value && in_array($value, $data)) {
                    exit($this->_json(0, mys_lang('域名[%s]绑定重复', $value)));
                }
                $data[$name] = $value;
            }
            \Soulcms\Service::M('Site')->domain($post);
            \Soulcms\Service::M('cache')->sync_cache('');
            \Soulcms\Service::L('input')->system_log('设置网站域名参数');
            exit($this->_json(1, mys_lang('操作成功')));
        }

        $page = intval(\Soulcms\Service::L('input')->get('page'));
        list($module, $data) = \Soulcms\Service::M('Site')->domain();

        \Soulcms\Service::V()->assign([
            'page' => $page,
            'data' => $data,
            'form' => mys_form_hidden(['page' => $page]),
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '域名设置' => ['site_domain/index', 'fa fa-cog'],
                    'help' => ['407'],
                ]
            ),
            'module' => $module,
        ]);
        \Soulcms\Service::V()->display('site_domain.html');
    }

    public function bang_index() {
        $this->index();
    }

    public function edit() {

        if (IS_POST) {
            $domain = trim(\Soulcms\Service::L('input')->post('domain', true));
            if (!$domain) {
                exit($this->_json(0, mys_lang('域名不能为空')));
            }

            \Soulcms\Service::M('Site')->edit_domain($domain);
            \Soulcms\Service::L('input')->system_log('变更网站主域名');
            exit($this->_json(1, mys_lang('操作成功，请域名解析到本站IP')));
        }

        \Soulcms\Service::V()->assign([
            'form' => mys_form_hidden(),
        ]);
        \Soulcms\Service::V()->display('site_domain_edit.html');exit;
    }

}

