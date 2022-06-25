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



// 收款管理
class Member_paymeet extends \Soulcms\Table
{

    public function __construct(...$params)
    {
        parent::__construct(...$params);
        // 支持附表存储
        $this->is_data = 0;
        // 模板前缀(避免混淆)
        $this->my_field = array(
            'title' => array(
                'ismain' => 1,
                'name' => mys_lang('关键字'),
                'fieldname' => 'title',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                )
            ),
            'username' => array(
                'ismain' => 1,
                'name' => mys_lang('付款账户'),
                'fieldname' => 'username',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                )
            ),
            'tousername' => array(
                'ismain' => 1,
                'name' => mys_lang('收款账户'),
                'fieldname' => 'tousername',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                )
            ),
            'uid' => array(
                'ismain' => 1,
                'name' => mys_lang('付款uid'),
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
        $this->name = mys_lang('上门收款');
        // 初始化数据表
        $this->_init([
            'table' => 'member_paylog',
            'field' => $this->my_field,
            'sys_field' => [],
            'order_by' => 'inputtime desc',
            'date_field' => 'inputtime',
            'where_list' => '`type`="meet"',
            'list_field' => [],
        ]);
        \Soulcms\Service::V()->assign([
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '上门收款' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-user'],
                    '详情' => ['hide:'.\Soulcms\Service::L('Router')->class.'/edit', 'fa fa-edit'],
                    'help' => [ 596 ],
                ]
            ),
            'field' => $this->my_field,
            'is_meet' => 1,
        ]);
    }

    // index
    public function index() {
        $this->_List();
        \Soulcms\Service::V()->display('member_paylog_list.html');
    }

    // edit
    public function edit() {
        list($tpl, $data) = $this->_Post((int)\Soulcms\Service::L('input')->get('id'), [], 1);
        !$data && $this->_admin_msg(0, mys_lang('支付记录不存在'));
        \Soulcms\Service::V()->display('member_paylog_edit.html');
    }
    
    // 删除
    public function del() {
        $this->_Del(\Soulcms\Service::L('input')->get_post_ids());
    }

    /**
     * 保存内容
     * $id      内容id,新增为0
     * $data    提交内容数组,留空为自动获取
     * $old     老数据
     * $func    格式化提交的数据 提交前
     * $func    格式化提交的数据 保存后
     * */
    protected function _Save($id = 0, $data = [], $old = [], $before = null, $after = null) {

        $post = \Soulcms\Service::L('input')->post('post');
        if (!isset($post['verify'])) {
            return mys_return_data(0, mys_lang('审核状态必须选择'), ['field' => 'verify']);
        } elseif (!$post['note']) {
            return mys_return_data(0, mys_lang('审核备注必须填写'), ['field' => 'note']);
        }

        // 更新提醒
        \Soulcms\Service::M('member')->todo_admin_notice('member_paymeet/edit:id/'.$id, 0);

        // 收到款
        if ($post['verify']) {
            \Soulcms\Service::M('member')->notice($old['uid'], 5, '流水号('.$id.') 上门付款成功',\Soulcms\Service::L('Router')->member_url('paylog/show', ['id'=>$id]));
            return \Soulcms\Service::M('Pay')->paysuccess('fc-'.$id, $post['note']);
        } else {
            \Soulcms\Service::M('member')->notice($old['uid'], 5, '流水号('.$id.') 上门付款失败',\Soulcms\Service::L('Router')->member_url('paylog/show', ['id'=>$id]));
            \Soulcms\Service::M()->table('member_paylog')->update($id, [
                'result' => $post['note'],
                'status' => 0,
            ]);
        }

        return mys_return_data($id, 'ok');
    }
    
}
