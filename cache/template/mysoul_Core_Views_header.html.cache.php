<?php if ($fn_include = $this->_include("head.html")) include($fn_include); ?>
<body class="page-content-white">
<style>
    .main-content2 {background: #fff!important}
    .page-content3 {margin-left:0px !important; border-left: 0  !important;}
    .page-content-white .page-bar .page-breadcrumb>li>i.fa-circle {top:0px !important; }
</style>
<div class="page-container" style="margin-bottom: 0px !important;">
    <div class="page-content-wrapper">
        <div class="page-content page-content3 mybody-nheader main-content  <?php if (isset($_GET['is_ajax']) && $_GET['is_ajax']) { ?> main-content2<?php } ?>">
            <?php if (!isset($_GET['hide_menu']) || !$_GET['hide_menu']) {  if (isset($menu) && $menu && !$is_ajax) { ?>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <?php echo $menu; ?>
                    </ul>
                </div>
                <?php } ?>
                <div style="padding-top:17px;margin-bottom:30px;">
            <?php } else { ?>
                <div style="padding-top:0px;margin-bottom:30px;">
            <?php } ?>
