<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * This controller contains the common functions
 * @author Teamtweaks
 *
 */
class MY_Controller extends CI_Controller {

    public $privStatus;
    public $data = array();

    function __construct() {
        parent::__construct();
        ob_start();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->helper('url');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->load->library('session');

        if ($this->config->item('common_prefix') && $this->config->item('common_prefix') != '' && $this->config->item('common_prefix') != '-') {
            define('SITE_COMMON_DEFINE', $this->config->item('common_prefix'));
        } else {
            define('SITE_COMMON_DEFINE', 'fancyy-');
        }

        if ($this->config->item('https_enabled') && $this->config->item('https_enabled') != '') {
            define('HTTTPS_ENABLED', $this->config->item('https_enabled'));
        } else {
            define('HTTTPS_ENABLED', 'no');
        }

        if (HTTTPS_ENABLED == 'yes') {
            if ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'on') {
                $this->session->keep_flashdata('sErrMSGType');
                $this->session->keep_flashdata('sErrMSG');
                redirect(base_url() . $this->uri->uri_string());
            }
        } else if (HTTTPS_ENABLED == 'no') {
            if ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off') {
                $this->session->keep_flashdata('sErrMSGType');
                $this->session->keep_flashdata('sErrMSG');
                redirect(base_url() . $this->uri->uri_string());
            }
        }
        /*
         * Connecting Database
         */
        $this->load->database();

        $this->data['demoserverChk'] = $demoserverChk = strpos($this->input->server('DOCUMENT_ROOT'), 'kaviraj/');

        /*
         * Loading CMS Pages
         */
        if ($_SESSION['cmsPages'] == '') {
            $cmsPages = $this->db->query('select * from ' . CMS . ' where `status`="Publish" and `hidden_page`="No" order by priority');
            $_SESSION['cmsPages'] = $cmsPages->result_array();
        }
        $this->data['cmsPages'] = $_SESSION['cmsPages'];

        /*
         * Loading Categories
         */
        if ($_SESSION['all_categories'] == '') {
            $_SESSION['all_categories'] = $this->db->query('select * from ' . CATEGORY . ' where `status`="Active" order by cat_position asc');
        }

        $this->data['all_categories'] = $_SESSION['all_categories'];
        $root_id_arr = array();
        if ($this->data['all_categories']->num_rows() > 0) {
            foreach ($this->data['all_categories']->result() as $all_cat_row) {
                if (!in_array($all_cat_row->rootID, $root_id_arr)) {
                    $root_id_arr[] = $all_cat_row->rootID;
                }
            }
        }

        $this->data['root_id_arr'] = array_filter($root_id_arr);



        /*
         * Loading Footer Widgets
         */
        if ($_SESSION['footerWidget'] == '') {
            $footerWidget = $this->db->query('select * from ' . FOOTER . ' where `status`="Active"');
            $_SESSION['footerWidget'] = $footerWidget->result_array();
        }
        $this->data['footerWidget'] = $_SESSION['footerWidget'];

        /*
         * Loading Theme Layouts
         */
        if ($_SESSION['themeLayout'] == '') {
            $themeLayout = $this->db->query('select * from ' . THEME_LAYOUT . '');
            $_SESSION['themeLayout'] = $themeLayout->result_array();
        }
        $this->data['themeLayout'] = $_SESSION['themeLayout'];

        /*
         * Loading Theme Controls
         */
        if ($_SESSION['layoutList'] == '') {
            $layoutList = $this->db->query('select * from ' . CONTROLMGMT . '');
            $_SESSION['layoutList'] = $layoutList;
        }
        $this->data['layoutList'] = $_SESSION['layoutList'];

        /*
         * Getting fancybox count
         */
        if ($_SESSION['fancyBoxCount'] == '') {
            $fancyBoxList = $this->db->query('select * from ' . FANCYYBOX . ' where `status`="Publish"');
            $_SESSION['fancyBoxCount'] = $fancyBoxList->num_rows();
        }
        $this->data['fancyBoxCount'] = $_SESSION['fancyBoxCount'];

        /*
         * Loading active languages
         */
        if ($_SESSION['activeLgs'] == '') {
            $activeLgsList = $this->db->query('select * from ' . LANGUAGES . ' where `status`="Active"');
            $_SESSION['activeLgs'] = $activeLgsList->result_array();
        }
        $this->data['activeLgs'] = $_SESSION['activeLgs'];

        /*
         * Loading default languages
         */
        if ($_SESSION['defaultLg'] == '') {
            $defaultLgList = $this->db->query('select * from ' . LANGUAGES . ' where `default`="yes"');
            $_SESSION['defaultLg'] = $defaultLgList->result_array();
        }
        $this->data['defaultLg'] = $_SESSION['defaultLg'];

        /*
         * Checking user language and loading user details
         */
        if ($this->checkLogin('U') != '') {
            $this->data['userDetails'] = $this->db->query('select * from ' . USERS . ' where `id`="' . $this->checkLogin('U') . '"');
            $selectedLangCode = $this->session->userdata('language_code');
            if ($this->data['userDetails']->row()->language != $selectedLangCode) {
                $this->session->set_userdata('language_code', $this->data['userDetails']->row()->language);
                $this->session->keep_flashdata('sErrMSGType');
                $this->session->keep_flashdata('sErrMSG');
                redirect($this->uri->uri_string());
            }
        }

        if (substr($uriMethod, 0, 7) == 'display' || substr($uriMethod, 0, 4) == 'view' || $uriMethod == '0') {
            $this->privStatus = '0';
        } else if (substr($uriMethod, 0, 3) == 'add') {
            $this->privStatus = '1';
        } else if (substr($uriMethod, 0, 4) == 'edit' || substr($uriMethod, 0, 6) == 'insert' || substr($uriMethod, 0, 6) == 'change') {
            $this->privStatus = '2';
        } else if (substr($uriMethod, 0, 6) == 'delete') {
            $this->privStatus = '3';
        } else {
            $this->privStatus = '0';
        }

        $this->load->model('pricing_model');
        $condition_price_full = '';
        $this->data['pricefulllist'] = $this->pricing_model->get_all_details(PRICING, array());
        $this->load->model('layout_model');
        $this->data['layoutfulllist'] = $this->layout_model->get_all_details(LAYOUT, array());
        $this->data['login_succ_msg'] = 'Login Success';
        if ($this->data['layoutfulllist']->num_rows() > 0) {
            foreach ($this->data['layoutfulllist']->result() as $layout_row) {
                if ($layout_row->place == 'login success msg') {
                    $this->data['login_succ_msg'] = $layout_row->text;
                }
            }
        }
        $this->data['title'] = $this->config->item('meta_title');
        ;
        $this->data['heading'] = '';
        $this->data['flash_data'] = $this->session->flashdata('sErrMSG');
        $this->data['flash_data_type'] = $this->session->flashdata('sErrMSGType');
        $this->data['adminPrevArr'] = $this->config->item('adminPrev');
        $this->data['adminEmail'] = $this->config->item('email');
        $this->data['privileges'] = $this->session->userdata('fc_session_admin_privileges');
        $this->data['subAdminMail'] = $this->session->userdata('fc_session_admin_email');
        $this->data['loginID'] = $this->session->userdata('fc_session_user_id');
        $this->data['allPrev'] = '0';
        $this->data['logo'] = $this->config->item('logo_image');
        $this->data['fevicon'] = $this->config->item('fevicon_image');
        $this->data['footer'] = $this->config->item('footer_content');
        $this->data['siteContactMail'] = $this->config->item('site_contact_mail');
        $this->data['WebsiteTitle'] = $this->config->item('email_title');
        $this->data['siteTitle'] = $this->config->item('email_title');
		$this->data['siteLOGO'] = $this->config->item('logo_site');
        $this->data['meta_title'] = $this->config->item('meta_title');
        $this->data['meta_keyword'] = $this->config->item('meta_keyword');
        $this->data['meta_description'] = $this->config->item('meta_description');
        $this->data['giftcard_status'] = $this->config->item('giftcard_status');
        $this->data['sidebar_id'] = $this->session->userdata('session_sidebar_id');
        if ($this->session->userdata('fc_session_admin_name') == $this->config->item('admin_name')) {
            $this->data['allPrev'] = '1';
        }
        $this->data['paypal_ipn_settings'] = unserialize($this->config->item('payment_0'));
        $this->data['paypal_credit_card_settings'] = unserialize($this->config->item('payment_1'));
        $this->data['authorize_net_settings'] = unserialize($this->config->item('payment_2'));
        $this->data['currencySymbol'] = $this->config->item('currency_currency_symbol');
        //		$this->data['currencySymbol'] = html_entity_decode($this->config->item('currency_currency_symbol'));
        $this->data['currencyType'] = $this->config->item('currency_currency_type');
        $this->data['datestring'] = "%Y-%m-%d %h:%i:%s";
        if ($this->checkLogin('U') != '') {
            $this->data['common_user_id'] = $this->checkLogin('U');
        } elseif ($this->checkLogin('T') != '') {
            $this->data['common_user_id'] = $this->checkLogin('T');
        } else {
            $temp_id = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $this->session->set_userdata('fc_session_temp_id', $temp_id);
            $this->data['common_user_id'] = $temp_id;
        }
        $this->data['emailArr'] = $this->config->item('emailArr');
        $this->data['notyArr'] = $this->config->item('notyArr');
        $this->load->model('minicart_model');
        $this->load->model('product_model');

        /*
         * Like button texts
         */
        define(LIKE_BUTTON, $this->config->item('like_text'));
        define(LIKED_BUTTON, $this->config->item('liked_text'));
        define(UNLIKE_BUTTON, $this->config->item('unlike_text'));

        if ($_SESSION['authUrl'] == '') {
            //header( 'Location:http://192.168.1.253/fancyclone/');
        }


        /* Refereral Start */

        if ($this->input->get('ref') != '') {
            //echo $this->input->get('ref');
            $referenceName = $this->input->get('ref');
            $this->session->set_userdata('referenceName', $referenceName);
        }

        /* Refereral End */

        /* Multilanguage start */
        if ($this->uri->segment('1') != 'admin') {

            $selectedLanguage = $this->session->userdata('language_code');
            $defaultLanguage = $this->data['defaultLg'][0]['lang_code'];
            if ($defaultLanguage == '') {
                $defaultLanguage = 'en';
            }
            $filePath = APPPATH . "language/" . $selectedLanguage . "/" . $selectedLanguage . "_lang.php";
            if ($selectedLanguage != '') {

                if (!(is_file($filePath))) {

                    $this->lang->load($defaultLanguage, $defaultLanguage);
                } else {
                    $this->lang->load($selectedLanguage, $selectedLanguage);
                }
            } else {
                $this->lang->load($defaultLanguage, $defaultLanguage);
            }
        }
        /* Multilanguage end */

        /*         * *Mini cart Lg*** */

        $mini_cart_lg = array();

        if ($this->lang->line('items') != '')
            $mini_cart_lg['lg_items'] = stripslashes($this->lang->line('items'));
        else
            $mini_cart_lg['lg_items'] = "items";

        if ($this->lang->line('header_description') != '')
            $mini_cart_lg['lg_description'] = stripslashes($this->lang->line('header_description'));
        else
            $mini_cart_lg['lg_description'] = "Description";

        if ($this->lang->line('qty') != '')
            $mini_cart_lg['lg_qty'] = stripslashes($this->lang->line('qty'));
        else
            $mini_cart_lg['lg_qty'] = "Qty";

        if ($this->lang->line('giftcard_price') != '')
            $mini_cart_lg['lg_price'] = stripslashes($this->lang->line('giftcard_price'));
        else
            $mini_cart_lg['lg_price'] = "Price";

        if ($this->lang->line('order_sub_total') != '')
            $mini_cart_lg['lg_sub_tot'] = stripslashes($this->lang->line('order_sub_total'));
        else
            $mini_cart_lg['lg_sub_tot'] = "Order Sub Total";

        if ($this->lang->line('proceed_to_checkout') != '')
            $mini_cart_lg['lg_proceed'] = stripslashes($this->lang->line('proceed_to_checkout'));
        else
            $mini_cart_lg['lg_proceed'] = "Proceed to Checkout";

        /*         * *Mini cart Lg*** */

        $this->data['MiniCartViewSet'] = $this->minicart_model->mini_cart_view($this->data['common_user_id'], $mini_cart_lg);
    }

    /**
     *
     * This function return the session value based on param
     * @param $type
     */
    public function checkLogin($type = '') {
        if ($type == 'A') {
            return $this->session->userdata('fc_session_admin_id');
        } else if ($type == 'N') {
            return $this->session->userdata('fc_session_admin_name');
        } else if ($type == 'M') {
            return $this->session->userdata('fc_session_admin_email');
        } else if ($type == 'P') {
            return $this->session->userdata('fc_session_admin_privileges');
        } else if ($type == 'U') {
            return $this->session->userdata('fc_session_user_id');
        } else if ($type == 'T') {
            return $this->session->userdata('fc_session_temp_id');
        }
    }

    /**
     *
     * This function set the error message and type in session
     * @param string $type
     * @param string $msg
     */
    public function setErrorMessage($type = '', $msg = '') {
        ($type == 'success') ? $msgVal = 'message-green' : $msgVal = 'message-red';
        $this->session->set_flashdata('sErrMSGType', $msgVal);
        $this->session->set_flashdata('sErrMSG', $msg);
    }

    /**
     *
     * This function check the admin privileges
     * @param String $name	->	Management Name
     * @param Integer $right	->	0 for view, 1 for add, 2 for edit, 3 delete
     */
    public function checkPrivileges($name = '', $right = '') {
        $prev = '0';
        $privileges = $this->session->userdata('fc_session_admin_privileges');
        extract($privileges);
        $userName = $this->session->userdata('fc_session_admin_name');
        $adminName = $this->config->item('admin_name');
        if ($userName == $adminName) {
            $prev = '1';
        }
        if (isset(${$name}) && is_array(${$name}) && in_array($right, ${$name})) {
            $prev = '1';
        }
        if ($prev == '1') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     *
     * Generate random string
     * @param Integer $length
     */
    public function get_rand_str($length = '6') {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     *
     * Unsetting array element
     * @param Array $productImage
     * @param Integer $position
     */
    public function setPictureProducts($productImage, $position) {
        unset($productImage[$position]);
        return $productImage;
    }

    /**
     *
     * Resize the image
     * @param int target_width
     * @param int target_height
     * @param string image_name
     * @param string target_path
     */
    public function imageResizeWithSpace($box_w, $box_h, $userImage, $savepath) {

        $thumb_file = $savepath . $userImage;

        list($w, $h, $type, $attr) = getimagesize($thumb_file);

        $size = getimagesize($thumb_file);
		
        switch ($size["mime"]) {
            case "image/jpeg":
                $img = imagecreatefromjpeg($thumb_file); //jpeg file
                break;
            case "image/gif":
                $img = imagecreatefromgif($thumb_file); //gif file
                break;
            case "image/png":
                $img = imagecreatefrompng($thumb_file); //png file
                break;

            default:
                $im = false;
                break;
        }

        $new = imagecreatetruecolor($box_w, $box_h);
        if ($new === false) {
            //creation failed -- probably not enough memory
            return null;
        }


        $fill = imagecolorallocate($new, 255, 255, 255);
        imagefill($new, 0, 0, $fill);

        //compute resize ratio
        $hratio = $box_h / imagesy($img);
        $wratio = $box_w / imagesx($img);
        $ratio = min($hratio, $wratio);

        if ($ratio > 1.0)
            $ratio = 1.0;

        //compute sizes
        $sy = floor(imagesy($img) * $ratio);
        $sx = floor(imagesx($img) * $ratio);

        $m_y = floor(($box_h - $sy) / 2);
        $m_x = floor(($box_w - $sx) / 2);

        if (!imagecopyresampled($new, $img, $m_x, $m_y, //dest x, y (margins)
                        0, 0, //src x, y (0,0 means top left)
                        $sx, $sy, //dest w, h (resample to this size (computed above)
                        imagesx($img), imagesy($img)) //src w, h (the full size of the original)
        ) {
            //copy failed
            imagedestroy($new);
            return null;
        }
        imagedestroy($i);
        imagejpeg($new, $thumb_file, 99);
    }

}
