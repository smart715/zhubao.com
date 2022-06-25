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


class Catids extends \Soulcms\Library\A_Field {
	
	/**
     * 构造函数
     */
    public function __construct(...$params) {
        parent::__construct(...$params);
        $this->fieldtype = ['TEXT' => ''];
        $this->defaulttype = 'TEXT';
    }
	
	/**
	 * 字段相关属性参数
	 *
	 * @param	array	$value	值
	 * @return  string
	 */
	public function option($option) {


		return ['
                <div class="form-group">
                  	<label class="col-md-2 control-label">'.mys_lang('重要提醒').'</label>
                    <div class="col-md-9"><label class="form-control-static">本字段名一定要是catids才能参与搜索</label></div>
                </div>
				', '<div class="form-group">
			<label class="col-md-2 control-label">'.mys_lang('控件宽度').'</label>
			<div class="col-md-9">
				<label><input type="text" class="form-control" size="10" name="data[setting][option][width]" value="'.$option['width'].'"></label>
				<span class="help-block">'.mys_lang('[整数]表示固定宽带；[整数%]表示百分比').'</span>
			</div>
		</div>'];
	}

	
	/**
	 * 字段输出
	 */
	public function output($value) {
        return mys_string2array($value);
	}

	/**
	 * 字段入库值
	 *
	 * @param	array	$field	字段信息
	 * @return  void
	 */
	public function insert_value($field) {
        $save = [];
        $data = \Soulcms\Service::L('Field')->post[$field['fieldname']];
        $category = \Soulcms\Service::C()->_module_member_category(\Soulcms\Service::C()->module['category'], \Soulcms\Service::C()->module['dirname'], 'add');
        if (!IS_ADMIN && !$category) {
            \Soulcms\Service::C()->_json(1, mys_lang('模块[%s]没有可用栏目权限', \Soulcms\Service::C()->module['dirname']));
        }
        if ($data) {
            foreach ($data as $t) {
                if ($t) {
                    $save[] = $t;
                    if (!IS_ADMIN && !$category[$t]) {
                        \Soulcms\Service::C()->_json(1, mys_lang('模块[%s]没有栏目(%s)权限', \Soulcms\Service::C()->module['dirname'], $t));
                    }
                }
            }
            $save = array_unique($save);
        }
        \Soulcms\Service::L('Field')->data[$field['ismain']][$field['fieldname']] = mys_array2string($save);
	}

	/**
	 * 字段表单输入
	 *
	 * @param	string	$field	字段数组
	 * @param	array	$value	值
	 * @return  string
	 */
	public function input($field, $value = null) {

		// 字段禁止修改时就返回显示字符串
		if ($this->_not_edit($field, $value)) {
			return $this->show($field, $value);
		}

		// 字段存储名称
		$name = $field['fieldname'];

		// 字段显示名称
		$text = ($field['setting']['validate']['required'] ? '<span class="required" aria-required="true"> * </span>' : '').$field['name'];

		// 字段提示信息
		$tips = ($name == 'title' && APP_DIR) || $field['setting']['validate']['tips'] ? '<span class="help-block" id="mys_'.$field['fieldname'].'_tips">'.$field['setting']['validate']['tips'].'</span>' : '';


		// 开始输出
		$str = '';

        // 表单宽度设置
        $width = \Soulcms\Service::_is_mobile() ? '100%' : ($field['setting']['option']['width'] ? $field['setting']['option']['width'] : '100%');
		$str.= '<div class="dropzone-file-area" style="text-align:left" id="'.$name.'-sort-items" style="width:'.$width.(is_numeric($width) ? 'px' : '').';">';

        // 输出默认菜单
        $tpl = '<div class="catids_'.$name.'_row" id="mys_catids_'.$name.'_row_{id}">';
        $tpl.= '<label style="margin-right: 10px;"><a class="btn btn-sm " href="javascript:;" onclick="$(\'#mys_catids_'.$name.'_row_{id}\').remove()"> <i class="fa fa-close"></i> </a></label>';
        $tpl.= '<label>'.\Soulcms\Service::L('Tree')->select_category(
            \Soulcms\Service::C()->module['category'],
            0,
            ' name=\'data['.$field['fieldname'].'][]\'',
            '', 1, 1
        ).'</label>';
        $tpl.= '</div>';

        // 字段默认值
        $values = mys_string2array($value);
        if ($values) {
            foreach ($values as $id => $value) {
                if ($value) {
                    $str.= '<div class="catids_'.$name.'_row" id="mys_catids_'.$name.'_row_'.$value.'">';
                    $str.= '<label style="margin-right: 10px;"><a class="btn btn-sm " href="javascript:;" onclick="$(\'#mys_catids_'.$name.'_row_'.$value.'\').remove()"> <i class="fa fa-close"></i> </a></label>';
                    $str.= '<label>'.\Soulcms\Service::L('Tree')->select_category(
                            \Soulcms\Service::C()->module['category'],
                            $value,
                            ' name=\'data['.$field['fieldname'].'][]\'',
                            '', 1, 1
                        ).'</label>';
                    $str.= '</div>';
                }
            }
        }

		// 整体
		$str.= '</div>';
        $str.= '<div class="margin-top-10">	<a href="javascript:;" class="btn blue btn-sm" onClick="mys_add_catids_'.$name.'()"> <i class="fa fa-plus"></i> '.mys_lang('添加').' </a>';
        $str.= '</div>';
        $str.= '<script type="text/javascript">
		function mys_add_catids_'.$name.'() {
			var id=($("#'.$name.'-sort-items .catids_'.$name.'_row").size() + 1) * 10;
			var html = "'.addslashes(str_replace(PHP_EOL, '', $tpl)).'";
			html = html.replace(/\{id\}/g, id);
			$("#'.$name.'-sort-items").append(html);
		}
		
		</script><span class="help-block">'.$tips.'</span>';
		return $this->input_format($name, $text, $str);
	}

    /**
     * 字段表单显示
     *
     * @param	string	$field	字段数组
     * @param	array	$value	值
     * @return  string
     */
    public function show($field, $value = null) {


        return $this->input_format($field['fieldname'], $field['name'], '<div class="form-control-static">'.mys_linkagepos($field['setting']['option']['linkage'], $value, ' - ').'</div>');
    }

}