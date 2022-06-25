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



// 审核管理
class Member_verify extends \Soulcms\Table
{

    public function __construct(...$params)
    {
        parent::__construct(...$params);

        $this->my_field = array(
            'username' => array(
                'ismain' => 1,
                'name' => mys_lang('账号'),
                'fieldname' => 'username',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                    'validate' => array(
                        'required' => 1,
                    )
                )
            ),
            'email' => array(
                'ismain' => 1,
                'name' => mys_lang('邮箱'),
                'fieldname' => 'email',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                    'validate' => array(
                        'required' => 1,
                    )
                )
            ),
            'phone' => array(
                'ismain' => 1,
                'name' => mys_lang('手机'),
                'fieldname' => 'phone',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                    'validate' => array(
                        'required' => 1,
                    )
                )
            ),
            'name' => array(
                'ismain' => 1,
                'name' => mys_lang('姓名'),
                'fieldname' => 'name',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                    'validate' => array(
                        'required' => 1,
                    )
                )
            ),
        );
        // 表单显示名称
        $this->name = mys_lang('用户');
        // 初始化数据表
        $this->_init([
            'table' => 'member',
            'field' => $this->member_cache['field'],
            'sys_field' => [],
            'order_by' => 'id desc',
            'list_field' => [],
        ]);
        $this->group = $this->member_cache['group'];
        \Soulcms\Service::V()->assign([
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '待审核用户' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-user'],
                ]
            ),
            'field' => $this->my_field,
            'group' => $this->group,
        ]);
    }

    // 用户管理
    public function index() {

        $p = [];
        $name = \Soulcms\Service::L('input')->request('field');
        $value = \Soulcms\Service::L('input')->request('keyword');

        $where = [
            '`id` IN (select id from `'.\Soulcms\Service::M()->dbprefix('member_data').'` where `is_verify`=0)',
        ];

        if ($name && $value && isset($this->my_field[$name])) {
            $p[$name] = $value;
            $where[] = '`'.$name.'` LIKE "%'.$value.'%"';
        }
        
        $groupid = (int)\Soulcms\Service::L('input')->request('groupid');
        if ($groupid) {
            $p['groupid'] = $groupid;
            $where[] = '`id` IN (select uid from `'.\Soulcms\Service::M()->dbprefix('member_group_index').'` where id='.$groupid.')';
        }
        
        $where && \Soulcms\Service::M()->set_where_list(implode(' AND ', $where));

        $this->_List($p);

        \Soulcms\Service::V()->assign([
            'is_verify' => 1,
            'uriprefix' => 'member',
        ]);
        \Soulcms\Service::V()->display('member_list.html');
    }

    // 审核
    public function edit() {

        $ids = \Soulcms\Service::L('input')->get_post_ids();
        !$ids && $this->_json(0, mys_lang('所选用户不存在'));

        foreach ($ids as $id) {
            \Soulcms\Service::M('member')->verify_member($id);
        }

        $this->_json(1, mys_lang('操作成功'));
    }


}
