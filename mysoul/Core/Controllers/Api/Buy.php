<?php namespace Soulcms\Controllers\Api;

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



// 交易下单
class Buy extends \Soulcms\Common {

    public function index() {

        $id = (int)\Soulcms\Service::L('input')->get('id');
        $fid = (int)\Soulcms\Service::L('input')->get('fid');
        (!$fid || !$id) && exit($this->_msg(0, mys_lang('支付参数不完整')));

        $num = max(1, (int)\Soulcms\Service::L('input')->get('num'));
        $sku = mys_safe_replace(\Soulcms\Service::L('input')->get('sku'), 'undefined');

        $field = $this->get_cache('table-field', $fid);
        !$field && exit($this->_msg(0, mys_lang('支付字段不存在')));

        // 获取付款价格
        $rt = \Soulcms\Service::M('pay')->get_pay_info($id, $field, $num, $sku);
        isset($rt['code']) && !$rt['code'] && exit($this->_msg(0, $rt['msg']));

        // 挂钩点 购买商品之前
        \Soulcms\Hooks::trigger('member_buy', $rt);

        \Soulcms\Service::V()->assign($rt);
        \Soulcms\Service::V()->assign([
            'num' => $rt['num'],
            'price' => $rt['price'],
            'total' => $rt['total'],
            'payform' => mys_payform($rt['mid'], $rt['total'], $rt['title'].$rt['sku_string'], $rt['url']),
            'meta_title' => mys_lang('在线付款').SITE_SEOJOIN.SITE_NAME,
            'meta_keywords' => $this->get_cache('site', SITE_ID, 'config', 'SITE_KEYWORDS'),
            'meta_description' => $this->get_cache('site', SITE_ID, 'config', 'SITE_DESCRIPTION')
        ]);
        \Soulcms\Service::V()->display('buy.html');
    }
}
