<?php
$this->load->view('site/templates/header',$this->data);
?>
<style>

.bookmarkCon {
	background: #f0f3f6;
	border-top: 1px solid #e2e8ed;
	line-height: 67px;
	display: inline-block;
	min-width: 602px;
	padding: 0 14px;
	font-size: 16px;
	color: #373d48;
	margin-bottom: 28px;
}
.intro {
	border-bottom: 1px solid #ebecef;
}
.intro h3 {
	font-size: 30px;
	color: #22324e;
	padding-bottom: 12px;
	text-align: left;
	margin-bottom: 0;
}
.intro p {
	color: rgb(113, 118, 126);
	font-size: 18px;
	line-height: 26px;
}
.bookmarkTop {
}
.bookmarkTop h4 {
	font-size: 20px;
	color: #22324e;
	padding: 40px 0 27px;
	margin:0;
}
.bookmarkCon a{
	display: inline-block;
	background: #558cc9;
	border-radius: 5px;
	box-shadow: 0 3px 0 #3b5c8b;
	border: 0;
	padding: 0 20px;
	line-height: 40px;
	color: #fff;
	font-size: 18px;
	font-weight: bold;
	text-shadow: 0 -1px 0 #3b5c8b;
	margin: -7px 18px 0 0;
	cursor: move;
	vertical-align: middle;
	text-decoration:none;
}
.bookmarkTop p {
	line-height: 20px;
	padding-bottom: 10px;
}
.bookmarkTop ol {
	padding: 30px 0 10px;
}
.bookmarkTop li {
	position: relative;
	line-height: 20px;
	padding: 0 0 25px 33px;
}
.no {
	display: inline-block;
	width: 20px;
	height: 20px;
	line-height: 20px;
	text-align: center;
	color: #fff;
	font-size: 12px;
	font-weight: bold;
	background: #cbd2d8;
	border-radius: 10px;
	
	position: absolute;
	top: 0;
	left: 0;
}
.bookmarkTop strong {
	display: block;
	font-size: 14px;
}
</style>

<div id="container-wrapper">
	<div class="container notify" style="width:940px;">
		


	<div id="content">
		
		<div class="notifications altered">
			
			<div class="intro">
		<h3><?php if($this->lang->line('header_add_to') != '') { echo stripslashes($this->lang->line('header_add_to')); } else echo "Add to"; ?> <?php echo $siteTitle?></h3>
		<p><?php if($this->lang->line('be_a_part_of_the') != '') { echo stripslashes($this->lang->line('be_a_part_of_the')); } else echo "Be a part of the"; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('com_fav_things') != '') { echo stripslashes($this->lang->line('com_fav_things')); } else echo "community and add your favorite things"; ?>.</p>
	</div>
			
			
			<div class="bookmarkTop">
		<h4><?php if($this->lang->line('bo_ma_but') != '') { echo stripslashes($this->lang->line('bo_ma_but')); } else echo "Bookmarklet Button"; ?></h4>
		<div class="bookmarkCon">
 		<a href='javascript:(function(){

 		_my_script=document.createElement("SCRIPT");
		_my_script.type="text/javascript";
 		
		_my_script.src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js";
		document.getElementsByTagName("head")[0].appendChild(_my_script);
		
 		_my_script=document.createElement("SCRIPT");
		_my_script.type="text/javascript";
 		
 		document.body.setAttribute("bookmarklet-uid","<?php echo $loginCheck;?>");
 		document.body.setAttribute("bookmarklet-baseUrl","<?php echo base_url();?>");
		
		_my_script.id = "wanela-bookmarklet";
		_my_script.src="<?php echo base_url();?>js/bookmarklet/tagg.js?x="+(Math.random());
		document.getElementsByTagName("head")[0].appendChild(_my_script);

 		})();'><?php if($this->lang->line('header_add_to') != '') { echo stripslashes($this->lang->line('header_add_to')); } else echo "Add to"; ?> <?php echo $siteTitle?></a> <?php if($this->lang->line('drag_this') != '') { echo stripslashes($this->lang->line('drag_this')); } else echo "Drag this"; ?> <b><?php if($this->lang->line('button') != '') { echo stripslashes($this->lang->line('button')); } else echo "button"; ?></b> <?php if($this->lang->line('in_ur_bo_ma_bar') != '') { echo stripslashes($this->lang->line('in_ur_bo_ma_bar')); } else echo "into your Bookmarks Bar"; ?> </div> 



		<p><strong><?php if($this->lang->line('sav_thing_own_catlog') != '') { echo stripslashes($this->lang->line('sav_thing_own_catlog')); } else echo "The bookmarklet lets you save things and products from any site to your own catalog"; ?>.</strong></p>
		<p class="chrome"><?php if($this->lang->line('instal_bookmark') != '') { echo stripslashes($this->lang->line('instal_bookmark')); } else echo "To install the bookmarklet in your browser, follow these steps"; ?>:</p>
		<ol>
			<li><span class="no">1</span> <strong><?php if($this->lang->line('dis_bookma_bar') != '') { echo stripslashes($this->lang->line('dis_bookma_bar')); } else echo "Display Bookmarks Bar"; ?></strong>
			<span class="chrome"><?php if($this->lang->line('mak_sure_click') != '') { echo stripslashes($this->lang->line('mak_sure_click')); } else echo "Make sure your bookmarks are visible by clicking"; ?> <b>Settings &gt; Tools &gt; Always show Bookmarks Bar</b>.</span>
			<span class="firefox" style="display: none;">Make sure your bookmarks are visible by clicking the top left orange color <b>Firefox button &gt; Options &gt; Bookmarks Toolbar</b>.</span></li>
			<li><span class="no">2</span> <strong><?php if($this->lang->line('drag_bookma') != '') { echo stripslashes($this->lang->line('drag_bookma')); } else echo "Drag bookmarklet"; ?></strong> <?php if($this->lang->line('drag_blue_above') != '') { echo stripslashes($this->lang->line('drag_blue_above')); } else echo "Drag the blue button above to your Bookmarks bar"; ?>.</li>
			<li><span class="no">3</span> <strong><?php if($this->lang->line('ur_finish') != '') { echo stripslashes($this->lang->line('ur_finish')); } else echo "You're finished"; ?></strong> <?php if($this->lang->line('when_browse') != '') { echo stripslashes($this->lang->line('when_browse')); } else echo "When you are browsing a webpage, click"; ?> <b><?php if($this->lang->line('header_add_to') != '') { echo stripslashes($this->lang->line('header_add_to')); } else echo "Add to"; ?> <?php echo $siteTitle;?></b> <?php if($this->lang->line('to_add_catalog') != '') { echo stripslashes($this->lang->line('to_add_catalog')); } else echo "to add things to your personal catalog"; ?>.</li>
		</ol>
	</div>
			
			
			
 
 </div>
		</div>
		<!-- / wrapper-content -->
		</div>
	<!-- / container -->
</div>

<?php
$this->load->view('site/templates/footer',$this->data);
?>