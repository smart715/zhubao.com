<?php namespace Soulcms\Model\Block;

// 模型类

class Block extends \Soulcms\Model
{

    // 格式化结果
    public function getValueAll($v) {

        foreach ($v as $i => $value) {
            $v[$i] = $this->getValue($value);
        }

        return $v;
    }

    public function getValue($value) {

        if (!$value['content']) {
            $value['i'] = 0;
            $value['value_0'] = '';
        } else {
            if (preg_match('/\{i-([0-9]+)\}:/U', $value['content'], $preg)) {
                $value['i'] = intval($preg[1]);
                $value['value_'.$value['i']] = str_replace($preg[0], '', $value['content']);
                if ($value['i'] == 4) {
                    $value['value_'.$value['i']] = mys_string2array($value['value_'.$value['i']]);
                }
            } else {
                $value['i'] = 1;
                $value['value_1'] = $value['content'];
            }
        }

        return $value;
    }

    // 缓存
    public function cache($siteid = SITE_ID) {



        $data = $this->table($siteid.'_block')->getAll();
        $cache = [];
        if ($data) {
            foreach ($data as $t) {
                $t = $this->getValue($t);
                if (!$t['code']) {
                    // 填充默认code
                    $t['code'] = $t['id'];
                    $this->table($siteid.'_block')->update($t['id'], [
                        'code' => $t['id'],
                    ]);
                }
                switch (intval($t['i'])) {
                    case 0:
                        // 文本内容
                        $value = $t['value_0'];
                        break;
                    case 1:
                        // 文本内容
                        $value = $t['value_1'];
                        break;
                    case 2:
                        // 丰富文本
                        $value = htmlspecialchars_decode($t['value_2']);
                        break;
                    case 3:
                        // 单文件
                        $value = (int)$t['value_3'];
                        break;
                    case 4:
                        // 多文件
                        $value = mys_string2array($t['value_4']);
                        break;
                }
                $cache[$t['code']] = [
                    1 => $t['name'],
                    0 => $value
                ];
            }
        }

        \Soulcms\Service::L('cache')->set_file('block-'.$siteid, $cache);
        return;
    }

}