<?php namespace Soulcms\Field;

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
 * 本文件是框架系统文件，二次开发时不建议修改本文件
 *
 * */


class Pays extends \Soulcms\Library\A_Field  {

    private $showfield = [
        'price' => '价格',
        'quantity' => '数量',
        'sn' => '编码',
    ];

	/**
     * 构造函数
     */
    public function __construct(...$params) {
        parent::__construct(...$params);
		$this->fieldtype = ['DECIMAL' => '10,2']; // TRUE表全部可用字段类型,自定义格式为 array('可用字段类型名称' => '默认长度', ... )
		$this->defaulttype = 'DECIMAL'; // 当用户没有选择字段类型时的缺省值
    }

	/**
	 * 字段相关属性参数
	 *
	 * @param	array	$value	值
	 * @return  string
	 */
	public function option($option, $field = null) {

        !$option['payfile'] && $option['payfile'] = 'buy.html';
        !$option['field'] && $option['field'] = [];
        $myfield = $this->showfield;
        foreach ($field as $t) {
            $t['fieldtype'] == 'Paystext' && $myfield[$t['fieldname']] = $t['name'];
        }
        $html = '';
        foreach ($myfield as $id => $t) {
            $html.= '<p style="margin-bottom:10px">';
            $html.= '<input type="checkbox" name="data[setting][option][field][]" '.(in_array($id, $option['field']) ? 'checked' : '').' value="'.$id.'" data-on-text="'.$t.'" data-off-text="'.mys_lang('禁用').'" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
		';
            $html.= '</p>';
        }

	    $opt = '
	    <div class="form-group">
			<label class="col-md-2 control-label">'.mys_lang('模板文件').'</label>
			<div class="col-md-9">
				<label><input type="text" class="form-control" size="20" name="data[setting][option][payfile]" value="'.$option['payfile'].'"></label>
				<span class="help-block">'.mys_lang('模板位于./config/pay/模板文件名').'</span>
			</div>
		</div>
	    <div class="form-group">
			<label class="col-md-2 control-label">'.mys_lang('余额付款').'</label>
			<div class="col-md-9">
			<input type="checkbox" name="data[setting][option][is_finecms]" '.($option['is_finecms'] ? 'checked' : '').' value="1" data-on-text="'.mys_lang('开启').'" data-off-text="'.mys_lang('关闭').'" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
			</div>
		</div>
	    <div class="form-group">
			<label class="col-md-2 control-label">'.mys_lang('显示参数').'</label>
			<div class="col-md-9">
			         '.$html.'
			</div>
		</div>
	    ';

        $style = '
		<div class="form-group">
			<label class="col-md-2 control-label">'.mys_lang('控件宽度').'</label>
			<div class="col-md-9">
				<label><input type="text" class="form-control" size="10" name="data[setting][option][width]" value="'.$option['width'].'"></label>
				<span class="help-block">'.mys_lang('[整数]表示固定宽带；[整数%]表示百分比').'</span>
			</div>
		</div>
		';

        return [$opt, $style];
	}

    /**
     * 创建sql语句
     */
    public function create_sql($name, $value, $cname) {
        $sql = 'ALTER TABLE `{tablename}` ADD `'.$name.'` DECIMAL(9,2) NULL , ADD `'.$name.'_sku` TEXT NULL , ADD `'.$name.'_quantity` INT(10) UNSIGNED NULL , ADD `'.$name.'_sn` VARCHAR(10) NULL';
        return $sql;
    }

    /**
     * 修改sql语句
     */
    public function alter_sql($name, $value, $cname) {
        return NULL;
    }

    /**
     * 删除sql语句
     */
    public function drop_sql($name) {
        $sql = 'ALTER TABLE `{tablename}` DROP `'.$name.'`, DROP `'.$name.'_sku`, DROP `'.$name.'_quantity`, DROP `'.$name.'_sn`';
        return $sql;
    }

