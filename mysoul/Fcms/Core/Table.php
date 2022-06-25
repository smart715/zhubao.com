<?php namespace Soulcms;

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




// 内容操作类
class Table extends \Soulcms\Common
{
    
    public $dfield; // 自定义字段对象
    public $init; // 数据表初始化 [ fmode init方法参数 ]
    public $is_get_catid; // 当期栏目id

    protected $field; // 自定义字段 [ 1 = [主表], 0 = [附表]]
    protected $sys_field; // 系统字段 [ 1 = [主表], 0 = [附表]]
    protected $form_rule; // 表单配置规则
    protected $is_data; // 是否支持附表
    protected $is_post_code; // 是否提交验证码
    protected $is_module_index; // 是否支持模块索引
    protected $is_category_data_field; // 是否支持模块栏目模型字段

    protected $edit_where; // 修改数据时的条件
    protected $delete_where; // 删除数据时的条件

    protected $name; // 定义一个操作显示名称
    protected $tpl_name; // 模板命名名称
    protected $tpl_prefix; // 模板前缀
    protected $list_pagesize; // 模板列表分页量

    protected $auto_save; // 自动存储
    protected $replace_id; // 替换主id(link_id)

    protected $url_params; // url参数固定

    public function __construct(...$params) {
        parent::__construct(...$params);
        $this->is_data = 0;
        $this->tpl_name = '';
        $this->auto_save = 1;
        $this->tpl_prefix =\Soulcms\Service::L('Router')->class.'_';
        $this->delete_where = '';
        $this->is_module_index = 0;
        $this->is_category_data_field = 0;
    }
    
    // 数据表初始化
    protected function _init($data) {
        !$data['show_field'] && $data['show_field'] = 'id';
        $this->field = $data['field'] ? $data['field'] : $this->field;
        $this->sys_field = $data['sys_field'] ? \Soulcms\Service::L('Field')->sys_field($data['sys_field']) : [];
        $data['field'] = $this->sys_field && $this->field ? $this->field + $this->sys_field : ($this->field ? $this->field : $this->sys_field);
        $this->init = $data;
        return $this;
    }

    // 获取入库时的字段
    protected function _field_save($catid) {

        $field = $this->sys_field && IS_ADMIN ? mys_array22array($this->sys_field, $this->field) : $this->field;

        // 栏目模型字段
        $this->is_category_data_field && $catid
        && $this->module['category'][$catid]['field']
        && $field = mys_array22array($field, $this->module['category'][$catid]['field']);

        if (!IS_ADMIN && $field) {
            // 非管理平台验证字段显示权限
            foreach ($field as $i => $t) {
                if (!$t['ismember']) {
                    unset($field[$i]);
                }
            }
        }

        return $field;
    }

    /**
     * 字段进行分组
     * */ 
    protected function _field_group($data) {

        $field = $this->field;
        $my_field = $sys_field = $diy_field = $cat_field = [];

        // 栏目模型字段
        $this->is_category_data_field && $data['catid']
        && $this->module['category'][$data['catid']]['field']
        && $field = mys_array22array($field, $this->module['category'][$data['catid']]['field']);

        uasort($field, function($a, $b){
            if($a['displayorder'] == $b['displayorder']){
                return 0;
            }
            return($a['displayorder']<$b['displayorder']) ? -1 : 1;
        });

        foreach ($field as $i => $t) {
            if ($t['setting']['is_right'] == 1) {
                // 右边字段归类为系统字段
                if (IS_ADMIN) {
                    $sys_field[$i] = $t;
                } else {
                    $my_field[$i] = $t;
                }

            } elseif ($t['setting']['is_right'] == 2) {
                // diy字段
                $diy_field[$i] = $t;
            } else {
                $my_field[$i] = $t;
            }
        }

        $this->sys_field && $sys_field = $this->sys_field + $sys_field ;

        return [$my_field, $sys_field, $diy_field, $cat_field];
    }

    /**
     * 获取内容
     * $id      内容id,新增为0
     * */
    protected function _Data($id = 0) {

        if (!$id) {
            return [];
        }

        $row = \Soulcms\Service::M()->init($this->init)->get($id);
        if (!$row) {
            return [];
        }

        // 附表存储
        if ($this->is_data) {
            $r = \Soulcms\Service::M()->table($this->init['table'] . '_data_'.intval($row['tablieid']))->get($id);
            $row = $r ? $r + $row : $row;
        }

        return $row;
    }

