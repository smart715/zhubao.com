<header class="row" id="header">
    <div class="row m0 logo_line">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 logo">
                    <a href="/" class="logo_a"><img src="<?php echo SITE_LOGO; ?>" alt="D-shine" style="width: 108%;height: 164px;margin-top: -49px;margin-bottom: -37px;">
                    </a>
                </div>
                <div class="col-sm-7 searchSec">
                    <div class="col-sm-12">
                        <div class="fright searchForm">
                            <form action="/index.php">
                                <div class="input-group">
                                    <input type="hidden" name="c" value="search">
                                    <input type="hidden" name="s" value="chanpin">

                                    <!-- <input type="hidden" name="search_param" value="all" id="search_param"> -->
                                    <input type="text" class="form-control" name="keyword" placeholder="Search Products" onfocus="if(this.value==defaultValue)this.value=''" onblur="if(this.value=='')this.value=defaultValue">
                                    <span class="input-group-btn searchIco">
                                        <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-default m0 navbar-static-top">
        <div class="container-fluid container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
                    <i class="fas fa-bars"></i> MENU
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="nav navbar-nav" style="    display: flex;justify-content: space-around;">
                    <?php $list_return_c1 = $this->list_tag("action=category module=share pid=0  return=c1"); if ($list_return_c1) extract($list_return_c1, EXTR_OVERWRITE); $count_c1=count($return_c1); if (is_array($return_c1)) { foreach ($return_c1 as $key_c1=>$c1) {  $is_first=$key_c1==0 ? 1 : 0;$is_last=$count_c1==$key_c1+1 ? 1 : 0; ?>
                    <?php if ($c1['child']) { ?>

                    <li class=" dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $c1['name']; ?></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php $list_return_c2 = $this->list_tag("action=category module=share pid=$c1[id]  return=c2"); if ($list_return_c2) extract($list_return_c2, EXTR_OVERWRITE); $count_c2=count($return_c2); if (is_array($return_c2)) { foreach ($return_c2 as $key_c2=>$c2) {  $is_first=$key_c2==0 ? 1 : 0;$is_last=$count_c2==$key_c2+1 ? 1 : 0; ?>
                            <li><a href="<?php echo $c2['url']; ?>"><?php echo $c2['name']; ?></a></li>
                            <?php } } ?>
                        </ul>
                    </li>
                    <?php } else { ?>
                    <li class=""><a href="<?php echo $c1['url']; ?>"><?php echo $c1['name']; ?></a></li>
                    <?php } ?>
                    <?php } } ?>
                    <!-- <li class="offers_navbtn"><a href="#"><i class="fas fa-gift"></i>Offers</a></li> -->

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>