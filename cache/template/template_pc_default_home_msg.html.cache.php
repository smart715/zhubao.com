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

    <!--Mechanic Styles-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

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
                <!-- <ul class="breadcrumb fright">
                    <li><a href="/">HOME</a></li>
                    <span style="color:black">&nbsp; / </span>
                    <span style="color:black">&nbsp;<?php echo mys_catpos($catid, ' / ', true, '&nbsp;<a href=[url] style="color:black">[name]</a>'); ?></span>
                </ul> -->
            </div>
        </div>
    </section>

    <section class="row contentRowPad greybg">
        <div class="container">
            <div class="row"> 
                <ul class="list clearfix" style="list-style:none;display: flex;justify-content: space-between;">
                        <?php $list_return = $this->list_tag("action=search module=MOD_DIR id=$searchid total=$sototal order=$params[order] urlrule=$urlrule catid=$catid  page=10 pagesize=2"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                        <?php if ($sototal) { ?>
                        <li class="item"> <a class="clearfix" href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>">
                          <div class="txt fr">
                            <h3 style="color:black;text-align: center"><?php echo $t['title']; ?></h3>
                            <div class="mark" style="background:none;color:grey;display: flex;justify-content: space-around;"><span>时间：<?php echo mys_date($t['_inputtime'],'Y-m-d'); ?></span>
                                <span>浏览量：<?php echo $t['hits']; ?></span>
                            </div>
                            <p class="desc"><?php echo $t['description']; ?></p>
                          </div>
                          <div class="img"> <img src="<?php echo mys_get_file($t['thumb']); ?>" alt="<?php echo $t['title']; ?>"></div>
                          </a>
                        </li>

                        <?php } } ?>
                </ul>
            </div>
        </div>
    </section>

    <div><?php echo $pages; ?></div>

    <style>
        .pagination {
            display: flex;
            justify-content: center
        }
    </style>

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