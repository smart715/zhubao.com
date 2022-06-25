<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<script>
$(function () {
    <?php if ($is_scategory) { ?>
    mys_tid(<?php echo intval($data['tid']); ?>);
    <?php } else { ?>
    mys_tid(1);
    <?php } ?>
});
function mys_tid(i) {
    $('.mys_tid_0').hide();
    $('.mys_tid_1').hide();
    $('.mys_tid_2').hide();
    $('.mys_tid_'+i).show();
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

<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo $form; ?>

    <div class="portlet bordered light myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="<?php if ($page==0) { ?>active<?php } ?>">
                    <a href="#tab_0" data-toggle="tab" onclick="$('#mys_page').val('0')"> <i class="fa fa-cog"></i> <?php echo mys_lang('基本设置'); ?> </a>
                </li>
                <li class="<?php if ($page==1) { ?>active<?php } ?>">
                    <a href="#tab_1" data-toggle="tab" onclick="$('#mys_page').val('1')"> <i class="fa fa-table"></i> <?php echo mys_lang('内容设置'); ?> </a>
                </li>
                <li class="<?php if ($page==3) { ?>active<?php } ?>">
                    <a href="#tab_3" data-toggle="tab" onclick="$('#mys_page').val('3')"> <i class="fa fa-internet-explorer"></i> <?php echo mys_lang('SEO优化'); ?> </a>
                </li>
                <li class="<?php if ($page==4) { ?>active<?php } ?>">
                    <a href="#tab_4" data-toggle="tab" onclick="$('#mys_page').val('4')"> <i class="fa fa-html5"></i> <?php echo mys_lang('模板设置'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('所属栏目'); ?></label>
                            <div class="col-md-9">
                                <label><?php echo $select; ?></label>
                            </div>
                        </div>

                        <?php if ($is_scategory) { ?>
                        <div class="form-group r1">
                            <label class="col-md-2 control-label"><?php echo mys_lang('栏目类型'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[tid]" value="0" onclick="mys_tid(0)" <?php if (!$data['tid']) { ?> checked<?php } ?> /> <?php echo mys_lang('单网页'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[tid]" value="1" onclick="mys_tid(1)" <?php if ($data['tid']==1) { ?> checked<?php } ?> /> <?php echo mys_lang('内容模块'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[tid]" value="2" onclick="mys_tid(2)" <?php if ($data['tid']==2) { ?> checked<?php } ?> /> <?php echo mys_lang('外部地址'); ?> <span></span></label>
                                </div>
                            </div>
                        </div>
                        <?php }  if ($module['share']) { ?>
                        <div class="form-group mys_tid_1 " style="display: none">
                            <label class="col-md-2 control-label"><?php echo mys_lang('共享模块'); ?></label>
                            <div class="col-md-9">
                                <label>
                                    <select class="form-control" name="data[mid]">
                                    <option value=""> -- </option>
                                    <?php if (is_array($module_share)) { $count=count($module_share);foreach ($module_share as $t) {  if ($t['share']) { ?>
                                    <option value="<?php echo $t['dirname']; ?>" <?php if ($t['dirname']==$data['mid']) { ?>selected<?php } ?>> <?php echo mys_lang($t['name']); ?> </option>
                                    <?php }  } } ?>
                                    </select>
                                </label>
                                <span class="help-block"><?php echo mys_lang('当同一父级栏目下存在多个不同的模块栏目时，其父级栏目将自动转换为单页栏目'); ?></span>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group " id="mys_row_name">
                            <label class="col-md-2 control-label"><?php echo mys_lang('栏目名称'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[name]" value="<?php echo htmlspecialchars($data['name']); ?>" id="mys_name" onblur="d_topinyin('dirname','name', 1);"></label>
                                <span class="help-block" id="mys_name_tips"><?php echo mys_lang('栏目的一个显示名称'); ?></span>
                            </div>
                        </div>
                        <div class="form-group " id="mys_row_dirname">
                            <label class="col-md-2 control-label"><?php echo mys_lang('目录名称'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[dirname]" id="mys_dirname" value="<?php echo $data['dirname']; ?>"></label>
                                <span class="help-block" id="mys_dirname_tips"><?php echo mys_lang('栏目目录确保唯一，用于url填充或者生成目录'); ?></span>
                            </div>
                        </div>
                        <div class="form-group mys_tid_2 " style="display: none">
                            <label class="col-md-2 control-label"><?php echo mys_lang('外链地址'); ?></label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="data[setting][linkurl]" value="<?php echo $data['setting']['linkurl']; ?>">
                                <span class="help-block"><?php echo mys_lang('可跳转到指定地址（不允许发布内容）'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('显示状态'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[show]" value="1" <?php if ($data['show']) { ?>checked<?php } ?> data-on-text="<?php echo mys_lang('显示'); ?>" data-off-text="<?php echo mys_lang('隐藏'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo mys_lang('前端循环调用不会显示'); ?></span>
                            </div>
                        </div>
                        <div class="form-group mys_tid_0">
                            <label class="col-md-2 control-label"><?php echo mys_lang('继承下级'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[setting][getchild]" value="1" <?php if ($data['setting']['getchild']) { ?>checked<?php } ?> data-on-text="<?php echo mys_lang('是'); ?>" data-off-text="<?php echo mys_lang('否'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo mys_lang('选择“是”时，将下级第一个页面数据作为当前的栏目，只对父级单网页有效'); ?></span>
                            </div>
                        </div>
                        <div class="form-group mys_tid_1">
                            <label class="col-md-2 control-label"><?php echo mys_lang('禁止修改'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[setting][notedit]" value="1" <?php if ($data['setting']['notedit']) { ?>checked<?php } ?> data-on-text="<?php echo mys_lang('是'); ?>" data-off-text="<?php echo mys_lang('否'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo mys_lang('内容发布之后将禁止修改栏目'); ?></span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane <?php if ($page==3) { ?>active<?php } ?>" id="tab_3">
                    <div class="form-body">

                        <?php if ($module['share']) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('生成静态'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[setting][html]" value="1" <?php if ($data['setting']['html']) { ?>checked<?php } ?> data-on-text="<?php echo mys_lang('开启'); ?>" data-off-text="<?php echo mys_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo mys_lang('开启生成静态时必须给它配置URL规则'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('URL规则'); ?></label>
                            <div class="col-md-9">

                                <label>
                                    <select class="form-control" name="data[setting][urlrule]">
                                        <option value="0"> <?php echo mys_lang('动态地址'); ?> </option>
                                        <?php $return_u = [];$list_return_u = $this->list_tag("action=cache name=urlrule  return=u"); if ($list_return_u) { extract($list_return_u); $count_u=count($return_u);} if (is_array($return_u)) { foreach ($return_u as $key_u=>$u) {  $is_first=$key_u==0 ? 1 : 0;$is_last=$count_u==$key_u+1 ? 1 : 0;   if ($u['type']==3) { ?><option value="<?php echo $u['id']; ?>" <?php if ($u['id'] == $data['setting']['urlrule']) { ?>selected<?php } ?>> <?php echo $u['name']; ?> </option><?php }  } } ?>
                                    </select>
                                </label>
                                <label style="margin-left:20px;"><?php echo mys_lang('<a href="'.mys_url('urlrule/index', ['hide_menu' => 1]).'" style="color:blue !important">[URL规则管理]</a>'); ?> </label>

                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('SEO标题'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control " style="height:90px" name="data[setting][seo][list_title]"><?php echo $data['setting']['seo']['list_title']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('SEO关键字'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control " style="height:90px" name="data[setting][seo][list_keywords]"><?php echo $data['setting']['seo']['list_keywords']; ?></textarea>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('SEO描述信息'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control " style="height:90px" name="data[setting][seo][list_description]"><?php echo $data['setting']['seo']['list_description']; ?></textarea>

                            </div>
                        </div>
                        <?php if ($id) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('同步到其他栏目'); ?></label>
                            <div class="col-md-9">
                                <label><button onclick="mys_iframe('<?php echo mys_lang('复制'); ?>', '<?php echo mys_url(APP_DIR.'/category/copy_edit'); ?>&at=seo&catid=<?php echo $id; ?>')" type="button" class="btn green btn-sm"> <i class="fa fa-copy"></i> <?php echo mys_lang('同步配置'); ?></button></label>
                                <label><?php echo mys_lang('把本页的设置数据同步到其他栏目；需要保存之后再同步'); ?></label>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
                <div class="tab-pane <?php if ($page==4) { ?>active<?php } ?>" id="tab_4">
                    <div class="form-body">
                        <div class="form-group mys_tid_1">
                            <label class="col-md-2 control-label"><?php echo mys_lang('电脑列表信息数'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['pagesize']; ?>" name="data[setting][template][pagesize]"></label>
                                <span class="help-block"><?php echo mys_lang('列表页面每页显示的信息数量，静态生成时调用此参数'); ?></span>
                            </div>
                        </div>
                        <div class="form-group mys_tid_1">
                            <label class="col-md-2 control-label"><?php echo mys_lang('手机列表信息数'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['mpagesize']; ?>" name="data[setting][template][mpagesize]"></label>
                                <span class="help-block"><?php echo mys_lang('列表页面每页显示的信息数量，静态生成时调用此参数'); ?></span>
                            </div>
                        </div>
                        <?php if ($is_scategory) { ?>
                        <div class="form-group mys_tid_0">
                            <label class="col-md-2 control-label"><?php echo mys_lang('单网页模板'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['page']; ?>" name="data[setting][template][page]"></label>
                                <span class="help-block"><?php echo mys_lang('单网页模板默认page.html'); ?></span>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group mys_tid_1">
                            <label class="col-md-2 control-label"><?php echo mys_lang('内容列表页模板'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['list']; ?>" name="data[setting][template][list]"></label>
                                <span class="help-block"><?php echo mys_lang('模块栏目列表默认list.html'); ?></span>
                            </div>
                        </div>
                        <div class="form-group mys_tid_1">
                            <label class="col-md-2 control-label"><?php echo mys_lang('内容栏目封面模板'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['category']; ?>" name="data[setting][template][category]"></label>
                                <span class="help-block"><?php echo mys_lang('默认category.html'); ?></span>
                            </div>
                        </div>
                        <div class="form-group mys_tid_1">
                            <label class="col-md-2 control-label"><?php echo mys_lang('内容搜索页模板'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['search'] ? $data['setting']['template']['search'] : 'search.html' ?>" name="data[setting][template][search]"></label>
                                <span class="help-block"><?php echo mys_lang('默认search.html'); ?></span>
                            </div>
                        </div>
                        <div class="form-group mys_tid_1">
                            <label class="col-md-2 control-label"><?php echo mys_lang('内容详细页模板'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" value="<?php echo $data['setting']['template']['show']; ?>" name="data[setting][template][show]"></label>
                                <span class="help-block"><?php echo mys_lang('默认show.html'); ?></span>
                            </div>
                        </div>
                        <?php if ($id) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo mys_lang('同步到其他栏目'); ?></label>
                            <div class="col-md-9">
                                <label><button onclick="mys_iframe('<?php echo mys_lang('复制'); ?>', '<?php echo mys_url(APP_DIR.'/category/copy_edit'); ?>&at=tpl&catid=<?php echo $id; ?>')" type="button" class="btn green btn-sm"> <i class="fa fa-copy"></i> <?php echo mys_lang('同步配置'); ?></button></label>
                                <label><?php echo mys_lang('把本页的设置数据同步到其他栏目；需要保存之后再同步'); ?></label>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="tab-pane <?php if ($page==1) { ?>active<?php } ?>" id="tab_1">
                    <div class="form-body">
                        <?php echo $sysfield;  echo $myfield;  echo $diyfield; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="mys_ajax_submit('<?php echo mys_now_url(); ?>', 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo mys_lang('保存内容'); ?></button>
            <button type="button" onclick="mys_ajax_submit('<?php echo mys_now_url(); ?>', 'myform', '2000', '<?php echo $post_url; ?>')" class="btn blue"> <i class="fa fa-plus"></i> <?php echo mys_lang('保存再添加'); ?></button>
            <button type="button" onclick="mys_ajax_submit('<?php echo mys_now_url(); ?>', 'myform', '2000', '<?php echo $reply_url; ?>')" class="btn yellow"> <i class="fa fa-mail-reply-all"></i> <?php echo mys_lang('保存并返回'); ?></button>
        </div>
    </div>
</form>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>