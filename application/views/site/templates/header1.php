<!-- Bootstrap theme added by Cedex -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

<!-- Static navbar -->
<nav class="navbar navbar-static-top">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="line div72 text-center line"><a class="navbar-brand" href="#"><img class="logo-margin" src="<?php echo base_url('assets/img/logo_icon.jpg'); ?>" /></a></li>

                <li class="div144 text-center line" id="brand_name"><a href="#">Sexiest Shoppe</a></li>

                <li class="dropdown text-center line div72">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger icon-big" aria-hidden="true"></span></a>
                    <ul class="dropdown-menu2 min_400" role="menu">
                        <div class="div_400 col-md-12 col-sm-12">
                            <?php //print_r($all_categories) ?>

                            <div class="col-md-3 col-sm-3 test padding_zero">
                                <?php $index = 0; ?>
                                <?php foreach ($all_categories as $key => $category): ?>
                                    <?php if ((((($index + 1) % $split) == 0) && $index != 0)): ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ((($index + 1) % $split) == 0): ?>
                                    <div class="col-md-3 col-sm-3 test vertical_line padding_zero">
                                    <?php endif; ?>
                                    <li><a href="<?php echo $category->orginal_url; ?>"><i class="fa fa-angle-right"></i> <?php echo $category->cat_name; ?></a></li>
                                    <?php $index++; ?>
                                <?php endforeach; ?>
                            </div>

                            <!-- <div class="col-md-3 col-sm-3 test ">
                                 <li><a href="page-about-basic.html"><i class="fa fa-angle-right"></i> About Basic</a></li>
                                 <li><a href="page-about-us.html"><i class="fa fa-angle-right"></i> About Us</a></li>
                                 <li><a href="page-about-me.html"><i class="fa fa-angle-right"></i> About Me</a></li>
                             </div>
                            -->

                            <div class="col-md-3 col-sm-3 test vertical_line padding_zero">
                                <li><a href="javascript:void(0)"><i class="fa fa-angle-right"></i> Stores</a></li>

                                <li class="menu-item dropdown dropdown-submenu width90">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">By Price</a>
                                    <ul class="dropdown-menu2">
                                        <?php foreach ($pricefulllist->result() as $priceRangeRow): ?>
                                            <li><a href="shopby/all?p=<?php echo url_title($priceRangeRow->price_range); ?>"><?php echo $currencySymbol . ' ' . ucfirst($priceRangeRow->price_range); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>

                                <li class="menu-item dropdown dropdown-submenu width90">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">By Color</a>
                                    <ul class="dropdown-menu2">
                                        <?php foreach ($mainColorLists->result() as $colorRow): ?>
                                            <li><a href="shopby/all?c=<?php echo strtolower($colorRow->list_value); ?>"><i class="color <?php echo strtolower($colorRow->list_value); ?>"></i> <?php echo ucfirst($colorRow->list_value); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>

                                <li><a href="fancybox"><i class="fa fa-angle-right"></i> Gift Box</a></li>

                                <li><a href="gift-cards"><i class="fa fa-angle-right"></i> Gift Cards</a></li>

                                <li><a href="bookmarklets"><i class="fa fa-angle-right"></i> Bookmarklets</a></li>

                            </div>

                        </div>
                    </ul>
                </li>

                <li class="dropdown div72 text-center line">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-info-sign icon-big" aria-hidden="true"></span></span></a>
                    <ul class="dropdown-menu2 dropdown-menu1" role="menu">
                        <li class="horizontal-line"><a href="#">About Us</a></li>
                        <li class="horizontal-line"><a href="#">Android</a></li>
                        <li class="horizontal-line"><a href="#">Business</a></li>
                        <li class="horizontal-line"><a href="#">FAQ</a></li>
                        <li class="horizontal-line"><a href="#">Contact</a></li>
                        <li class="horizontal-line"><a href="#">Privacy Policy</a></li>
                    </ul>
                </li>

                <li class="line2"></li>
            </ul>

            <span class="search_bar srch">
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control" style="height:30px;" />
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
            </span>


            <ul class="nav navbar-nav navbar-right">
                <li class="div72 text-center line"><a href="#about"><span class="glyphicon glyphicon-shopping-cart icon-big" aria-hidden="true"></span>0</a></li>
                <li class="div72 text-center line"><a href="#about"><span class="glyphicon glyphicon-cloud-upload icon-big" aria-hidden="true"></span></a></li>

                <li class="div72 text-center line"><a class="navbar-brand" href="lang/en"><img class="flag" src="<?php echo base_url('assets/img/flag.jpg'); ?>" /></a></li>

                <li class="div72 text-center line"><a href="notifications"><span class="glyphicon glyphicon-flash icon-big" aria-hidden="true"></span></a></li>

                <li class="dropdown div72 text-center line">
                    <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown" role="button" aria-expanded="false"><img class="logo-margin" src="<?php echo base_url('images/users/' . $thumbImg); ?>" /></a>
                    <ul class="dropdown-menu2 dropdown-menu1" role="menu">
                        <?php if ($loginCheck != ''): ?>
                            <li class="horizontal-line"><a href="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Upload</a></li>
                            <li class="horizontal-line"><a href="invite-friends"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Invite</a></li>
                            <li class="horizontal-line"><a href="settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a></li>
                            <li><a href="logout"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign Out</a></li>
                        <?php else: ?>
                            <li class="horizontal-line log_style1"><a href="#">Social Media Login</a></li>
                            <li class="horizontal-line log_style1"><a href="login">Login</a></li>
                            <li class="horizontal-line log_style1"><a href="signup" class="popup-signup-ajax">Sign Up</a></li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li class="line2"></li>
            </ul>

        </div><!--/.nav-collapse -->
    </div>
</nav>
<!-- header_end -->