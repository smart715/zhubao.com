<?php

/**
 * 余额支付发起接口
 */

// 判断用户权限
if (!$this->uid) {
    $return = mys_return_data(0, mys_lang('你还没有登录'), ['url' => \Soulcms\Service::L('router')->member_url('login/index')]);
} elseif ($data['type'] == 'recharge') {
    $return = mys_return_data(0, mys_lang('充值不能使用余额支付'));
} elseif ($data['uid'] != $this->uid) {
    $return = mys_return_data(0, mys_lang('无权限操作'));
} elseif ((float)\Soulcms\Service::C()->member['money'] <= 0 ) {
    $return = mys_return_data(0, mys_lang('账户余额不足'));
} elseif (\Soulcms\Service::C()->member['money'] - $data['value'] < 0) {
    $return = mys_return_data(0, mys_lang('账户可用余额不足'));
} else {
    $rt = $this->paysuccess('fc-'.$id, '');
    if (!$rt['code']) {
        $return = $rt;
    } else {
        mys_redirect(mys_url('api/pay/call', ['id'=>$id]));exit;
    }
}



