<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><a href="javascript:mys_update_cache('module', 'module');"><?php echo mys_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>
<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo $form; ?>
    <div class="portlet bordered light myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="<?php if ($page==0) { ?>active<?php } ?>">
                    <a href="#tab_0" data-toggle="tab" onclick="$('#mys_page').val('0')"> <i class="fa fa-cog"></i> <?php echo mys_lang('模块设置'); ?> </a>
                </li>
                <li class="<?php if ($page==3) { ?>active<?php } ?>">
                    <a href="#tab_3" data-toggle="tab" onclick="$('#mys_page').val('3')"> <i class="fa fa-table"></i> <?php echo mys_lang('后台列表显示字段'); ?> </a>
                </li>
                <li class="<?php if ($page==4) { ?>active<?php } ?>">
                    <a href="#tab_4" data-toggle="tab" onclick="$('#mys_page').val('4')"> <i class="fa fa-comments"></i> <?php echo mys_lang('后台评论显示字段'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">
                        <?php if (!$data['share']) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('首页静态'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[setting][module_index_html]" value="1" <?php if ($data['setting']['module_index_html']) { ?>checked<?php } ?> data-on-text="<?php echo mys_lang('开启'); ?>" data-off-text="<?php echo mys_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo mys_lang('开启之后当前模块的首页将会自动生成静态文件'); ?></span>
                            </div>
                        </div>
                        <?php }  if (!$is_hcategory) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('同步其他栏目'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[setting][sync_category]" value="1" <?php if ($data['setting']['sync_category']) { ?>checked<?php } ?> data-on-text="<?php echo mys_lang('开启'); ?>" data-off-text="<?php echo mys_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo mys_lang('将内容同步发布到其他的栏目之中'); ?></span>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('自动存储关键词'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[setting][auto_save_tag]" value="1" <?php if ($data['setting']['auto_save_tag']) { ?>checked<?php } ?> data-on-text="<?php echo mys_lang('开启'); ?>" data-off-text="<?php echo mys_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo mys_lang('增加内容时自动将关键词存储到关键字库之中'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('后台默认排序'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-xlarge" type="text" name="data[setting][order]" value="<?php if ($data['setting']['order']) {  echo $data['setting']['order'];  } else { ?>displayorder DESC,updatetime DESC<?php } ?>" ></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('拒绝审核理由'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" style="height:150px; width:100%;" name="data[setting][verify_msg]"><?php echo $data['setting']['verify_msg']; ?></textarea>
                                <span class="help-block"><?php echo mys_lang('常用的拒绝审核理由，一行一个'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('删除内容理由'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" style="height:150px; width:100%;" name="data[setting][delete_msg]"><?php echo $data['setting']['delete_msg']; ?></textarea>
                                <span class="help-block"><?php echo mys_lang('常用的删除理由，一行一个'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="tab-pane <?php if ($page==3) { ?>active<?php } ?>" id="tab_3">
                    <div class="form-body">
                        <?php if (is_array($field)) { $count=count($field);foreach ($field as $n=>$t) { ?>
                        <div class="form-group field-<?php echo $n; ?>">
                            <label class="col-md-2 control-label"><?php echo mys_lang($t['name']); ?> (<?php echo $t['fieldname']; ?>)</label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" onclick="mys_field_show('<?php echo $n; ?>', 1)" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][use]" value="1" <?php if ($data['setting']['list_field'][$t['fieldname']]['use']) { ?> checked<?php } ?> > <?php echo mys_lang('显示'); ?>
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" onclick="mys_field_show('<?php echo $n; ?>', 0)" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][use]" value="0" <?php if (!$data['setting']['list_field'][$t['fieldname']]['use']) { ?> checked<?php } ?>> <?php echo mys_lang('隐藏'); ?>
                                        <span></span>
                                    </label>
                                </div>
                                <div class="list-field-cog">
                                    <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:layer.msg('<?php echo mys_lang('排列顺序值由小到大'); ?>');"><?php echo mys_lang('序列'); ?></a>
                                        </span>
                                        <input class="form-control" type="text" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][order]" value="<?php echo $data['setting']['list_field'][$t['fieldname']]['order'] ? $data['setting']['list_field'][$t['fieldname']]['order'] : $n+100 ?>" />
                                    </div>
                                </div>
                                <div class="list-field-cog">
                                    <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:layer.msg('<?php echo mys_lang('列表的显示名称'); ?>');"><?php echo mys_lang('名称'); ?></a>
                                        </span>
                                        <input class="form-control" type="text" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][name]" value="<?php echo $data['setting']['list_field'][$t['fieldname']]['name'] ? $data['setting']['list_field'][$t['fieldname']]['name'] : $t['name'] ?>" />
                                    </div>
                                </div>
                                <div class="list-field-cog">
                                    <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:layer.msg('<?php echo mys_lang('不填宽度表示自动宽度'); ?>');"><?php echo mys_lang('宽度'); ?></a>
                                        </span>
                                        <input class="form-control" type="text" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][width]" value="<?php echo $data['setting']['list_field'][$t['fieldname']]['width']; ?>" />
                                    </div>
                                </div>
                                <div class="list-field-cog">
                                    <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:mys_call_alert();"><?php echo mys_lang('回调'); ?></a>
                                        </span>
                                        <input class="form-control" type="text" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][func]" value="<?php echo $data['setting']['list_field'][$t['fieldname']]['func']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(function() {
                                mys_field_show('<?php echo $n; ?>', <?php echo intval($data['setting']['list_field'][$t['fieldname']]['use']); ?>);
                            });
                        </script>
                        <?php } } ?>
                    </div>
                </div>


                <div class="tab-pane <?php if ($page==4) { ?>active<?php } ?>" id="tab_4">
                    <div class="form-body">
                        <?php if (is_array($comment_field)) { $count=count($comment_field);foreach ($comment_field as $n=>$t) { ?>
                        <div class="form-group comment-field-<?php echo $n; ?>">
                            <label class="col-md-2 control-label"><?php echo mys_lang($t['name']); ?> (<?php echo $t['fieldname']; ?>)</label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" onclick="mys_field_show_comment('<?php echo $n; ?>', 1)" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][use]" value="1" <?php if ($data['setting']['comment_list_field'][$t['fieldname']]['use']) { ?> checked<?php } ?> > <?php echo mys_lang('显示'); ?>
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" onclick="mys_field_show_comment('<?php echo $n; ?>', 0)" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][use]" value="0" <?php if (!$data['setting']['comment_list_field'][$t['fieldname']]['use']) { ?> checked<?php } ?>> <?php echo mys_lang('隐藏'); ?>
                                        <span></span>
                                    </label>
                                </div>
                                <div class="comment-list-field-cog">
                                    <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:layer.msg('<?php echo mys_lang('排列顺序值由小到大'); ?>');"><?php echo mys_lang('序列'); ?></a>
                                        </span>
                                        <input class="form-control" type="text" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][order]" value="<?php echo $data['setting']['comment_list_field'][$t['fieldname']]['order'] ? $data['setting']['comment_list_field'][$t['fieldname']]['order'] : $n+100 ?>" />
                                    </div>
                                </div>
                                <div class="comment-list-field-cog">
                                    <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:layer.msg('<?php echo mys_lang('列表的显示名称'); ?>');"><?php echo mys_lang('名称'); ?></a>
                                        </span>
                                        <input class="form-control" type="text" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][name]" value="<?php echo $data['setting']['comment_list_field'][$t['fieldname']]['name'] ? $data['setting']['comment_list_field'][$t['fieldname']]['name'] : $t['name'] ?>" />
                                    </div>
                                </div>
                                <div class="comment-list-field-cog">
                                    <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:layer.msg('<?php echo mys_lang('不填宽度表示自动宽度'); ?>');"><?php echo mys_lang('宽度'); ?></a>
                                        </span>
                                        <input class="form-control" type="text" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][width]" value="<?php echo $data['setting']['comment_list_field'][$t['fieldname']]['width']; ?>" />
                                    </div>
                                </div>
                                <div class="comment-list-field-cog">
                                    <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:mys_call_alert();"><?php echo mys_lang('回调'); ?></a>
                                        </span>
                                        <input class="form-control" type="text" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][func]" value="<?php echo $data['setting']['comment_list_field'][$t['fieldname']]['func']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(function() {
                                mys_field_show_comment('<?php echo $n; ?>', <?php echo intval($data['setting']['comment_list_field'][$t['fieldname']]['use']); ?>);
                            });
                        </script>
                        <?php } } ?>
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
<script type="text/javascript">
    $(function() {
        mys_theme(<?php echo $is_theme; ?>);
    });
    function mys_field_show(n, u) {
        if (u) {
            $('.field-'+n+' .list-field-cog').show();
        } else {
            $('.field-'+n+' .list-field-cog').hide();
        }
    }
    function mys_field_show_comment(n, u) {
        if (u) {
            $('.comment-field-'+n+' .comment-list-field-cog').show();
        } else {
            $('.comment-field-'+n+' .comment-list-field-cog').hide();
        }
    }
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
        <label><select class="form-control" name="site[theme]">
            <option value="default"> -- </option>
            <?php if (is_array($theme)) { $count=count($theme);foreach ($theme as $t) { ?>
            <option<?php if ($t==$site['theme']) { ?> selected=""<?php } ?> value="<?php echo $t; ?>"><?php echo $t; ?></option>
            <?php } } ?>
        </select></label>
        <span class="help-block"><?php echo mys_lang('位于网站主站根目录下：/static/风格名称/'); ?></span>
    </div>
</div>
<div id="mys_web" style="display: none">
    <label class="col-md-2 control-label"><?php echo mys_lang('远程资源'); ?></label>
    <div class="col-md-9">
        <input class="form-control  input-xlarge" type="text" placeholder="http://" name="site[theme]" value="<?php echo strpos($site['theme'], 'http') === 0 ? $site['theme'] : ''; ?>">
        <span class="help-block"><?php echo mys_lang('网站将调用此地址的css,js,图片等静态资源'); ?></span>
    </div>
</div>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>