<?php namespace Soulcms\Admin;

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




// 会员权限
class Member extends \Soulcms\Common
{
    public $auth;
    public $tree; // 模块栏目
    public $module; // 模块信息

    public function __construct(...$params) {
        parent::__construct(...$params);
        // 初始化模块
        $this->_module_init(APP_DIR);
        // 模块权限数据
        $data = \Soulcms\Service::M()->db->table('member_setting')->where('name', 'auth_module')->get()->getRowArray();
        $this->auth = mys_string2array($data['value']);
        $this->is_hcategory = isset($this->module['config']['hcategory']) && $this->module['config']['hcategory'];
        // 栏目
        $this->tree = [];
        if (!IS_SHARE && !$this->is_hcategory) {
            foreach($this->module['category'] as $t) {
                $t['is_post'] = 0;
                if (!$t['child']) {
                    $t['is_post'] = 1;
                }
                $this->tree[$t['id']] = $t;
            }
        }


    }

    // ========================

    /* *
     * 模块权限划分
     * auth_module => array(
     *  siteid1 => array(
     *      首页 index []
     *      栏目 category []
     *      表单 form[]
     *      评论 comment[]
     *  )
     *
     * )
     *
     * */
    protected function _Index() {
        \Soulcms\Service::V()->assign([
            'list' => $this->_get_group(),
            'form' => $this->module['form'],
            'auth' => $this->auth[SITE_ID][MOD_DIR],
            'verify' => \Soulcms\Service::M()->table('admin_verify')->getAll(),
            'categroy' => $this->tree ? \Soulcms\Service::L('Tree')->init($this->tree)->html_icon()->get_tree_array(0) : [],
            'is_comment' => $this->module['comment'] ? 1 : 0,
            'is_hcategory' => $this->is_hcategory,
        ]);
        \Soulcms\Service::V()->display('share_member_index.html');
    }

    // 模块权限保存
    public function add() {

        if (IS_AJAX_POST) {

            $at = \Soulcms\Service::L('input')->get('at');
            !$at && $this->_json(0, mys_lang('参数错误'));

            $id = \Soulcms\Service::L('input')->post('id');
            switch ($at) {

                case 'category':
                    $this->auth[SITE_ID][MOD_DIR][$at] = [];
                    foreach ($this->tree as $catid => $r) {
                        $t = $id[$catid];
                        $this->auth[SITE_ID][MOD_DIR][$at][$catid] = [
                            'show' => mys_member_auth_id($this->member_cache['authid'], $t['show']),
                            'add' => mys_member_auth_id($this->member_cache['authid'], $t['add']),
                            'edit' => mys_member_auth_id($this->member_cache['authid'], $t['edit']),
                            'del' => mys_member_auth_id($this->member_cache['authid'], $t['del']),
                            'code' => mys_member_auth_id($this->member_cache['authid'], $t['code']),
                            'verify' => $t['verify'],
                            'exp' => $t['exp'],
                            'score' => $t['score'],
                            'day_post' => $t['day_post'],
                            'total_post' => $t['total_post'],
                            'test' => 1,
                        ];
                    }
                    break;

                case 'form':
                    $this->auth[SITE_ID][MOD_DIR][$at] = [];
                    foreach ($id as $fid => $t) {
                        $this->auth[SITE_ID][MOD_DIR][$at][$fid] = [
                            'show' => mys_member_auth_id($this->member_cache['authid'], $t['show']),
                            'add' => mys_member_auth_id($this->member_cache['authid'], $t['add']),
                            'code' => mys_member_auth_id($this->member_cache['authid'], $t['code']),
                            'verify' => mys_member_auth_id($this->member_cache['authid'], $t['verify']),
                            'exp' => $t['exp'],
                            'score' => $t['score'],
                            'day_post' => $t['day_post'],
                            'total_post' => $t['total_post'],
                            'test' => 1,
                        ];
                    }
                    break;

                case 'comment':

                    $this->auth[SITE_ID][MOD_DIR][$at] = [
                        'add' => mys_member_auth_id($this->member_cache['authid'], $id['add']),
                        'verify' => mys_member_auth_id($this->member_cache['authid'], $id['verify']),
                        'exp' => $id['exp'],
                        'score' => $id['score'],
                    ];
                    break;

                default:
                    $this->auth[SITE_ID][MOD_DIR][$at] = mys_member_auth_id($this->member_cache['authid'], $id);
                    break;

            }

            \Soulcms\Service::M()->db->table('member_setting')->replace([
                'name' => 'auth_module',
                'value' => mys_array2string($this->auth)
            ]);
            \Soulcms\Service::M('cache')->sync_cache('member');
            $this->_json(1, mys_lang('操作成功'));
        }

        $this->_json(0, mys_lang('请求错误'));
    }

    // 模块表单权限设置
    public function form_edit() {

        $table = \Soulcms\Service::L('input')->get('table');

        if (IS_AJAX_POST) {

            $t = \Soulcms\Service::L('input')->post('data');
            $at = 'form';
            if (isset($this->auth[SITE_ID][MOD_DIR][$at])) {
                $this->auth[SITE_ID][MOD_DIR][$at] = [];
            }
            $this->auth[SITE_ID][MOD_DIR][$at][$table] = [
                'show' => mys_member_auth_id($this->member_cache['authid'], $t['show']),
                'add' => mys_member_auth_id($this->member_cache['authid'], $t['add']),
                'code' => mys_member_auth_id($this->member_cache['authid'], $t['code']),
                'verify' => mys_member_auth_id($this->member_cache['authid'], $t['verify']),
                'exp' => $t['exp'],
                'score' => $t['score'],
                'day_post' => $t['day_post'],
                'total_post' => $t['total_post'],
                'test' => 1,
            ];

            \Soulcms\Service::M()->db->table('member_setting')->replace([
                'name' => 'auth_module',
                'value' => mys_array2string($this->auth)
            ]);
            \Soulcms\Service::M('cache')->sync_cache('member');
            $this->_json(1, mys_lang('操作成功'));

            exit;
        }

        \Soulcms\Service::V()->assign([
            'auth' => $this->auth[SITE_ID][MOD_DIR],
            'form' => mys_form_hidden(),
            'list' => $this->_get_group(),
            'table' => $table,
        ]);
        \Soulcms\Service::V()->display('site_member_form.html');exit;
    }

