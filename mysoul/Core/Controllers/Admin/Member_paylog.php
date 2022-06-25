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



// 资金流水
class Member_paylog extends \Soulcms\Table
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
                'isint' => 1,
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
        $this->name = mys_lang('资金流水');
        // 初始化数据表
        $this->_init([
            'table' => 'member_paylog',
            'field' => $this->my_field,
            'order_by' => 'inputtime desc',
            'date_field' => 'inputtime',
        ]);
        \Soulcms\Service::V()->assign([
            'field' => $this->my_field,
        ]);
    }

    // index
    public function index() {
        \Soulcms\Service::M()->set_where_list('`status`=1');
        $this->_List();
        \Soulcms\Service::V()->assign([
            'not_pay' => 1,
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '资金流水' => [ \Soulcms\Service::L('Router')->class.'/index', 'fa fa-calendar'],
                    'help' => [ 594 ],
                ]
            ),
        ]);
        \Soulcms\Service::V()->display('member_paylog_list.html');
    }

    // index
    public function not_index() {
        \Soulcms\Service::M()->set_where_list('`status`=0');
        $this->_List();
        \Soulcms\Service::V()->assign([
            'not_pay' => 1,
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '资金流水' => [\Soulcms\Service::L('Router')->class.'/not_index', 'fa fa-calendar'],
                    'help' => [ 595 ],
                ]
            ),
        ]);
        \Soulcms\Service::V()->display('member_paylog_list.html');
    }

    // edit
    public function edit() {
        list($tpl, $data) = $this->_Post((int)\Soulcms\Service::L('input')->get('id'), [], 1);
        !$data && $this->_admin_msg(0, mys_lang('支付记录不存在'));
        \Soulcms\Service::V()->assign([
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '资金流水' => [APP_DIR.'/'.\Soulcms\Service::L('Router')->class.'/'.($data['status'] ? 'index' : 'not_index'), 'fa fa-calendar'],
                    '详情' => ['hide:'.APP_DIR.'/'.\Soulcms\Service::L('Router')->class.'/edit', 'fa fa-edit'],
                ]
            ),
        ]);
        \Soulcms\Service::V()->display('member_paylog_edit.html');
    }

    // 系统回收
    public function system_edit() {

        $id = (int)\Soulcms\Service::L('input')->get('id');
        $data =  \Soulcms\Service::M('Pay')->table('member_paylog')->get($id);
        !$data && $this->_json(0, mys_lang('支付记录不存在'));
        1 != $data['status'] && $this->_json(0, mys_lang('支付记录不满足回收条件'));
        $data['value'] < 0 && $this->_json(0, mys_lang('付款金额不满足回收条件'));
        $data['mid'] != 'recharge' && $this->_json(0, mys_lang('只能回收充值金额'));

        $user = \Soulcms\Service::M('member')->table('member')->get($data['uid']);
        !$user && $this->_json(0, mys_lang('用户记录不存在'));

        if (IS_AJAX_POST) {
            $post = \Soulcms\Service::L('input')->post('data');
            $user['money'] - $data['value'] < 0 && $this->_json(0, mys_lang('付款账号余额不足'));
            !$post['note'] && $this->_json(0, mys_lang('回收备注一定要填写'), ['field' => 'note']);
            // 扣除付款方的钱
            $rt =  \Soulcms\Service::M('Pay')->add_money($data['uid'], -$data['value']);
            !$rt['code'] && $this->_json(0, $rt['msg']);
            // 增加到交易流水
            $rt =  \Soulcms\Service::M('Pay')->add_paylog([
                'uid' => $data['uid'],
                'username' => $data['username'],
                'touid' => 0,
                'tousername' => '',
                'mid' => 'system',
                'title' => mys_lang('系统回收'),
                'value' => -$data['value'],
                'type' => 'finecms',
                'status' => 1,
                'result' => $post['note'],
                'paytime' => SYS_TIME,
                'inputtime' => SYS_TIME,
            ]);
            !$rt['code'] && $this->_json(0, $rt['msg']);
            $this->_json(1, mys_lang('操作成功'));
        }

        \Soulcms\Service::V()->assign([
            'data' => $data,
            'user' => $user,
            'form' => mys_form_hidden(),
        ]);
        \Soulcms\Service::V()->display('member_paylog_system.html');exit;
    }

    // 短信催付
    public function notice_del() {

        $ids = \Soulcms\Service::L('input')->get_post_ids();
        !$ids && $this->_json(0, mys_lang('所选数据不存在'));

        $sql = 'select phone from `'.\Soulcms\Service::M()->dbprefix('member').'` where `id` in (select `uid` from `'.\Soulcms\Service::M()->dbprefix('member_paylog').'` where `id` in ('.implode(',', $ids).') )';
        $data = \Soulcms\Service::M()->db->query($sql)->getResultArray();
        !$data && $this->_json(0, mys_lang('所选数据不存在'));

        $i = 0;
        foreach ($data as $t) {
            $rt = \Soulcms\Service::M('member')->sendsms_text($t['phone'], mys_lang('您还有未付款的交易，请尽快付款；若已付，请忽略此消息'));
            if ($rt['code']) {
                $i ++;
            }
        }

        $this->_json(1, mys_lang('已发送给%s个用户', $i));
    }

    // 删除
    public function del() {
        $this->_Del(
            \Soulcms\Service::L('input')->get_post_ids(),
            null,
            null,
            \Soulcms\Service::M()->dbprefix($this->init['table'])
        );

    }


}
