<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<script>
    function mys_page_content(id) {
        mys_iframe('<i class="fa fa-edit"></i> <?php echo mys_lang('编辑内容'); ?>','<?php echo mys_url(APP_DIR.'/category/content_edit'); ?>&id='+id, '90%', '90%');
    }
    function mys_link_url(id) {
        mys_iframe('<i class="fa fa-edit"></i> <?php echo mys_lang('编辑地址'); ?>','<?php echo mys_url(APP_DIR.'/category/link_edit'); ?>&id='+id, '50%', '40%');
    }
    // ajax关闭或启用
    function mys_cat_ajax_open_close(e, url, fan) {
        var index = layer.load(2, {
            shade: [0.3,'#fff'], //0.1透明度的白色背景
            time: 10000
        });
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "json",
            success: function (json) {
                layer.close(index);
                if (json.code == 1) {
                    if (json.data.share == 1) {
                        if (json.data.value == fan) {
                            $(e).attr('class', 'badge badge-no');
                            $(e).html('<i class="fa fa-times"></i>');
                        } else {
                            $(e).attr('class', 'badge badge-yes');
                            $(e).html('<i class="fa fa-check"></i>');
                        }
                    } else {
                        // 独立模块 mys_is_page_html
                        var obj = $('.mys_is_page_html');
                        if (json.data.value == fan) {
                            obj.attr('class', 'mys_is_page_html badge badge-no');
                            obj.html('<i class="fa fa-times"></i>');
                        } else {
                            obj.attr('class', 'mys_is_page_html badge badge-yes');
                            obj.html('<i class="fa fa-check"></i>');
                        }
                    }
                    mys_tips(1, json.msg);
                } else {
                    mys_tips(0, json.msg);
                }
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                mys_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
    }
    function mys_cat_ajax_save(value, id) {
        var url = "<?php echo mys_url($uriprefix.'/displayorder_edit'); ?>&id="+id;
        var index = layer.load(2, {
            shade: [0.3,'#fff'], //0.1透明度的白色背景
            time: 10000
        });
        $.ajax({
            type: "GET",
            cache: false,
            url: url+'&value='+value,
            dataType: "json",
            success: function (json) {
                layer.close(index);
                if (json.code == 1) {
                    mys_tips(1, json.msg);
                } else {
                    mys_tips(0, json.msg);
                }
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                mys_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
    }
    // ajax关闭或启用
    function mys_cat_ajax_show_open_close(e, url, fan) {
        var index = layer.load(2, {
            shade: [0.3,'#fff'], //0.1透明度的白色背景
            time: 10000
        });
        var obj = $(e);
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "json",
            success: function (json) {
                layer.close(index);
                if (json.code == 1) {
                    if (json.data.value == fan) {
                        obj.attr('class', 'badge badge-no');
                        obj.html('<i class="fa fa-times"></i>');
                    } else {
                        obj.attr('class', 'badge badge-yes');
                        obj.html('<i class="fa fa-check"></i>');
                    }
                    mys_tips(1, json.msg);
                } else {
                    mys_tips(0, json.msg);
                }
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                mys_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
    }
    $(function() {
        $(".select-cat").click(function(){
            var action = $(this).attr("action");
            var childs = $(this).attr("childs");
            var catid = $(this).attr("catid");
            var catids= new Array(); //定义一数组
            catids = childs.split(","); //字符分割
            if (action == 'close') {
                $.cookie('mys_<?php echo SITE_ID; ?>_<?php echo APP_DIR; ?>_'+catid, null,{path:"/",expires: -1});
                $(this).attr("action", "open");
                $(this).html("[-]");
                for (i=0;i<catids.length ;i++ ) {
                    if (catids[i] != catid) {
                        $(".mys_catid_"+catids[i]).show();
                    }
                }
            } else {
                // 关闭状态存储cookie
                $.cookie('mys_<?php echo SITE_ID; ?>_<?php echo APP_DIR; ?>_'+catid, 1);
                $(this).attr("action", "close");
                $(this).html("[+]");
                for (i=0;i<catids.length ;i++ ) {
                    if (catids[i] != catid) {
                        $(".mys_catid_"+catids[i]).hide();
                    }
                }
            }
        });
        $(".select-cat").each(function(){
            var childs = $(this).attr("childs");
            var catid = $(this).attr("catid");
            var cache = $.cookie('mys_<?php echo SITE_ID; ?>_<?php echo APP_DIR; ?>_'+catid);
            if (cache) {
                $(this).attr("action", "close");
                $(this).html("[+]");
                var catids= new Array(); //定义一数组
                catids = childs.split(","); //字符分割
                for (i=0;i<catids.length ;i++ ) {
                    if (catids[i] != catid) {
                        $(".mys_catid_"+catids[i]).hide();
                    }
                }
            }
        });
    });
    function mys_scjt() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo mys_url($uriprefix.'/scjt_edit'); ?>",
            data: $("#myform").serialize(),
            success: function(json) {
                if (json.code == 1) {
                    mys_bfb('<?php echo mys_lang('生成栏目'); ?>', '', json.msg);
                } else {
                    mys_cmf_tips(json.code, json.msg);
                }

            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                mys_ajax_alert_error(HttpRequest, ajaxOptions, thrownError)
            }
        });
    }
    function mys_scjt2() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo mys_url($uriprefix.'/scjt2_edit'); ?>",
            data: $("#myform").serialize(),
            success: function(json) {
                if (json.code == 1) {
                    mys_bfb('<?php echo mys_lang('生成内容'); ?>', '', json.msg);
                } else {
                    mys_cmf_tips(json.code, json.msg);
                }

            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                mys_ajax_alert_error(HttpRequest, ajaxOptions, thrownError)
            }
        });
    }
