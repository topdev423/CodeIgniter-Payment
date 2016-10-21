<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "site/landing";
$route['404_override'] = '';

$route['admin'] = "admin/adminlogin";
$route['signup'] = "site/user/signup_form";
$route['login'] = "site/user/login_form";
$route['logout'] = "site/user/logout_user";
$route['forgot-password'] = "site/user/forgot_password_form";
$route['send-confirm-mail'] = "site/user/send_quick_register_mail";
$route['onboarding'] = "site/product/onboarding";
$route['gift-cards'] = "site/giftcard";
$route['cart'] = "site/cart";
$route['checkout/(:any)'] = "site/checkout";
$route['order/(:any)'] = "site/order";

$route['settings'] = "site/user_settings";
$route['settings/password'] = "site/user_settings/password_settings";
$route['settings/preferences'] = "site/user_settings/preferences_settings";
$route['settings/notifications'] = "site/user_settings/notifications_settings";
$route['purchases'] = "site/user_settings/user_purchases";
//$route['gifts/list'] = "site/user_settings/user_group_gifts";
$route['orders'] = "site/user_settings/user_orders";
$route['fancyybox/manage'] = "site/user_settings/manage_fancyybox";
$route['settings/shipping'] = "site/user_settings/shipping_settings";
$route['credits'] = "site/user_settings/user_credits";
$route['referrals/(:any)'] = "site/user_settings/user_referrals/$1";
$route['referrals'] = "site/user_settings/user_referrals";
$route['settings/giftcards'] = "site/user_settings/user_giftcards";
$route['things/(:any)/edit'] = "site/product/edit_product_detail/$1";
$route['things/(:any)/edit/(:any)'] = "site/product/edit_product_detail/$1";
$route['things/(:any)/delete'] = "site/product/delete_product/$1";
$route['things/shuffle'] = "site/product/display_product_shuffle";
$route['things/(:any)'] = "site/product/display_product_detail/$1";
$route['user/(:any)/added'] = "site/user/display_user_added";
$route['user/(:any)/lists'] = "site/user/display_user_lists";
$route['user/(:any)/lists/(:num)'] = "site/user/display_user_lists_home";
$route['user/(:any)/lists/(:num)/followers'] = "site/user/display_user_lists_followers";
$route['user/(:any)/lists/(:num)/settings'] = "site/user/edit_user_lists";
$route['user/(:any)/wants'] = "site/user/display_user_wants";
$route['user/(:any)/owns'] = "site/user/display_user_owns";
$route['user/(:any)/follows'] = "site/user/display_user_follow";
$route['user/(:any)/following'] = "site/user/display_user_following/$1";
$route['user/(:any)/followers'] = "site/user/display_user_followers/$1";
$route['user/(:any)/things/(:any)'] = "site/product/display_user_thing/$1";
$route['user/(:any)'] = "site/user/display_user_profile/$1";
$route['shopby/(:any)'] = "site/searchShop/search_shopby/$1";
$route['shop'] = "site/shop";
$route['stores'] = "site/seller";

$route['giftguide/list/(:any)/followers'] = "site/searchShop/search_priceby_followers/$1";
$route['colorsby/list/(:any)/followers'] = "site/searchShop/search_colorby_followers/$1";
$route['giftguide/list/(:any)'] = "site/searchShop/search_priceby/$1";
$route['colorsby/list/(:any)'] = "site/searchShop/search_colorby/$1";

$route['fancybox'] = "site/fancybox";
$route['fancybox/(:any)/(:any)'] = "site/fancybox/display_fancybox/$1";

$route['sales/create'] = "site/product/sales_create";
$route['seller-signup'] = "site/user/seller_signup_form";

$route['pages/(:num)/(:any)'] = "site/cms/page_by_id";
$route['pages/(:any)'] = "site/cms";

$route['create-brand'] = "site/user/create_brand_form";
$route['view-purchase/(:any)'] = "site/user/view_purchase";
$route['view-order/(:any)'] = "site/user/view_order";
$route['order-review/(:num)/(:num)/(:any)'] = "site/user/order_review";
$route['order-review/(:num)'] = "admin/order/order_review";

$route['image-crop/(:any)'] = "site/user/image_crop";
$route['lang/(:any)'] = "site/fancybox/language_change/$1";

$route['notifications'] = "site/notify/display_notifications";

$route['payment-success'] = "admin/commission/display_payment_success";
$route['payment-failed'] = "admin/commission/display_payment_failed";

$route['bookmarklet'] = "site/bookmarklet";
$route['bookmarklets'] = "site/bookmarklet/display_bookmarklet";

$route['invite-friends'] = "site/user/invite_friends";
$route['feedback/(:num)'] = "site/user/display_user_product_feedback/$1";

$route['t/(:any)'] = "site/product/load_short_url";

/* End of file routes.php */
/* Location: ./application/config/routes.php */