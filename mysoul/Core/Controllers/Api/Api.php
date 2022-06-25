<?php namespace Soulcms\Controllers\Api;

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



// 通用接口处理
class Api extends \Soulcms\Home\Api
{

	/**
     * 保存浏览器定位坐标
     */
    public function baidu_position() {

        $value = mys_safe_replace(\Soulcms\Service::L('input')->get('value'));
        $cookie = \Soulcms\Service::L('input')->get_cookie('baidu_position');
        if ($cookie != $value) {
            \Soulcms\Service::L('input')->set_cookie('baidu_position', $value, 10000);
            exit('ok');
        }
        exit('none');
    }

    /**
     * 二维码显示
     */
    public function qrcode() {

        $value = urldecode(\Soulcms\Service::L('input')->get('text'));
        $thumb = urldecode(\Soulcms\Service::L('input')->get('thumb'));
        $matrixPointSize = (int)\Soulcms\Service::L('input')->get('size');
        $errorCorrectionLevel = mys_safe_replace(\Soulcms\Service::L('input')->get('level'));

        //生成二维码图片
        require_once FCPATH.'ThirdParty/Qrcode/Phpqrcode.php';
        $QR = WRITEPATH.'caching/qrcode-'.md5($value.$thumb.$matrixPointSize.$errorCorrectionLevel).'-qrcode.png';
        \QRcode::png($value, $QR, $errorCorrectionLevel, $matrixPointSize, 3);
        $QR = imagecreatefromstring(file_get_contents($QR));

        if ($thumb) {
            $logo = imagecreatefromstring(file_get_contents($thumb));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 4;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            //重新组合图片并调整大小
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }

        // 输出图片
        ob_start();
        ob_clean();
        header("Content-type: image/png");
        ImagePng($QR);
        exit;
    }

    /**
     * 搜索
     */
    public function search() {

        $dir = mys_safe_replace(\Soulcms\Service::L('input')->get('dir'));
        if (!$dir) {
            $this->_msg(0, mys_lang('模块参数不能为空'));
        } elseif (!mys_is_module($dir)) {
            $this->_msg(0, mys_lang('模块[%s]未安装', $dir));
        }
        $keyword = mys_safe_replace(\Soulcms\Service::L('input')->get('keyword'));
        // 跳转url
        mys_redirect(\Soulcms\Service::L('Router')->search_url([], 'keyword', $keyword, $dir));
    }

    /**
     * 检查关键字
     */
    public function checktitle() {

        // 获取参数
        $id = (int)\Soulcms\Service::L('input')->get('id');
        $title = mys_safe_replace(\Soulcms\Service::L('input')->get('title'));
        $module = mys_safe_replace(\Soulcms\Service::L('input')->get('module'));

        // 判断参数
        (!$title || !$module) && exit('');

        // 判断模块
        !\Soulcms\Service::L('cache')->get('module-'.SITE_ID.'-'.$module) && exit('');

        // 判断是否重复存在
        $num = \Soulcms\Service::M()->db->table(SITE_ID.'_'.$module)->where('id<>', $id)->where('title', $title)->countAllResults();
        $num ? exit(mys_lang('重复')) : exit('');
    }

    /**
     * 提取关键字
     */
    public function getkeywords() {

        $kw = mys_get_keywords(mys_safe_replace(\Soulcms\Service::L('input')->get('title')));
        exit($kw);
    }

    /**
     * 存储临时表单内容
     */
    public function save_form_data() {

        $rt = \Soulcms\Service::L('cache')->init('file')->save(
            mys_safe_filename(\Soulcms\Service::L('input')->get('name')),
            \Soulcms\Service::L('input')->post('data'),
            7200
        );
        var_dump($rt);
        exit;
    }

    /**
     * 删除临时表单内容
     */
    public function delete_form_data() {
        \Soulcms\Service::L('cache')->init('file')->delete(mys_safe_filename(\Soulcms\Service::L('input')->get('name', true)));
        $this->_json(1, mys_lang('清除成功'));
        exit;
    }

    /**
     * 验证码
     */
    public function captcha() {

        $w = intval($_GET['width']);
        $h = intval($_GET['height']);
        $code = \Soulcms\Service::L('captcha')->create($w, $h);
        $this->session()->set('captcha', $code);
        exit();
    }

