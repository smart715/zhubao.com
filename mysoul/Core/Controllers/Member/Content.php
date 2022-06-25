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


class Content extends \Soulcms\Table
{
    public $module;
    public $my_module;


    /**
     * 评论
     */
    public function comment() {

        $this->module = \Soulcms\Service::L('cache')->get('module-'.SITE_ID.'-content');
        if (!$this->module) {
            $this->_msg(0, mys_lang('系统还没有可用的内容模块'));
        }
        // 筛选出没有开启评论的模块
        foreach ($this->module as $i => $t) {
            if (!$t['comment']) {
                unset($this->module[$i]);
                continue;
            }
        }

        if (!$this->module) {
            $this->_msg(0, mys_lang('系统没有对内容模块开启评论功能'));
        }

        $dir = \Soulcms\Service::L('input')->get('module');
        if (!$dir || !isset($this->module[$dir])) {
            $one = reset($this->module);
            $this->my_module = $one['dirname'];
        } else {
            $this->my_module = $dir;
        }

        $table = mys_module_table_prefix($this->my_module);
        $this->_init([
            'table' => $table.'_comment',
            'select_list' => $table.'_comment.*,'.$table.'.title,'.$table.'.url',
            'order_by' => $table.'_comment.inputtime desc',
            'join_list' => [$table, $table.'.id='.$table.'_comment.cid', 'left'],
            'where_list' => $table.'_comment.uid='.$this->uid.'',
        ]);

        list($tpl, $data) = $this->_List();

        // 初始化变量
        unset($data['param']['module']);
        unset($data['param']['total']);
        unset($data['param']['order']);

        // 列出内容模块
        foreach ($this->module as $i => $t) {
            $data['param']['module'] = $i;
            $this->module[$i]['url'] =\Soulcms\Service::L('Router')->member_url('member/content/'.\Soulcms\Service::L('Router')->method, $data['param']);
        }

        $list = [];
        if ($data['list']) {
            foreach ($data['list'] as $i => $t) {
                $t['url'] = mys_url_prefix($t['url'], $this->my_module);
                $list[] = $t;
            }
        }

        \Soulcms\Service::V()->assign([
            'list' => $list,
            'module' => $this->module,
            'my_module' => $this->my_module,
            'del_url' =>\Soulcms\Service::L('Router')->member_url('member/content/delete', [
                'module' => $this->my_module,
                'action' =>\Soulcms\Service::L('Router')->method
            ])
        ]);
        \Soulcms\Service::V()->display('content_'.\Soulcms\Service::L('Router')->method.'.html');
    }

}
