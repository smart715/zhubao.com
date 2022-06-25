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



// 用户组申请
class Member_apply extends \Soulcms\Table
{

    public function __construct(...$params)
    {
        parent::__construct(...$params);
        // 支持附表存储
        $this->is_data = 0;
        // 模板前缀(避免混淆)
        $this->my_field = array(
            'username' => array(
                'ismain' => 1,
                'name' => mys_lang('账户'),
                'fieldname' => 'username',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                )
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
        // 表单显示名称
        $this->name = mys_lang('用户组审核');
        // 初始化数据表
        $this->_init([
            'table' => 'member_group_verify',
            'field' => $this->my_field,
            'sys_field' => [],
            'order_by' => 'inputtime desc',
            'date_field' => 'inputtime',
            'list_field' => [],
        ]);
        \Soulcms\Service::V()->assign([
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '用户组审核' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-users'],
                    '详情' => ['hide:'.\Soulcms\Service::L('Router')->class.'/edit', 'fa fa-edit'],
                ]
            ),
            'field' => $this->my_field,
        ]);
    }

    // index
    public function index() {
        $this->_List();
        \Soulcms\Service::V()->display('member_apply_list.html');
    }

    // edit
    public function edit() {

        list($tpl, $data) = $this->_Post((int)\Soulcms\Service::L('input')->get('id'), [], 1);
        !$data && $this->_admin_msg(0, mys_lang('申请记录不存在'));

        $my = mys_string2array($data['content']);

        // 获取该组可用字段
        $field = [
            'note' => array(
                'ismain' => 1,
                'name' => mys_lang('审核备注'),
                'fieldname' => 'note',
                'fieldtype' => 'Textarea',
                'setting' => array(
                    'option' => array(
                        'width' => '80%',
                    ),
                )
            ),
        ];
        if ($this->member_cache['field'] && $this->member_cache['group'][$data['gid']]['field']) {
            foreach ($this->member_cache['field'] as $fname => $t) {
                in_array($fname, $this->member_cache['group'][$data['gid']]['field']) && $field[$fname] = $t;
            }
        }

        $verify_msg = [];
        if ($this->member_cache['config']['verify_msg']) {
            $msg = @explode(PHP_EOL, $this->member_cache['config']['verify_msg']);
            $msg && $verify_msg = $msg;
        }

        \Soulcms\Service::V()->assign([
            'myfield' => \Soulcms\Service::L('field')->toform($this->uid, $field, $my),
            'verify_msg' => $verify_msg,
        ]);
        \Soulcms\Service::V()->display('member_apply_post.html');
    }

    /**
     * 保存内容
     * $id      内容id,新增为0
     * $data    提交内容数组,留空为自动获取
     * $func    格式化提交的数据
     * */
    protected function _Save($id = 0, $data = [], $old = [], $func = null, $func2 = null) {

        \Soulcms\Service::M('member')->todo_admin_notice('member_apply/edit:id/'.$id);

        $post = \Soulcms\Service::L('input')->post('data');
        $member = \Soulcms\Service::M('member')->member_info($old['uid']);
        $member['verify_group'] = $this->member_cache['group'][$old['gid']]['name'];
        $member['verify_status'] = $post['status'] ? mys_lang('成功') : mys_lang('被拒绝');
        $member['verify_content'] = $post['note'];

        if ($post['status']) {
            unset($post['status']);
            // 获取该组可用字段
            $field = [];
            if ($this->member_cache['field'] && $this->member_cache['group'][$old['gid']]['field']) {
                foreach ($this->member_cache['field'] as $fname => $t) {
                    in_array($fname, $this->member_cache['group'][$old['gid']]['field']) && $field[$fname] = $t;
                }
            }

            // 表单操作类
            \Soulcms\Service::L('form')->id($id); // 初始化id
            list($post, $return, $attach) = \Soulcms\Service::L('form')->validation($post, [], $field, []);
            $return && $this->_json(0, $return['error'], ['field' => $return['name']]);
            unset($post[1]['uid']);
            unset($post[1]['username']);

            $post[1] && \Soulcms\Service::M()->table('member_data')->update($old['uid'], $post[1]);
            SYS_ATTACHMENT_DB && $attach && \Soulcms\Service::M('Attachment')->handle($old['uid'], \Soulcms\Service::M()->dbprefix('member').'-'.$id, $attach);

            \Soulcms\Service::M()->table('member_group_verify')->delete($id);
            $post[1] && \Soulcms\Service::M()->table('member_data')->update($old['uid'], $post[1]);
            \Soulcms\Service::M('member')->insert_group($old['uid'], $old['gid']);
            $old['lid'] && \Soulcms\Service::M('member')->update_level($old['uid'], $old['gid'], $old['lid']);
        } else {
            // 审核拒绝
            unset($post['status']);
            \Soulcms\Service::M()->table('member_group_verify')->update($id, [
                'content' => mys_array2string($post),
                'status' => 1, // 拒绝
            ]);
        }

        // 通知 钩子
        \Soulcms\Service::L('Notice')->send_notice('member_verify_group', $member);
        \Soulcms\Hooks::trigger('member_verify_group_after', $member);

        $this->_json(1, mys_lang('操作成功'));
    }

    // 删除
    public function del() {
        $this->_Del(\Soulcms\Service::L('input')->get_post_ids(), null, function($rows) {
            foreach ($rows as $t) {
                // 删除审核提醒
                \Soulcms\Service::M('member')->delete_admin_notice('member_apply/edit:id/'.$t['id'], SITE_ID);
            }
            return mys_return_data(1, 'ok');
        });
    }
    
}
