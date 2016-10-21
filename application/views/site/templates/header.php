<?php
$pricesval = $pricefulllist->result_array();
$ColorsListVal = $mainColorLists->result_array();

if (is_file('google-login-mats/index.php')) {
    require_once 'google-login-mats/index.php';
}

$by_creating_accnt = str_replace("{SITENAME}", $siteTitle, $this->lang->line('header_create_acc'));

$all_temp_categories = $all_categories->result();
$all_categories = array();

foreach ($all_temp_categories as $key => $row) {
    $all_categories[$row->id] = $row;
}

foreach ($all_categories as $key => $row) {
    if ($all_categories[$key]->rootID == 0)
        $all_categories[$key]->orginal_url = $row->seourl;
    else {
        $seo_url = $row->seourl;
        $child = $row;
        while (isset($all_categories[$child->rootID])) {
            $child = $all_categories[$child->rootID];
            $seo_url = $child->seourl . "/" . $seo_url;
        }
        $all_categories[$key]->orginal_url = $seo_url;
    }

    $all_categories[$key]->orginal_url = "shopby/" . $all_categories[$key]->orginal_url;
}

$category_count = count($all_categories);
$split = round($category_count / 3);

if (($split * 3) < $category_count) {
    $split++;
}

// Fix 
$last_category = array_pop($all_categories);

// Get username
$profile_url = '';

// Thumb image
$thumbImg = 'user-thumb1.png';
if ($loginCheck != '') {
    if ($userDetails->row()->thumbnail) {
        $thumbImg = $userDetails->row()->thumbnail;
    }

    $profile_url = base_url('user/' . $userDetails->row()->user_name . '/added');
}

