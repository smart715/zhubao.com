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



class Member_field extends \Soulcms\Common
{

    public function __construct(...$params) {
        parent::__construct(...$params);
        \Soulcms\Service::V()->assign([
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '字段划分' => ['member_field/index', 'fa fa-cog'],
                    '自定义字段' => ['url:'.\Soulcms\Service::L('Router')->url('field/index', ['rname' => 'member']), 'fa fa-code'],
                ]
            ),
            'uriprefix' => 'member_field'
        ]);
    }

    public function index() {

        $color = $list = $group = [];

        // 字段配置
        $data = \Soulcms\Service::M()->db->table('member_setting')->where('name', 'field')->get()->getRowArray();
        $value = $data ? mys_string2array($data['value']) : [];

        // 注册配置
        $data = \Soulcms\Service::M()->db->table('member_setting')->where('name', 'register_field')->get()->getRowArray();
        $register = $data ? mys_string2array($data['value']) : [];

        // 字段查询
        $field = \Soulcms\Service::M()->db->table('field')->where('disabled', 0)->where('relatedname', 'member')->orderBy('displayorder ASC,id ASC')->get()->getResultArray();
        if ($field) {
            foreach ($field as $f) {
                $f['register'] = in_array($f['id'], $register);
                $f['group'] = $value[$f['id']];
                $list[$f['fieldname']] = $f;
            }
        }

        // 用户组
        $data = \Soulcms\Service::M()->db->table('member_group')->orderBy('displayorder ASC,id ASC')->get()->getResultArray();
        if ($data) {
            $_color = ['blue', 'red', 'green', 'dark', 'yellow'];
            foreach ($data as $i => $t) {
                $group[$t['id']] = $t;
                $color[$t['id']] = $_color[$i];
            }
        }
        
        \Soulcms\Service::V()->assign([
            'list' => $list,
            'group' => $group,
            'color' => $color,
        ]);
        \Soulcms\Service::V()->display('member_field.html');
    }

    public function add() {

        $ids = \Soulcms\Service::L('input')->get_post_ids();
        !$ids && $this->_json(0, mys_lang('你还没有选择呢'));

        $gid = (int)\Soulcms\Service::L('input')->post('groupid');
        !$gid && $this->_json(0, mys_lang('你还没有选择用户组'));

        $data = \Soulcms\Service::M()->db->table('member_setting')->where('name', 'field')->get()->getRowArray();
        $value = $data ? mys_string2array($data['value']) : [];

        foreach ($ids as $id) {
            $value[$id][$gid] = $gid;
        }

        \Soulcms\Service::M()->db->table('member_setting')->replace([
            'name' => 'field',
            'value' => mys_array2string($value)
        ]);

        \Soulcms\Service::M('cache')->sync_cache('member'); // 自动更新缓存
        $this->_json(1, mys_lang('划分成功'));
    }

    public function reg_edit() {

        $fid = (int)\Soulcms\Service::L('input')->get('id');
        !$fid && $this->_json(0, mys_lang('字段id不存在'));

        $data = \Soulcms\Service::M()->db->table('member_setting')->where('name', 'register_field')->get()->getRowArray();
        $register = $data ? mys_string2array($data['value']) : [];

        if ($register[$fid]) {
            unset($register[$fid]);
            $rt = 1;
        } else {
            $register[$fid] = $fid;
            $rt = 0;
        }

        \Soulcms\Service::M()->db->table('member_setting')->replace([
            'name' => 'register_field',
            'value' => mys_array2string($register)
        ]);

        \Soulcms\Service::M('cache')->sync_cache('member'); // 自动更新缓存
        $this->_json(1, mys_lang('操作成功'), ['value' => $rt]);
    }

    public function del() {

        $fid = (int)\Soulcms\Service::L('input')->get('fid');
        !$fid && $this->_json(0, mys_lang('字段id不存在'));

        $gid = (int)\Soulcms\Service::L('input')->get('gid');
        !$gid && $this->_json(0, mys_lang('用户组id不存在'));

        $data = \Soulcms\Service::M()->db->table('member_setting')->where('name', 'field')->get()->getRowArray();
        $value = $data ? mys_string2array($data['value']) : [];
        !$value[$fid][$gid] && $this->_json(0, mys_lang('配置不存在'));

        unset($value[$fid][$gid]);
        
        \Soulcms\Service::M()->db->table('member_setting')->replace([
            'name' => 'field',
            'value' => mys_array2string($value)
        ]);

        \Soulcms\Service::M('cache')->sync_cache('member'); // 自动更新缓存
        $this->_json(1, mys_lang('删除成功'));
    }


}
