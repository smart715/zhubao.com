

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo $cat['name']; ?>_<?php echo SITE_NAME; ?></title>
      <!--Favicons-->
      <!--Favicons-->
      <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="theme-color" content="#ffffff">
      <!--Bootstrap and Other Vendors-->
      <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/fontawesome-all.min.css">
      <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/owl.carousel.css">
       
      <link rel="stylesheet" type="text/css" href="<?php echo THEME_PATH; ?>skin/css/flexslider.css" media="screen" />
      <!--Fonts-->
      <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
      <!--Mechanic Styles-->
      <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/style.css">
      <link rel="stylesheet" href="<?php echo THEME_PATH; ?>skin/css/responsive.css">
      <!--[if lt IE 9]>
      <script src="<?php echo THEME_PATH; ?>skin/css/html5shiv.min.js"></script>
      <script src="<?php echo THEME_PATH; ?>skin/css/respond.min.js"></script>
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
      <!-- <section id="whatWeDid" class="row contentRowPad">
         <div class="container">
            <div class="row">
               <div class="col-sm-6 tab_menu">
                  <div class="row m0">
                     <ul class="nav navbar-right" role="tablist" id="myTab">
                            <?php $list_return = $this->list_tag("action=module module=guanyu catid=5 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                        <li role="presentation" class=""><a  role="tab" data-toggle="tab"><?php echo $t['keywords']; ?></a></li>
                        <?php } } ?>
                    </ul>
                  </div>
               </div>
               <div class="col-sm-6 tab-contents">
                    <div class="tab-content">
                            <?php $list_return = $this->list_tag("action=module module=guanyu catid=5 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                            <div role="tabpanel" class="tab-pane" style="display:block">
                                    <h3><?php echo $t['title']; ?></h3>
                                    <p><?php echo $t['description']; ?></p>
                                 </div>
                         <?php } } ?>
                     
                    </div>
                 </div>
     
            </div>
         </div>
      </section> -->
     
      <!-- <section id="whatWeDid" class="row contentRowPad">
        <div class="container">
           <div class="row">
              <div class="col-sm-6 tab_menu">
                 <div class="row m0">
                    <ul class="nav navbar-right" role="tablist" id="myTab">
                            <?php $list_return = $this->list_tag("action=module module=guanyu catid=5 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                       <li role="presentation" class=""><a href="#wwd2018" aria-controls="wwd2018" role="tab" data-toggle="tab" aria-expanded="false"><?php echo $t['keywords']; ?></a></li>
                       <?php } } ?>
                       <li role="presentation" class="active"><a href="#wwd2017" aria-controls="wwd2017" role="tab" data-toggle="tab" aria-expanded="true">2017</a></li>
                       <li role="presentation"><a href="#wwd2016" aria-controls="wwd2016" role="tab" data-toggle="tab">2016</a></li>
                       <li role="presentation"><a href="#wwd2015" aria-controls="wwd2015" role="tab" data-toggle="tab">2015</a></li>
                    </ul>
                 </div>
              </div>
              <div class="col-sm-6 tab-contents">
                 <div class="tab-content">
                        <?php $list_return = $this->list_tag("action=module module=guanyu catid=5 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                    <div role="tabpanel" class="tab-pane" id="wwd2018">
                       <h3><?php echo $t['title']; ?></h3>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.</p>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.to help our lovely customers.</p>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.to help our lovely customers.</p>
                    </div>
                    <?php } } ?>
                    <div role="tabpanel" class="tab-pane active" id="wwd2017">
                       <h3>What we did in 2017</h3>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.</p>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.to help our lovely customers.</p>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.to help our lovely customers.</p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="wwd2016">
                       <h3>What we did in 2016</h3>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.</p>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.to help our lovely customers.</p>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.to help our lovely customers.</p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="wwd2015">
                       <h3>What we did in 2015</h3>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.</p>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.to help our lovely customers.</p>
                       <p>We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.to help our lovely customers.</p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section> -->

    <section id="times" class="times" style="width:1120px;margin:0 auto;">
            <?php $list_return = $this->list_tag("action=module module=guanyu catid=5 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
            <div  class="content" style="text-align:center;line-height:25px">
                    <h3><?php echo $t['title']; ?></h3>
                    <p><?php echo $t['description']; ?></p>
                 </div>
                 <?php } } ?>
    </section>

      <section id="hww" class="row contentRowPad">
         <div class="container">
            <h3><?php echo mys_block('how_we_work', 1); ?></h3>
            <?php $list_return = $this->list_tag("action=module module=guanyu catid=2 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
            <div class="col-sm-4">
               <h5><span><?php echo $t['keywords']; ?></span> <?php echo $t['title']; ?></h5>
               <p><?php echo $t['description']; ?></p>
            </div>
            <?php } } ?>
         </div>
      </section>
      <section id="ourTeam" class="row contentRowPad">
         <div class="container">
            <div class="row sectionTitle">
               <h3><?php echo mys_block('meet_our_team', 1); ?></h3>
            </div>
            <div class="row">
            <?php $list_return = $this->list_tag("action=module module=guanyu catid=3 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
               <div class="col-sm-3">
                  <div class="thumbnail">
                     <img src="<?php echo mys_get_file($t['thumb']); ?>" alt="...">
                     <div class="caption">
                        <h4><?php echo $t['title']; ?></h4>
                        <h5><?php echo $t['description']; ?></h5>
                        <ul class="list-inline row m0">
                           <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                           <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                     </div>
                  </div>
           
        </div> <?php } } ?>
            </div>
         </div>
      </section>
      <section id="testimonialTabs" class="row contentRowPad">
         <div class="container">
            <div class="row sectionTitle">
               <h3><?php echo mys_block('some_words_from_our_customers', 1); ?></h3>
               <h5><?php echo mys_block('some_words_from_our_customers'); ?></h5>
            </div>
            <div class="row">
                <?php $list_return = $this->list_tag("action=module module=guanyu catid=4 order=updatetime page=1"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
               <div class="col-sm-6">
                  <div class="row m0 testimonialStyle2">
                     <div class="testiInner">
                        <p><?php echo $t['description']; ?></p>
                        <div class="row m0 clientInfo">
                           <div class="thumbnail"><img src="<?php echo mys_get_file($t['thumb']); ?>" alt=""></div>
                           <div class="clientName"><?php echo $t['title']; ?></div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } } ?>
            </div>
         </div>
      </section>
      <!--Testimonial Tabs-->
      <section id="brands" class="row contentRowPad">
         <div class="container">
            <div class="row sectionTitle">
               <h3><?php echo mys_block('our_clients', 1); ?></h3>
               <h5><?php echo mys_block('our_clients'); ?></h5>
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
      <script src="<?php echo THEME_PATH; ?>skin/jsisotope-custom.js"></script>
      <!--FlexSlider-->
      <script src="<?php echo THEME_PATH; ?>skin/js/jquery.flexslider-min.js"></script>
      <!--D-shine JS-->
      <script src="<?php echo THEME_PATH; ?>skin/js/d-shine.js"></script>
   </body>
</html>