    /**
     * 汉字转换拼音
     */
    public function pinyin() {
        $name = mys_safe_replace(\Soulcms\Service::L('input')->get('name'));
        !$name && exit('');
        $py = \Soulcms\Service::L('pinyin')->result($name);
        if (strlen($py) > 12) {
            $sx = \Soulcms\Service::L('pinyin')->result($name, 0);
            $sx && exit($sx);
        }
        exit($py);

    }


    /**
     * 联动菜单调用
     */
    public function linkage() {

        $pid = (int)\Soulcms\Service::L('input')->get('parent_id');
        $code = mys_safe_replace(\Soulcms\Service::L('input')->get('code'));
        $linkage = \Soulcms\Service::L('cache')->get('linkage-'.SITE_ID.'-'.$code);

        $json = array();
        foreach ($linkage as $v) {
            $v['pid'] == $pid && $json[] = array('region_id' => $v['ii'], 'region_name' => $v['name']);
        }

        echo json_encode($json);exit;
    }

    /**
     * Ajax调用字段属性表单
     *
     * @return void
     */
    public function field() {

        $id = (int)\Soulcms\Service::L('input')->get('id');
        $app = mys_safe_replace(\Soulcms\Service::L('input')->get('app'));
        $type = mys_safe_replace(\Soulcms\Service::L('input')->get('type'));

        // 关联表
        \Soulcms\Service::M('field')->relatedid = mys_safe_replace(\Soulcms\Service::L('input')->get('relatedid'));
        \Soulcms\Service::M('field')->relatedname = mys_safe_replace(\Soulcms\Service::L('input')->get('relatedname'));

        // 获取全部字段
        $all = \Soulcms\Service::M('field')->get_all();
        $data = $id ? $all[$id] : null;
        $value = $data ? $data['setting']['option'] : []; // 当前字段属性信息

        list($option, $style) = \Soulcms\Service::L('field')->app($app)->option($type, $value, $all);

        exit(json_encode(['option' => $option, 'style' => $style]));
    }


    /**
     * 动态调用模板
     */
    public function template() {

        $file = mys_safe_filename(\Soulcms\Service::L('input')->get('name'));
        $module = mys_safe_filename(\Soulcms\Service::L('input')->get('module'));

        if ($module) {
            $this->_module_init($module);
            \Soulcms\Service::V()->module($module);
        }

        \Soulcms\Service::V()->assign(\Soulcms\Service::L('input')->get('', true));

        ob_start();
        \Soulcms\Service::V()->display($file);
        $html = ob_get_contents();
        ob_clean();

        if (isset($_GET['format']) && $_GET['format'] == 'json') {
            $this->_json(1, $html, [
                'file' => $file,
                'module' => $module,
            ]);
        } else if (isset($_GET['format']) && $_GET['format'] == 'text') {
            exit($html);
        }

        $this->_jsonp(1, $html, [
            'file' => $file,
            'module' => $module,
        ]);
    }

