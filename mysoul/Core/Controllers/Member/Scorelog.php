<?php namespace Soulcms\Controllers\Member;

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



class Scorelog extends \Soulcms\Table
{

    public function __construct(...$params)
    {
        parent::__construct(...$params);
        // 支持附表存储
        $this->is_data = 0;
        // 表单显示名称
        $this->name = mys_lang('金币流水');
        // 初始化数据表
        $this->_init([
            'table' => 'member_scorelog',
            'order_by' => 'inputtime desc',
            'date_field' => 'inputtime',
        ]);
    }

    // index
    public function index() {

        $tid = (int)\Soulcms\Service::L('input')->get('tid');
        $where = ['`uid`='.$this->uid];
        switch ($tid) {
            case 1: // 收入
                $where[] = '`value` > 0';
                break;
            case -1: // 消费
                $where[] = '`value` < 0';
                break;
            default : // 全部
                break;
        }

        \Soulcms\Service::M()->set_where_list(implode(' AND ', $where));
        list($tpl, $data) = $this->_List(['tid' => $tid]);

        // 初始化
        $data['param']['tid'] = $data['param']['total'] = 0;

        // 列出类别
        $my = [];
        $type = ['0' => '全部', '1' => '收入', '-1' => '消费'];
        foreach ($type as $i => $t) {
            $data['param']['tid'] = $i;
            $my[$i] = [
                'name' => mys_lang($t),
                'url' =>\Soulcms\Service::L('Router')->member_url('member/scorelog/index', $data['param'])
            ];
        }

        $my[9] = [
            'name' => mys_lang('兑换'),
            'url' =>\Soulcms\Service::L('Router')->member_url('member/scorelog/add')
        ];
        $my[10] = [
            'name' => mys_lang('充值'),
            'url' =>\Soulcms\Service::L('Router')->member_url('member/scorelog/pay')
        ];

        \Soulcms\Service::V()->assign([
            'tid' => $tid,
            'type' => $my,
        ]);
        \Soulcms\Service::V()->display('scorelog_index.html');
    }

    /**
     * 兑换金币
     */
    public function add()
    {
        if (IS_POST) {

            $value = intval(\Soulcms\Service::L('input')->post('value'));
            if (!$this->member_cache['pay']['convert']) {
                $this->_json(0, mys_lang('系统没有设置兑换比例'));
            } elseif (!$value) {
                $this->_json(0, mys_lang('兑换数量必须填写'), ['field' => 'value']);
            } elseif ($value % $this->member_cache['pay']['convert'] != 0) {
                $this->_json(0, mys_lang('兑换数量必须比例数的倍数'), ['field' => 'value']);
            }

            $price = floatval($value / $this->member_cache['pay']['convert']);
            if ($price <= 0) {
                $this->_json(0, mys_lang('支付价格有误'), ['field' => 'value']);
            } elseif ($this->member['money'] - $price < 0) {
                $this->_json(0, mys_lang('账户余额不足'));
            }

            $rt = \Soulcms\Service::M('Pay')->add_money($this->uid, -$price);
            !$rt['code'] && $this->_json(0, $rt['msg']);
            $rt = \Soulcms\Service::M('member')->add_score($this->uid, $value, mys_lang('自助兑换'));
            if (!$rt['code']) {
                \Soulcms\Service::M('Pay')->add_money($this->uid, $price);
                $this->_json(0, $rt['msg']);
            }
            // 增加到交易流水
            \Soulcms\Service::M('Pay')->add_paylog([
                'uid' => $this->member['id'],
                'username' => $this->member['username'],
                'touid' => 0,
                'tousername' => '',
                'mid' => 'system',
                'title' => mys_lang('兑换（%s）: %s', SITE_SCORE, $value),
                'value' => -$price,
                'type' => 'finecms',
                'status' => 1,
                'result' => '',
                'paytime' => SYS_TIME,
                'inputtime' => SYS_TIME,
            ]);

            $this->_json(1, mys_lang('操作成功'));
        }

        \Soulcms\Service::V()->assign([
            'form' => mys_form_hidden(),
        ]);
        \Soulcms\Service::V()->display('scorelog_add.html');
    }

    /**
     * 在线充值
     */
    public function pay() {
        define('FC_PAY', 1);
        !$this->member_cache['pay']['convert'] && $this->_msg(0, mys_lang('系统没有设置兑换比例'));
        \Soulcms\Service::V()->assign([
            'payfield' => mys_payform('score', '', '', '', 1),
        ]);
        \Soulcms\Service::V()->display('scorelog_pay.html');
    }
}