    /**
     * 排序值操作
     * $id      内容id
     * */
    protected function _Display_Order($id, $value, $after = null) {

        // 查询数据
        $row = \Soulcms\Service::M()->init($this->init)->get($id);
        !$row && $this->_json(0, mys_lang('数据%s不存在', $id));

        $rt = \Soulcms\Service::M()->init($this->init)->save($id, 'displayorder', $value, $this->edit_where);
        !$rt['code'] && $this->_json(0, $rt['msg']);

        \Soulcms\Service::L('input')->system_log($this->name.'：修改('.$row[$this->init['show_field']].')排序值为'.$value);

        // 自动更新缓存
        IS_ADMIN && \Soulcms\Service::M('cache')->sync_cache();
        // 提交之后的操作
        if ($after) {
            call_user_func_array($after, [$row]);
        }
        $this->_json(1, mys_lang('操作成功'));

    }
    
    // 格式化保存数据
    protected function _Format_Data($id, $data, $old) {

        return $data;
    }

    /**
     * 保存内容
     * $id      内容id,新增为0
     * $data    提交内容数组,留空为自动获取
     * $old    老数据 
     * $func    格式化提交的数据 提交前   
     * $func    格式化提交的数据 保存后
     * */ 
    protected function _Save($id = 0, $data = [], $old = [], $before = null, $after = null) {

        // 附表id号
        $this->is_data && $tid = intval($old['tableid']);

        // 格式化提交的数据
        if ($before) {
            $rt = call_user_func_array($before, [$id, $data, $old]);
            if (!$rt['code']) {
                return $rt;
            }
            $data = $rt['data'];
        }

        // 模块数据
        if ($this->is_module_index) {
            $rt = $this->content_model->save($id, $data, $old);
            if (!$rt['code']) {
                return $rt;
            }
            $data = $rt['data'];
            $data[1]['id'] = $data[0]['id'] = $id = $rt['code'];
        } else {
            // 主表数据
            $main = isset($data[1]) ? $data[1] : $data;
            if ($id) {
                // 更新数据
                $rt = \Soulcms\Service::M()->table($this->init['table'])->update($id, $main, $this->edit_where);
                if (!$rt['code']) {
                    return $rt;
                }
            } else {
                // 新增数据
                $rt = \Soulcms\Service::M()->table($this->init['table'])->replace($main);
                if (!$rt['code']) {
                    return $rt;
                }
                // 新增获取id
                $_id = $rt['code'];
                // 副表以5w数据量无限分表
                if ($this->is_data) {
                    $tid = floor($_id / 50000);
                    \Soulcms\Service::M()->table($this->init['table'])->update($_id, ['tableid' => $tid], $this->edit_where);
                }
            }
            // 附表存储
            if ($this->is_data) {
                // 判断附表是否存在,不存在则创建
                \Soulcms\Service::M()->is_data_table($this->init['table'].'_data_', $tid);
                $table = $this->init['table'].'_data_'.$tid;
                if ($id) {
                    if ($data[0]) {
                        $rt = \Soulcms\Service::M()->table($table)->update($id, $data[0], $this->edit_where);
                        if ($rt['msg']) {
                            // 删除主表
                            \Soulcms\Service::M()->table($this->init['table'])->delete($id);
                            // 删除索引
                            $this->is_module_index && \Soulcms\Service::M()->table($this->init['table'].'_index')->delete($id);
                            return $rt;
                        } 
                    } else {
                        // 有种情况就是附表没有数据;
                    }
                } else {
                    $data[0]['id'] = $_id; // 录入主表id
                    $rt = \Soulcms\Service::M()->table($table)->replace($data[0]);
                    if ($rt['msg']) {
                        // 删除主表
                        \Soulcms\Service::M()->table($this->init['table'])->delete($_id);
                        // 删除索引
                        $this->is_module_index && \Soulcms\Service::M()->table($this->init['table'].'_index')->delete($_id);
                        return $rt;
                    }
                }
            }

            // 获取真实id
            $data[1]['id'] = $data[0]['id'] = $id = $id ? $id : $_id;
        }

        // 提交之后的操作
        if ($after) {
            $rt = call_user_func_array($after, [$id, $data, $old]);
            $rt && $data = $rt;
        }

        return mys_return_data($id, 'ok', $data);
    }

