<?php if ($fn_include = $this->_include("head.html")) include($fn_include); ?>

<body scroll="no" style="overflow: hidden;" class="page-sidebar-closed-hide-logo page-content-white page-header-fixed page-sidebar-fixed ">
<style>.page-content {padding:0px !important;} </style>
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="<?php echo SITE_URL; ?>" target="_block"><img src="<?php echo THEME_PATH; ?>assets/logo.png" alt="logo" class="logo-default" /> </a>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <div class="top-menu my-top-left pull-left">
            <ul class="nav navbar-nav pull-left fc-all-menu-top ">
                <?php if (is_array($top)) { $count=count($top);foreach ($top as $t) { ?>
                <li id="mys_menu_top_<?php echo $t['id']; ?>" class="dropdown <?php if ($t['id']==$first) { ?>open<?php } ?>">
                    <a class="dropdown-toggle popovers" data-container="body" data-trigger="hover" data-placement="bottom" data-content="<?php echo mys_lang($t['name']); ?>"  href="javascript:Mlink('<?php echo $t['id']; ?>', '<?php echo $t['left_id']; ?>', '<?php echo $t['link_id']; ?>', '<?php echo $t['url']; ?>');">
                        <i class="<?php echo $t['icon']; ?>"></i>
                        <br>
                        <i class="top-txt-menu"><?php echo mys_lang($t['name']); ?></i>
                    </a>
                </li>
                <?php } } ?>
            </ul>
        </div>
        <div class="top-menu my-top-right">
            <ul class="nav navbar-nav pull-right">
                <?php if ($is_mobile) { ?>
                <li class="dropdown fc-mini-menu-top">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-bars"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default fc_mini_menu_top">
                        <?php if (is_array($top)) { $count=count($top);foreach ($top as $t) { ?>
                        <li>
                            <a id="mys_mini_menu_top_<?php echo $t['id']; ?>" class="mys_mini_menu_top <?php if ($t['id']==$first) { ?>open<?php } ?>" href="javascript:Mlink('<?php echo $t['id']; ?>', '<?php echo $t['left_id']; ?>', '<?php echo $t['link_id']; ?>', '<?php echo $t['url']; ?>');">
                                <i class="<?php echo $t['icon']; ?>"></i> <?php echo mys_lang($t['name']); ?>
                            </a>
                        </li>
                        <?php } } ?>
                    </ul>
                </li>
                <?php echo $mstring;  }  if (count(\Soulcms\Service::C()->site_info) > 1) { ?>
                <li class="dropdown dropdown-extended dropdown-tasks">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-share-alt"></i>
                        <span class="badge badge-default"> <?php echo count(\Soulcms\Service::C()->site_info); ?> </span>
                        <br>
                        <i class="top-txt-menu"><?php echo mys_lang('多站'); ?></i>
                    </a>
                    <ul class="dropdown-menu extended tasks">
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height:300px;" data-handle-color="#637283">
                                <?php if (is_array(\Soulcms\Service::C()->site_info)) { $count=count(\Soulcms\Service::C()->site_info);foreach (\Soulcms\Service::C()->site_info as $i=>$t) {  if (\Soulcms\Service::M('auth')->_check_site($i)) { ?>
                                <li>
                                    <a href="javascript:;" onClick="mys_select_site('<?php echo $i; ?>')" title="<?php echo $t['SITE_NAME']; ?>" <?php if (SITE_ID == $i) { ?>class="on"<?php } ?>>
                                    <span class="task">
                                            <span class="desc"> <?php echo mys_strcut($t['SITE_NAME'], 30); ?> </span>
                                        </span>
                                    </a>
                                </li>
                                <?php }  } } ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php }  if ($is_mobile) { ?>
                <li class="dropdown">
                    <a href="javascript:;"  class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-wrench"></i>
                        <br>
                        <i class="top-txt-menu"><?php echo mys_lang('账号'); ?></i>
                    </a>
                    <?php } else { ?>
                <li class="dropdown dropdown-user">
                    <a style="margin-right: -10px;height: 70px;" href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="<?php echo $admin['username']; ?>" class="img-circle" src="<?php echo mys_avatar($admin['uid']); ?>" />
                        <span style="padding-top: 10px;" class="username username-hide-on-mobile"> <?php echo mys_strcut($admin['username'], 8); ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <?php } ?>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li><a href="<?php echo mys_url('member/alogin_index', ['id'=>$admin['uid']]); ?>" target="_blank"><i class="fa fa-user"></i> <?php echo mys_lang('用户中心'); ?> </a></li>
                        <li><a href="javascript:;" onClick="mys_logout('<?php echo mys_url('login/out'); ?>');"><i class="fa fa-user-times"></i> <?php echo mys_lang('退出系统'); ?></a></li>
                        <li class="divider"> </li>
                        <li><a href="javascript:mys_update_cache_data();" target="right"><i class="fa fa-trash"></i> <?php echo mys_lang('更新前端 '); ?></a></li>
                        <?php if (\Soulcms\Service::C()->_is_admin_auth('cache/index')) { ?>
                        <li><a href="<?php echo mys_url('cache/index'); ?>" target="right"><i class="fa fa-refresh"></i> <?php echo mys_lang('缓存更新'); ?></a></li>
                        <?php }  if (\Soulcms\Service::C()->_is_admin_auth('check/index')) { ?>
                        <li><a href="<?php echo mys_url('check/index'); ?>" target="right"><i class="fa fa-wrench"></i> <?php echo mys_lang('系统体检'); ?></a></li>
                        <?php }  if ($admin['adminid']==1) { ?>
                        <li class="divider"> </li>
                        <li><a href="<?php echo mys_url('error_php/index'); ?>" target="right"><i class="fa fa-bug"></i> <?php echo mys_lang('PHP错误'); ?></a></li>
                        <li><a href="<?php echo mys_url('error/index'); ?>" target="right"><i class="fa fa-shield"></i> <?php echo mys_lang('系统错误'); ?></a></li>
                        <li><a href="<?php echo mys_url('content/index', ['p'=>1, 'page'=>1]); ?>" target="right"><i class="fa fa-code"></i> <?php echo mys_lang('执行SQL'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="clearfix"> </div>

<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">

        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed  page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>

                <?php echo $string; ?>

            </ul>
            <!-- END SIDEBAR MENU -->
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content index-content">

            <!--<div class="theme-panel hidden-xs hidden-sm">
                <div class="toggler"> </div>
                <div class="toggler-close"> </div>
                <div class="theme-options" style="">
                    <div class="theme-option" style="text-align: center;    margin-top: 30px;">
                        <button type="button" onClick="mys_add_menu()" class="btn blue-madison"> <i class="fa fa-plus"></i> <?php echo mys_lang('将此页面加入到快捷菜单'); ?> </button>
                    </div>
                    <div style="text-align: center; margin-bottom: 20px">
                        <button type="button" onClick="$('.theme-panel').remove()" class="btn red"> <i class="fa fa-times"></i> <?php echo mys_lang('隐藏'); ?> </button>
                    </div>

                </div>
            </div>-->

            <div class="page-toolbar fc-mb-left-menu">



            </div>

            <iframe name="right" id="right_page" src="<?php echo mys_url('home/main'); ?>&cache=<?php echo SYS_TIME; ?>" url="<?php echo mys_url('home/main'); ?>&cache=<?php echo SYS_TIME; ?>" frameborder="false" scrolling="auto" style="border:none; margin-bottom:0px;" width="100%" height="auto" allowtransparency="true"></iframe>

        </div>
    </div>

</div>
<script type="text/javascript">
    // 退出
    function mys_logout(url) {
        var r=confirm(lang['logout']);
        if (r==true) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                success: function(json) {
                    if (json.code == 1) {
                        setTimeout("window.location.href='<?php echo mys_url("login/index"); ?>'", 1000);
                    }
                    mys_tips(json.code, json.msg);
                },
                error: function(HttpRequest, ajaxOptions, thrownError) {
                    mys_ajax_alert_error(HttpRequest, ajaxOptions, thrownError)
                }
            });
        }
    }
    function mys_select_site(id) {
        var r=confirm('<?php echo mys_lang("你确定要切换到选中站点吗？"); ?>')
        if (r==true) {
            window.location.href='<?php echo mys_url("api/site"); ?>&id='+id
        }
    }

    function Mlink(top, left, link, url) {

        // 延迟提示
        /*
        var admin_loading = layer.load(2, {
            time: 1000
        });*/

        $('.mys_menu_item').hide();
        $('.mys_menu_'+top).show();
        $('.mys_menu_'+top+' .sub-menu').hide();

        $('#mys_m_top_'+top+' li').removeClass('active open');
        $('.mys_menu_'+top+' li').removeClass('active open');

        $('#mys_menu_link_'+link).addClass('active open');
        $('#mys_menu_m_link_'+link).addClass('active open');

        // 顶级菜单选择
        $('.top-menu .navbar-nav li').removeClass('open');
        $('.mys_mini_menu_top').removeClass('open');
        $('#mys_menu_top_'+top).addClass('open');
        $('#mys_mini_menu_top_'+top).addClass('open');

        // 移动端选择
        $('.fc-mb-sum-menu').hide();
        $('#mys_m_top_'+top).show();

        // 分组菜单选择
        $('.mys_menu_'+top+'').removeClass('active open');
        $('.mys_menu_'+top+' .selected').hide();
        $('.mys_menu_'+top+' .arrow').removeClass('open');

        $('#mys_menu_left_'+left).addClass('active open');
        $('#mys_menu_left_'+left+' .selected').show();
        $('#mys_menu_left_'+left+' .arrow').addClass('open');
        $('#mys_menu_left_'+left+' .sub-menu').show();

        $("#right_page").attr('src', url);
        $("#right_page").attr("url", url);
    }
    function wSize(){
        var str=getWindowSize();
        var strs= new Array(); //定义一数组
        strs=str.toString().split(","); //字符分割
        var heights = strs[0]-70,Body = $('body');
        $('#right_page').height(heights);
    }
    if(!Array.prototype.map)
        Array.prototype.map = function(fn,scope) {
            var result = [],ri = 0;
            for (var i = 0,n = this.length; i < n; i++){
                if(i in this){
                    result[ri++]  = fn.call(scope ,this[i],i,this);
                }
            }
            return result;
        };

    var getWindowSize = function(){
        return ["Height","Width"].map(function(name){
            return window["inner"+name] ||
                    document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
        });
    }
 
    $(function(){
        wSize();
        // 宽度小时
        if ($(document).width() < 900) {
            $('.page-sidebar .sidebar-toggler').click();
        }
    });
</script>
</body>
</html>