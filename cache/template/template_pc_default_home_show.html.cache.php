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
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/bootstrap-select.min.css">
     
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_PATH; ?>skin/css/flexslider.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_PATH; ?>skin/css/bootstrap-rating.css" media="screen" />
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    <!--Mechanic Styles-->
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/style.css">
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/responsive.css">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
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
            <div class="row singleProduct">
                <div class="col-sm-7">
                    <div class="row m0 flexslider" id="productImageSlider">
                        <ul class="slides">
                                <?php $block=mys_block('show1');  if (is_array($block['file'])) { $count=count($block['file']);foreach ($block['file'] as $i=>$file) { ?>
                            <li><img src="<?php echo mys_get_file($file); ?>" alt=""></li>
                                <?php } } ?>
                
                        </ul>
                    </div>
                    <div class="row m0 flexslider" id="productImageSliderNav">
                        <ul class="slides">
                                <?php $block=mys_block('show2');  if (is_array($block['file'])) { $count=count($block['file']);foreach ($block['file'] as $i=>$file) { ?>
                            <li><img class="img-thumbnail" src="<?php echo mys_get_file($file); ?>" alt=""></li>
                                <?php } } ?>
                
                        </ul>
                    </div>
                </div>
                <div class="col-sm-5">
                       
                    <div class="row m0"> 
                        <?php $list_return = $this->list_tag("action=module module=chanpin catid=12 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                        <h4 class="heading"><?php echo $t['title']; ?></h4>
                        <h3 class="heading price"><?php echo $t['jiage']; ?></h3>
                        <!-- <div class="row m0 starsRow">
                            <div class="fleft">
                                    <?php echo $t['hits']; ?> Review(s) <span>|</span> <a href="#">Add Your Review</a>
                            </div>
                        </div> -->
                        <div class="row m0 shortDesc">
                            <p class="m0"><?php echo $t['description']; ?></p>
                        </div>
                       <?php } } ?>
                        <div class="row m0">
                            <ul class="list-inline wce">
                                <li><a href="#"><i class="far fa-heart"></i>Add to Wishlist</a></li>
                                <li><a href="#"><i class="fas fa-shopping-cart-alt"></i>Add to Compare</a></li>
                                <li><a href="#"><i class="fas fa-envelope"></i>Email to a Friend</a></li>
                            </ul>
                        </div>
                        <div class="row m0 qtyAtc">
                        
                            <button class="fleft btn btn-default"><img src="<?php echo mys_get_file(mys_block('gouwuche')); ?>" alt=""> add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m0 tabRow">
                <ul class="nav nav-tabs" role="tablist" id="shortcodeTab">
                    <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">
                        <i class="fas fa-align-left"></i> description
                    </a></li>
                   
                </ul>
                <div class="tab-content shortcodeTabContent">
                    <div role="tabpanel" class="tab-pane row m0 active" id="description">
                        <div class="fleft img"><img class="img-responsive" src="<?php echo mys_get_file(mys_block('product_detailst')); ?>" alt=""></div>
                        <div class="fleft desc">
                            <h5 class="heading"><?php echo mys_block('product_details', 1); ?></h5>
                            <p><?php echo mys_block('product_details'); ?></p>
                        </div>
                    </div>
                </div>
            </div> <!--Tabs Row-->
            <div class="row shortcodesRow m0">
                <div class="row sectionTitle">
                    <h3><?php echo mys_block('latest_products', 1); ?></h3>
                    <h5><?php echo mys_block('latest_products'); ?></h5>
                </div>
                <?php $list_return = $this->list_tag("action=module module=chanpin catid=$catid order=hits num=4"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
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
                                <div class="row m0 proType"><a href="#"><?php echo $t['description']; ?></a></div>
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
                        <div class="row m0 proName"><a href="<?php echo $t['url']; ?>"><?php echo $t['title']; ?></a></div>
                        <div class="row m0 proBuyBtn">
                            <button class="addToCart btn">add to cart</button>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </section>
    
    <footer class="row">
        <div class="row m0 topFooter">
            <div class="container line1">
                <div class="row footFeatures">
                    <div class="col-sm-4 footFeature">
                        <div class="media">
                            <div class="media-left icon"><img src="images/icons/car3.png" alt=""></div>
                            <div class="media-body texts">
                                <h4>free shipping</h4>
                                <h2>International</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 footFeature">
                        <div class="media m0">
                            <div class="media-left icon"><img src="images/icons/tel24-7_2.png" alt=""></div>
                            <div class="media-body texts">
                                <h4>24 hours helpline</h4>
                                <h2>123 456 789</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 footFeature">
                        <div class="media m0">
                            <div class="media-left icon"><img src="images/icons/shopping-bag2.png" alt=""></div>
                            <div class="media-body texts">
                                <h4>see our</h4>
                                <h2>latest offers</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container line2">
                <div class="row">
                    <div class="col-sm-3 widget">
                        <div class="row m0">
                            <h4>About Dshine</h4>
                            <p>We provide the best Quality of products to you.We are always here to help our lovely customers.</p>
                            <ul class="list-inline">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 widget">
                        <div class="row m0">
                            <h4>information</h4>
                            <ul class="nav">
                                <li><a href="about.html">About Us</a></li>
                                
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Top Brands</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 widget">
                        <div class="row m0">
                            <h4>top brands</h4>
                            <ul class="nav">
                                <li><a href="#">Fusce iaculis</a></li>
	                            <li><a href="#">Nisl dapibus</a></li>
	                            <li><a href="#">Vulputate sapien</a></li>
	                            <li><a href="#">Aliquet</a></li>
	                            <li><a href="#">Risus feugiat</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 widget">
                        <div class="row m0">
                            <h4>subscribe to our latest news</h4>
                            <form action="subscriptionList.php" method="post" role="form">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="subscribeEmail" name="subscribeEmail" placeholder="EMAIL ADDRESS">
                                </div>
                                <input type="submit" class="form-control" value="Subscribe" id="submit" name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row m0 copyRight">
            <div class="container">
                <div class="row">
                    <div class="fleft">Copyright &copy; 2018.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></div>
                    <ul class="nav nav-pills fright">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">about</a></li>
                        <li><a href="blog.html">blog</a></li>
                        <li><a href="contact.html">contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    
   
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