    /**
     * 提交内容
     * $id      内容id,新增为0,否则视为修改
     * $draft   草稿数据
     * $is_data 将内容数据返回到data数组里面
     * $is_post 强制post执行
     * */
    protected function _Post($id = 0, $draft = [], $is_data = 0, $is_post = 0) {

        $uri =\Soulcms\Service::L('Router')->uri();
        $name = md5($id.$uri); // 当前页面唯一标识

        // 表单操作类
        \Soulcms\Service::L('Form')->id($id); // 初始化id

        // 获取数据
        $data = $this->_Data($id);
        $this->replace_id && $id = $this->replace_id; // 替换主id

        // 初始化自定义字段类
        \Soulcms\Service::L('Field')->app(APP_DIR);

        if (IS_AJAX_POST || $is_post) {
            // 内容不存在
            !$data && $id && $this->_json(0, mys_lang('数据#%s不存在', $id));
            \Soulcms\Service::L('field')->value = $data;
            // 验证码验证
            $this->is_post_code && !\Soulcms\Service::L('Form')->check_captcha('code') && $this->_json(0, mys_lang('The verification code is incorrect'), ['field' => 'code']);
            // 验证数据
            $post = \Soulcms\Service::L('input')->post('data');
            list($post, $return, $attach) = \Soulcms\Service::L('Form')->validation(
                $post, 
                $this->form_rule,
                $this->_field_save(intval(\Soulcms\Service::L('input')->post('catid'))),
                $data
            );
            // 输出错误
            $return && $this->_json(0, $return['error'], ['field' => $return['name']]);
            // 格式化数据
            $post = $this->_Format_Data($id, $post, $data);
            // 保存数据
            $rt = $this->_Save($id, $post, $data);
            !$rt['code'] && $this->_json(0, $rt['msg'], $rt['data']);
            $post['id'] = $rt['code'];
            // 记录日志
            $logname = isset($post[$this->init['show_field']]) && $post[$this->init['show_field']] ? $post[$this->init['show_field']] : $data[$this->init['show_field']];
            !$logname && $logname = $post['id'];
            $id ? \Soulcms\Service::L('input')->system_log($this->name.'：修改('.$logname.')') : \Soulcms\Service::L('input')->system_log($this->name.'：新增('.$logname.')');
            // 获取新的存储id
            $id = $rt['code'];
            // 附件归档
            SYS_ATTACHMENT_DB && $attach && \Soulcms\Service::M('Attachment')->handle(isset($data['uid']) ? $data['uid'] : $this->member['id'], \Soulcms\Service::M()->dbprefix($this->init['table']).'-'.$id, $attach);
            // 删除临时存储数据
            \Soulcms\Service::L('Form')->auto_form_data_delete($name);
            // 执行回调方法
            $this->_Call_Post($rt['data']);
        }

        // 内容不存在
        if (!$data && $id) {
            IS_ADMIN ? $this->_admin_msg(0, mys_lang('数据#%s不存在', $id)) : $this->_msg(0, mys_lang('数据#%s不存在', $id));
            return [null, null];
        }

        // 默认获取表单自动存储的数据
        defined('SYS_AUTO_FORM') && SYS_AUTO_FORM
        && !$id && $this->auto_save && $data = \Soulcms\Service::L('Form')->auto_form_data($name, $data);

        // 当存在草稿时系统默认加载草稿数据
        $draft && $data = $draft;

        // 主要数据
        $mydata = $data;

        // 获取从get中栏目参数
        $this->is_get_catid && $data['catid'] = $mydata['catid'] = $this->is_get_catid;

        // 是否包在data里面
        $is_data && $data['data'] = $mydata;

        // 获取自定义字段表单控件
        list($my_field, $sys_field, $diy_field, $cat_field) = $this->_field_group($mydata);
        $data['myfield'] = \Soulcms\Service::L('Field')->toform($id, $my_field, $mydata);
        $data['sysfield'] = \Soulcms\Service::L('Field')->toform($id, $sys_field, $mydata);
        $data['diyfield'] = \Soulcms\Service::L('Field')->toform($id, $diy_field, $mydata);
        $data['catfield'] = \Soulcms\Service::L('Field')->toform($id, $cat_field, $mydata);

        // 动态实时存储表单值
        !$id && $this->auto_save && $data['auto_form_data_ajax'] = \Soulcms\Service::L('Form')->auto_form_data_ajax($name);

        // 表单隐藏域
        $data['form'] = mys_form_hidden([
            'id' => $id,
            'table' => IS_ADMIN ? $this->init['table'] : '',
        ]);

        // 获取添加URL
        $data['post_url'] = IS_MEMBER ? \Soulcms\Service::L('Router')->member_url(\Soulcms\Service::L('Router')->uri('add'), $this->url_params) :  \Soulcms\Service::L('Router')->url(\Soulcms\Service::L('Router')->uri('add'), $this->url_params);

        // 获取返回URL
        $data['reply_url'] = \Soulcms\Service::L('Router')->get_back(\Soulcms\Service::L('Router')->uri('index'), $this->url_params);
        $data['uriprefix'] = trim(APP_DIR.'/'.\Soulcms\Service::L('Router')->class, '/'); // uri前缀部分
        
        // 判断是否是编辑,返回id号
        $data['is_edit'] = $id;

        \Soulcms\Service::V()->assign($data);

        return [$this->_tpl_filename('post'), $data];
    }

