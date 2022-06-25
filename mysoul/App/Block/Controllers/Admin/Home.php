<?php namespace Soulcms\Controllers\Admin;

// 自定义资料
class Home extends \Soulcms\Table
{

    private $my_field;

    public function __construct(...$params)
    {
        parent::__construct(...$params);
        $this->tpl_name = 'block'; // 模板命名名称
        \Soulcms\Service::V()->assign([
            'menu' => \Soulcms\Service::M('auth')->_admin_menu(
                [
                    '自定义资料' => [APP_DIR.'/'.\Soulcms\Service::L('Router')->class.'/index', 'fa fa-th-large'],
                    '添加' => [APP_DIR.'/'.\Soulcms\Service::L('Router')->class.'/add', 'fa fa-plus'],
                    '修改' => ['hide:'.APP_DIR.'/'.\Soulcms\Service::L('Router')->class.'/edit', 'fa fa-edit'],
                    '更新缓存' => ['ajax:api/cache_update', 'fa fa-refresh'],
                    //'help' => [352],
                ]
            ),
            'type' => [
                '0' => mys_lang('单文本'),
                '1' => mys_lang('多文本'),
                '2' => mys_lang('富文本'),
                '3' => mys_lang('单文件'),
                '4' => mys_lang('多文件'),
            ]
        ]);
        // 支持附表存储
        $this->is_data = 0;
        $this->my_field = array(
            'name' => array(
                'ismain' => 1,
                'name' => mys_lang('名称'),
                'fieldname' => 'name',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                    'validate' => array(
                        'required' => 1,
                        'tips' => mys_lang('显示名称'),
                        'formattr' => ' onblur="d_topinyin(\'code\', \'name\')"'
                    )
                )
            ),
            'code' => array(
                'ismain' => 1,
                'name' => mys_lang('别名'),
                'fieldname' => 'code',
                'fieldtype' => 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => 200,
                    ),
                    'validate' => array(
                        'required' => 1,
                        'tips' => mys_lang('调用名称，由字母或数字组成，不得重复'),
                    )
                )
            ),
            'value_0' => array(
                'ismain' => 0,
                'fieldname' => 'value_0',
                'fieldtype'	=> 'Text',
                'setting' => array(
                    'option' => array(
                        'width' => '90%',
                    ),
                    'validate' => array(
                        'xss' => 1,
                    ),
                    'is_right' => 2,
                )
            ),
            'value_1' => array(
                'ismain' => 0,
                'fieldname' => 'value_1',
                'fieldtype'	=> 'Textarea',
                'setting' => array(
                    'option' => array(
                        'width' => '90%',
                        'height' => 250,
                    ),
                    'validate' => array(
                        'xss' => 1,
                    ),
                    'is_right' => 2,
                )
            ),
            'value_2' => array(
                'ismain' => 0,
                'fieldtype' => 'Ueditor',
                'fieldname' => 'value_2',
                'setting' => array(
                    'option' => array(
                        'mode' => 1,
                        'height' => 300,
                        'width' => '100%'
                    ),
                    'is_right' => 2,
                )
            ),
            'value_3' => array(
                'ismain' => 0,
                'fieldtype' => 'File',
                'fieldname' => 'value_3',
                'setting' => array(
                    'option' => array(
                        'ext' => '*',
                        'input' => 1,
                        'size' => 99999,
                    ),
                    'is_right' => 2,
                )
            ),
            'value_4' => array(
                'ismain' => 0,
                'fieldtype' => 'Files',
                'fieldname' => 'value_4',
                'setting' => array(
                    'option' => array(
                        'ext' => '*',
                        'desc' => 1,
                        'input' => 1,
                        'size' => 99999,
                        'count' => 99999,
                    ),
                    'is_right' => 2,
                )
            ),
        );
        // 表单显示名称
        $this->name = mys_lang('自定义资料');
        // 初始化数据表
        $this->_init([
            'table' => SITE_ID.'_block',
            'field' => $this->my_field,
            'order_by' => 'id desc',
        ]);
        \Soulcms\Service::V()->assign([
            'field' => $this->my_field,
        ]);
    }

    // 后台查看表单列表
    public function index() {
        list($tpl, $data) = $this->_List();
        $data['list'] && $data['list'] = \Soulcms\Service::M('Block', APP_DIR)->getValueAll($data['list']);
        \Soulcms\Service::V()->assign($data);
        \Soulcms\Service::V()->display($tpl);
    }

    // 后台添加表单内容
    public function add() {
        list($tpl) = $this->_Post(0);
        \Soulcms\Service::V()->display($tpl);
    }

    // 后台修改表单内容
    public function edit() {
        list($tpl) = $this->_Post(intval(\Soulcms\Service::L('Input')->get('id')));
        \Soulcms\Service::V()->display($tpl);
    }

    // 调用代码
    public function show_index() {

        $data =$this->_Data(intval(\Soulcms\Service::L('Input')->get('id')));
        !$data && $this->_json(0, mys_lang('数据#%s不存在', $_GET['id']));

        $key = $data['code'] ? $data['code'] : $data['id'];
        $code = '// 下面调用标题';
        $code.= PHP_EOL.'{mys_block(\''.$key.'\', 1)}';
        $code.= PHP_EOL.'// 下面调用内容';
        switch ($data['i']) {
            case 3:
                $code.= PHP_EOL.'{mys_get_file(mys_block(\''.$key.'\'))}';
                break;
            case 4:
                $code.= PHP_EOL.'{php $block=mys_block(\''.$key.'\');}';
                $code.= PHP_EOL.'{loop $block.file $i $file}';
                $code.= PHP_EOL.'文件地址: {mys_get_file($file)}';
                $code.= PHP_EOL.'文件标题: {$block[\'title\'][$i]}';
                $code.= PHP_EOL.'{/loop}';
                break;
            default:
                $code.= PHP_EOL.'{mys_block(\''.$key.'\')}';
                break;
        }
        \Soulcms\Service::V()->assign('code', $code);
        \Soulcms\Service::V()->display('block_show.html');
        exit;
    }

    // 保存
    protected function _Save($id = 0, $data = [], $old = [], $func = null, $func2 = null) {
        return parent::_Save($id, $data, $old, function($id, $data, $old){
            $data[1]['code'] = mys_safe_replace($data[1]['code']);
            if (!$data[1]['code']) {
                return mys_return_data(0, mys_lang('别名不存在'));
            } elseif (\Soulcms\Service::M()->table(SITE_ID.'_block')->is_exists($id, 'code', $data[1]['code'])) {
                return mys_return_data(0, mys_lang('别名已经存在'));
            }
            switch (intval($_POST['type'])) {
                case 0:
                    // 文本内容
                    $data[1]['content'] = '{i-0}:'.($data[0]['value_0'] ? $data[0]['value_0'] : '');
                    break;
                case 1:
                    // 文本内容
                    $data[1]['content'] = $data[0]['value_1'] ? $data[0]['value_1'] : '';
                    break;
                case 2:
                    // 丰富文本
                    $data[1]['content'] = '{i-2}:'.($data[0]['value_2'] ? $data[0]['value_2'] : '');
                    break;
                case 3:
                    // 单文件
                    $data[1]['content'] = '{i-3}:'.($data[0]['value_3'] ? $data[0]['value_3'] : '');
                    break;
                case 4:
                    // 多文件
                    $data[1]['content'] = '{i-4}:'.($data[0]['value_4'] ? mys_array2string($data[0]['value_4']) : '');
                    break;
            }
            return mys_return_data(1, null, $data);
        }, function ($id, $data, $old) {
            // 更新缓存
            \Soulcms\Service::M('block', APP_DIR)->cache();
        });
    }

    /**
     * 获取内容
     * $id      内容id,新增为0
     * */
    protected function _Data($id = 0) {
        $data = parent::_Data($id);
        $data = \Soulcms\Service::M('Block', APP_DIR)->getValue($data);
        return $data;
    }

    // 后台删除表单内容
    public function del() {
        $this->_Del(
            \Soulcms\Service::L('Input')->get_post_ids(),
            null,
            function ($r) {
                // 更新缓存
                \Soulcms\Service::M('block', APP_DIR)->cache();
            },
            \Soulcms\Service::M()->dbprefix($this->init['table'])
        );
    }

}
