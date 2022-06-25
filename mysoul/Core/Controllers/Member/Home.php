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



class Home extends \Soulcms\Common
{

    /**
     * 用户中心首页
     */
    public function index() {

        // 接口请求时返回会员数据
        IS_API_HTTP && $this->_json(1, mys_lang('认证成功'), $this->member);
        
        \Soulcms\Service::V()->assign([
            'meta_title' => mys_lang('用户中心')
        ]);
        \Soulcms\Service::V()->display('index.html');
    }

}