    // 测试字段是否被创建成功，默认成功为0，需要继承开发
    public function test_sql($tables, $field) {

        if (!$tables) {
            return 0;
        }

        foreach ($tables as $table) {
            if (!\Soulcms\Service::M()->db->fieldExists($field.'_sku', $table)) {
                return '给表['.$table.']创建字段['.$field.'_sku'.']失败';
            }
            if (!\Soulcms\Service::M()->db->fieldExists($field.'_quantity', $table)) {
                return '给表['.$table.']创建字段['.$field.'_quantity'.']失败';
            }
            if (!\Soulcms\Service::M()->db->fieldExists($field.'_sn', $table)) {
                return '给表['.$table.']创建字段['.$field.'_sn'.']失败';
            }
            if (!\Soulcms\Service::M()->db->fieldExists($field, $table)) {
                return '给表['.$table.']创建字段['.$field.']失败';
            }
        }

        return 0;
    }

    // 显示字段
    private function _get_myfield($field) {

        $my = [];
        $_field = \Soulcms\Service::L('Field')->get_myfields();
        foreach ($field['setting']['option']['field'] as $ff) {
            if (isset($this->showfield[$ff])) {
                $my[$ff] = $this->showfield[$ff];
            } elseif (isset($_field[$ff])) {
                $my[$ff] = $_field[$ff]['name'];
            } else {
                continue;
            }
        }

        return $my;
    }

    /**
     * 字段入库值
     *
     * @param	array	$field	字段信息
     * @return  void
     */
    public function insert_value($field) {

        if ((int)$_POST['is_field_pay']) {
            // 组合
            $price = 0;
            $quantity = 0;
            $sku = $_POST['data'][$field['fieldname'].'_sku'];
            if ($sku['value']) {
                $price_array = [];
                foreach ($sku['value'] as $v) {
                    $quantity+= intval($v['quantity']);
                    $price_array[] = $v['price'];
                }
                $price = min($price_array);
            }
            \Soulcms\Service::L('Field')->data[$field['ismain']][$field['fieldname']] = (float)$price;
            \Soulcms\Service::L('Field')->data[$field['ismain']][$field['fieldname'].'_sn'] = '';
            \Soulcms\Service::L('Field')->data[$field['ismain']][$field['fieldname'].'_sku'] = mys_array2string($sku);
            \Soulcms\Service::L('Field')->data[$field['ismain']][$field['fieldname'].'_quantity'] = abs((int)$quantity);
        } else {
            // 单一
            \Soulcms\Service::L('Field')->data[$field['ismain']][$field['fieldname']] = (float)$_POST[$field['fieldname']]['price'];
            \Soulcms\Service::L('Field')->data[$field['ismain']][$field['fieldname'].'_sn'] = mys_safe_replace($_POST[$field['fieldname']]['sn']);
            \Soulcms\Service::L('Field')->data[$field['ismain']][$field['fieldname'].'_sku'] = '';
            \Soulcms\Service::L('Field')->data[$field['ismain']][$field['fieldname'].'_quantity'] = (int)$_POST[$field['fieldname']]['quantity'];
            $_field = \Soulcms\Service::L('Form')->get_myfields();
            foreach ($field['setting']['option']['field'] as $ff) {
                if (isset($_field[$ff])) {
                    \Soulcms\Service::L('Field')->data[$_field[$ff]['ismain']][$ff] = (string)$_POST[$field['fieldname']][$ff];
                }
            }

        }

    }

    /**
     * 字段值
     */
    public function get_value($name, $data) {

    }

    /**
     * 字段输出
     *
     * @param	array	$value	值
     * @return  string
     */
    public function output($value) {
        return (float)$value;
    }

