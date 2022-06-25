<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $cat['name']; ?>_<?php echo SITE_NAME; ?></title>
    <!--Favicons-->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!--Bootstrap and Other Vendors-->
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/owl.carousel.css">

    <link rel="stylesheet" type="text/css" href="<?php echo THEME_PATH; ?>skin/css/flexslider.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_PATH; ?>skin/css/bootstrap-rating.css" media="screen" />
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <!--Mechanic Styles-->
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/style.css">
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/responsive.css">
    <!--[if lt IE 9]>
      <script src="<?php echo THEME_PATH; ?>skin/js/html5shiv.min.js"></script>
      <script src="<?php echo THEME_PATH; ?>skin/js/respond.min.js"></script>
      <![endif]-->

    <!-- 系统关键js(所有自建模板必须引用) -->
    <script type="text/javascript">var assets_path = '<?php echo THEME_PATH; ?>assets/'; var is_mobile_cms = '<?php echo \Soulcms\Service::IS_MOBILE(); ?>';</script>
    <script src="<?php echo LANG_PATH; ?>lang.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/layer/layer.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/js/cms.js" type="text/javascript"></script>
    <!-- 系统关键js结束 -->
</head>

<body>

    <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
    <?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
    <!--Header-->
    <section id="breadcrumbRow" class="row">
        <h2><?php echo $cat['name']; ?></h2>
        <div class="row pageTitle m0">
            <div class="container">
                <h4 class="fleft"><?php echo $cat['name']; ?></h4>
                <ul class="breadcrumb fright">
                    <li><a href="/">HOME</a></li>
                    <span style="color:black">&nbsp; / </span>
                    <span style="color:black">&nbsp;<?php echo mys_catpos($catid, ' / ', true, '&nbsp;<a href=[url] style="color:black">[name]</a>'); ?></span>
                </ul>
            </div>
        </div>
    </section>
    <section class="row contentRowPad">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-8">
                    <div class="blog row m0 single_post">
                        <div class="row m0 titleRow">
                            <div class="fleft date"><?php echo mys_date($_inputtime,'d'); ?><span><?php echo $keywords; ?></span></div>
                            <div class="fleft titlePart">
                                <a href="#">
                                    <h4 class="blogTitle heading"><?php echo $title; ?></h4>
                                </a>
                                <p class="m0">By <a href="#"><?php echo $author; ?></a><span>|</span><a href="#"><?php echo mys_show_hits($id); ?>
                                        Comments</a></p>
                            </div>
                        </div>
                        <div class="row m0 featureImg">
                            <img src="<?php echo mys_get_file($thumb); ?>" alt="">
                        </div>
                        <div class="row m0 excerpt">
                            <?php echo $content; ?>
                        </div>
                    </div>
                    <!--Blog Row End-->
                    <div class="shareRow row m0">
                        <h4 class="heading fleft">Share this post</h4>
                        <ul class="list-inline">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fab fa-tumblr"></i></a></li>
                        </ul>
                    </div>
                    <!--Share Widget-->

                    <!-- <div class="media authorBox">
                        <div class="media-left authorImg">
                            <a href="#">
                                <img src="images/blog/author.png" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="heading">About <a href="#">Dwayne Johnson</a></h5>
                            <p>We provide the best Quality of products to you.We are always here to help our lovely
                                customers. We ship our products anywhere with more secure. We provide the best Quality
                                of products to you.</p>
                        </div>
                        <div class="row m0">
                            <ul class="list-inline">
                                <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i> twitter</a></li>
                                <li><a href="#"><i class="fab fa-google-plus"></i> google+</a></li>
                                <li><a href="#"><i class="fas fa-envelope"></i> Email</a></li>
                            </ul>
                        </div>
                    </div> -->
                    <!--Author Box - Shortcode Item -> Single Blog Page-->

                    <div class="row m0 comments">
                        <h4 class="heading commentCount">3 Comments</h4>
                        <?php $list_return = $this->list_tag("action=module module=guanyu catid=6 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                        <div class="media commentBox">
                            <div class="media-left">
                                <a href="#">
                                    <img src="<?php echo mys_get_file($t['thumb']); ?>" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="heading"><?php echo $t['title']; ?></h5>
                                <h6><?php echo $t['keywords'];  echo mys_date($t['_inputtime'],'d'); ?>, <?php echo mys_date($t['_inputtime'],'Y'); ?> <span>|</span>
                                    <!-- <a href="#replyForm"><?php echo $t['huifu']; ?></a> -->
                                </h6>
                                <p><?php echo $t['description']; ?></p>
                            </div>
                        </div>
                        <!--Comment Box - Shortcode Item -> Single Blog Page-->
                        <?php } } ?>
                    </div>
                    <!--Comments here-->

                    <div class="row m0" id="replyForm">
                        <h4 class="heading">leave a comment</h4>
                        <?php extract(mys_get_form_post_value('comment')) ?>
                        <form action="" class="message" method="post" name="myform" id="myform">
                            <?php echo $form; ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="commenterName">Name *</label>
                                    <input type="text" class="form-control" name="data[name]" id="commenterName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="commenterEmail">Email *</label>
                                    <input type="email" class="form-control" name="data[email]" id="commenterEmail">
                                </div>
                                <div class="col-sm-4">
                                    <label for="commenterUrl">Website</label>
                                    <input type="url" class="form-control" name="data[website]" id="commenterUrl">
                                </div>
                            </div>
                            <div class="row m0">
                                <label for="comments">Comment</label>
                                <textarea name="data[comment]" id="comments" class="form-control"></textarea>
                            </div>
                            <div class="row m0">
                                <div class="col-sm-4">
                                    <label for="code">code</label>
                                    <input id="checkcode" name="code" type="text" class="form-control">
                                    <div style="    position: relative;  left: 105%; margin-top: -68px;"><?php echo mys_code(120, 35); ?></div> 
                                </div>

                            </div>

                            <button class="btn btn-primary btn-default filled" type="submit" style="margin-top:30px" onclick="mys_ajax_submit('<?php echo $post_url; ?>', 'myform', '2000', '<?php echo $rt_url; ?>')" name="btn">post comment</button>
                        </form>
                    </div>

                </div>

                <div class="col-sm-4 col-md-4">
                    <div class="row m0 sidebar">
                        <form action="#" class="searchForm row m0">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search">
                                <span class="input-group-addon p0">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                        <!--Shortcode Element-->
                        <div class="row m0 categories">
                                <h4 class="heading">categories</h4>
                                <ul class="list-unstyled">
                                    <?php $list_return = $this->list_tag("action=module module=chanpin catid=8 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                   <li><?php echo $t['title']; ?></li>
                                   <?php } } ?>
                                </ul>
                        </div>
                        <!--Shortcode Element-->

                        <div class="row m0 latestPosts">
                            <h4 class="heading">Latest post</h4>
                            <?php $list_return = $this->list_tag("action=module module=chanpin catid=9 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>

                        <div class="media latestPost">
                           <div class="media-left">
                              <a href="#">
                              <img src="<?php echo mys_get_file($t['thumb']); ?>" alt="">
                              </a>
                           </div>
                           <div class="media-body">
                              <h5 class="heading"><?php echo $t['description']; ?></h5>
                              <p><?php echo $t['keywords']; ?>, <?php echo mys_date($t['_inputtime'],'Y'); ?></p>
                           </div>
                        </div>
                        <?php } } ?>
                        </div>
                        <!--Shortcode Element-->

                        <div class="row m0 tags">
                            <h4 class="heading">tags</h4>
                            <ul class="nav tagsNav">
                                    <?php $list_return = $this->list_tag("action=module module=chanpin catid=10 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
        
                                   <li><a href="#"><?php echo $t['title']; ?></a></li>
                                   <?php } } ?>
                                </ul>
                        </div>
                        <!--Shortcode Element-->

                        <div class="row m0 flickrPhoto">
                                <h4 class="heading"><?php echo mys_block('flickr_photostream', 1); ?></h4>
                                <ul class="list-inline">
                                    <?php $block=mys_block('flickr_photostream');  if (is_array($block['file'])) { $count=count($block['file']);foreach ($block['file'] as $i=>$file) { ?>
                                   <li><a href="#"><img src="<?php echo mys_get_file($file); ?>" alt=""></a></li>
                                    <?php } } ?>
                                </ul>
                        </div>
                        <!--Shortcode Element-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>
    <!--jQuery, Bootstrap and other vendor JS-->
    <!--jQuery-->
    <script src="<?php echo THEME_PATH; ?>skin/js/jquery-2.1.3.min.js"></script>
    <!--Google Maps-->
    <script src="http://ditu.google.cn/maps/api/js"></script>
    <!--Bootstrap JS-->
    <script src="<?php echo THEME_PATH; ?>skin/js/bootstrap.min.js"></script>

    <!--Owl Carousel-->
    <script src="<?php echo THEME_PATH; ?>skin/js/owl.carousel.min.js"></script>
    <!--Isotope-->
    <script src="<?php echo THEME_PATH; ?>skin/js/isotope-custom.js"></script>
    <!--FlexSlider-->
    <script src="<?php echo THEME_PATH; ?>skin/js/jquery.flexslider-min.js"></script>
    <!--D-shine JS-->
    <script src="<?php echo THEME_PATH; ?>skin/js/d-shine.js"></script>
</body>

</html>