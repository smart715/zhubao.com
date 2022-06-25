
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $meta_title; ?></title>
    
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
    <!-- 系统关键js(所有自建模板必须引用) -->
    <script type="text/javascript">var assets_path = '<?php echo THEME_PATH; ?>assets/';var is_mobile_cms = '<?php echo \Soulcms\Service::IS_MOBILE(); ?>';</script>
    <script src="<?php echo LANG_PATH; ?>lang.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/layer/layer.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/js/cms.js" type="text/javascript"></script>
    <!-- 系统关键js结束 -->   
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
    
  
    
    <section id="contactRow" class="row contentRowPad">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row m0">
                        <h4 class="contactHeading heading">contact form style</h4>
                    </div>
                    <div class="row m0 contactForm">
                            <?php extract(mys_get_form_post_value('lianxi')) ?>
                            <form action="" class="message"  method="post" name="myform" id="myform" class="row m0">
                                <?php echo $form; ?> 
                        <!-- <form class="row m0" id="contactForm" method="post" name="contact" action="contact_process.php"> -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" name="data[name]" id="name">
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" name="data[email]" id="email">
                                </div>
                            </div>
                            <div class="row m0">
                                <label for="subject">subject *</label>
                                <input type="text" class="form-control" name="data[subject]" id="subject">
                            </div>
                            <div class="row m0">
                                    <label for="message">your message</label>
                                    <textarea name="data[message]" id="message" class="form-control"></textarea>
                                </div>
                            <!-- <div class="row m0">
                                <label for="message">your message</label>
                                <textarea name="data[message]" id="message" class="message"></textarea>
                            </div> -->
                            <div class="row m0 captchaRow">
                                <?php echo mys_code(120, 35); ?>
                                <label for="checkcode">Enter the above text</label>
                                <input type="text" class="form-control" name="code" id="checkcode">
                            </div>
                            <input type="button" class="btn btn-primary btn-lg filled" onclick="mys_ajax_submit('<?php echo $post_url; ?>', 'myform', '2000', '<?php echo $rt_url; ?>')" name="btn" value="send message">
                            <!-- <button class="btn btn-primary btn-lg filled" type="submit">send message</button>                             -->
                        </form>
                        <!-- <div id="success">
                                <span class="green textcenter">
                                    Your message was sent successfully! I will be in touch as soon as I can.
                                </span>
                        </div>
                        <div id="error">
                            <span>
                                Something went wrong, try refreshing and submitting the form again.
                            </span>
                        </div> -->
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row m0">
                        <h4 class="contactHeading heading">contact info style</h4>
                    </div>
                    <div class="media contactInfo">
                        <div class="media-left">
                            <i class="fas fa-map-marker"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="heading"><?php echo mys_block('_where_to_reach_us', 1); ?></h5>
                            <p><?php echo mys_block('_where_to_reach_us'); ?></p>
                            <h5><?php echo SITE_ADDRESS; ?></h5>
                        </div> 
                    </div> <!--contactInfo-->
                    <div class="media contactInfo">
                        <div class="media-left">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="heading"><?php echo mys_block('_email_us_', 1); ?></h5>
                            <p><?php echo mys_block('_email_us_'); ?></p>
                            <h5><?php echo SITE_EMAIL; ?></h5>
                        </div>
                    </div> <!--contactInfo-->
                    <div class="media contactInfo">
                        <div class="media-left">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="heading"><?php echo mys_block('need_to_call_us', 1); ?></h5>
                            <p><?php echo mys_block('need_to_call_us'); ?></p>
                            <h5><?php echo SITE_TEL; ?></h5>
                        </div>
                    </div> <!--contactInfo-->
                    <div class="media contactInfo">
                        <div class="media-left">
                            <i class="fas fa-question"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="heading"><?php echo mys_block('_we_have_great_support', 1); ?></h5>
                            <p><?php echo mys_block('_we_have_great_support'); ?></p>
                        </div>
                    </div> <!--contactInfo-->
                </div>
            </div>
        </div>
        <style>
            .col-sm-6 .media p{
                width: 280px
            }
        </style>
    </section>
      <section id="googleMapRow" class="row">
        <div class="row m0" id="mapBox"></div>
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
    
    <!--Google Map JS-->
    <script src="<?php echo THEME_PATH; ?>skin/js/google-map.js"></script>
    
    <!--Contact JS-->
    <script src="<?php echo THEME_PATH; ?>skin/js/contact.js"></script>
</body>
</html>