    /**
     * 字段表单输入
     *
     * @return  string
     */
    public function input($field, $value = [], $html = []) {

        if (!defined('FC_PAY') && (IS_MEMBER || IS_ADMIN)) {

            if (!$field['setting']['option']['field']) {
                return $this->input_format($field['fieldname'], $field['name'], '<div class="form-control-static">字段Pays没有设置显示参数</div>');
            }

            // 字段显示名称
            $text = ($field['setting']['validate']['required'] ? '<span class="required" aria-required="true"> * </span>' : '').$field['name'];

            // 字段提示信息
            $tips = $field['setting']['validate']['tips'] ? '<span class="help-block" id="mys_'.$field['fieldname'].'_tips">'.$field['setting']['validate']['tips'].'</span>' : '';

            $tpl_group = '
            <div class="portlet-body fc-sku-group" id="mys_sku_group_{id}" did="{id}">
                <input type="hidden" id="mys_sku_group_text_{id}" name="data['.$field['fieldname'].'_sku][group][{id}]" value="{name}">
		        <div class="row fc-sku-group-name">
                    <div class="col-md-6 fc-sku-group-name-input">{name}</div>
                    <div class="text-right col-md-6">
                        <button onclick="javascript:mys_sku_add_value(\'{id}\');" type="button" class="btn green btn-sm"> '.mys_lang('添加值').'</button>
                        <button onclick="javascript:mys_sku_edit_group(\'{id}\');" type="button" class="edit btn blue btn-sm"> '.mys_lang('修改').'</button>
                        <button onclick="javascript:mys_sku_save_group(\'{id}\');" type="button" class="save btn blue btn-sm" style="display:none"> '.mys_lang('保存').'</button>
                        <button onclick="javascript:mys_sku_del_group(\'{id}\');" type="button" class="btn red btn-sm"> '.mys_lang('删除').'</button>
                    </div>
                </div>
		        <div class="row fc-sku-group-body" id="mys_sku_value_{id}">
		        {value}
                </div>
            </div>
            ';

            $tpl_value = '
            <div class="fc-sku-group-value col-md-4" id="mys_sku_value_{id}_{iid}" did="{iid}">
		        <div class="input-group input-group-sm">
                    <input type="text" class="fc-sku-value-name-input form-control" onblur="mys_sku_init()" name="data['.$field['fieldname'].'_sku][name][{id}][{iid}]" fname="{id}_{iid}" value="{name}">
                    <span class="input-group-btn">
                        <button class="btn red" onclick="javascript:mys_sku_del_value(\'{id}\', \'{iid}\');" type="button"><i class="fa fa-trash"></i></button>
                    </span>
                </div>
            </div>
            ';

            // 显示字段
            $pay_html = '';
            $myfield = $this->_get_myfield($field);
            $sku_field_name = '';
            $sku_field_id = [];
            foreach ($myfield as $ff => $name) {
                $pay_html.= '<div class="form-group">
                            <label class="col-md-2 control-label">'.$name.'</label>
                            <div class="col-md-7">
                                <input type="text" name="'.$field['fieldname'].'['.$ff.']" value="'.$value[$ff].'" class="form-control input-inline input-medium">
                            </div>
                        </div>';
                $sku_field_name.= '<th>'.$name.'</th>';
                $sku_field_id[] = $ff;
            }

            $result = '';
            if (isset($value['sku']['group']) && $value['sku']['group']) {
                foreach ($value['sku']['group'] as $id => $name) {
                    $html = '';
                    if (isset($value['sku']['name'][$id]) && $value['sku']['name'][$id]) {
                        foreach ($value['sku']['name'][$id] as $iid => $vname) {
                            $html.= str_replace(
                                ['{id}', '{name}', '{iid}'],
                                [$id, $vname, $iid],
                                $tpl_value
                            );
                        }
                    }
                    $result.= str_replace(
                        ['{id}', '{name}', '{value}'],
                        [$id, $name, $html],
                        $tpl_group
                    );
                }
            }

            $ovalue = [];
            if (isset($value['sku']['value']) && $value['sku']['value']) {
                foreach ($value['sku']['value'] as $ii => $t) {
                    foreach ($sku_field_id as $if) {
                        $ovalue[$ii.'_'.$if] = $t[$if];
                    }
                }
            }


            // 是否单一模式
            $is_field_pay = $result && $ovalue ? 1 : 0;

            $str = '
            <div class="mt-radio-inline">
                <label class="mt-radio">
                    <input type="radio" onclick="$(\'#mys_field_pay\').show();$(\'#mys_field_pays\').hide();" name="is_field_pay" value="0" '.(!$is_field_pay ? 'checked' : '').'> 单一价格
                    <span></span>
                </label>
                <label class="mt-radio">
                    <input type="radio" onclick="$(\'#mys_field_pays\').show();$(\'#mys_field_pay\').hide();" name="is_field_pay" value="1" '.($is_field_pay ? 'checked' : '').'> 组合价格
                    <span></span>
                </label>
            </div>
            <div id="mys_field_pay" style="display:'.(!$is_field_pay ? 'block' : 'none').';">
                <div class="portlet light bordered">
                    
                   <div class="form-body" style="padding:30px 0 10px 0">
                   
                        '.$pay_html.'
                   </div>
                </div>
            </div>
            <div id="mys_field_pays" style="display:'.($is_field_pay ? 'block' : 'none').';">
                <p>
                    <label><button type="button" class="btn blue btn-sm" onclick="mys_sku_add_group()"> <i class="fa fa-plus"></i> 添加属性</button></label>
                    <label><button type="button" class="btn green btn-sm" onclick="mys_sku_init()"> <i class="fa fa-refresh"></i> 更新属性</button></label>
                </p>
                <div class="portlet light bordered">
                    
                    <div id="mys_sku_result">
                        '.$result.'
                    </div>
                    
                </div>
                
                
                <div id="mys_sku_table">
                        
                </div>
            
                <script type="text/javascript">
                var arrayValue = new Array();
                var tpl_group = "'.$this->_js_var($tpl_group).'";
                var tpl_value = "'.$this->_js_var($tpl_value).'";
                var field_name = "'.$field['fieldname'].'_sku";
                var sku_field_name = "'.$this->_js_var($sku_field_name).'";
                var sku_field_id = '.mys_array2string($sku_field_id).';
                arrayValue = '.($ovalue ? mys_array2string($ovalue) : 'new Array()').';
                </script>
                <script type="text/javascript" src="'.ROOT_THEME_PATH.'assets/js/sku.js"></script>
                <script type="text/javascript">
                $(function(){
                    mys_sku_init();
                });
                </script>
            </div>
            ';
            return $this->input_format($field['fieldname'], $text, $str.$tips);
        } else {

            // 付款金额
            $html['pay_value'] = $value ? $value : '';
            // 付款方式
            $html['pay_type'] = [];
            $html['pay_default'] = '';
            if (\Soulcms\Service::C()->member
                && $field['setting']['option']['is_finecms']
                && is_file(ROOTPATH.'api/pay/finecms/config.php')) {
                // 余额支付
                $html['pay_default'] = 'finecms';
                $html['pay_type']['finecms'] = require ROOTPATH.'api/pay/finecms/config.php';
            }

            if (\Soulcms\Service::C()->member_cache['payapi']) {
                foreach (\Soulcms\Service::C()->member_cache['payapi'] as $name => $t) {
                    if (!is_file(ROOTPATH.'api/pay/'.$name.'/config.php')) {
                        continue; // 排除是否存在配置文件
                    }
                    !$html['pay_default'] && $html['pay_default'] = $name;
                    $html['pay_type'][$name] = require ROOTPATH.'api/pay/'.$name.'/config.php';
                }
            }

            // 付款界面模板
            $htmlfile = $field['setting']['option']['payfile'] && is_file(WEBPATH.'config/pay/'.$field['setting']['option']['payfile']) ? WEBPATH.'config/pay/'.$field['setting']['option']['payfile'] :  ROOTPATH.'config/pay/buy.html';
            if (!is_file($htmlfile)) {
                return '支付表单模板文件不存在：'.$htmlfile;
            }

            $member = \Soulcms\Service::C()->member;
            $pay_url = \Soulcms\Service::L('router')->member_url('pay/index');

            // 获取付款界面代码
            ob_start();
            $file = \Soulcms\Service::V()->code2php(file_get_contents($htmlfile));
            require_once $file;
            $code = ob_get_clean();

            return $code;
        }
	}

