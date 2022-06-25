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


// 生成静态
class Html extends \Soulcms\Common
{

    public function __construct(...$params) {
        parent::__construct(...$params);

        // 生成权限文件
        !mys_html_auth(1) && $this->_admin_msg(0, mys_lang('/cache/html/ 无法写入文件'));
    }

    // 生成静态
    public function index() {

        \Soulcms\Service::V()->assign([
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '生成静态' => [\Soulcms\Service::L('Router')->class.'/'.\Soulcms\Service::L('Router')->method, 'fa fa-file-code-o'],
                    'help' => [417],
                ]
            ),
            'module' => \Soulcms\Service::L('cache')->get('module-'.SITE_ID.'-content'),
        ]);
        \Soulcms\Service::V()->display('html_index.html');
    }

    // 生成单页
    public function page_index() {

        $this->member_cache['auth_site'][SITE_ID]['home'] && $this->_json(0, '当前网站设置了访问权限，无法生成静态');

        \Soulcms\Service::V()->assign([
            'todo_url' => '/index.php?s=page&m=htmlfile',
            'count_url' =>\Soulcms\Service::L('Router')->url('html/page_count_index'),
        ]);
        \Soulcms\Service::V()->display('html_bfb.html');exit;
    }

    // 单页生成的数量统计
    public function page_count_index() {
        $data = mys_save_bfb_data($this->get_cache('page-'.SITE_ID, 'data'));
        !mys_count($data) && $this->_json(0, '没有可用生成的自定义页面数据');
        \Soulcms\Service::L('cache')->init()->save('page-html-file', $data, 3600);
        $this->_json(1, 'ok');
    }

    // 栏目
    public function category_index() {

        $this->member_cache['auth_site'][SITE_ID]['home'] && $this->_json(0, '当前网站设置了访问权限，无法生成静态');

        $app = \Soulcms\Service::L('input')->get('app');
        $ids = \Soulcms\Service::L('input')->get('ids');

        \Soulcms\Service::V()->assign([
            'todo_url' => '/index.php?'.($app ? 's='.$app.'&' : '').'c=html&m=category&ids='.$ids,
            'count_url' =>\Soulcms\Service::L('Router')->url('html/category_count_index', ['app' => $app, 'ids' => $ids]),
        ]);
        \Soulcms\Service::V()->display('html_bfb.html');exit;
    }

    // 获取生成的栏目
    private function _category_data($ids, $cats) {

        if (!$ids) {
            return $cats;
        }

        $rt = [];
        $arr = explode(',', $ids);
        foreach ($arr as $id) {
            if ($id && $cats[$id]) {
                $rt[$id] = $cats[$id];
            }
        }

        return $rt;
    }

    // 栏目的数量统计
    public function category_count_index() {

        $app = \Soulcms\Service::L('input')->get('app');
        $ids = \Soulcms\Service::L('input')->get('ids');

        if ($app) {
            $cat = $this->get_cache('module-'.SITE_ID.'-'.$app, 'category');
        } else {
            $cat = $this->get_cache('module-'.SITE_ID.'-share', 'category');
        }

        \Soulcms\Service::L('html')->get_category_data($app, $this->_category_data($ids, $cat));
    }

    // 内容
    public function show_index() {

        $this->member_cache['auth_site'][SITE_ID]['home'] && $this->_json(0, '当前网站设置了访问权限，无法生成静态');

        $app = \Soulcms\Service::L('input')->get('app');
        $ids = \Soulcms\Service::L('input')->get('catids');

        \Soulcms\Service::V()->assign([
            'todo_url' => '/index.php?'.($app ? 's='.$app.'&' : '').'c=html&m=show&catids='.$ids,
            'count_url' =>\Soulcms\Service::L('Router')->url('html/show_count_index', ['app' => $app, 'catids' => $ids, 'date_to' => \Soulcms\Service::L('input')->get('date_to'), 'date_form' => \Soulcms\Service::L('input')->get('date_form')]),
        ]);
        \Soulcms\Service::V()->display('html_bfb.html');exit;
    }

    // 内容数量统计
    public function show_count_index() {
        \Soulcms\Service::L('html')->get_show_data(\Soulcms\Service::L('input')->get('app'), [
            'catids' => \Soulcms\Service::L('input')->get('catids'),
            'date_to' => \Soulcms\Service::L('input')->get('date_to'),
            'date_form' => \Soulcms\Service::L('input')->get('date_form')
        ]);
    }

    private function _get_cat_data($app, $ids) {

    }

}
