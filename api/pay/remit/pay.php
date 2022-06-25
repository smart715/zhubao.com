<?php

/**
 * 转账汇款发起接口
 */

// 判断用户权限
if (!$this->uid) {
    $return = mys_return_data(0, mys_lang('你还没有登录'), ['url' => \Soulcms\Service::L('router')->member_url('login/index')]);
} elseif ($data['uid'] != $this->uid) {
    $return = mys_return_data(0, mys_lang('无权限操作'));
} else {
    if (IS_POST && $data['status'] != 2) {
        // 确认已汇款
        $this->table('member_paylog')->update($id, ['status' => 2]);
        // 通知后台
        \Soulcms\Service::M('member')->admin_notice(0, 'pay', \Soulcms\Service::C()->member, mys_lang('转账汇款审核'), 'member_payremit/edit:id/'.$id);
        $data['status'] = 2;
    }
    // 付款界面模板
    $htmlfile = is_file(WEBPATH.'config/pay/payremit.html') ? WEBPATH.'config/pay/payremit.html' : ROOTPATH.'config/pay/payremit.html';
    $member = \Soulcms\Service::C()->member;
    // 获取付款界面代码
    ob_start();
    $file = \Soulcms\Service::V()->code2php(file_get_contents($htmlfile));
    require_once $file;
    $html = ob_get_clean();
    $return =  mys_return_data(1, 'ok', $html);
}