    /**
     * 字段表单显示
     *
     * @param	string	$field	字段数组
     * @param	array	$value	值
     * @return  string
     */
    public function show($field, $value = null) {


        // 字段显示名称
        $text = ($field['setting']['validate']['required'] ? '<span class="required" aria-required="true"> * </span>' : '').$field['name'];


        $tpl_group = '
            <div class="portlet-body fc-sku-group" id="mys_sku_group_{id}" did="{id}">
                <input type="hidden" id="mys_sku_group_text_{id}" name="data['.$field['fieldname'].'_sku][group][{id}]" value="{name}">
		        <div class="row fc-sku-group-name">
                    <div class="col-md-6 fc-sku-group-name-input">{name}</div>
                </div>
		        <div class="row fc-sku-group-body" id="mys_sku_value_{id}">
		        {value}
                </div>
            </div>
            ';

        $tpl_value = '
            <div class="fc-sku-group-value col-md-4" id="mys_sku_value_{id}_{iid}" did="{iid}">
		        <div class="input-group input-group-sm">
                    <input type="text" class="fc-sku-value-name-input form-control" onblur="mys_sku_init()" name="data['.$field['fieldname'].'_sku][name][{id}][{iid}]" fname="{id}_{iid}" value="{name}">
                    <span class="input-group-btn">
                        <button class="btn red" onclick="javascript:mys_sku_del_value(\'{id}\', \'{iid}\');" type="button"><i class="fa fa-trash"></i></button>
                    </span>
                </div>
            </div>
            ';

        // 显示字段
        $pay_html = '';
        $myfield = $this->_get_myfield($field);
        $sku_field_name = '';
        $sku_field_id = [];
        foreach ($myfield as $ff => $name) {
            $pay_html.= '<div class="form-group">
                            <label class="col-md-2 control-label">'.$name.'</label>
                            <div class="col-md-7">
                                <div class="form-control-static">'.$value[$ff].'</div>
                            </div>
                        </div>';
            $sku_field_name.= '<th>'.$name.'</th>';
            $sku_field_id[] = $ff;
        }

        $result = '';
        if (isset($value['sku']['group']) && $value['sku']['group']) {
            foreach ($value['sku']['group'] as $id => $name) {
                $html = '';
                if (isset($value['sku']['name'][$id]) && $value['sku']['name'][$id]) {
                    foreach ($value['sku']['name'][$id] as $iid => $vname) {
                        $html.= str_replace(
                            ['{id}', '{name}', '{iid}'],
                            [$id, $vname, $iid],
                            $tpl_value
                        );
                    }
                }
                $result.= str_replace(
                    ['{id}', '{name}', '{value}'],
                    [$id, $name, $html],
                    $tpl_group
                );
            }
        }

        $ovalue = [];
        if (isset($value['sku']['value']) && $value['sku']['value']) {
            foreach ($value['sku']['value'] as $ii => $t) {
                foreach ($sku_field_id as $if) {
                    $ovalue[$ii.'_'.$if] = $t[$if];
                }
            }
        }


        // 是否单一模式
        $is_field_pay = $result && $ovalue ? 1 : 0;

        $str = '
      
            <div id="mys_field_pay" style="display:'.(!$is_field_pay ? 'block' : 'none').';">
                <div class="portlet light bordered">
                    
                   <div class="form-body" style="padding:30px 0 10px 0">
                   
                        '.$pay_html.'
                   </div>
                </div>
            </div>
            <div id="mys_field_pays" style="display:'.($is_field_pay ? 'block' : 'none').';">
               
                <div class="hide">
                    
                    <div id="mys_sku_result">
                        '.$result.'
                    </div>
                    
                </div>
                
                
                <div id="mys_sku_table">
                        
                </div>
            
                <script type="text/javascript">
                var arrayValue = new Array();
                var tpl_group = "'.$this->_js_var($tpl_group).'";
                var tpl_value = "'.$this->_js_var($tpl_value).'";
                var field_name = "'.$field['fieldname'].'_sku";
                var sku_field_name = "'.$this->_js_var($sku_field_name).'";
                var sku_field_id = '.mys_array2string($sku_field_id).';
                arrayValue = '.mys_array2string($ovalue).';
                </script>
                <script type="text/javascript" src="'.ROOT_THEME_PATH.'assets/js/sku.js"></script>
                <script type="text/javascript">
                $(function(){
                    mys_sku_init();
                });
                </script>
            </div>
            ';
        return $this->input_format($field['fieldname'], $text, $str);

    }

    // 格式化js变量
    private function _js_var($html) {

        return str_replace([PHP_EOL, chr(13)], "", addslashes($html));
    }
}