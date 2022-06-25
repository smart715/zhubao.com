<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<script type="text/javascript">
    $(function() {
        <?php if (empty($data['SITE_CLOSE'])) { ?>
            $('.mys_close_msg').hide();
        <?php } else { ?>
            $('.mys_close_msg').show();
        <?php } ?>
        mys_theme(<?php echo $is_theme; ?>);
    });
    function mys_theme(id) {
        if (id == 1) {
            $("#mys_theme_html").html($("#mys_web").html());
        } else {
            $("#mys_theme_html").html($("#mys_local").html());
        }
    }
</script>
<div id="mys_local" style="display: none">
    <label class="col-md-2 control-label"><?php echo mys_lang('主题风格'); ?></label>
    <div class="col-md-9">
        <label><select class="form-control" name="data[SITE_THEME]">
            <option value="default"> -- </option>
            <?php if (is_array($theme)) { $count=count($theme);foreach ($theme as $t) { ?>
            <option<?php if ($t==$data['SITE_THEME']) { ?> selected=""<?php } ?> value="<?php echo $t; ?>"><?php echo $t; ?></option>
            <?php } } ?>
        </select></label>
        <span class="help-block"><?php echo mys_lang('位于网站主站根目录下：/static/风格名称/'); ?></span>
    </div>
</div>
<div id="mys_web" style="display: none">
    <label class="col-md-2 control-label"><?php echo mys_lang('远程资源'); ?></label>
    <div class="col-md-9">
        <input class="form-control  input-xlarge" type="text" placeholder="http://" name="data[SITE_THEME2]" value="<?php echo $data['SITE_THEME']; ?>">
        <span class="help-block"><?php echo mys_lang('网站将调用此地址的css,js,图片等静态资源'); ?></span>
    </div>
</div>
<div class="note note-danger">
    <p><a href="javascript:mys_update_cache();"><?php echo mys_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>