    /**
     * 内容关联字段数据读取
     */
    public function related() {

        // 强制将模板设置为后台
        \Soulcms\Service::V()->admin();

        // 登陆判断
        !$this->uid && $this->_json(0, mys_lang('会话超时，请重新登录'));

        // 参数判断
        $dirname = mys_safe_filename(\Soulcms\Service::L('input')->get('module'));
        !$dirname && $this->_json(0, mys_lang('module参数不存在'));

        // 站点选择
        $site = max(1, (int)$_GET['site']);

        // 模块缓存判断
        $module = $this->get_cache('module-'.$site.'-'.$dirname);
        !$module && $this->_json(0, mys_lang('模块（%s）不存在', $dirname));

        $module['field']['id'] = array(
            'name' => 'Id',
            'ismain' => 1,
            'fieldtype' => 'Text',
            'fieldname' => 'id',
        );

        $builder = \Soulcms\Service::M()->db->table($site.'_'.$dirname);

        if ($this->member['adminid'] > 0) {
            $module['field']['author'] = array(
                'name' => mys_lang('作者'),
                'ismain' => 1,
                'fieldtype' => 'Text',
                'fieldname' => 'author',
            );
        }

        // 搜索结果显示条数
        $limit = (int)$_GET['limit'];
        $limit = $limit ? $limit : 50;


        if (IS_POST) {
            $ids = \Soulcms\Service::L('input')->get_post_ids();
            !$ids && $this->_json(0, mys_lang('没有选择项'));
            $id = array();
            foreach ($ids as $i) {
                $id[] = (int)$i;
            }
            $builder->whereIn('id', $id);
            $list = $builder->limit($limit)->orderBy('updatetime DESC')->get()->getResultArray();
            !$list && $this->_json(0, mys_lang('没有相关数据'));
            $rt = [];
            foreach ($list as $t) {
                $rt[] = [
                    'id' => $t['id'],
                    'value' => '<a href="'.$t['url'].'" tagreg="_blank">'.$t['title'].'</a>'
                ];
            }
            $this->_json(1, mys_lang('操作成功'), ['result' => $rt]);
        }

        $data = $_GET;

        if ($data['search']) {
            $catid = (int)$data['catid'];
            $catid && $builder->whereIn('catid', $module['category'][$catid]['catids']);
            $data['keyword'] = mys_safe_replace(urldecode($data['keyword']));
            if (isset($data['keyword']) && $data['keyword']
                && $data['field'] && isset($module['field'][$data['field']])) {
                $data['keyword'] = mys_safe_replace(urldecode($data['keyword']));
                if ($data['field'] == 'id') {
                    // id搜索
                    $id = array();
                    $ids = explode(',', $data['keyword']);
                    foreach ($ids as $i) {
                        $id[] = (int)$i;
                    }
                    $builder->whereIn('id', $id);
                } else {
                    // 其他模糊搜索
                    $builder->like($data['field'], $data['keyword']);
                }
            }
        }

        sort($module['field']);
        $db = $builder->limit($limit)->orderBy('updatetime DESC')->get();
        $list = $db ? $db->getResultArray() : [];

        \Soulcms\Service::V()->assign(array(
            'list' => $list,
            'param' => $data,
            'field' => $module['field'],
            'select' => \Soulcms\Service::L('tree')->select_category(
                $module['category'],
                $data['catid'],
                'name="catid"',
                '--'
            ),
            'category' => $module['category'],
            'search' => mys_form_search_hidden(['search' => 1, 'module' => $dirname, 'site' => $site, 'limit' => $limit]),
        ));
        \Soulcms\Service::V()->display('api_related.html');exit;
    }

