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



// 授权登录
class Member_oauth extends \Soulcms\Table
{

    public function __construct(...$params)
    {
        parent::__construct(...$params);
        // 支持附表存储
        $this->is_data = 0;
        // 模板前缀(避免混淆)
        $this->my_field = array(
            'nickname' => array(
                'ismain' => 1,
                'name' => mys_lang('昵称'),
                'isemoji' => 1,
                'fieldname' => 'nickname',
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
            'table' => 'member_oauth',
            'field' => $this->my_field,
            'sys_field' => [],
            'order_by' => 'id desc',
            'list_field' => [],
        ]);
        \Soulcms\Service::V()->assign([
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '授权账号' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-qq'],
                    '详情' => ['hide:'.\Soulcms\Service::L('Router')->class.'/edit', 'fa fa-edit'],
                ]
            ),
            'field' => $this->my_field,
        ]);
    }

    // index
    public function index() {
        $this->_List();
        \Soulcms\Service::V()->display('member_oauth.html');
    }

    // 删除
    public function del() {
        $this->_Del(\Soulcms\Service::L('input')->get_post_ids());
    }
    
}
