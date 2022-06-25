<?php namespace Soulcms\Home;

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




// 内容网站表单操作类 基于 Ftable
class Form extends \Soulcms\Table
{
    public $cid; // 内容id
    public $form; // 表单信息

    public function __construct(...$params) {
        parent::__construct(...$params);
        // 判断表单是否操作
        $cache = \Soulcms\Service::L('cache')->get('form-'.SITE_ID);
        $this->form = $cache[\Soulcms\Service::L('Router')->class];
        if (!$this->form) {
            $this->_msg(0, mys_lang('网站表单【%s】不存在',\Soulcms\Service::L('Router')->class));
            exit;
        }
        // 支持附表存储
        $this->is_data = 1;
        // 模板前缀(避免混淆)
        $this->tpl_name = $this->form['table'];
        $this->tpl_prefix = 'form_';
        // 初始化数据表
        $this->_init([
            'table' => SITE_ID.'_form_'.\Soulcms\Service::L('Router')->class,
            'field' => $this->form['field'],
            'show_field' => 'title',
        ]);
        // 写入模板
        \Soulcms\Service::V()->assign([
            'form_name' => $this->form['name'],
            'form_table' => $this->form['table'],
        ]);
    }

    // ========================

    // 内容列表
    protected function _Home_List() {


        if (SYS_CACHE && SYS_CACHE_PAGE && !defined('SC_HTML_FILE')) {
            // 启用页面缓存
            $this->cachePage(SYS_CACHE_PAGE * 3600);
        }

        // 无权限访问表单
        if (!mys_member_auth(
            $this->member_authid,
            $this->member_cache['auth_site'][SITE_ID]['form'][$this->form['table']]['show'])
        ) {
            $this->_msg(0, mys_lang('您的用户组无权限访问表单'));
            return;
        }

        // seo
        \Soulcms\Service::V()->assign(\Soulcms\Service::L('Seo')->form_list(
            $this->form,
            max(1, (int)\Soulcms\Service::L('input')->get('page'))
        ));

        \Soulcms\Service::V()->assign([
            'urlrule' =>\Soulcms\Service::L('Router')->form_list_url($this->form['table'], '[page]'),
        ]);
        \Soulcms\Service::V()->display($this->_tpl_filename('list'));
    }

    // 添加内容
    protected function _Home_Post() {

        if ($this->form['setting']['is_close_post']) {
            $this->_msg(0, mys_lang('禁止前端提交表单'));
        }

        // 无权限访问表单
        if (!mys_member_auth(
            $this->member_authid,
            $this->member_cache['auth_site'][SITE_ID]['form'][$this->form['table']]['add'])
        ) {
            $this->_msg(0, mys_lang('您的用户组无发布权限'));
            return;
        }

        // 判断会员权限
        $this->member && $this->_member_option(0);

        // 是否有验证码
        $this->is_post_code = mys_member_auth(
            $this->member_authid,
            $this->member_cache['auth_site'][SITE_ID]['form'][$this->form['table']]['code']
        );

        list($tpl) = $this->_Post(0);

        // seo
        \Soulcms\Service::V()->assign(\Soulcms\Service::L('Seo')->form_post($this->form));

        \Soulcms\Service::V()->assign([
            'form' =>  mys_form_hidden(),
            'rt_url' => $this->form['setting']['rt_url'] ? $this->form['setting']['rt_url'] : mys_now_url(),
            'is_post_code' => $this->is_post_code,
        ]);
        \Soulcms\Service::V()->display($tpl);
    }