    // 栏目权限设置
    public function category_edit() {

        $catid = (int)\Soulcms\Service::L('input')->get('catid');

        if (IS_AJAX_POST) {

            $t = \Soulcms\Service::L('input')->post('data');
            $at = 'category';

            if (isset($this->auth[SITE_ID][$at])) {
                $this->auth[SITE_ID][$at] = [];
            }
            $this->auth[SITE_ID][MOD_DIR][$at][$catid] = [
                'show' => mys_member_auth_id($this->member_cache['authid'], $t['show']),
                'add' => mys_member_auth_id($this->member_cache['authid'], $t['add']),
                'edit' => mys_member_auth_id($this->member_cache['authid'], $t['edit']),
                'del' => mys_member_auth_id($this->member_cache['authid'], $t['del']),
                'code' => mys_member_auth_id($this->member_cache['authid'], $t['code']),
                'verify' => $t['verify'],
                'exp' => $t['exp'],
                'score' => $t['score'],
                'day_post' => $t['day_post'],
                'total_post' => $t['total_post'],
                'test' => 1,
            ];

            \Soulcms\Service::M()->db->table('member_setting')->replace([
                'name' => 'auth_module',
                'value' => mys_array2string($this->auth)
            ]);
            \Soulcms\Service::M('cache')->sync_cache('member');
            $this->_json(1, mys_lang('操作成功'));

            exit;
        }

        \Soulcms\Service::V()->assign([
            'cat' => $this->tree[$catid],
            'auth' => $this->auth[SITE_ID][MOD_DIR],
            'form' => mys_form_hidden(),
            'list' => $this->_get_group(),
            'catid' => $catid,
            'verify' => \Soulcms\Service::M()->table('admin_verify')->getAll(),
        ]);
        \Soulcms\Service::V()->display('site_member_category.html');exit;
    }
    
    // 复制栏目权限
    public function edit() {

        $catid = (int)\Soulcms\Service::L('input')->get('catid');
        if (IS_AJAX_POST) {

            $auth = $this->auth[SITE_ID][MOD_DIR]['category'][$catid];
            !$auth && $this->_json(0, mys_lang('当前栏目没有配置权限规则'));

            $catids = \Soulcms\Service::L('input')->post('catid');
            !$catids && $this->_json(0, mys_lang('你还没有选择栏目呢'));

            $c = 0;
            if (isset($catids[0]) && $catids[0] == 0) {
                foreach ($this->module['category'] as $id => $t) {
                    $c ++;
                    $this->auth[SITE_ID][MOD_DIR]['category'][$id] = $auth;
                }
            } else {
                foreach ($catids as $id) {
                    $c ++;
                    $this->auth[SITE_ID][MOD_DIR]['category'][$id] = $auth;
                }
            }


            \Soulcms\Service::M()->db->table('member_setting')->replace([
                'name' => 'auth_module',
                'value' => mys_array2string($this->auth)
            ]);
            \Soulcms\Service::M('cache')->sync_cache('member');
            $this->_json(1, mys_lang('共复制%s个栏目', $c));
            exit;
        }

        \Soulcms\Service::V()->assign([
            'form' =>  mys_form_hidden(),
            'select' => \Soulcms\Service::L('Tree')->select_category(
                $this->module['category'],
                0,
                'id=\'mys_catid\' name=\'catid[]\' multiple="multiple" style="height:200px"',
                mys_lang('全部栏目'),
                0,
                0
            ),
        ]);
        \Soulcms\Service::V()->display('share_member_copy.html');exit;
    }

    // 清空栏目权限
    public function del() {

        $catid = (int)\Soulcms\Service::L('input')->get('catid');

        if (IS_AJAX) {

            unset($this->auth[SITE_ID][MOD_DIR]['category'][$catid]);

            \Soulcms\Service::M()->db->table('member_setting')->replace([
                'name' => 'auth_module',
                'value' => mys_array2string($this->auth)
            ]);

            \Soulcms\Service::M('cache')->sync_cache('member');
            $this->_json(1, mys_lang('权限配置清除成功'));
        }

        $this->_json(0, mys_lang('请求错误'));
    }

    private function _get_group() {

        // 用户组
        $list = [
            0 => [
                'name' => mys_lang('游客'),
                'level' => [],
                'space' => '',
            ]
        ];

        foreach ($this->member_cache['group'] as $t) {
            $list[$t['id']] = [
                'name' => mys_lang($t['name']),
                'level' => [],
                'space' => '',
            ];
            if ($t['level']) {
                foreach ($t['level'] as $lv) {
                    $list[$t['id'].'-'.$lv['id']] = [
                        'name' => mys_lang($lv['name']),
                        'space' => ' style="padding-left:40px"'
                    ];
                    $list[$t['id']]['level'] = 1;
                }
            }
        }
        return $list;
    }

}
