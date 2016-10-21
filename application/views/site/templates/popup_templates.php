<!-- popups -->
<div id="popup_container"> <img class="loader" src="images/site/loading.gif">
  <div class="popup ly-title reply-popup"> </div>
  
<?php 
$this->load->view('site/popup/register');
$this->load->view('site/popup/shipping');
$this->load->view('site/popup/product');
$this->load->view('site/popup/fancyybox');
$this->load->view('site/popup/list');
$this->load->view('site/popup/gift_recommend');
$this->load->view('site/popup/comment');
$this->load->view('site/popup/upload');
$this->load->view('site/popup/share');
$this->load->view('site/popup/contact_seller');
?>

</div>
<!-- /popups -->