    /**
     * 回调保存或添加结果
     * */
    protected function _Call_Post($data) {
        $this->_json(1, mys_lang('操作成功'));
    }

    /**
     * 显示内容
     * $id      内容id,新增为0,否则视为修改
     * */
    protected function _Show($id) {

        // 获取数据
        $data = $this->_Data($id);
        // 内容不存在
        if (!$data) {
            return [null, null];
        }

        // 初始化自定义字段类
        \Soulcms\Service::L('Field')->app(APP_DIR);

        // 获取自定义字段表单控件
        list($my_field, $sys_field, $diy_field, $cat_field) = $this->_field_group($data);
        $data['myfield'] = \Soulcms\Service::L('Field')->toform($id, $my_field, $data, 1);
        $data['sysfield'] = \Soulcms\Service::L('Field')->toform($id, $sys_field, $data, 1);
        $data['diyfield'] = \Soulcms\Service::L('Field')->toform($id, $diy_field, $data, 1);
        $data['catfield'] = \Soulcms\Service::L('Field')->toform($id, $cat_field, $data, 1);

        $fields = $this->field;
        $fields['inputtime'] = ['fieldtype' => 'Date'];
        $fields['updatetime'] = ['fieldtype' => 'Date'];

        // 格式化字段
        $page = max(1, (int)\Soulcms\Service::L('input')->get('page'));
        $data = \Soulcms\Service::L('Field')->format_value($fields, $data, $page);

        // 获取返回URL
        $data['reply_url'] = \Soulcms\Service::L('Router')->get_back(\Soulcms\Service::L('Router')->uri('index'), $this->url_params);
        $data['uriprefix'] = trim(APP_DIR.'/'.\Soulcms\Service::L('Router')->class, '/'); // uri前缀部分

        \Soulcms\Service::V()->assign($data);

        return [$this->_tpl_filename('show'), $data];
    }

    /**
     * 批量删除数据
     * $ids
     * $before 删除前执行的操作
     * $after 删除后执行的操作
     * $attach 删除关联附件
     * */ 
    protected function _Del($ids, $before = null, $after = null, $attach = 0) {

        !$ids && $this->_json(0, mys_lang('所选数据不存在'));

        $rows = \Soulcms\Service::M()->init($this->init)->where_in('id', $ids)->getAll();
        !$rows && $this->_json(0, mys_lang('所选数据不存在2'));

        // 删除之前执行
        if ($before) {
            $rt = call_user_func_array($before, [$rows]);
            !$rt['code'] && $this->_json(0, $rt['msg']);
            $rt['data'] && $rows = $rt['data'];
        }
        
        // 删除数据
        $ids = [];
        foreach ($rows as $t) {
            $id = intval($t['id']);
            $rt = \Soulcms\Service::M()->init($this->init)->delete($id, $this->delete_where);
            !$rt['code'] && $this->_json(0, $rt['msg']);
            if ($this->is_data) {
                // 附表存储
                $rt = \Soulcms\Service::M()->init($this->init)->table($this->init['table'].'_data_'.intval($t['tableid']))->delete($id, $this->delete_where);
                !$rt['code'] && $this->_json(0, $rt['msg']);
            }
            // 删除附件
            SYS_ATTACHMENT_DB && $attach && \Soulcms\Service::M('Attachment')->cid_delete((int)$t['uid'], $id, $attach);
            $ids[] = $id;
        }

        // 删除之后执行
        $after && call_user_func_array($after, [$rows]);

        // 写入日志
        \Soulcms\Service::L('input')->system_log($this->name.'：删除('.implode(', ', $ids).')');
        
        $this->_json(1, mys_lang('操作成功'));
    }