    // 显示内容
    protected function _Home_Show() {


        if (SYS_CACHE && SYS_CACHE_PAGE && !defined('SC_HTML_FILE')) {
            // 启用页面缓存
            $this->cachePage(SYS_CACHE_PAGE * 3600);
        }

        // 无权限访问表单
        if (!mys_member_auth(
            $this->member_authid,
            $this->member_cache['auth_site'][SITE_ID]['form'][$this->form['table']]['show'])
        ) {
            $this->_msg(0, mys_lang('您的用户组无权限访问表单'));
            return;
        }

        $id = intval(\Soulcms\Service::L('input')->get('id'));
        $name = 'from_'.$this->form['table'].'_show_id_'.$id;
        $cache = \Soulcms\Service::L('cache')->init()->get($name);
        if (!$cache) {
            list($tpl, $data) = $this->_Show($id);
            !$data && $this->_msg(0, mys_lang('网站表单内容不存在'));
            $data = $this->_Call_Show($data);
            $cache = [
                $tpl,
                $data
            ];
            // 缓存结果
            if ($data['uid'] != $this->uid && SYS_CACHE) {
                if ($this->member && $this->member['is_admin']) {
                    // 管理员时不进行缓存
                    \Soulcms\Service::L('cache')->init()->delete($name);
                } else {
                    \Soulcms\Service::L('cache')->init()->save($name, $cache, SYS_CACHE_SHOW * 3600);
                }
            }
        } else {
            list($tpl, $data) = $cache;
        }

        if (!$data['status']) {
            $this->_msg(0, mys_lang('内容正在审核中'));
        }

        \Soulcms\Service::V()->assign($data);

        // seo
        \Soulcms\Service::V()->assign(\Soulcms\Service::L('Seo')->form_show(
            $this->form,
            $data
        ));

        \Soulcms\Service::V()->display($tpl);
    }


    // ===========================

    // 格式化保存数据 保存之前
    protected function _Format_Data($id, $data, $old) {


        // 判断日发布量
        $day_post = $this->_member_value(
            $this->member_authid,
            $this->member_cache['auth_site'][SITE_ID]['form'][$this->form['table']]['day_post']
        );
        if ($this->uid && $day_post
            && \Soulcms\Service::M()->db
                ->table($this->init['table'])
                ->where('uid', $this->uid)
                ->where('DATEDIFF(from_unixtime(inputtime),now())=0')
                ->countAllResults() >= $day_post) {
            $this->_json(0, mys_lang('每天发布数量不能超过%s个', $day_post));
        }

        // 判断发布总量
        $total_post = $this->_member_value(
            $this->member_authid,
            $this->member_cache['auth_site'][SITE_ID]['form'][$this->form['table']]['total_post']
        );
        if ($this->uid && $total_post
            && \Soulcms\Service::M()->db
                ->table($this->init['table'])
                ->where('uid', $this->uid)
                ->countAllResults() >= $total_post) {
            $this->_json(0, mys_lang('发布数量不能超过%s个', $total_post));
        }

        // 审核状态
        $is_verify = mys_member_auth(
            $this->member_authid,
            $this->member_cache['auth_site'][SITE_ID]['form'][$this->form['table']]['verify']
        );
        $data[1]['status'] = $is_verify ? 0 : 1;
        
        // 默认数据
        $data[0]['uid'] = $data[1]['uid'] = (int)$this->member['uid'];
        $data[1]['author'] = $this->member['username'] ? $this->member['username'] : 'guest';
        $data[1]['inputip'] = \Soulcms\Service::L('input')->ip_address();
        $data[1]['inputtime'] = SYS_TIME;
        $data[1]['tableid'] = 0;
        $data[1]['displayorder'] = 0;

        return $data;
    }


    /**
     * 回调处理结果
     * $data
     * */
    protected function _Call_Post($data) {

        // 挂钩点
        \Soulcms\Hooks::trigger('form_post_after', $data);

        // 提醒通知
        if ($this->form['setting']['notice']['use']) {
            if ($this->form['setting']['notice']['username']) {
                $user = mys_member_username_info($this->form['setting']['notice']['username']);
                if (!$user) {
                    log_message('error', '网站表单【'.$this->form['name'].'】已开启通知提醒，但通知人账号['.$this->form['setting']['notice']['username'].']有误');
                } else {
                    \Soulcms\Service::L('Notice')->send_notice_user('form_'.$this->form['table'].'_post', $user['id'], mys_array2array($data[1], $data[0]), $this->form['setting']['notice']);
                }
            } else {
                log_message('error', '网站表单【'.$this->form['name'].'】已开启通知提醒，但未设置通知人');
            }
        }


        $data[1]['status'] && $this->_json(1, mys_lang('The operation succeeds'));

        // 提醒
        \Soulcms\Service::M('member')->admin_notice(SITE_ID, 'content', $this->member, mys_lang('%s提交审核', $this->form['name']), 'form/'.$this->form['table'].'_verify/edit:id/'.$data[1]['id'], SITE_ID);
        $this->_json(1, mys_lang('The operation succeeds.Wait for the administrator approval'), ['url' => $this->form['setting']['rt_url']]);
    }

    // 前端回调处理类
    protected function _Call_Show($data) {

        return $data;
    }
}
