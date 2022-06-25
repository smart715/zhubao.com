<footer class="row">
        <div class="row m0 topFooter">
            <div class="container line1">
                <div class="row footFeatures">
                    <div class="col-sm-4 footFeature">
                        <div class="media">
                            <div class="media-left icon"><img src="<?php echo mys_get_file(mys_block('free_shippingt')); ?>" alt=""></div>
                            <div class="media-body texts">
                                <h4><?php echo mys_block('free_shipping', 1); ?></h4>
                                <h2><?php echo mys_block('free_shipping'); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 footFeature">
                        <div class="media m0">
                            <div class="media-left icon"><img src="<?php echo mys_get_file(mys_block('24_hours_helplinet')); ?>" alt=""></div>
                            <div class="media-body texts">
                                <h4><?php echo mys_block('24_hours_helplinet', 1); ?></h4>
                                <h2><?php echo SITE_TEL; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 footFeature">
                        <div class="media m0">
                            <div class="media-left icon"><img src="<?php echo mys_get_file(mys_block('see_ourtu')); ?>" alt=""></div>
                            <div class="media-body texts">
                                <h4><?php echo mys_block('see_our', 1); ?></h4>
                                <h2><?php echo mys_block('see_our'); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container line2">
                <div class="row" style="display: flex;
                justify-content: space-between;">
                    <div class="col-sm-3 widget">
                        <div class="row m0">
                            <h4><?php echo mys_block('about_dshine', 1); ?></h4>
                            <p><?php echo mys_block('about_dshine'); ?></p>
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
                                <!-- <li><a href="index.php?c=category&id=2">About Us</a></li>
                                <li><a href="index.php?c=category&id=4">Blog</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Top Brands</a></li> -->
                                <?php $list_return = $this->list_tag("action=category module=share pid=0"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?> 
                                <li><a href="<?php echo $t['url']; ?>"><?php echo $t['name']; ?></a></li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 widget">
                        <div class="row m0">
                            <h4>top brands</h4>
                            <ul class="nav">
                                    <?php $list_return = $this->list_tag("action=category module=share pid=0"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?> 
                                <li><a href="<?php echo $t['url']; ?>"><?php echo $t['name']; ?></a></li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-sm-3 widget">
                        <div class="row m0">
                            <h4>subscribe to our latest news</h4>
                            <form action="subscriptionList.php" method="post" role="form">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="subscribeEmail" name="subscribeEmail"
                                        placeholder="EMAIL ADDRESS">
                                </div>
                                <input type="submit" class="form-control" value="Subscribe" id="submit" name="submit">
                            </form>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="row m0 copyRight">
            <div class="container">
                <div class="row">
                    <div class="fleft"><?php echo SITE_COPYRIGHT; ?>
                        <a href="#" target="_blank" rel="noopener noreferrer"><?php echo SITE_ICP; ?></a>
                    </div>
                    <ul class="nav nav-pills fright">
                            <?php $list_return = $this->list_tag("action=category module=share pid=0"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?> 
                        <li><a href="<?php echo $t['url']; ?>"><?php echo $t['name']; ?></a></li>
                        <?php } } ?>
                    </ul>
                </div>
            </div>
        </div>
    </footer>