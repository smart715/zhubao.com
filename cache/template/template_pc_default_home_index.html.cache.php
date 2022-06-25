<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $cat['name']; ?>_<?php echo SITE_NAME; ?></title>
    <!--Favicons-->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!--Bootstrap and Other Vendors-->
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/owl.carousel.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo THEME_PATH; ?>skin/css/flexslider.css" media="screen" />
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <!--Mechanic Styles-->
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/style.css">
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/responsive.css">
    <!--[if lt IE 9]>
      <script src="<?php echo THEME_PATH; ?>skin/js/html5shiv.min.js"></script>
      <script src="<?php echo THEME_PATH; ?>skin/js/respond.min.js"></script>
      <![endif]-->
</head>

<body>


    <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
    <?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
    <!--Header-->
    <section id="slider" class="row">
        <div class="row sliderCont flexslider m0">
               
            <ul class="slides nav">
                <?php $list_return = $this->list_tag("action=module module=lunbotu catid=$catid order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                <li style="width: 100%; float: left; margin-right: -100%; position: relative;display: block;">
                    <img src="<?php echo mys_get_file($t['thumb']); ?>" alt="">
                    <div class="text_lines row m0">
                        <div class="container p0">
                            <h3><?php echo $t['title']; ?></h3>
                            <h2><?php echo $t['description']; ?></h2>
                            <h4><a class="theme_btn with_i" href="#"><i class="fas fa-plus-circle"></i><?php echo $t['keywords']; ?></a></h4>
                        </div>
                    </div>
                    <!--Text Lines-->
                </li>
                <?php } } ?>

            </ul>
            <ul class="flex-direction-nav">
                <li class="flex-nav-prev"><a class="flex-prev" href="#"><i class="fas fa-angle-left"></i></a></li>
                <li class="flex-nav-next"><a class="flex-next" href="#"><i class="fas fa-angle-right"></i></a></li>
            </ul>
        </div>
    </section>
    <!--Slider-->
    <section id="ring_sec" class="ring_sec">
        <div id="trigger" class="container ">
            <div class="row">
                <div class="col-md-6  diamond_j_cont">
                    <div class="diamond_j" style="background-image: url(<?php echo mys_get_file(mys_block('dshine')); ?>);">
                    </div>
                    <div class="diamond_b">
                        <img alt="" class="img-responsive" src="<?php echo mys_get_file(mys_block('guanyuwomen')); ?>">
                    </div>
                </div>
                <div class="col-md-6  ring_cont">
                    <?php $list_return = $this->list_tag("action=category module=share id=2"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                    <h2><?php echo $t['name'];  echo mys_block('dshine', 1); ?></h2>
                    <p><?php echo $t['content']; ?></p>
                    <?php } } ?>
                    <a class="com_btn" href="index.php?c=category&id=2">Start More</a>
                </div>
            </div>
        </div>
    </section>
    <section id="shopRings">
        <div class="sectionTitle">
            <h3><?php echo mys_block('new_arrivels', 1); ?></h3>
            <h5><?php echo mys_block('new_arrivels'); ?></h5>
        </div>
        <div class="d-carousel-cener owl-carousel">
            <?php $list_return = $this->list_tag("action=module module=chanpin catid=1 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
            <div class="dc-inner">
                <a href="index.php?s=chanpin&c=show&id=61">
                    <img alt="ring" src="<?php echo mys_get_file($t['thumb']); ?>">
                    <div class="dc-containt">
                        <h2><?php echo $t['title']; ?></h2>
                        <p><?php echo $t['description']; ?></p>
                    </div>
                </a>
            </div>
            <?php } } ?>
        </div>
    </section>

    <section id="shopFeatures_new">
        <div class=" shopFeatures_new container">

            <ul>
                <?php $list_return = $this->list_tag("action=module module=chanpin catid=13 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                <?php if ($is_first) { ?>
                <li class="sf_first">
                    <img alt="" class="img-responsive" src="<?php echo mys_get_file($t['thumb']); ?>">
                    <div class="sf_box">
                        <div class="sf_box_inner">
                            <h2><?php echo $t['title']; ?></h2>
                            <h3><?php echo $t['keywords']; ?></h3>
                            <p><?php echo $t['description']; ?></p>
                        </div>
                    </div>
                </li>
                <?php } else { ?>
                <li>
                    <a href="index.php?c=category&id=5">
                        <img alt="" class="img-responsive" src="<?php echo mys_get_file($t['thumb']); ?>">
                        <div class="sf_box">
                            <div class="sf_box_inner">
                                <h3><?php echo $t['title']; ?></h3>
                                <p><?php echo $t['description']; ?></p>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
                <?php } } ?>
            </ul>
        </div>
    </section>
    <section id="featureProducts" class="row contentRowPad">
        <div class="container">
            <div class="row sectionTitle">
                <h3><?php echo mys_block('featured_products', 1); ?></h3>
                <h5><?php echo mys_block('featured_products'); ?></h5>
            </div>
            <div class="row">
                <?php $list_return = $this->list_tag("action=module module=chanpin catid=2 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                <div class="col-sm-3 product">
                    <div class="productInner row m0">
                        <div class="row m0 imgHov">
                            <img src="<?php echo mys_get_file($t['thumb']); ?>" alt="">
                            <div class="row m0 hovArea">
                                <div class="row m0 icons">
                                    <ul class="list-inline">
                                        <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fas fa-shopping-cart-alt"></i></a></li>
                                        <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                    </ul>
                                </div>
                                <div class="row m0 proType"><a href="index.php?c=category&id=2"><?php echo $t['description']; ?></a></div>
                                <div class="row m0 proRating">
                                    <i class="fas fa-star-o"></i>
                                    <i class="fas fa-star-o"></i>
                                    <i class="fas fa-star-o"></i>
                                    <i class="fas fa-star-o"></i>
                                    <i class="fas fa-star-o"></i>
                                </div>
                                <div class="row m0 proPrice"><i class="fas fa-usd"></i><?php echo $t['keywords']; ?></div>
                            </div>
                        </div>
                        <div class="row m0 proName"><a href="index.php?s=chanpin&c=show&id=61"><?php echo $t['title']; ?></a></div>
                        <div class="row m0 proBuyBtn">
                            <button class="addToCart btn">add to cart</button>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </section>
    <!--Feature Products 4 Collumn-->
    <section id="featureCategory" class="row contentRowPad">
        <div class="container">
            <div class="row m0 sectionTitle">
                <h3><?php echo mys_block('our_featured_categories', 1); ?></h3>
                <h5><?php echo mys_block('our_featured_categories'); ?></h5>
            </div>
            <div class="owl-carousel featureCats row m0">
                <?php $list_return = $this->list_tag("action=module module=chanpin catid=3 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                <div class="item">
                    <div class="row m0 imgHov">
                        <img src="<?php echo mys_get_file($t['thumb']); ?>" alt="">
                        <div class="row m0 hovArea">
                            <i class="fas fa-heart-o"></i><br>
                            <h4><?php echo $t['keywords']; ?></h4>
                            <a href="index.php?c=category&id=5">shop now</a>
                        </div>
                    </div>
                    <div class="cat_h">
                        <a href="index.php?c=category&id=5">
                            <h4><?php echo $t['title']; ?></h4>
                            <span><?php echo $t['description']; ?></span>
                        </a>
                    </div>
                </div>
                <?php } } ?>
            </div>
            <!-- <div class="owl-nav">
                <div class="owl-prev"><i class="fas fa-angle-left"></i></div>
                <div class="owl-next"><i class="fas fa-angle-right"></i></div>
            </div>
            <div class="owl-dots">
                <div class="owl-dot active"><span></span></div>
                <div class="owl-dot"><span></span></div>
            </div> -->
        </div>
    </section>
    <!--Feature Categories-->
    <section id="D-Shine" class="row contentRowPad">
        <div class="container">
            <div class="row sectionTitle">
                <h3><?php echo mys_block('this_is_dshine', 1); ?></h3>
                <h5><?php echo mys_block('this_is_dshine'); ?></h5>
            </div>
            <div class="row">
                <?php $list_return = $this->list_tag("action=module module=chanpin catid=4 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                <div class="col-sm-4 product">
                    <div class="productInner row m0">
                        <div class="row m0 imgHov">
                            <img src="<?php echo mys_get_file($t['thumb']); ?>" alt="">
                            <div class="row m0 hovArea">
                                <div class="row m0 icons">
                                    <ul class="list-inline">
                                        <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fas fa-shopping-cart-alt"></i></a></li>
                                        <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                    </ul>
                                </div>
                                <div class="row m0 proType"><a href="#"><?php echo $t['title']; ?></a></div>
                                <div class="row m0 proRating">
                                    <i class="fas fa-star-o"></i>
                                    <i class="fas fa-star-o"></i>
                                    <i class="fas fa-star-o"></i>
                                    <i class="fas fa-star-o"></i>
                                    <i class="fas fa-star-o"></i>
                                </div>
                                <div class="row m0 proPrice"><i class="fas fa-usd"></i><?php echo $t['keywords']; ?></div>
                            </div>
                        </div>
                        <div class="row m0 proName"><a href="index.php?s=chanpin&c=show&id=61"><?php echo $t['description']; ?></a></div>
                        <div class="row m0 proBuyBtn">
                            <button class="addToCart btn">add to cart</button>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </section>
    <!--Feature Products 4 Collumn-->
    <!-- <section id="testimonialTabs" class="row contentRowPad">
        <div class="container">
            <div class="row sectionTitle">
                <h3><?php echo mys_block('some_words_from_our_customers', 1); ?></h3>
                <h5><?php echo mys_block('some_words_from_our_customers'); ?></h5>
            </div>
            <div class="row">
                <div class="tab-content testiTabContent">
                    <?php $list_return = $this->list_tag("action=module module=chanpin catid=5 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                    <div role="tabpanel" class="tab-pane active" id="testi1">
                        <p><span class="t_q_start">“</span><?php echo $t['description']; ?><span class="t_q_end">”</span></p>
                        <h5 class="customerName"><?php echo $t['title']; ?></h5>
                    </div>
                    <?php } } ?>
                </div>
                <ul class="nav nav-tabs" role="tablist" id="testiTab">
                    <?php $list_return = $this->list_tag("action=module module=chanpin catid=5 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                    <li role="presentation">
                        <a href="#testi" aria-controls="testi" role="tab" data-toggle="tab">
                            <img src="<?php echo mys_get_file($t['thumb']); ?>" alt="">
                        </a>
                        <div class="testi_rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                        </div>
                    </li>
                    <?php } } ?>
                </ul>
            </div>
        </div>
    </section> -->
    <!--Testimonial Tabs-->
    <section id="brands" class="row contentRowPad">
        <div class="container">
            <div class="row sectionTitle">
                <h3><?php echo mys_block('our_brands', 1); ?></h3>
                <h5><?php echo mys_block('our_brands'); ?></h5>
            </div>
            <div class="row brands">
                <ul class="nav navbar-nav">
                    <?php $list_return = $this->list_tag("action=module module=chanpin catid=6 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                    <li><a href="#"><img src="<?php echo mys_get_file($t['thumb']); ?>" alt=""></a></li>
                    <?php } } ?>

                </ul>
            </div>
        </div>
    </section>
    <section id="homeBlog">
        <div class="container blog_j">
            <div class="row sectionTitle">
                <h3><?php echo mys_block('blog_updates', 1); ?></h3>
                <h5><?php echo mys_block('blog_updates'); ?></h5>
            </div>
            <div class="row">
                <?php $list_return = $this->list_tag("action=module module=chanpin catid=7 order=hits num=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                <div class="col-sm-6">
                    <div class="blog_inner single">
                        <div class="blog_j_img">
                            <img alt="" class="img-responsive" src="<?php echo mys_get_file($t['thumb']); ?>">
                            <div class="btn_readmore">
                                <a href="index.php?c=category&id=4">Read more</a>
                            </div>
                        </div>
                        <div class="blog_j_text">
                            <p><?php echo $t['description']; ?></p>
                            <span>
                                <?php echo $t['keywords'];  echo mys_date($t['_inputtime'],'d'); ?>
                            </span>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
                <div class="col-sm-6">
                    <div class="row">


                        <div class="col-sm-6">
                            <?php $list_return = $this->list_tag("action=module module=chanpin catid=7 order=updatetime num=2"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                            <div class="blog_inner">
                                <div class="blog_j_img">
                                    <img alt="" class="img-responsive" src="<?php echo mys_get_file($t['thumb']); ?>">
                                    <div class="btn_readmore">
                                        <a href="index.php?c=category&id=4">Read more</a>
                                    </div>
                                </div>
                                <div class="blog_j_text">
                                    <p><?php echo $t['description']; ?></p>
                                </div>
                                
                            </div>
                            <?php } } ?>
                        </div>

                            <div class="col-sm-6">
                                <?php $list_return = $this->list_tag("action=module module=chanpin catid=7 order=hits num=2"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                <div class="blog_inner">
                                    <div class="blog_j_img">
                                        <img alt="" class="img-responsive" src="<?php echo mys_get_file($t['thumb']); ?>">
                                        <div class="btn_readmore">
                                            <a href="index.php?c=category&id=4">Read more</a>
                                        </div>
                                    </div>
                                    <div class="blog_j_text">
                                        <p><?php echo $t['description']; ?></p>
                                    </div>
                                    
                                </div>
                                <?php } } ?>

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