<style type="text/css">
<?php

/*
 * Header
 * 
 */
if (isset($themeLayout[0]['value']) && $themeLayout[0]['value']!=''){
?>
#navigation-test [class^="feed-"], #navigation-test .feed-notification li:hover, .header_top, #navigation-test [class^="menu-contain"], #navigation-test .menu-contain-gift li .submenu-contain ul, #navigation-test .gnb.hover [class^="mn-"],
.header_top,#header-new
{
	background: <?php echo $themeLayout[0]['value'];?>;
}
<?php 	
}
if (isset($themeLayout[1]['value']) && $themeLayout[1]['value']!=''){
?>
.header_top,#header-new
{
	border-bottom: 1px solid <?php echo $themeLayout[1]['value'];?>;
}
#navigation-test .gnb,#navigation-test .search
{
	border-left: 1px solid <?php echo $themeLayout[1]['value'];?>;
}
#navigation-test .gnb.current, #navigation-test .gnb.hover,
.shop .list .search-frm .selectBox-dropdown,
.shop .list .search-frm .search .selectBox-dropdown.selectBox-menuShowing
{
	border-color: <?php echo $themeLayout[1]['value'];?>;
}
#navigation-test .left .gnb:last-child,#navigation-test .left .gnb.hover:last-child
{
	border-right: 1px solid <?php echo $themeLayout[1]['value'];?>;
}
#navigation-test [class^="menu-contain"] ul,#navigation-test .menu-contain-cart tbody td, #navigation-test .menu-contain-cart tbody th
{
	border-top: 1px solid <?php echo $themeLayout[1]['value'];?>;
}
<?php 
}
if (isset($themeLayout[2]['value']) && $themeLayout[2]['value']!=''){
?>
#navigation-test a,#navigation-test [class^="menu-contain"] .hover li a,
#header-new .sign-cmt
{
	color: <?php echo $themeLayout[2]['value'];?>;
}
<?php 
}
if (isset($themeLayout[3]['value']) && $themeLayout[3]['value']!=''){
?>
#navigation-test .gnb.hover [class^="mn-"], #navigation-test a:hover, #navigation-test .menu-contain-lang .selected,
#navigation-test [class^="menu-contain"] .hover a, #navigation-test [class^="menu-contain"] .hover li a:hover
{
	color: <?php echo $themeLayout[3]['value'];?>;
}
<?php 
}
if (isset($themeLayout[12]['value']) && $themeLayout[12]['value']!=''){
?>
#navigation-test [class^="menu-contain"] a:hover, #navigation-test [class^="menu-contain"] .hover
{
	background: <?php echo $themeLayout[12]['value'];?>;
}
<?php 
}


/*
 * Body
 * 
 */