    /**
     * 会员关联字段数据读取
     */
    public function members() {

        // 强制将模板设置为后台
        \Soulcms\Service::V()->admin();

        // 登陆判断
        !$this->uid && $this->_json(0, mys_lang('会话超时，请重新登录'));


        $field = array(
            'id' => array(
                'ismain' => 1,
                'name' => 'Uid',
                'fieldname' => 'username',
                'fieldtype' => 'Text',
            ),
            'username' => array(
                'ismain' => 1,
                'name' => mys_lang('账号'),
                'fieldname' => 'username',
                'fieldtype' => 'Text',
            ),
            'email' => array(
                'ismain' => 1,
                'name' => mys_lang('邮箱'),
                'fieldname' => 'email',
                'fieldtype' => 'Text',
            ),
            'phone' => array(
                'ismain' => 1,
                'name' => mys_lang('手机'),
                'fieldname' => 'phone',
                'fieldtype' => 'Text',
            ),
            'name' => array(
                'ismain' => 1,
                'name' => mys_lang('姓名'),
                'fieldname' => 'name',
                'fieldtype' => 'Text',
            ),
        );

        $builder = \Soulcms\Service::M()->db->table('member');


        // 搜索结果显示条数
        $limit = (int)$_GET['limit'];
        $limit = $limit ? $limit : 50;


        if (IS_POST) {
            $ids = \Soulcms\Service::L('input')->get_post_ids();
            !$ids && $this->_json(0, mys_lang('没有选择项'));
            $id = array();
            foreach ($ids as $i) {
                $id[] = (int)$i;
            }
            $builder->whereIn('id', $id);
            $list = $builder->limit($limit)->orderBy('id DESC')->get()->getResultArray();
            !$list && $this->_json(0, mys_lang('没有相关数据'));
            $rt = [];
            foreach ($list as $t) {
                $rt[] = [
                    'id' => $t['id'],
                    'value' => '<img class="img-circle" src="'.mys_avatar($t['id']).'" style="width:30px;height:30px;margin-right:10px;"> '.$t['username'],
                ];
            }
            $this->_json(1, mys_lang('操作成功'), ['result' => $rt]);
        }

        $data = $_GET;

        if ($data['search']) {
            $gid = (int)$data['groupid'];
            if ($gid) {
                $builder->where('`id` IN (select uid from `'.\Soulcms\Service::M()->dbprefix('member_group_index').'` where gid='.$gid.')');
            }
            $data['keyword'] = mys_safe_replace(urldecode($data['keyword']));
            if (isset($data['keyword']) && $data['keyword']
                && $data['field'] && isset($field[$data['field']])) {
                $data['keyword'] = mys_safe_replace(urldecode($data['keyword']));
                if ($data['field'] == 'id') {
                    // id搜索
                    $id = array();
                    $ids = explode(',', $data['keyword']);
                    foreach ($ids as $i) {
                        $id[] = (int)$i;
                    }
                    $builder->whereIn('id', $id);
                } else {
                    // 其他模糊搜索
                    $builder->like($data['field'], $data['keyword']);
                }
            }
        }

        $db = $builder->limit($limit)->orderBy('id DESC')->get();
        $list = $db ? $db->getResultArray() : [];

        \Soulcms\Service::V()->assign(array(
            'list' => $list,
            'param' => $data,
            'field' => $field,
            'group' => $this->member_cache['group'],
            'search' => mys_form_search_hidden(['search' => 1, 'limit' => $limit]),
        ));
        \Soulcms\Service::V()->display('api_members.html');exit;
    }

    /**
     * 退出前台账号
     */
    public function loginout() {

        // 注销授权登陆的会员
        if ($this->session()->get('member_auth_uid')) {
            \Soulcms\Service::C()->session()->delete('member_auth_uid');
            $this->_json(0, mys_lang('当前状态无法退出账号'));
        }

        $this->_json(1, mys_lang('您的账号已退出系统'), [
            'url' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITE_URL,
            'sso' => \Soulcms\Service::M('member')->logout(),
        ]);
    }

    /**
     * 电脑和手机网站切换处理接口
     */
    public function client() {

        $at = \Soulcms\Service::L('input')->get('at');
        if ($at == 'select') {
            $url = urldecode(\Soulcms\Service::L('input')->get('url'));
            !is_file(WRITEPATH.'config/domain_client.php') && $this->_json(0, mys_lang('配置文件domain_client不存在'));

            $domain = require WRITEPATH.'config/domain_client.php';
            !$domain && $this->_json(0, mys_lang('系统没有绑定手机域名'));

            $url = mys_http_prefix($url);
            $temp = parse_url($url);
            $host = $temp['host'];
            $value = 0;
            if (isset($domain[$host])) {
                // 如果现在是电脑端,我们就找对应的移动端域名
                $value = 0;
            } else {
                $domain = array_flip($domain);
                !isset($domain[$host]) && $this->_json(0, mys_lang('域名%s切换失败', $host));
                $value = 1;
            }
            \Soulcms\Service::L('input')->set_cookie('is_mobile', $value, $value ? 3600 : -3600);
            $url = str_replace($host, $domain[$host], $url);
            //$url = '';
            $sync = [];
            foreach ($domain as $url1 => $url2) {
                $sync[] = mys_http_prefix($url1).'/index.php?s=api&c=api&m=client&value='.$value;
                $sync[] = mys_http_prefix($url2).'/index.php?s=api&c=api&m=client&value='.$value;
            }
            $this->_json(1, mys_lang('正在切换: %s', $url), ['sso' => $sync, 'url' => $url]);
        } else {
            $value = (int)\Soulcms\Service::L('input')->get('value');
            \Soulcms\Service::L('input')->set_cookie('is_mobile', $value, $value ? 3600 : -3600);
            $this->_jsonp(1, 'ok');
        }
        exit;

    }


}