<form action="" class="form-horizontal" method="post" name="myform" id="myform">
<?php echo $form; ?>
    <div class="portlet bordered light myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="<?php if ($page==0) { ?>active<?php } ?>">
                    <a href="#tab_0" data-toggle="tab" onclick="$('#mys_page').val('0')"> <i class="fa fa-globe"></i> <?php echo mys_lang('站点信息'); ?> </a>
                </li>
                <li class="<?php if ($page==3) { ?>active<?php } ?>">
                    <a href="#tab_3" data-toggle="tab" onclick="$('#mys_page').val('3')"> <i class="fa fa-cog"></i> <?php echo mys_lang('参数设置'); ?> </a>
                </li>
                <li class="<?php if ($page==1) { ?>active<?php } ?>">
                    <a href="#tab_1" data-toggle="tab" onclick="$('#mys_page').val('1')"> <i class="fa fa-share-alt-square"></i> <?php echo mys_lang('域名设置'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('首页静态'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[SITE_INDEX_HTML]" value="1" <?php if ($data['SITE_INDEX_HTML']) { ?>checked<?php } ?> data-on-text="<?php echo mys_lang('开启'); ?>" data-off-text="<?php echo mys_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo mys_lang('开启之后首页将会自动生成静态文件'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('网站状态'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline"><input type="radio" onclick="$('.mys_close_msg').hide()" name="data[SITE_CLOSE]" value="0" <?php if (empty($data['SITE_CLOSE'])) { ?>checked<?php } ?> /> <?php echo mys_lang('开启'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" onclick="$('.mys_close_msg').show()" name="data[SITE_CLOSE]" value="1" <?php if ($data['SITE_CLOSE']) { ?>checked<?php } ?> /> <?php echo mys_lang('关闭'); ?> <span></span></label>
                                </div>
                                <span class="help-block"><?php echo mys_lang('当关闭网站时，除管理员之外的用户将无法访问（静态页面除外）'); ?></span>
                            </div>
                        </div>
                        <div class="form-group mys_close_msg">
                            <label class="col-md-2 control-label"><?php echo mys_lang('关闭理由'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" style="height:100px" name="data[SITE_CLOSE_MSG]"><?php echo $data['SITE_CLOSE_MSG'] ? $data['SITE_CLOSE_MSG'] : '网站升级中....'; ?></textarea>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('网站LOGO'); ?></label>
                            <div class="col-md-9">
                                <?php echo $logofield; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('网站名称'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[SITE_NAME]" id="mys_name" value="<?php echo $data['SITE_NAME']; ?>"></label>
                             </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('版权信息'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[SITE_COPYRIGHT]" value="<?php echo $data['SITE_COPYRIGHT']; ?>"></label>
                             </div>
                        </div>                        

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('ICP备案信息'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[SITE_ICP]" value="<?php echo $data['SITE_ICP']; ?>"></label>
                             </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('电话'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[SITE_TEL]" value="<?php echo $data['SITE_TEL']; ?>"></label>
                             </div>
                        </div>   

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('手机'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[SITE_PHONE]" value="<?php echo $data['SITE_PHONE']; ?>"></label>
                             </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('QQ'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[SITE_QQ]" value="<?php echo $data['SITE_QQ']; ?>"></label>
                             </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('邮箱'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[SITE_EMAIL]" value="<?php echo $data['SITE_EMAIL']; ?>"></label>
                             </div>
                        </div>  

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('公司地址'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[SITE_ADDRESS]" value="<?php echo $data['SITE_ADDRESS']; ?>"></label>
                             </div>
                        </div>  

                        
                        
                        <div class="form-group ">
                            <label class="col-md-2 control-label"><?php echo mys_lang('第三方统计代码'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" style="height:100px" name="data[SITE_TONGJI]"><?php echo $data['SITE_TONGJI']; ?></textarea>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane <?php if ($page==3) { ?>active<?php } ?>" id="tab_3">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('网站语言'); ?></label>
                            <div class="col-md-9">
                                <label><select class="form-control" name="data[SITE_LANGUAGE]">
                                    <option value="zh-cn"> -- </option>
                                    <?php if (is_array($lang)) { $count=count($lang);foreach ($lang as $t) { ?>
                                    <option<?php if ($t==$data['SITE_LANGUAGE']) { ?> selected=""<?php } ?> value="<?php echo $t; ?>"><?php echo $t; ?></option>
                                    <?php } } ?>
                                </select></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('时间格式'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[SITE_TIME_FORMAT]" value="<?php echo $data['SITE_TIME_FORMAT']; ?>"></label>
                                <span class="help-block"><?php echo mys_lang('网站时间显示格式与date函数一致，默认Y-m-d H:i:s'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('风格模式'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline"><input type="radio" onclick="mys_theme(1)" name="theme" value="1" <?php if ($is_theme) { ?>checked<?php } ?> /> <?php echo mys_lang('远程地址'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" onclick="mys_theme(0)" name="theme" value="0" <?php if (!$is_theme) { ?>checked<?php } ?> /> <?php echo mys_lang('本站资源'); ?> <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="mys_theme_html">

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('模板目录'); ?></label>
                            <div class="col-md-9">
                                <label><select class="form-control" name="data[SITE_TEMPLATE]">
                                    <option value="default"> -- </option>
                                    <?php if (is_array($template_path)) { $count=count($template_path);foreach ($template_path as $t) { ?>
                                    <option<?php if ($t==$data['SITE_TEMPLATE']) { ?> selected=""<?php } ?> value="<?php echo $t; ?>"><?php echo $t; ?></option>
                                    <?php } } ?>
                                </select></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('网站时区'); ?></label>
                            <div class="col-md-9">
                                <label><select class="form-control" name="data[SITE_TIMEZONE]">
                                    <option value=""> -- </option>
                                    <option value="-12" <?php if ($data['SITE_TIMEZONE']=="-12") { ?>selected<?php } ?>>(GMT -12:00)</option>
                                    <option value="-11" <?php if ($data['SITE_TIMEZONE']=="-11") { ?>selected<?php } ?>>(GMT -11:00)</option>
                                    <option value="-10" <?php if ($data['SITE_TIMEZONE']=="-10") { ?>selected<?php } ?>>(GMT -10:00)</option>
                                    <option value="-9" <?php if ($data['SITE_TIMEZONE']=="-9") { ?>selected<?php } ?>>(GMT -09:00)</option>
                                    <option value="-8" <?php if ($data['SITE_TIMEZONE']=="-8") { ?>selected<?php } ?>>(GMT -08:00)</option>
                                    <option value="-7" <?php if ($data['SITE_TIMEZONE']=="-7") { ?>selected<?php } ?>>(GMT -07:00)</option>
                                    <option value="-6" <?php if ($data['SITE_TIMEZONE']=="-6") { ?>selected<?php } ?>>(GMT -06:00)</option>
                                    <option value="-5" <?php if ($data['SITE_TIMEZONE']=="-5") { ?>selected<?php } ?>>(GMT -05:00)</option>
                                    <option value="-4" <?php if ($data['SITE_TIMEZONE']=="-4") { ?>selected<?php } ?>>(GMT -04:00)</option>
                                    <option value="-3.5" <?php if ($data['SITE_TIMEZONE']=="-3.5") { ?>selected<?php } ?>>(GMT -03:30)</option>
                                    <option value="-3" <?php if ($data['SITE_TIMEZONE']=="-3") { ?>selected<?php } ?>>(GMT -03:00)</option>
                                    <option value="-2" <?php if ($data['SITE_TIMEZONE']=="-2") { ?>selected<?php } ?>>(GMT -02:00)</option>
                                    <option value="-1" <?php if ($data['SITE_TIMEZONE']=="-1") { ?>selected<?php } ?>>(GMT -01:00)</option>
                                    <option value="0" <?php if ($data['SITE_TIMEZONE']=="0") { ?>selected<?php } ?>>(GMT)</option>
                                    <option value="1" <?php if ($data['SITE_TIMEZONE']=="1") { ?>selected<?php } ?>>(GMT +01:00)</option>
                                    <option value="2" <?php if ($data['SITE_TIMEZONE']=="2") { ?>selected<?php } ?>>(GMT +02:00)</option>
                                    <option value="3" <?php if ($data['SITE_TIMEZONE']=="3") { ?>selected<?php } ?>>(GMT +03:00)</option>
                                    <option value="3.5" <?php if ($data['SITE_TIMEZONE']=="3.5") { ?>selected<?php } ?>>(GMT +03:30)</option>
                                    <option value="4" <?php if ($data['SITE_TIMEZONE']=="4") { ?>selected<?php } ?>>(GMT +04:00)</option>
                                    <option value="4.5" <?php if ($data['SITE_TIMEZONE']=="4.5") { ?>selected<?php } ?>>(GMT +04:30)</option>
                                    <option value="5" <?php if ($data['SITE_TIMEZONE']=="5") { ?>selected<?php } ?>>(GMT +05:00)</option>
                                    <option value="5.5" <?php if ($data['SITE_TIMEZONE']=="5.5") { ?>selected<?php } ?>>(GMT +05:30)</option>
                                    <option value="5.75" <?php if ($data['SITE_TIMEZONE']=="5.75") { ?>selected<?php } ?>>(GMT +05:45)</option>
                                    <option value="6" <?php if ($data['SITE_TIMEZONE']=="6") { ?>selected<?php } ?>>(GMT +06:00)</option>
                                    <option value="6.5" <?php if ($data['SITE_TIMEZONE']=="6.6") { ?>selected<?php } ?>>(GMT +06:30)</option>
                                    <option value="7" <?php if ($data['SITE_TIMEZONE']=="7") { ?>selected<?php } ?>>(GMT +07:00)</option>
                                    <option value="8" <?php if ($data['SITE_TIMEZONE']=="" || $data['SITE_TIMEZONE']=="8") { ?>selected<?php } ?>>(GMT +08:00)</option>
                                    <option value="9" <?php if ($data['SITE_TIMEZONE']=="9") { ?>selected<?php } ?>>(GMT +09:00)</option>
                                    <option value="9.5" <?php if ($data['SITE_TIMEZONE']=="9.5") { ?>selected<?php } ?>>(GMT +09:30)</option>
                                    <option value="10" <?php if ($data['SITE_TIMEZONE']=="10") { ?>selected<?php } ?>>(GMT +10:00)</option>
                                    <option value="11" <?php if ($data['SITE_TIMEZONE']=="11") { ?>selected<?php } ?>>(GMT +11:00)</option>
                                    <option value="12" <?php if ($data['SITE_TIMEZONE']=="12") { ?>selected<?php } ?>>(GMT +12:00)</option>
                                </select></label>
                                <span class="help-block"><?php echo mys_lang('例如中国地区选择“GMT +08:00”表示东八区'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane  <?php if ($page==1) { ?>active<?php } ?>" id="tab_1">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('网站域名'); ?></label>
                            <div class="col-md-4">
                                <div class="input-group" style="width: 300px;">
                                    <input type="text" <?php if (SITE_ID == 1) { ?> readonly<?php } ?> name="data[SITE_DOMAIN]" id="mys_domain" value="<?php echo $data['SITE_DOMAIN']; ?>" class="form-control">
                                    <span class="input-group-btn">
                                        <?php if (SITE_ID == 1) { ?>
                                        <a class="btn red" href="javascript:mys_iframe('<?php echo mys_lang("变更域名"); ?>', '<?php echo mys_url("site_domain/edit"); ?>');"><i class="fa fa-edit"></i> <?php echo mys_lang('变更'); ?></a>
                                        <?php } else { ?>
                                        <a class="btn blue" href="<?php echo SITE_URL; ?>" target="_blank"><i class="fa fa-send"></i> <?php echo mys_lang('访问'); ?></a>
                                        <?php } ?>
                                    </span>
                                </div>
                                <span class="help-block" id="mys_domain_tips"><?php echo mys_lang('例如：www.test.com，不能包含/符号'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('其他域名'); ?></label>
                            <div class="col-md-9">
                                <label><textarea class="form-control input-large" style="height:150px" name="data[SITE_DOMAINS]"><?php echo str_replace(',',PHP_EOL, $data['SITE_DOMAINS']); ?></textarea></label>
                                <span class="help-block"><?php echo mys_lang('当前站点支持绑定多个域名，它们将会301到主域名，域名一行一个'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="mys_ajax_submit('<?php echo mys_now_url(); ?>&page='+$('#mys_page').val(), 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo mys_lang('保存'); ?></button>
        </div>
    </div>
</form>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>