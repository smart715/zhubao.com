<?php namespace Soulcms\Library;

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


/**
 * 列表格式化函数库
 */

class Function_list
{

    private $uid_data = [];

    // 用于列表显示栏目
    function catid($catid, $param = [], $data = []) {

        $url = IS_ADMIN ? \Soulcms\Service::L('router')->url(APP_DIR.'/'.$_GET['c'].'/index', ['catid' => $catid]) : mys_url_prefix(mys_cat_value(APP_DIR, $catid, 'url'), MOD_DIR).'" target="_blank';
        $value = mys_cat_value(APP_DIR, $catid, 'name');

        return '<a href="'.$url.'">'.mys_strcut($value, 10).'</a>';
    }

    // 用于列表显示内容
    function comment($value, $param = [], $data = []) {

        return $this->content($value, $param, $data);
    }

    // 用于列表显示内容
    function content($value, $param = [], $data = []) {

        $value = mys_clearhtml($value);
        $title = mys_replace_emotion(mys_keyword_highlight(mys_strcut($value, 30), $param['keyword']));
        !$title && $title = '...';

        return isset($data['url']) && $data['url'] ? '<a href="'.mys_url_prefix($data['url'], MOD_DIR).'" target="_blank" title="'.$value.'">'.$title.'</a>' : $title;
    }

    // 用于列表显示联动菜单值
    function linkage_address($value, $param = [], $data = []) {

        return mys_linkage('address', $value, 0, 'name');
    }

    // 用于列表显示状态
    function status($value, $param = [], $data = []) {

        return '<label>'.($value ? '<span class="label label-sm label-success">'.mys_lang('已通过') : '<span class="label label-sm label-danger">'.mys_lang('待审核')).'</span></label>';
    }

    // 用于列表显示标题
    function title($value, $param = [], $data = []) {

        $value = mys_clearhtml($value);
        $title = ($data['thumb'] ? '<i class="fa fa-photo"></i> ' : '').mys_keyword_highlight(mys_strcut($value, 30), $param['keyword']);
        !$title && $title = '...';

        return isset($data['url']) && $data['url'] ? ('<a href="'.mys_url_prefix($data['url'], MOD_DIR).'" target="_blank" title="'.$value.'">'.$title.'</a>'.($data['link_id'] > 0 ? '  <i class="fa fa-link font-green" title="'.mys_lang('同步链接').'"></i>' : '')) : $title;
    }

    // 用于列表显示时间日期格式
    function datetime($value, $param = [], $data = []) {
        return mys_date($value, null, 'red');
    }

    // 用于列表显示日期格式
    function date($value, $param = [], $data = []) {
        return mys_date($value, 'Y-m-d', 'red');
    }

    // 用于列表显示作者
    function author($value, $param = [], $data = []) {
        if ($value == 'guest') {
            return mys_lang('游客');
        } elseif ((isset($data['username']) || isset($data['author'])) && $data['uid']) {
            // 模块需要重新查询名字
            $member = $this->uid_data[$data['uid']] = isset($this->uid_data[$data['uid']]) && $this->uid_data[$data['uid']] ? $this->uid_data[$data['uid']] : \Soulcms\Service::M('member')->username($data['uid']);
        } else {
            $member = $value;
        }
        return '<a class="fc_member_show" href="javascript:;" member="'.$member.'">'.mys_strcut($value, 10).'</a>';
    }

    // 用于列表显示作者
    function uid($uid, $param = [], $data = []) {
        // 查询username
        $this->uid_data[$uid] = isset($this->uid_data[$uid]) && $this->uid_data[$uid] ? $this->uid_data[$uid] : \Soulcms\Service::M('member')->username($uid);
        return '<a class="fc_member_show" href="javascript:;" member="'.$this->uid_data[$uid].'">'.mys_strcut($this->uid_data[$uid], 10).'</a>';
    }

    // 用于列表显示ip地址
    function ip($value, $param = [], $data = [], $len = 200) {
        return '<a href="http://www.ip138.com/ips138.asp?ip='.$value.'&action=2" target="_blank">'.mys_strcut(\Soulcms\Service::L('ip')->address($value), $len).'</a>';
    }

    // 用于列表显示作者
    function files($value, $param = [], $data = []) {
        return mys_lang($value ? '有' : '无');
    }

    // 用于列表显示价格
    function price($value, $param = [], $data = []) {
        return '<span style="color:#ef4c2f">￥'.number_format($value, 2).'</span>';
    }

    // 用于列表显示价格、库存
    function price_quantity($value, $param = [], $data = []) {
        return '<span style="color:#ef4c2f">￥'.number_format($value, 2).'</span> / '.$data['price_quantity'];
    }


}