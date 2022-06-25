<?php namespace Soulcms\Admin;

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




// 网站表单操作类 基于 Ftable
class Form extends \Soulcms\Table
{
    protected $form;
    protected $is_verify;

    public function __construct(...$params)
    {
        parent::__construct(...$params);
        // 判断是否来自审核控制器
        $this->is_verify = strpos(\Soulcms\Service::L('Router')->class, '_verify') !== false;
        // 判断表单是否操作
        $cache = \Soulcms\Service::L('cache')->get('form-'.SITE_ID);
        $this->form = $cache[str_replace('_verify', '',\Soulcms\Service::L('Router')->class)];
        !$this->form && $this->_admin_msg(0, mys_lang('网站表单【%s】不存在', str_replace('_verify', '',\Soulcms\Service::L('Router')->class)));
        // 支持附表存储
        $this->is_data = 1;
        // 模板前缀(避免混淆)
        $this->tpl_prefix = 'share_form_';
        // 单独模板命名
        $this->tpl_name = $this->form['table'];
        // 表单显示名称
        $this->name = mys_lang('网站表单（%s）', $this->form['name']);
        $sysfield = ['inputtime', 'inputip', 'displayorder', 'author'];
        $this->is_verify && $sysfield[] = 'status';
        // 初始化数据表
        $this->_init([
            'table' => SITE_ID.'_form_'.$this->form['table'],
            'field' => $this->form['field'],
            'sys_field' => $sysfield,
            'date_field' => 'inputtime',
            'show_field' => 'title',
            'list_field' => $this->form['setting']['list_field'],
            'order_by' => 'inputtime desc',
            'where_list' => $this->is_verify ? 'status=0' : 'status=1',
        ]);
        $menu = $this->is_verify ? \Soulcms\Service::M('auth')->_admin_menu([
            '审核管理' => [APP_DIR.'/'.\Soulcms\Service::L('Router')->class.'/index', 'fa fa-edit'],
        ]) : \Soulcms\Service::M('auth')->_admin_menu(
            [
                mys_lang('%s管理', $this->form['name']) => ['form/'.\Soulcms\Service::L('Router')->class.'/index', mys_icon($this->form['setting']['icon'])],
                '添加' => ['form/'.\Soulcms\Service::L('Router')->class.'/add', 'fa fa-plus'],
                '修改' => ['hide:form/'.\Soulcms\Service::L('Router')->class.'/edit', 'fa fa-edit'],
                '查看' => ['hide:form/'.\Soulcms\Service::L('Router')->class.'/show_index', 'fa fa-search'],
            ]
        );
        \Soulcms\Service::V()->assign([
            'menu' => $menu,
            'field' => $this->init['field'],
            'form_list' => $cache,
            'form_name' => $this->form['name'],
            'form_table' => $this->form['table'],
            'is_verify' => $this->is_verify,
        ]);
    }

    // 后台添加表单内容
    protected function _Admin_Add() {
        list($tpl) = $this->_Post(0);
        \Soulcms\Service::V()->display($tpl);
    }

    // 后台修改表单内容
    protected function _Admin_Edit() {
        $id = intval(\Soulcms\Service::L('input')->get('id'));
        list($tpl, $data) = $this->_Post($id);
        !$data && $this->_admin_msg(0, mys_lang('数据不存在: '.$id));
        $this->is_verify && $data['status'] && $this->_admin_msg(0, mys_lang('已经通过了审核'));
        \Soulcms\Service::V()->display($tpl);
    }

    // 后台查看表单内容
    protected function _Admin_Show() {
        list($tpl, $data) = $this->_Show(intval(\Soulcms\Service::L('input')->get('id')));
        !$data && $this->_admin_msg(0, mys_lang('数据#%s不存在', $_GET['id']));
        \Soulcms\Service::V()->display($tpl);
    }

    // 后台查看表单列表
    protected function _Admin_List() {
        list($tpl) = $this->_List();
        \Soulcms\Service::V()->display($tpl);
    }

