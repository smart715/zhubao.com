<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>


<script>
    <?php if ($is_verify) {  } else {  echo $auto_form_data_ajax;  } ?>
    function mys_syncat() {
        var width = '40%';
        var height = '60%';
        var title = '<i class="fa fa-refresh"></i> <?php echo mys_lang('同步到其他栏目'); ?>';
        var url = '<?php echo mys_url(MOD_DIR.'/home/syncat_edit'); ?>&catid='+$('#mys_syncatid').val();
        layer.open({
            type: 2,
            title: title,
            shadeClose: true,
            shade: 0,
            area: [width, height],
            btn: [lang['ok']],
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                $(body).find('.form-group').removeClass('has-error');
                // 延迟加载
                var loading = layer.load(2, {
                    shade: [0.3,'#fff'], //0.1透明度的白色背景
                    time: 10000
                });
                $.ajax({type: "POST",dataType:"json", url: url, data: $(body).find('#myform').serialize(),
                    success: function(json) {
                        layer.close(loading);
                        if (json.code == 1) {
                            layer.close(index);
                            $('#mys_syncatid').val(json.data);
                            $('#mys_syncat_text').show();
                            $('#mys_syncat_num').html(json.msg);
                        } else {
                            mys_tips(json.code, json.msg);
                        }
                        return false;
                    },
                    error: function(HttpRequest, ajaxOptions, thrownError) {
                        mys_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
                    }
                });
                return false;
            },
            content: url+'&is_ajax=1'
        });
    }

    // 定时发布
    function mys_ajax_time_submit() {

        layer.open({
            type: 2,
            title: '<i class="fa fa-clock-o"></i> <?php echo mys_lang('定时发布'); ?>',
            fix:true,
            scrollbar: false,
            shadeClose: true,
            shade: 0,
            area: ["40%", "70%"],
            btn: [lang['ok']],
            success: function (json) {
                if (json.code == 0) {
                    layer.close();
                    mys_tips(json.code, json.msg);
                }
            },
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var loading = layer.load(2, {
                    time: 10000
                });
                var url = '<?php echo mys_url(APP_DIR.'/time/add'); ?>';
                var posttime = $(body).find('#posttime').val();
                if (posttime.length < 5) {
                    layer.closeAll('loading');
                    mys_tips(0, "<?php echo mys_lang('发布时间必须填写'); ?>");
                    return false;
                }
                $('#myform .form-group').removeClass('has-error');
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: url+"&posttime="+posttime,
                    data: $("#myform").serialize(),
                    success: function(json) {
                        layer.close(loading);
                        if (json.code == 1) {
                            mys_tips(1, json.msg);
                            setTimeout("window.location.href = '<?php echo mys_url(APP_DIR.'/time/index'); ?>'", 2000);
                        } else {
                            mys_tips(0, json.msg);
                            if (json.data.field) {
                                $('#mys_row_'+json.data.field).addClass('has-error');
                                $('#mys_'+json.data.field).focus();
                            }
                        }
                    },
                    error: function(HttpRequest, ajaxOptions, thrownError) {
                        mys_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
                    }
                });

                return false;
            },
            content: "<?php echo mys_url(APP_DIR.'/time/add'); ?>&is_ajax=1"
        });
    }

