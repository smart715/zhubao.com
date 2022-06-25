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



class Module_content extends \Soulcms\Common
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
                $module[$dir]['url'] =\Soulcms\Service::L('Router')->url($dir.'/content/index');
            }
        }

        $tmp['system'] = [
            'name' => '内容维护',
            'icon' => 'fa fa-database',
            'title' => '内容维护',
            'url' => \Soulcms\Service::L('Router')->url('content/index'),
            'dirname' => 'system',
        ];

        $module = mys_array22array($module, $tmp);

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

}