    // 后台删除表单内容
    protected function _Admin_Del() {
        $this->_Del(
            \Soulcms\Service::L('input')->get_post_ids(),
            null,
            function ($rows) {
                // 对应删除提醒
                foreach ($rows as $t) {
                    \Soulcms\Service::M('member')->delete_admin_notice('form/'.$this->form['table'].'_verify/edit:id/'.$t['id'], SITE_ID);
                    \Soulcms\Service::M('member')->delete_admin_notice('form/'.$this->form['table'].'/edit:id/'.$t['id'], SITE_ID);
                    \Soulcms\Service::L('cache')->clear('from_'.$this->form['table'].'_show_id_'.$t['id']);
                }

            },
            \Soulcms\Service::M()->dbprefix($this->init['table'])
        );
    }

    // 后台批量审核
    protected function _Admin_Status() {

        $ids = \Soulcms\Service::L('input')->get_post_ids();
        !$ids && $this->_json(0, mys_lang('所选数据不存在'));

        // 格式化
        $in = [];
        foreach ($ids as $i) {
            $i && $in[] = intval($i);
        }
        !$in && $this->_json(0, mys_lang('所选数据不存在'));

        $rows = \Soulcms\Service::M()->db->table($this->init['table'])->whereIn('id', $in)->get()->getResultArray();
        !$rows && $this->_json(0, mys_lang('所选数据不存在'));

        foreach ($rows as $row) {
            !$row['status'] && $this->_verify($row);
        }

        $this->_json(1, mys_lang('操作成功'));
    }

    // 后台批量保存排序值
    protected function _Admin_Order() {
        $this->_Display_Order(
            intval(\Soulcms\Service::L('input')->get('id')),
            intval(\Soulcms\Service::L('input')->get('value'))
        );
    }

    // 格式化保存数据 保存之前
    protected function _Format_Data($id, $data, $old) {

        // 后台添加时默认通过
        !$id && !$this->is_verify && $data[1]['status'] = 1;
        !$id && $data[1]['tableid'] = 0;

        return $data;
    }

    /**
     * 保存内容
     * $id      内容id,新增为0
     * $data    提交内容数组,留空为自动获取
     * $func    格式化提交的数据
     * */
    protected function _Save($id = 0, $data = [], $old = [], $func = null, $func2 = null) {
        
        return parent::_Save($id, $data, $old, null,
            function ($id, $data, $old) {
                $data[1]['status'] && $this->is_verify && $this->_verify([
                    'id' => (int)$data[1]['id'],
                    'uid' => (int)$data[1]['uid'],
                    'status' => 0,
                ]);
                //\Soulcms\Service::M('member')->todo_admin_notice('form/'.$this->form['table'].'_verify/edit:id/'.$id, SITE_ID);// clear
                \Soulcms\Service::L('cache')->clear('from_'.$this->form['table'].'_show_id_'.$id);
            }
        );
    }

    // 审核表单
    protected function _verify($row) {

        if ($row['status']) {
            return;
        }

        // 增减金币
        $score = $this->_member_value(\Soulcms\Service::M('member')->authid($row['uid']), $this->member_cache['auth_site'][SITE_ID]['form'][$this->form['table']]['score']);
        $score && \Soulcms\Service::M('member')->add_score($row['uid'], $score, mys_lang('%s发布', $this->form['name']));

        // 增减经验
        $exp = $this->_member_value(\Soulcms\Service::M('member')->authid($row['uid']), $this->member_cache['auth_site'][SITE_ID]['form'][$this->form['table']]['exp']);
        $exp && \Soulcms\Service::M('member')->add_experience($row['uid'], $exp, mys_lang('%s发布', $this->form['name']));

        \Soulcms\Service::M()->db->table($this->init['table'])->where('id', $row['id'])->update(['status' => 1]);

        // 任务执行成功
        \Soulcms\Service::M('member')->todo_admin_notice('form/'.$this->form['table'].'_verify/edit:id/'.$row['id'], SITE_ID);

        // 提醒
        \Soulcms\Service::M('member')->notice($row['uid'], 3, mys_lang('%s审核成功', $this->form['name']));

        // 挂钩点 程序初始化之后
        \Soulcms\Hooks::trigger('form_verify', $row);
    }

}
