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



class Seo_category extends \Soulcms\Common
{

    public function index() {

        $module = \Soulcms\Service::L('cache')->get('module-'.SITE_ID.'-content');
        !$module && $this->_admin_msg(0, mys_lang('系统没有安装内容模块'));

        $share = 0;

        // 设置url
        foreach ($module as $dir => $t) {
            if ($t['share']) {
                $share = 1;
                unset($module[$dir]);
                continue;
            } elseif ($t['hlist'] == 1) {
                //1表示不出现在模块管理、评论tab、搜索tab、内容维护tab的列表之中
                unset($module[$dir]);
                continue;
            } elseif ($t['hcategory']) {
                //1表示不使用栏目功能和发布权限功能
                unset($module[$dir]);
                continue;
            }
            $module[$dir]['url'] = mys_url(\Soulcms\Service::L('Router')->class.'/show_index', ['dir' => $dir]);
        }

        if ($share) {
            $tmp['share'] = [
                'name' => '共享',
                'icon' => 'fa fa-share-alt',
                'title' => '共享',
                'url' => mys_url(\Soulcms\Service::L('Router')->class.'/show_index', ['dir' => 'share']),
                'dirname' => 'share',
            ];
            $one = $tmp['share'];
            $module = mys_array22array($tmp, $module);
        } else {
            $one = reset($module);
        }

        // 只存在一个项目
        mys_count($module) == 1 && mys_redirect($one['url']);

        \Soulcms\Service::V()->assign([
            'url' => $one['url'],
            'menu' => \Soulcms\Service::M('auth')->_iframe_menu($module, $one['dirname'], 496),
            'module' => $module,
            'dirname' => $one['dirname'],
        ]);
        \Soulcms\Service::V()->display('iframe_content.html');exit;
    }

    // 获取树形结构列表
    protected function _get_tree_list($data) {

        $tree = [];
        $rule = $this->get_cache('urlrule');
        foreach($data as $t) {
            $t['name'] = mys_strcut($t['name'], 30);
            $t['setting'] = mys_string2array($t['setting']);
            $t['option'] = '<a class="btn btn-xs green" href="javascript:edit_seo('.$t['id'].', \''.$t['name'].'\');"> <i class="fa fa-edit"></i> '.mys_lang('设置SEO').'</a>';
            $t['option'].= '<a class="btn btn-xs red" href="javascript:mys_iframe(\''.mys_lang('复制').'\', \''.mys_url(($this->module['share'] ? '' : $this->module['dirname']).'/category/copy_edit').'&at=seo&catid='.$t['id'].'\');"> <i class="fa fa-copy"></i> '.mys_lang('同步到其他栏目').'</a>';
            // 判断是否生成静态
            $is_html = intval($this->module['share'] ? $t['setting']['html'] : $this->module['html']);
            $t['is_page_html'] = '<a href="javascript:;" onclick="mys_cat_ajax_open_close(this, \''.\Soulcms\Service::L('Router')->url(($this->module['share'] ? '' : $this->module['dirname']).'/category/html_edit', ['id'=>$t['id']]).'\', 0);" class="mys_is_page_html badge badge-'.(!$is_html ? 'no' : 'yes').'"><i class="fa fa-'.(!$is_html ? 'times' : 'check').'"></i></a>';
            $t['html'] = '';
            $name = $t['setting']['urlrule'] && isset($rule[$t['setting']['urlrule']]['name']) ? $rule[$t['setting']['urlrule']]['name'] : '';
            !$name && $name = mys_lang('动态模式');
            if ($this->module['share']) {
                $t['html'] = '<a href="javascript:edit_seo('.$t['id'].', \''.$t['name'].'\');" class="btn btn-xs '.($t['setting']['urlrule'] && isset($rule[$t['setting']['urlrule']]['name']) ? 'red' : 'green').'"> <i class="fa fa-code"></i> '.$name.'</a>';
            } else {
                $t['html'] = '<a href="javascript:edit_seo2();" class="btn btn-xs green">  <i class="fa fa-code"></i> '.$name.'</a>';
            }
            $tree[$t['id']] = $t;
        }


        $str = "<tr class='\$class'>";
        $str.= "<td style='text-align:center'>\$id</td>";
        $str.= "<td>\$spacer<a target='_blank' href='\$url'>\$name</a> </td>";
        $str.= "<td>\$html</td>";
        $str.= "<td style='text-align:center'>\$is_page_html</td>";
        $str.= "<td>\$option</td>";
        $str.= "</tr>";


        return \Soulcms\Service::L('Tree')->init($tree)->html_icon()->get_tree(0, $str);
    }


    public function show_index() {

        $dir = \Soulcms\Service::L('input')->get('dir');
        $this->module = \Soulcms\Service::L('cache')->get('module-'.SITE_ID.'-'.$dir);
        if (!$this->module) {
            $this->_admin_msg(0, mys_lang('模块[%s]缓存不存在', $dir));
            return;
        }

        \Soulcms\Service::V()->assign([
            'list' => $this->_get_tree_list($this->module['category']),
            'dirname' => $dir,
            'save_url' => mys_url(\Soulcms\Service::L('Router')->class.'/edit', ['dir' => $dir]),
            'site_name' => $this->site_info[SITE_ID]['SITE_NAME'],
        ]);
        \Soulcms\Service::V()->display('seo_category.html');
    }

    public function edit() {

        $dir = \Soulcms\Service::L('input')->get('dir');
        $module = \Soulcms\Service::L('cache')->get('module-'.SITE_ID.'-'.$dir);
        if (!$module) {
            $this->_admin_msg(0, mys_lang('模块[%s]缓存不存在', $dir));
            return;
        }

        $id = (int)\Soulcms\Service::L('input')->get('id');
        $data = \Soulcms\Service::M()->table(SITE_ID.'_'.$dir.'_category')->where('id', $id)->getRow();
        !$data && $this->_admin_msg(0, mys_lang('栏目#%s不存在', $id));
        $data['setting'] = mys_string2array($data['setting']);

        if (IS_AJAX_POST) {
            $seo = \Soulcms\Service::L('input')->post('seo', true);
            $set = \Soulcms\Service::L('input')->post('setting', true);
            foreach (['list_title', 'list_keywords', 'list_description'] as $name) {
                $data['setting']['seo'][$name] = $seo[$name];
            }
            $data['setting']['html'] = (int)$set['html'];
            $data['setting']['urlrule'] = (int)$set['urlrule'];
            \Soulcms\Service::M()->db->table(SITE_ID.'_'.$dir.'_category')->where('id', $id)->update([
                'setting' => mys_array2string($data['setting']),
            ]);
            \Soulcms\Service::M('cache')->sync_cache('');
            $this->_json(1, '操作成功，更新缓存生效');
        }


        \Soulcms\Service::V()->assign([
            'data' => $data,
            'dirname' => $dir,
        ]);
        \Soulcms\Service::V()->display('seo_category_edit.html');exit;
    }

}
