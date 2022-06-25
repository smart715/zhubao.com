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



// 提醒

class Member_notice extends \Soulcms\Table
{

    public function __construct(...$params)
    {
        parent::__construct(...$params);
        \Soulcms\Service::V()->assign('menu', \Soulcms\Service::M('auth')->_admin_menu(
            [
                '站内消息' => ['member_notice/index', 'fa fa-bell'],
                '发送消息' => ['member_notice/add', 'fa fa-plus'],
                'help' => [ 669 ],
            ]
        ));
        // 表单显示名称
        $this->name = mys_lang('站内消息');
    }

    public function index() {

        $this->my_field = array(
            'username' => array(
                'ismain' => 1,
                'name' => mys_lang('用户名'),
                'fieldname' => 'username',
            ),
            'uid' => array(
                'ismain' => 1,
                'name' => mys_lang('uid'),
                'fieldname' => 'uid',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                )
            ),
        );

        $param = [
            'table' => 'member_notice',
            'field' => $this->my_field,
        ];
        $name = mys_safe_replace(\Soulcms\Service::L('input')->request('field'));
        $value = mys_safe_replace(\Soulcms\Service::L('input')->request('keyword'));
        if ($name == 'username' && $value) {
            unset($param['field']['username']);
            $param['where_list'] = '`uid` IN (select id from `'.\Soulcms\Service::M()->dbprefix('member').'` where username="'.$value.'")';
        }

        // 初始化数据表
        $this->_init($param);
        \Soulcms\Service::V()->assign([
            'type' => mys_notice_info(),
            'field' => $this->my_field,
        ]);
        $this->_List();
        \Soulcms\Service::V()->display('member_notice_list.html');
    }

    // 删除
    public function del() {
        // 初始化数据表
        $this->_init([
            'table' => 'member_notice',
        ]);
        $this->_Del(\Soulcms\Service::L('input')->get_post_ids());
    }

    // 发送
    public function add() {

        $type = [
            0 => mys_lang('全部'),
            1 => mys_lang('单个'),
            2 => mys_lang('批量'),
        ];
        foreach ($this->member_cache['group'] as $id => $t) {
            $type['g'.$id] = $t['name'];
        }

        if (IS_AJAX_POST) {
            $post = \Soulcms\Service::L('input')->post('data');

            $this->_json(1, mys_lang('操作成功'));
        }

        \Soulcms\Service::V()->assign([
            'form' => mys_form_hidden(),
            'type' => $type,
        ]);
        \Soulcms\Service::V()->display('member_notice_post.html');
    }


    // 内容查看
    public function show() {
        $id = intval($_GET['id']);
        $data = \Soulcms\Service::M()->table('member_notice')->get($id);

        \Soulcms\Service::V()->assign([
            'data' => $data,
        ]);
        \Soulcms\Service::V()->display('member_notice_show.html');exit;
    }

    // 内容处理
    public function todo_add() {

        $post = \Soulcms\Service::L('input')->post('data');
        $cache = [];

        switch ($post['type']) {

            case '0':
                // 全部会员
                $data = \Soulcms\Service::M()->table('member')->getAll();
                if ($data) {
                    foreach ($data as $t) {
                        $t['username'] && $cache[] = $t['username'];
                    }
                }
                break;

            case '1':
                //单个
                $post['username'] && $cache[] = $post['username'];
                break;

            case '2':
                //批量
                $data = explode(PHP_EOL, $post['usernames']);
                if ($data) {
                    foreach ($data as $t) {
                        $t && $cache[] = $t;
                    }
                }
                break;

            default:
                // 用户组
                $gid = (int)substr($post['type'], 1);
                $data = \Soulcms\Service::M()->query_sql('select `username` from `{dbprefix}member` where `id` in (select `uid` from `{dbprefix}member_group_index` where `gid`='.$gid.' )', 1);
                if ($data) {
                    foreach ($data as $t) {
                        $t['username'] && $cache[] = $t['username'];
                    }
                }
                break;

        }

        $cache && $cache = array_unique($cache);

        !mys_count($cache) && $this->_json(0, mys_lang('无可用账号'));
        !$post['note'] && $this->_json(0, mys_lang('消息内容不存在'));


        // 存储文件
        \Soulcms\Service::L('cache')->init()->save('member-notice-send', [
            'usernames' => mys_save_bfb_data($cache),
            'note' => $post['note'],
            'url' => $post['url'],
        ], 3600);

        $this->_json(1, 'ok', ['url' => mys_url('member_notice/show_index', ['counts'=> mys_count($cache)])]);
    }

    // 内容处理
    public function show_index() {
        \Soulcms\Service::V()->assign([
            'menu' => '',
            'hidebtn' => 1,
            'todo_url' =>  mys_url('member_notice/send_add'),
            'count_url' =>  mys_url('member_notice/show_count_index'),
        ]);
        \Soulcms\Service::V()->display('member_notice_bfb.html');exit;
    }

    // 内容数量统计
    public function show_count_index() {

        $data = \Soulcms\Service::L('cache')->init()->get('member-notice-send');
        !mys_count($data) && $this->_json(0, mys_lang('无可用缓存内容'));

        $this->_json(mys_count($data['usernames']), 'ok');
    }

    public function send_add() {

        $page = max(1, intval($_GET['pp']));
        $cache = \Soulcms\Service::L('cache')->init()->get('member-notice-send');
        !$cache && $this->_json(0, mys_lang('缓存不存在'));

        $data = $cache['usernames'][$page];
        if ($data) {
            $html = '';
            foreach ($data as $username) {

                $user = \Soulcms\Service::M()->db->table('member')->where('username', $username)->get()->getRowArray();
                if (!$user) {
                    $ok = "<span class='error'>".mys_lang('账号不存在', $username)."</span>";
                    $class = ' p_error';
                } else {
                    $ok = "<span class='ok'>".mys_lang('发送成功')."</span>";
                    \Soulcms\Service::M('member')->notice($user['id'], 1, $cache['note'], $cache['url']);
                }

                $html.= '<p class="'.$class.'"><label class="rleft">'.$username.'</label><label class="rright">'.$ok.'</label></p>';

            }
            $this->_json($page + 1, $html);
        }

        // 完成
        \Soulcms\Service::L('cache')->init()->delete('member-notice-send');
        $this->_json(100, '');
    }

    
}