</script>
<?php if ($post_notice_msg) { ?>
<div class="note note-danger">
    <p><?php echo $post_notice_msg; ?></p>
</div>
<?php } ?>
<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo $form; ?>
    <div class="myfbody">
        <div class="row ">
            <div class="<?php if ($is_mobile) { ?>col-md-12<?php } else { ?>col-md-9<?php } ?>">

                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-green sbold "><?php echo mys_lang('基本内容'); ?></span>
                        </div>

                        <div class="actions">
                            <?php if ($draft_list) { ?>
                            <div class="btn-group">
                                <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false">
                                    <?php echo mys_lang('草稿'); ?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo $draft_url; ?>"> <?php echo mys_lang('查看原文'); ?> </a>
                                    </li>
                                    <?php if (is_array($draft_list)) { $count=count($draft_list);foreach ($draft_list as $t) { ?>
                                    <li>
                                        <a href="<?php echo $draft_url; ?>&did=<?php echo $t['id']; ?>" <?php if ($t['id']==$did) { ?>style="color:red"<?php } ?>> <?php echo mys_date($t['inputtime']); ?> </a>
                                    </li>
                                    <?php } } ?>
                                </ul>
                            </div>
                            <?php } ?>
                            <div class="btn-group">
                                <a class="btn" href="<?php echo $reply_url; ?>"> <i class="fa fa-mail-reply"></i> <?php echo mys_lang('返回列表'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-body">
                            <div class="form-group <?php if (!$is_category_show) { ?>hide<?php } ?>">
                                <label class="col-md-2 control-label"><?php echo mys_lang('栏目'); ?></label>
                                <div class="col-md-9">
                                    <?php if ($module['category'][$catid]['setting']['notedit']) { ?>
                                    <label style="margin-top: 7px;">
                                        <span class="label label-sm label-success circle"><?php echo $module['category'][$catid]['name']; ?></span>
                                    </label>
                                    <input type="hidden" id="mys_catid" name="catid" value="<?php echo $catid; ?>">
                                    <?php } else { ?>
                                        <label style="margin-right:10px"><?php echo $select; ?></label>
                                        <?php if ($module['setting']['sync_category']) {  if (!$id || $is_sync_cat) { ?>
                                        <label style="margin-right:10px"><a href="javascript:;" onclick="mys_syncat()">[<?php echo mys_lang('同步发布到其他栏目'); ?>]</a></label>
                                        <label>
                                            <input id="mys_syncatid" name="sync_cat" type="hidden" value="<?php echo $is_sync_cat; ?>" />
                                            <span id="mys_syncat_text" class="label label-success" style="display: <?php if ($is_sync_cat) { ?>blank<?php } else { ?>none<?php } ?>;"><b id="mys_syncat_num"><?php echo substr_count($is_sync_cat, ',') + 1; ?></b></span>
                                        </label>
                                        <?php } else if ($link_id != 0) { ?>
                                        <label><?php echo mys_lang('修改内容时会同步更新其他外联文档'); ?></label>
                                        <?php }  }  } ?>
                                </div>
                            </div>
                            <?php echo str_replace('col-md-9', 'col-md-10', $myfield); ?>
                        </div>
                    </div>
                </div>

                <?php if ($diyfield) { ?>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-green sbold "><?php echo mys_lang('其他内容'); ?></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-body">
                            <?php echo str_replace('col-md-9', 'col-md-10', $diyfield); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
            <div class="<?php if ($is_mobile) { ?>col-md-12<?php } else { ?>col-md-3<?php } ?> my-sysfield">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="form-body">
                            <?php echo $sysfield;  if ($weibo['use']) { ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo mys_lang('分享到官微'); ?></label>
                                <div class="col-md-9">
                                    <input type="checkbox" name="sync_weibo" value="1" <?php if ($weibo['open']) { ?>checked<?php } ?> data-on-text="<?php echo mys_lang('开启'); ?>" data-off-text="<?php echo mys_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                </div>
                            </div>
                            <?php }  if ($module['setting']['flag']) { ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo mys_lang('推荐位设置'); ?></label>
                                <div class="col-md-9">
                                    <div class="mt-checkbox-list">
                                        <?php if (is_array($module['setting']['flag'])) { $count=count($module['setting']['flag']);foreach ($module['setting']['flag'] as $i=>$t) { ?>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input name="flag[]" type="checkbox" <?php if (@in_array($i, (array)$myflag)) { ?> checked="checked" <?php } ?> value="<?php echo $i; ?>"> <i class="<?php echo mys_icon($t['icon']); ?>"></i> <?php echo $t['name']; ?>
                                            <span></span>
                                        </label>
                                        <?php } } ?>
                                    </div>
                                </div>
                            </div>
                            <?php }  if ($is_post_time) { ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo mys_lang('定时发布时间'); ?></label>
                                <div class="col-md-9">
                                    <span class="form-date input-group">
                                        <div class="input-group date field_date_post_inputtime">
                                            <input id="posttime" name="posttime" type="text" style="width:160px;" value="<?php echo mys_date($posttime, 'Y-m-d H:i:s'); ?>"  required="required" class="form-control ">
                                            <span class="input-group-btn">
                                                <button class="btn default date-set" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <script>
                                        $(function(){
                                            $(".field_date_post_inputtime").datetimepicker({
                                                isRTL: App.isRTL(),
                                                format: "yyyy-mm-dd hh:ii:ss",
                                                showMeridian: true,
                                                autoclose: true,
                                                pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
                                                todayBtn: true
                                            });
                                        });
                                        </script>
                                    </span>
                                </div>
                            </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php if ($is_verify) { ?>
        <div class="row ">
            <div class="col-md-12 ">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-green sbold "><?php echo mys_lang('内容审核'); ?></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo mys_lang('当前状态'); ?></label>
                                <div class="col-md-9">
                                    <p class="form-control-static">
                                        <?php if ($status) { ?>
                                        <span class="label label-warning"> <?php echo mys_lang('%s审中', $status); ?> </span>
                                        <?php } else { ?>
                                        <span class="label label-danger"> <?php echo mys_lang('被拒绝'); ?> </span>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo mys_lang('下级审核'); ?></label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> <?php echo $verify_step[$verify_next][name]; ?> </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo mys_lang('操作状态'); ?></label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio mt-radio-outline"><input type="radio" onclick="$('.mys_close_msg').hide()" name="verify[status]" value="1" checked /> <?php echo mys_lang('通过'); ?> <span></span></label>
                                        <label class="mt-radio mt-radio-outline"><input type="radio" onclick="$('.mys_close_msg').show()" name="verify[status]" value="0" /> <?php echo mys_lang('拒绝'); ?> <span></span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mys_close_msg" style="display:none">
                                <label class="col-md-2 control-label"><?php echo mys_lang('拒绝理由'); ?></label>
                                <div class="col-md-9">
                                    <textarea id="mys_verify_msg" class="form-control" style="height:100px" name="verify[msg]"></textarea>

                                </div>
                            </div>
                            <div class="form-group mys_close_msg" style="display:none">
                                <label class="col-md-2 control-label"><?php echo mys_lang('常用理由'); ?></label>
                                <div class="col-md-9">
                                    <label>
                                        <select class="form-control" onchange="javascript:$('#mys_verify_msg').val(this.value)">
                                            <option value=""> -- </option>
                                            <?php if (is_array($verify_msg)) { $count=count($verify_msg);foreach ($verify_msg as $t) { ?>
                                            <option value="<?php echo $t; ?>"><?php echo $t; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </label>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>


    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <?php if (!defined('IS_MODULE_RECYCLE')) {  if ($is_verify) { ?>
            <label><button type="button" onclick="$('#mys_is_draft').val(0);mys_ajax_submit('<?php echo mys_now_url(); ?>', 'myform', '2000', '<?php echo $reply_url; ?>')" class="btn green"> <i class="fa fa-save"></i> <?php echo mys_lang('提交审核'); ?></button></label>
            <?php } else if ($is_post_time) { ?>
            <label><button type="button" onclick="$('#mys_is_draft').val(0);mys_ajax_submit('<?php echo mys_now_url(); ?>&posttime=<?php echo mys_date($posttime, 'Y-m-d H:i:s'); ?>', 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo mys_lang('保存内容'); ?></button></label>
            <?php } else { ?>
            <label><button type="button" onclick="$('#mys_is_draft').val(0);mys_ajax_submit('<?php echo mys_now_url(); ?>', 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo mys_lang('保存内容'); ?></button></label>
            <label><button type="button" onclick="$('#mys_is_draft').val(0);mys_ajax_submit('<?php echo mys_now_url(); ?>', 'myform', '2000', '<?php echo $post_url; ?>&catid='+$('#mys_catid').val())" class="btn blue"> <i class="fa fa-plus"></i> <?php echo mys_lang('保存再添加'); ?></button></label>
            <label><button type="button" onclick="$('#mys_is_draft').val(0);mys_ajax_submit('<?php echo mys_now_url(); ?>', 'myform', '2000', '<?php echo $reply_url; ?>')" class="btn yellow"> <i class="fa fa-mail-reply-all"></i> <?php echo mys_lang('保存并返回'); ?></button></label>
            <label><button type="button" onclick="$('#mys_is_draft').val(1);mys_ajax_submit('<?php echo mys_now_url(); ?>', 'myform', '2000')" class="btn red"> <i class="fa fa-pencil"></i> <?php echo mys_lang('保存草稿'); ?></button></label>
            <?php if (!$id) { ?>
            <label><button type="button" onclick="mys_ajax_time_submit()" class="btn dark"> <i class="fa fa-clock-o"></i> <?php echo mys_lang('定时发布'); ?></button></label>
            <?php }  if ($is_form_cache) { ?>
            <label><button type="button" onclick="auto_form_data_delete()" class="btn red"> <i class="fa fa-trash"></i> <?php echo mys_lang('删除历史缓存'); ?></button></label>
            <?php }  }  } else { ?>
            <label><a href="<?php echo $reply_url; ?>" class="btn yellow"> <i class="fa fa-mail-reply-all"></i> <?php echo mys_lang('返回列表'); ?></a></label>
            <?php } ?>
        </div>
    </div>
</form>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>