if (isset($themeLayout[4]['value']) && $themeLayout[4]['value']!=''){
?>
html,
body, select, input, textarea, button
{
	background: <?php echo $themeLayout[4]['value'];?>;
}
.classic .stream li,
.classic .figure-item .figure-img .figure.classic,
.figure-item
{
	background: <?php echo $themeLayout[4]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[5]['value']) && $themeLayout[5]['value']!=''){
?>
#content, .wrapper-content,
.shop_text, #popup_container .popup.onboarding,
#popup_container .popup.add-fancy,
#popup_container .popup.sign .popup_wrap,
#popup_container .popup.thing-detail,
.shop .figure-product-new,
.shop .list .search-frm .search .selectBox-dropdown.selectBox-menuShowing,
.selectBox-dropdown
{
	background: <?php echo $themeLayout[5]['value'];?>;
}
.usersection .wrapper, .set_area #sidebar,
.detail_leftbar,.detail_thing_info1,
.seller-details,
.detail_leftbar1,
.detail_sidebar,.detail_option,
.detail_sidebar_list
{
	background: <?php echo $themeLayout[5]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[10]['value']) && $themeLayout[10]['value']!=''){
?>
.welcome strong,
#container-wrapper.sign h2, .popup.sign h2
{
	color: <?php echo $themeLayout[10]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[11]['value']) && $themeLayout[11]['value']!=''){
?>
.welcome span,
#container-wrapper.sign h3.stit, .popup.sign h3.stit
{
	color: <?php echo $themeLayout[11]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[6]['value']) && $themeLayout[6]['value']!=''){
?>
.figure-item .figure-img,
.figure-item:hover .figure-img .figcaption,
.figure-product figcaption,
.figure-product:hover figcaption,
.thing-detail .thing-info h3,
.shop .figure-product-new figcaption,
.cart-list .table-cart tbody td.title b,
.usersection .feature .figure-item .figure-img .figcaption,
.usersection .figure-item .figure-img .figcaption,
.list .wrapper-content .figure-item .figure-img .figcaption,
.thing h3, .photo h3
{
	color: <?php echo $themeLayout[6]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[7]['value']) && $themeLayout[7]['value']!=''){
?>
.figure-item .price,
.thing-section p.prices,
.thing-detail .thing-info .price,
.shop .figure-product-new .price
{
	color : <?php echo $themeLayout[7]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[8]['value']) && $themeLayout[8]['value']!=''){
?>
html, body
{
	color: <?php echo $themeLayout[8]['value'];?>;
}
.figure-item .username i, .figure-item .price i,
.figure-item .username, .figure-item .username a,
.thing-detail .thing-info .description,
.thing-detail .thing-info .thing-option label,
.figure-product .username, .figure-product .username a,
.gift-option-area label,
.shop .list .search-frm .selectBox-dropdown .selectBox-label,
.cart-list .cart-payment-order li .order-payment-type,
.cart-list .cart-payment-order li .order-payment-usd,
.cart-list .cart-payment-order li .order-payment-usd b,
.cart-list .table-cart .optional-list li .option-tit,
.cart-list .table-cart tbody td.title,
.cart-list .note,
.usersection .user-cover .bio,
.usersection .user-cover .location, .usersection .user-cover .location a,
.usersection .user-cover .followers small,
.usersection .user-cover .followers b,
.set_area .set_menu dd a,
.list .vcard .note,
.thing .figure-product p
{
	color : <?php echo $themeLayout[8]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[9]['value']) && $themeLayout[9]['value']!=''){
?>
.figure-item .username a,
.figure-product .username a,
.thing .figure-product p a
{
	color : <?php echo $themeLayout[9]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[13]['value']) && $themeLayout[13]['value']!=''){
?>
#scroll-to-top span
{
	color: <?php echo $themeLayout[13]['value'];?>;
}
<?php 
}
if (isset($themeLayout[14]['value']) && $themeLayout[14]['value']!=''){
?>
#scroll-to-top
{
	background: <?php echo $themeLayout[14]['value'];?>;
}
<?php 
}
if (isset($themeLayout[15]['value']) && $themeLayout[15]['value']!=''){
?>
.footer_new
{
	background: <?php echo $themeLayout[15]['value'];?>;
}
<?php 
}
if (isset($themeLayout[16]['value']) && $themeLayout[16]['value']!=''){
?>
.footer_links strong
{
	color: <?php echo $themeLayout[16]['value'];?>;
}
<?php 
}
if (isset($themeLayout[17]['value']) && $themeLayout[17]['value']!=''){
?>
.footer_links li,
.footer_links li a,
.copy_rights,
.bottom_links li a,
.bottom_links li
{
	color: <?php echo $themeLayout[17]['value'];?>;
}
.footer_links strong
{
	border-bottom: 1px solid <?php echo $themeLayout[17]['value'];?>;
}
<?php 
}
if (isset($themeLayout[18]['value']) && $themeLayout[18]['value']!=''){
?>
.footer_links li a:hover,
.bottom_links li a:hover
{
	color: <?php echo $themeLayout[18]['value'];?>;
}
<?php 
}
if (isset($themeLayout[22]['value']) && $themeLayout[22]['value']!=''){
?>
a, a:visited,
.signed-out .thing-section .thing-info li a,
#container-wrapper.sign a, .popup.sign a,
#header-new .sign-cmt a,
.usersection a,
.usersection a:hover,
.cart-list .cart-payment dl.cart-payment-ship a,
.cart-list .table-cart tbody td.quantity a,
.cart-list .table-cart tbody td.thumnail a
{
	color: <?php echo $themeLayout[22]['value'];?>;
}
<?php 
}
if (isset($themeLayout[19]['value']) && $themeLayout[19]['value']!=''){
?>
.shop_browse span,
.might-fancy span,
.thing h3, .photo h3,
.shop .breadcrumbs a,
.cart-list h2,
.cart-order-depth li.current,
.notify h2,
#navigation-test [class^="feed-"] h4,
.collaborative h2,
.set_area h2.ptit
{
	color: <?php echo $themeLayout[19]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[20]['value']) && $themeLayout[20]['value']!=''){
?>
.shop_browse li
{
	background-color: <?php echo $themeLayout[20]['value'];?>;
}
<?php 
}
if (isset($themeLayout[21]['value']) && $themeLayout[21]['value']!=''){
?>
.shop_browse b
{
	color: <?php echo $themeLayout[21]['value'];?>;
}
<?php 
}
if (isset($themeLayout[23]['value']) && $themeLayout[23]['value']!=''){
?>
.selstory-head
{
	background-color: <?php echo $themeLayout[23]['value'];?>;
}
<?php 
}
if (isset($themeLayout[24]['value']) && $themeLayout[24]['value']!=''){
?>
.selstory-head
{
	color: <?php echo $themeLayout[24]['value'];?>;
}
<?php 
}
if (isset($themeLayout[25]['value']) && $themeLayout[25]['value']!=''){
?>
.usersection .user-tab,
.usersection .stit,
.list .wrapper-content header,
.top-menu,
.everything_list,
.detail_link_list
{
	background: <?php echo $themeLayout[25]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[26]['value']) && $themeLayout[26]['value']!=''){
?>
.usersection .user-tab a:hover
{
	background: <?php echo $themeLayout[26]['value'];?> !important;
}
.top-menu .sorting a:hover{
	background-color: <?php echo $themeLayout[26]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[27]['value']) && $themeLayout[27]['value']!=''){
?>
.usersection .user-tab a.current,
.list .stats-list.tab li.active
{
	background: <?php echo $themeLayout[27]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[28]['value']) && $themeLayout[28]['value']!=''){
?>
.usersection .user-tab a,
.usersection .stit,
.list .stats-list.tab li a,
.top-menu .sorting a,
.detail_link_list
{
	color: <?php echo $themeLayout[28]['value'];?> !important;
	text-shadow: none !important;
}
<?php 
}
if (isset($themeLayout[29]['value']) && $themeLayout[29]['value']!=''){
?>
.usersection .user-tab a.current,
.list .stats-list.tab li.active,
.top-menu .sorting a.current
{
	color: <?php echo $themeLayout[29]['value'];?> !important;
	text-shadow: none !important;
}
<?php 
}
if (isset($themeLayout[30]['value']) && $themeLayout[30]['value']!=''){
?>
.usersection .user-tab small,
.list .stats-list.tab li.active strong, .list .stats-list.tab li a strong
{
	color: <?php echo $themeLayout[30]['value'];?> !important;
	text-shadow: none !important;
}
<?php 
}
if (isset($themeLayout[31]['value']) && $themeLayout[31]['value']!=''){
?>
.usersection .user-cover .username
{
	color: <?php echo $themeLayout[31]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[32]['value']) && $themeLayout[32]['value']!=''){
?>
.set_area .section .stit
{
	color: <?php echo $themeLayout[32]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[33]['value']) && $themeLayout[33]['value']!=''){
?>
.set_area .section .frm label
{
	color: <?php echo $themeLayout[33]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[34]['value']) && $themeLayout[34]['value']!=''){
?>
.set_area .section .frm .comment
{
	color: <?php echo $themeLayout[34]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[35]['value']) && $themeLayout[35]['value']!=''){
?>
.set_area .set_menu dd a.current
{
	background: <?php echo $themeLayout[35]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[36]['value']) && $themeLayout[36]['value']!=''){
?>
.set_area .set_menu dd a.current
{
	color: <?php echo $themeLayout[36]['value'];?> !important;
}
<?php 
}
if (isset($themeLayout[37]['value']) && $themeLayout[37]['value']!=''){
?>
.cart-order-depth li,
.usersection .activity-list .time
{
	color: <?php echo $themeLayout[37]['value'];?> !important;
}
<?php 
}
?>
</style>