// Language changes
$language_code = ($this->session->userdata('language_code')) ? $this->session->userdata('language_code') : 'en';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php
        if ($this->config->item('google_verification')) {
            echo stripslashes($this->config->item('google_verification'));
        }
        if ($heading == '') {
            ?>
            <title><?php echo $title; ?></title>
        <?php } else { ?>
            <title><?php echo $heading; ?></title>
        <?php } ?>
        <meta name="Title" content="<?php echo $meta_title; ?>" />
        <meta name="keywords" content="<?php echo $meta_keyword; ?>" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <base href="<?php echo base_url(); ?>" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/logo/<?php echo $fevicon; ?>"/>
        <link rel="stylesheet" type="text/css" media="all" href="css/style_header.css"/>
        <link rel="stylesheet" type="text/css" media="all" href="css/glyphicon.css"  />
		
		<style type="text/css">
		    #navigation-test .gnb > .menu-contain-gift ul li .extra_style{color: #515761 !important; padding-left: 20px !important; height:28px !important;min-height:28px !important;line-height:28px !important;}
		    #navigation-test .gnb > .menu-contain-gift ul li .extra_style:hover{color:white !important; background-color: #00aeef !important;}
		</style>

        <!-- Loading Css Files -->
        <?php $this->load->view('site/templates/css_files'); ?>

        <!-- Loading Script Files -->
        <?php $this->load->view('site/templates/script_files'); ?>

        <!-- Loading Theme Settings-->
        <?php $this->load->view('site/templates/theme_settings'); ?>
    </head>
    <body>
        <!-- header_start -->
        <header>

            <div class="header_top">
                <div class="main">
                    <?php if($loginCheck != ""){ ?>
                        <input type="hidden" id="logged_in_user_id" value="<?php echo $this->session->userdata('fc_session_user_id'); ?>" />
                    <?php } ?>
                    <div id="navigation-test">


                        <div class="left">

                            <h1 class="line3 logo div72 "><a class="navbar_logo" href="<?php echo base_url(); ?>" alt="<?php echo $siteTitle; ?>" title="<?php echo $siteTitle; ?>"><img src="images/logo/<?php echo $logo; ?>" style="width:48px; height:48px"/></a></h1>

                            <h1 class="logo div144 line3"><a class="navbar_brandname" href="<?php echo base_url(); ?>" alt="<?php echo $siteTitle; ?>" title="<?php echo $siteTitle; ?>"><img src="images/logo/<?php echo $siteLOGO; ?>"/></a></h1>

                            <ul class="gnb-wrap">
                                <li class="gnb line div72 hov">
                                    <a class="mn-gifts icon-no-padding" href="shop"><span style="color:#BEBFC5" class="glyphicon glyphicon-menu-hamburger icon-big icon_align" aria-hidden="true"></span></a>
                                    <div class="menu-contain-gift" style="width:600px">
                                        <!-- Display categories -->


                                        <div class="span3 border_right"> 
                                            <ul>
                                                <li><a href="<?php echo site_url("?sortby=newest-oldest"); ?>">
                                                    <i class="fa fa-angle-right"></i>
                                                    New</a></li>
                                                <?php $index = 0; ?>
                                                <?php foreach ($all_categories as $key => $category): ?>
                                                    <?php if ((((($index + 1) % $split) == 0) && $index != 0)): ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ((($index + 1) % $split) == 0): ?>
                                                <div class="span3 border_right">
                                                    <ul>
                                                    <?php endif; ?>


                                                    <?php if ($index === 0): ?>
                                                        <li><a href="<?php echo $last_category->orginal_url; ?>"><i class="fa fa-angle-right"></i> <?php echo $last_category->cat_name; ?></a></li>
                                                    <?php endif; ?>
                                                    <li><a href="<?php echo $category->orginal_url; ?>"><i class="fa fa-angle-right"></i> <?php echo $category->cat_name; ?></a></li>
                                                    <?php $index++; ?>
                                                <?php endforeach; ?>
                                        </div>

                                        <div class="span3 ">
                                            <ul>
                                                <?php if ($fancyBoxCount > 0): ?>
                                                    <li> <a href="fancybox">
                                                            <?php
                                                            if ($this->lang->line('header_fancybox') != '') {
                                                                echo stripslashes($this->lang->line('header_fancybox'));
                                                            } else
                                                                echo "Gift Box";
                                                            ?>
                                                        </a> </li>
                                                <?php endif; ?>
                                                <?php if ($this->config->item('giftcard_status') == 'Enable'): ?>
                                                    <li> <a href="gift-cards">
                                                            <?php
                                                            if ($this->lang->line('giftcard_cards') != '') {
                                                                echo stripslashes($this->lang->line('giftcard_cards'));
                                                            } else
                                                                echo "Gift Cards";
                                                            ?>
                                                        </a> </li>
                                                <?php endif; ?>
                                                <?php if ($loginCheck != ''): ?>
                                                    <li> <a href="bookmarklets">
                                                            <?php
                                                            if ($this->lang->line('bookmarklets') != '') {
                                                                echo stripslashes($this->lang->line('bookmarklets'));
                                                            } else
                                                                echo "Bookmarklets";
                                                            ?>
                                                        </a> </li>
                                                <?php endif; ?>
                                            </ul>
                                            <ul>
                                                <li> <a href="shopby/all?p=<?php echo url_title($pricesval[0]['price_range']); ?>"><i class="arrow"></i>
                                                        <?php
                                                        if ($this->lang->line('header_by_price') != '') {
                                                            echo stripslashes($this->lang->line('header_by_price'));
                                                        } else
                                                            echo "By Price";
                                                        ?>
                                                    </a>
                                                    <div class="submenu-contain">
                                                        <ul>
                                                            <?php foreach ($pricefulllist->result() as $priceRangeRow) { ?>
                                                                <li><a href="shopby/all?p=<?php echo url_title($priceRangeRow->price_range); ?>"><?php echo $currencySymbol; ?> <?php echo ucfirst($priceRangeRow->price_range); ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <?php if ($mainColorLists->num_rows() > 0) { ?>
                                                    <li> <a class="color-red" href="shopby/all?c=<?php echo $ColorsListVal[0]['list_value']; ?>"><i class="arrow"></i>
                                                            <?php
                                                            if ($this->lang->line('header_by_color') != '') {
                                                                echo stripslashes($this->lang->line('header_by_color'));
                                                            } else
                                                                echo "By Color";
                                                            ?>
                                                        </a>
                                                        <div class="submenu-contain">
                                                            <ul class="palette">
                                                                <?php
                                                                foreach ($mainColorLists->result() as $colorRow) {
                                                                    if ($colorRow->list_value != '') {
                                                                        ?>
                                                                        <li><a href="shopby/all?c=<?php echo strtolower($colorRow->list_value); ?>"><i class="color <?php echo strtolower($colorRow->list_value); ?>"></i> <?php echo ucfirst($colorRow->list_value); ?></a></li>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="gnb line div72 hov"><a  href="javascript:void(0)"><span style="color:#BEBFC5" class="glyphicon glyphicon-info-sign icon-big icon_align " aria-hidden="true"></span></a>
                                    <div class="menu-contain-gift drp_dwn">
                                        <ul>
                                            <li><a href="<?php echo base_url('pages/about-us'); ?>">About Us</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="<?php echo base_url('pages/andriod'); ?>">Android</a></li>
                                        </ul>
                                        <ul>  
                                            <li><a href="<?php echo base_url('pages/business'); ?>">Business</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="<?php echo base_url('pages/contact'); ?>">FAQ</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="<?php echo base_url('pages/ratings'); ?>">Ratings</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="<?php echo base_url('pages/faq'); ?>">Contact</a></li>
                                        </ul>
                                        <ul> 
                                            <li><a href="<?php echo base_url("pages/privacy-policy") ?>">Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="middle1">
                            <form action="<?php base_url(); ?>shopby/all" class="search">
                                <div class="search_outer" style="border: 1px solid #e5e5e5">
                                    <fieldset class="search_inner1">
                                        <input type="text" name="q" class="text" id="search-query" placeholder="" value="" autocomplete="off" style="margin-top:5px"/>
                                        <button type="submit" class="btn-submit" style="height: 23px; width: 22px; margin-right:5px">
                                            <?php
                                            if ($this->lang->line('header_search') != '') {
                                                echo stripslashes($this->lang->line('header_search'));
                                            } else
                                                echo "Search";
                                            ?>
                                        </button>
                                        <div class="feed-search" style="display: none;">
                                            <h4>
                                                <?php
                                                if ($this->lang->line('header_suggestions') != '') {
                                                    echo stripslashes($this->lang->line('header_suggestions'));
                                                } else
                                                    echo "Suggestions";
                                                ?>
                                            </h4>
                                            <div class="loading" style="display: block;"><i></i> <img class="loader" src="images/site/loading.gif"/> </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </form>
                        </div>
						
                        <div class="right">
                            <ul class="gnb-wrap">
                                <li class="gnb hov div72" id="MiniCartViewDisp">		
                                    <?php echo $MiniCartViewSet; ?>	
                                    <div style="clear:both !important"></div>
                                </li>
                                <?php if ($loginCheck != ''): ?>
                                    <li class="gnb hov div72 ">	
										<a href="add" class="mn-add"><div class="cloud"></div></a>
										<div class="menu-contain-gift drp_dwn">
											<ul>
												<li><a href="add" class="mn-add extra_style" style="">Upload</a></li>
											</ul>
										</div>
									</li>
                                <?php else: ?>
                                    <li class="gnb hov div72 "><a href="login">
                                            <div class="cloud"></div>
                                        </a></li>
                                <?php endif; ?>

                                <!-- Flags -->
                                <li class="gnb hov div72"> <a href="lang/en" class="navbar-brand"><img class="flag" src="<?php echo base_url('assets/img/' . $language_code . '.jpg'); ?>"></a>
                                    <div class="menu-contain-gift drp_dwn" style="left: -80px !important;">
                                        <?php foreach ($activeLgs as $activeLg): ?>
                                            <ul>
                                                <li><a href="<?php echo 'lang/' . $activeLg['lang_code']; ?>" style="line-height: 12px; padding: 0 0px;"> <?php echo $activeLg['name']; ?></a></li>
                                            </ul>
                                        <?php endforeach; ?>

                                        <!-- <ul><li><a href="lang/en" style="line-height: 12px; padding: 0 0px;"> English</a></li></ul>
                                                                    <ul><li><a href="lang/de" style="line-height: 12px; padding: 0 0px;"> Deutsh</a></li></ul> --> 
                                    </div>
                                </li>

                                <!-- Notifications -->
                                <li class="gnb hov div72 gnb-notification"> 
									<a href="<?php echo ($loginCheck != '')? "notifications":"javascript:void(0)"; ?>"><span class="glyphicon glyphicon-flash icon-big icon_align" style="color:#BEBFC5; top:3px;" aria-hidden="true"></span></a>
                                    <?php if ($loginCheck != ''): ?>
                                        <span class="jquery_notify" style="background:#D81900;color:#fff;height:20px;width:20px;border-radius: 20px;position: absolute; top: 24px;left: 34px;text-align: center;font-size: 11px;line-height: 20px; display:none;"></span>
                                        <div class="menu-contain-gift drp_dwn feed-notification" style="left: -70px !important;">
                                            <i class="arrow"></i>
                                            <h4 style="padding:2px 0px 10px 0px;color:#a1a1a1 !important;border-top:none;text-indent: 10px; font-size:12px">Notifications</h4>
											<div class="loading" style="display: none;"><i></i></div>
                                            <!-- <ul>
                                                <li class=""><a href="notifications" style="line-height: 12px; padding: 0 0px;"><span class="glyphicon glyphicon-envelope" aria-hidden="true" style="color:#c7c8cc"></span> Notifications</a>0</li>
                                            </ul> -->
                                            <a href="notifications" class="moreFeed" id="see_all" style="color:#6C89B2 ;">See all notifications</a>
                                            <style>
                                                .moreFeed:hover{
                                                    color:#fff !important;
                                                }
                                            </style>
                                        </div>
                                    <?php endif; ?>
                                </li>
								
                                <?php if ($loginCheck != ''): ?>
                                    <li class="gnb hov div72 "><a class="navbar_profilepic" href="<?php echo $profile_url; ?>" alt=""><img style="margin-top:24px; width:48px; height:48px;" src="<?php echo base_url('images/users/' . $thumbImg); ?>"/></a>
                                        <div class="menu-contain-gift drp_dwn" style="left: -80px !important;"> 
                                          <!-- <ul><li><a href="add" style="line-height: 12px; padding: 0 0px;"><span style="color:#c7c8cc" class="glyphicon glyphicon-plus" aria-hidden="true"></span> Upload</a></li></ul> -->
                                            <ul>
                                                <li><a href="invite-friends" style="line-height: 12px; padding: 0 0px;"><span style="color:#c7c8cc" class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Invite</a></li>
                                            </ul>
                                            <ul>
                                                <li><a href="settings" style="line-height: 12px; padding: 0 0px;"><span style="color:#c7c8cc" class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a></li>
                                            </ul>
                                            <ul>
                                                <li class="line" style="line-height: 12px; padding: 0 0px;"><a style="line-height: 15px !important;" href="logout"><span style="color:#c7c8cc" class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign Out</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php else: ?>
                                    <li class="gnb hov div72 "><a class="navbar_profilepic" href="<?php echo base_url(); ?>" alt=""><img style="margin-top:24px; width:48px; height:48px" src="<?php echo base_url('images/users/' . $thumbImg); ?>"/></a>
                                        <div class="menu-contain-gift drp_dwn" style="left: -80px !important;">
                                            <ul>
                                                <li><a href="login" style="line-height: 12px; padding: 0 0px;"><span style="color:#c7c8cc" class="glyphicon glyphicon-plus" aria-hidden="true"></span> Sign In</a></li>
                                            </ul>
                                            <ul>
                                                <li class="line" style="line-height: 12px; padding: 0 0px;"><a href="signup"><span style="color:#c7c8cc" class="glyphicon glyphicon-user" aria-hidden="true"></span> Sign Up</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header_end --> 
        <!-- Loading Popup Templates -->
        <?php $this->load->view('site/templates/popup_templates'); ?>
        <?php
        if ($this->config->item('google_verification_code')) {
            echo stripslashes($this->config->item('google_verification_code'));
        }
        ?>