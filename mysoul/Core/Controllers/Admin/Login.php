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



class Login extends \Soulcms\Common
{

	public function index() {

		$url = pathinfo(\Soulcms\Service::L('input')->get('go') ? urldecode(\Soulcms\Service::L('input')->get('go')) :\Soulcms\Service::L('Router')->url('home'));
		$url = $url['basename'] ? $url['basename'] :\Soulcms\Service::L('Router')->url('home/index');

		if (IS_AJAX_POST) {
            $sn = 0;
            if (defined('SYS_ADMIN_LOGINS') && SYS_ADMIN_LOGINS) {
                $sn = (int)$this->session()->get('fclogin_error_sn');
                $time = (int)$this->session()->get('fclogin_error_time');
                if (defined('SYS_ADMIN_LOGIN_TIME') && SYS_ADMIN_LOGIN_TIME && $time && SYS_TIME - $time > (SYS_ADMIN_LOGIN_TIME * 60)) {
                    // 超过时间了
                    \Soulcms\Service::C()->session()->set('fclogin_error_sn', 0);
                    \Soulcms\Service::C()->session()->set('fclogin_error_time', 0);
                }
            }
            $data = \Soulcms\Service::L('input')->post('data', true);
			if (SYS_ADMIN_CODE && !\Soulcms\Service::L('form')->check_captcha('code')) {
				$this->_json(0, mys_lang('验证码不正确'));
			} elseif (defined('SYS_ADMIN_LOGINS') && SYS_ADMIN_LOGINS && $sn && $sn > SYS_ADMIN_LOGINS) {
                $this->_json(0, mys_lang('失败次数已达到%s次，已被禁止登录', SYS_ADMIN_LOGINS));
			} elseif (empty($data['username']) || empty($data['password'])) {
				$this->_json(0, mys_lang('账号或密码必须填写'));
			} else {
				$login = \Soulcms\Service::M('auth')->login($data['username'], $data['password']);
                $this->admin['uid'] = 0;
                $this->admin['username'] = $data['username'];
                if ($login['code']) {
                    // 登录成功
                    $sync = [];
                    // 写入日志
                    \Soulcms\Service::L('input')->system_log('登录后台成功', 1);
                    $this->_json(1, 'ok', ['sync' => $sync, 'url' => \Soulcms\Service::L('input')->xss_clean($url)]);
                } else {
                    // 登录失败
                    if (defined('SYS_ADMIN_LOGINS') && SYS_ADMIN_LOGINS) {
                        \Soulcms\Service::C()->session()->set('fclogin_error_sn', intval($sn) + 1);
                        \Soulcms\Service::C()->session()->set('fclogin_error_time', SYS_TIME);
                    }
                    // 写入日志
                    \Soulcms\Service::L('input')->system_log($login['msg'].'（密码'.$data['password'].'）', 1);
                    $this->_json(0, $login['msg']);
                }
			}
		}

        $license = [];
		if (is_file(MYPATH.'Config/License.php')) {
            $license = require MYPATH.'Config/License.php';
        }

		\Soulcms\Service::V()->assign(array(
			'form' => mys_form_hidden(),
			'license' => $license,
		));
		\Soulcms\Service::V()->display('login.html');exit;
	}

	public function ajax() {



	}

	public function out() {
		$this->session()->remove('uid');
		$this->session()->remove('admin');
		$this->session()->remove('siteid');
		$this->_json(1, mys_lang('您已经安全退出系统了'));
	}

}