</script>

<div class="row my-content-top-tool">
    <div class="col-md-12 col-sm-12">
        <label style="margin-right:10px"><a href="<?php echo $list_url; ?>" class="btn green"> <?php echo $list_name; ?></a></label>
        <label style="margin-right:10px"><a href="<?php echo $field_url; ?>" class="btn blue"> <i class="fa fa-code"></i> <?php echo mys_lang('自定义字段'); ?></a></label>
        <label style="margin-right:10px"><a href="<?php echo $post_url; ?>" class="btn red"> <i class="fa fa-plus"></i> <?php echo mys_lang('添加栏目'); ?></a></label>
        <label><a href="<?php echo $post_all_url; ?>" class="btn blue"> <i class="fa fa-plus"></i> <?php echo mys_lang('批量添加'); ?></a></label>
    </div>
</div>

<div class="note note-danger">
    <p><a href="javascript:mys_update_cache('module', 'module');"><?php echo mys_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>

<div class="right-card-box">
<form class="form-horizontal" role="form" id="myform">
    <?php echo mys_form_hidden(); ?>
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover table-checkable dataTable">
            <thead>
            <tr class="heading">
                <th class="myselect">
                    <label class="mt-table mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                        <span></span>
                    </label>
                </th>
                <th width="70" style="text-align:center"> <?php echo mys_lang('排序'); ?> </th>
                <th width="50" style="text-align:center"> <?php echo mys_lang('显示'); ?> </th>
                <th width="50" style="text-align:center"> Id </th>
                <th> <?php echo mys_lang('栏目'); ?> </th>
                <?php if ($is_scategory) { ?>
                <th width="60" style="text-align:center"> <?php echo mys_lang('类型'); ?> </th>
                <?php }  if ($module['share']) { ?>
                <th width="70" style="text-align:center"> <?php echo mys_lang('模块'); ?> </th>
                <?php } ?>
                <th width="90" style="text-align:center"> <?php echo mys_lang('数据'); ?> </th>
                <th width="50" style="text-align:center"> <?php echo mys_lang('静态'); ?> </th>
                <th><?php echo mys_lang('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php echo $list; ?>
            </tbody>
        </table>
    </div>
    <div class="row fc-list-footer table-checkable ">
        <div class="col-md-12 fc-list-select">
            <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                <span></span>
            </label>
            <?php if (\Soulcms\Service::C()->_is_admin_auth('del')) { ?>
            <label><button type="button" onclick="mys_ajax_option('<?php echo mys_url($uriprefix.'/del'); ?>', '<?php echo mys_lang('你确定要删除它们吗？'); ?>', 1)" class="btn red btn-sm"> <i class="fa fa-trash"></i> <?php echo mys_lang('删除'); ?></button></label>
            <?php }  if (IS_SHARE && \Soulcms\Service::C()->_is_admin_auth('edit')) { ?>
            <label><button type="button" onclick="mys_ajax_option('<?php echo mys_url($uriprefix.'/htmlall_edit'); ?>', '<?php echo mys_lang('你确定要批量设置为静态模式吗？'); ?>', 1)" class="btn green btn-sm"> <i class="fa fa-file-o"></i> <?php echo mys_lang('静态'); ?></button></label>
            <label><button type="button" onclick="mys_ajax_option('<?php echo mys_url($uriprefix.'/phpall_edit'); ?>', '<?php echo mys_lang('你确定要批量设置为动态模式吗？'); ?>', 1)" class="btn red btn-sm"> <i class="fa fa-file"></i> <?php echo mys_lang('动态'); ?></button></label>
            <?php }  if (\Soulcms\Service::C()->_is_admin_auth('edit')) { ?>
            <label><?php echo $move_select; ?></label>
            <label><button type="button" onclick="mys_ajax_option('<?php echo mys_url($uriprefix.'/move_edit'); ?>', '<?php echo mys_lang('你确定要移动它们吗？'); ?>', 1)" class="btn blue btn-sm"> <i class="fa fa-edit"></i> <?php echo mys_lang('移动'); ?></button></label>
            <?php } ?>
            <label><button type="button" onclick="mys_scjt()" class="btn green btn-sm"> <i class="fa fa-reorder"></i> <?php echo mys_lang('生成栏目静态'); ?> </button></label>
            <label><button type="button" onclick="mys_scjt2()" class="btn blue btn-sm"> <i class="fa fa-th-large"></i> <?php echo mys_lang('生成内容静态'); ?> </button></label>
        </div>
    </div>
</form>
</div>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>