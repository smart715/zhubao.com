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


class Attachment extends \Soulcms\Common
{
    public $type;
    public $path;
    public $load_file;

	public function __construct(...$params) {
		parent::__construct(...$params);
        $this->type = [
            0 => [
                'name' => '本地磁盘',
            ],
        ];
        $this->path = FCPATH.'ThirdParty/Storage/';
        $local = mys_dir_map($this->path, 1);
        $this->load_file = [];
        foreach ($local as $dir) {
            if (is_file($this->path.$dir.'/App.php')) {
                $cfg = require $this->path.$dir.'/App.php';
                if ($cfg['id']) {
                    $this->load_file[] = $this->path.$dir.'/Config.html';
                    $this->type[$cfg['id']] = $cfg;
                }
            }
        }
	}

	public function index() {

        $data = is_file(WRITEPATH.'config/system.php') ? require WRITEPATH.'config/system.php' : [];

        if (IS_AJAX_POST) {
            $post = \Soulcms\Service::L('input')->post('data', true);
            \Soulcms\Service::M('System')->save_config($data,
                [
                    'SYS_FIELD_THUMB_ATTACH' => (int)$post['SYS_FIELD_THUMB_ATTACH'],
                    'SYS_FIELD_CONTENT_ATTACH' => (int)$post['SYS_FIELD_CONTENT_ATTACH'],
                    'SYS_ATTACHMENT_DB' => (int)$post['SYS_ATTACHMENT_DB'],
                    'SYS_ATTACHMENT_URL' => $post['SYS_ATTACHMENT_URL'],
                    'SYS_ATTACHMENT_PATH' => addslashes($post['SYS_ATTACHMENT_PATH']),
                ]
            );
            \Soulcms\Service::M('Site')->config(SITE_ID, 'image', \Soulcms\Service::L('input')->post('image'));
            \Soulcms\Service::L('input')->system_log('设置附件参数');
            // 自动更新缓存
            \Soulcms\Service::M('cache')->sync_cache('');
            $this->_json(1, mys_lang('操作成功'));
        }

        $page = intval(\Soulcms\Service::L('input')->get('page'));
        $site = \Soulcms\Service::M('Site')->config(SITE_ID);

        \Soulcms\Service::V()->assign([
            'page' => $page,
            'data' => $data,
            'form' => mys_form_hidden(['page' => $page]),
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '附件设置' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-folder'],
                    '远程附件' => [\Soulcms\Service::L('Router')->class.'/remote_index', 'fa fa-cloud'],
                    //'help' => [359],
                ]
            ),
            'image' => $site['image'],
            'remote' =>  \Soulcms\Service::C()->get_cache('attachment'),
        ]);
        \Soulcms\Service::V()->display('attachment_index.html');
	}

	public function remote_index() {

        \Soulcms\Service::V()->assign([
            'list' => \Soulcms\Service::M()->table('attachment_remote')->getAll(),
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '附件设置' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-folder'],
                    '远程附件' => [\Soulcms\Service::L('Router')->class.'/remote_index', 'fa fa-cloud'],
                    '添加' => [\Soulcms\Service::L('Router')->class.'/add', 'fa fa-plus'],
                    'help' => [88],
                ]
            ),
        ]);
        \Soulcms\Service::V()->display('attachment_remote.html');
	}

	public function add() {

	    if (IS_AJAX_POST) {
            $data = \Soulcms\Service::L('input')->post('data', true);
            $rt = \Soulcms\Service::M()->table('attachment_remote')->insert([
                'type' => intval($data['type']),
                'name' => (string)$data['name'],
                'url' => (string)$data['url'],
                'value' => mys_array2string($data['value']),
            ]);
            !$rt['code'] && $this->_json(0, $rt['msg']);
            // 自动更新缓存
            \Soulcms\Service::M('cache')->sync_cache('attachment');
            $this->_json(1, mys_lang('操作成功'));
        }
	    
        \Soulcms\Service::V()->assign([
            'form' => mys_form_hidden(),
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '附件设置' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-folder'],
                    '远程附件' => [\Soulcms\Service::L('Router')->class.'/remote_index', 'fa fa-cloud'],
                    '添加' => [\Soulcms\Service::L('Router')->class.'/add', 'fa fa-plus'],
                    'help' => [88],
                ]
            ),
        ]);
        \Soulcms\Service::V()->display('attachment_add.html');
	}

	public function edit() {

	    $id = intval($_GET['id']);

	    if (IS_AJAX_POST) {
            $data = \Soulcms\Service::L('input')->post('data', true);
            $rt = \Soulcms\Service::M()->table('attachment_remote')->update($id,
                [
                    'type' => intval($data['type']),
                    'name' => (string)$data['name'],
                    'url' => (string)$data['url'],
                    'value' => mys_array2string($data['value']),
                ]
            );
            !$rt['code'] && $this->_json(0, $rt['msg']);
            // 自动更新缓存
            \Soulcms\Service::M('cache')->sync_cache('attachment');
            $this->_json(1, mys_lang('操作成功'));
        }

        $data = \Soulcms\Service::M()->table('attachment_remote')->get($id);
	    $data['value'] = mys_string2array($data['value']);
	    $data['value'] = $data['value'][intval($data['type'])];

        \Soulcms\Service::V()->assign([
            'data' => $data,
            'form' => mys_form_hidden(),
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '附件设置' => [\Soulcms\Service::L('Router')->class.'/index', 'fa fa-folder'],
                    '远程附件' => [\Soulcms\Service::L('Router')->class.'/remote_index', 'fa fa-cloud'],
                    '添加' => [\Soulcms\Service::L('Router')->class.'/add', 'fa fa-plus'],
                    '修改' => ['hide:'.\Soulcms\Service::L('Router')->class.'/edit', 'fa fa-edit'],
                    'help' => [88],
                ]
            ),
        ]);
        \Soulcms\Service::V()->display('attachment_add.html');
	}

	public function del() {

        $ids = \Soulcms\Service::L('input')->get_post_ids();
        !$ids && exit($this->_json(0, mys_lang('你还没有选择呢')));

        \Soulcms\Service::M()->table('attachment_remote')->deleteAll($ids);
        \Soulcms\Service::L('input')->system_log('批量删除远程附件策略: '. @implode(',', $ids));
        // 自动更新缓存
        \Soulcms\Service::M('cache')->sync_cache('attachment');
        exit($this->_json(1, mys_lang('操作成功'), ['ids' => $ids]));
    }
	
}