    /**
     * 数据列表显示
     * $p      URL指定参数
     * $size   指定分页数据量
     * */
    protected function _List($p = [], $size = 0) {

        // 分页数量控制
        if (!$this->list_pagesize) {
            if (!$size) {
                if (IS_ADMIN) {
                    $size = (int)SYS_ADMIN_PAGESIZE;
                } else {
                    $size = (int)$this->member_cache['config']['pagesize'];
                    if (IS_API_HTTP) {
                        $size = (int)$this->member_cache['config']['pagesize_api'];
                    } elseif (\Soulcms\Service::IS_MOBILE()) {
                        $size = (int)$this->member_cache['config']['pagesize_mobile'];
                    }
                }
            }
            !$size && $size = 10;
        } else {
            $size = $this->list_pagesize;
        }

        // 查询数据结果
        list($list, $total, $param) = \Soulcms\Service::M()->init($this->init)->limit_page($size);
        $p && $param = $p + $param;
        $sql = \Soulcms\Service::M()->get_sql_query();

        // 分页URL格式
        $this->url_params && $param = mys_array22array($param, $this->url_params);
        $uri =\Soulcms\Service::L('Router')->uri();
        $url = IS_ADMIN ?\Soulcms\Service::L('Router')->url($uri, $param) :\Soulcms\Service::L('Router')->member_url($uri, $param);
        $url = $url.'&page={page}';

        // 分页输出样式
        if (IS_ADMIN) {
            $config = require CMSPATH.'Config/Apage.php';
        } else {
            $file = 'config/page/'.(\Soulcms\Service::IS_PC() ? 'pc' : 'mobile').'/member.php';
            if (is_file(WEBPATH.$file)) {
                $config = require WEBPATH.$file;
            } elseif (is_file(ROOTPATH.$file)) {
                $config = require ROOTPATH.$file;
            } else {
                exit('无法找到分页配置文件【'.$file.'】');
            }
        }

        // 存储当前页URL
       \Soulcms\Service::L('Router')->set_back(\Soulcms\Service::L('Router')->uri(), $param);

        $list_field = [];
        // 筛选出可用的字段
        if ($this->init['list_field']) {
            foreach ($this->init['list_field'] as $i => $t) {
                $t['use'] && $list_field[$i] = $t;
            }
        }
        
        // 默认显示字段
        !$list_field && $this->init['show_field'] && $list_field = [
            $this->init['show_field'] => [
                'name' => mys_lang('主题'),
                'func' => 'title',
                'width' => 0,
            ],
        ];

        // 查询表名称
        $list_table = \Soulcms\Service::M()->dbprefix($this->init['table']);
        if (isset($this->init['join_list'][0]) && $this->init['join_list'][0]) {
            $list_table.= ','.\Soulcms\Service::M()->dbprefix($this->init['join_list'][0]);
        }
        // 返回数据
        $data = [
            'list' => $list,
            'total' => $total,
            'param' => $param,
            'mypages' => \Soulcms\Service::L('input')->table_page($url, $total, $config, $size),
            'my_file' => $this->_tpl_filename('table'),
            'uriprefix' => trim(APP_DIR.'/'.\Soulcms\Service::L('Router')->class, '/'), // uri前缀部分
            'list_field' => $list_field, // 列表显示的可用字段
            'list_query' => urlencode(mys_authcode($sql, 'ENCODE')), // 查询列表的sql语句
            'list_table' => $list_table, // 查询列表的数据表名称
        ];

        // 过滤搜索变量
        $field = \Soulcms\Service::V()->get_value('field');
        if ($field) {
            foreach ($field as $i => $t) {
                if (!$t['fieldtype']) {
                    continue;
                } elseif (!in_array($t['fieldtype'], [
                    'Text',
                    'Textarea',
                    'Textbtn',
                    'Ueditor',
                    'Select',
                    'Radio',
                ])) {
                    unset($field[$i]);
                }
            }
            $data['field'] = $field;
        }

        \Soulcms\Service::V()->assign($data);

        return [$this->_tpl_filename('list'), $data];
    }

    // 获取模板文件名
    public function _tpl_filename($name) {

        if (IS_ADMIN) {
            $my_file = is_file(APPPATH.'Views/'.$this->tpl_name.'_'.$name.'.html') ? $this->tpl_name.'_'.$name.'.html' : $this->tpl_prefix.$name.'.html';
        } else {
            $my_file = is_file(mys_tpl_path().$this->tpl_name.'_'.$name.'.html') ? $this->tpl_name.'_'.$name.'.html' : $this->tpl_prefix.$name.'.html';
        }

        return $my_file;
    }

}
