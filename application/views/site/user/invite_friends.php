<?php
$this->load->view('site/templates/header');
?>
<div id="container-wrapper">
	<div class="container notify" style="width: 940px;">



		<div id="content">
			<p class="tit">
				<b> <?php if($this->lang->line('onboarding_invite_friends') != '') { echo $this->lang->line('onboarding_invite_friends'); } else echo "Invite friends to";echo " ".$siteTitle." </b><br>";
				if($this->lang->line('invite_friends_tag') != '') { echo $this->lang->line('invite_friends_tag'); } else echo "Search services you use to invite friends to"; ?>
				<?php echo " ".$siteTitle;?>. 
			
			</p>
			<div class="txt">
				<div class="scroll">
					<div class="intxt">
						<dl class="sns-people">
							<dt>
								<i class="ic-fb"></i> <span><b><?php if($this->lang->line('signup_facebook') != '') { echo stripslashes($this->lang->line('signup_facebook')); } else echo "Facebook"; ?>
								</b> </span>
								<button class="close">
									<span class="tooltip"><small><b></b> <?php if($this->lang->line('onboarding_close') != '') { echo stripslashes($this->lang->line('onboarding_close')); } else echo "Close"; ?>
									</small> </span>
								</button>
								<button class="btns-gray-embo facebook">
								<?php if($this->lang->line('invite_frds') != '') { echo stripslashes($this->lang->line('invite_frds')); } else echo "Invite friends"; ?>
								</button>
							</dt>
						</dl>
						<dl class="sns-people">
							<dt>
								<i class="ic-tw"></i> <span><b><?php if($this->lang->line('signup_twitter') != '') { echo stripslashes($this->lang->line('signup_twitter')); } else echo "Twitter"; ?>
								</b> </span>
								<button class="close">
									<span class="tooltip"><small><b></b> <?php if($this->lang->line('onboarding_close') != '') { echo stripslashes($this->lang->line('onboarding_close')); } else echo "Close"; ?>
									</small> </span>
								</button>
								<!-- 					<button class="btns-gray-embo"><?php if($this->lang->line('onboarding_find_frds') != '') { echo stripslashes($this->lang->line('onboarding_find_frds')); } else echo "Find friends"; ?></button></dt> -->
								<button class="btns-gray-embo twitter">
								<?php if($this->lang->line('invite_frds') != '') { echo stripslashes($this->lang->line('invite_frds')); } else echo "Invite friends"; ?>
								</button>
							</dt>
						</dl>
						<!--				<dl class="sns-people">
					<dt><i class="ic-gg"></i> <span><b><?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Google"; ?>+</b></span>
					<button class="close"><span class="tooltip"><small><b></b><?php if($this->lang->line('onboarding_close') != '') { echo stripslashes($this->lang->line('onboarding_close')); } else echo "Close"; ?></small></span></button>
					<button id="fancy-gplus-link" class="btns-gray-embo" data-gapiattached="true"><?php if($this->lang->line('onboarding_find_frds') != '') { echo stripslashes($this->lang->line('onboarding_find_frds')); } else echo "Invite friends"; ?></button></dt>
				</dl>
 -->
						<dl class="sns-people">
							<dt>
								<b><i class="ic-gm"></i> <span><b><?php if($this->lang->line('onboarding_gmail') != '') { echo stripslashes($this->lang->line('onboarding_gmail')); } else echo "Gmail"; ?>
									</b> </span> </b>
								<button class="close">
									<span class="tooltip"><small><b></b> <?php if($this->lang->line('onboarding_close') != '') { echo stripslashes($this->lang->line('onboarding_close')); } else echo "Close"; ?>
									</small> </span>
								</button>
								<button class="btns-gray-embo gmail">
								<?php if($this->lang->line('invite_frds') != '') { echo stripslashes($this->lang->line('invite_frds')); } else echo "Invite friends"; ?>
								</button>
							</dt>
						</dl>
						<p class="sns-notify">
						<?php if($this->lang->line('onboarding_choose_srvce') != '') { echo stripslashes($this->lang->line('onboarding_choose_srvce')); } else echo "Choosing a service will open a window for you to log in securely and invite your contacts to"; ?>
						<?php echo " ".$siteTitle;?>
							.
						</p>
					</div>
				</div>
			</div>
		</div>

		<?php
		$this->load->view('site/templates/footer_menu');
		?>
	</div>
</div>
<style>
<!--
.tit {
	position: relative;
	z-index: 2;
	color: #92959c;
	font-size: 13px;
	line-height: 22px;
	padding: 26px 20px 20px;
	border-bottom: 1px solid #ebecef;
}

.tit b {
	color: #393d4d;
	font-size: 18px;
}

.txt {
	position: relative;
	height: 400px;
	overflow: hidden;
	z-index: 1;
}

.txt .scroll {
	height: 100%;
	overflow: auto;
	margin-right: -7px;
	padding-right: 10px;
	overflow-x: hidden;
}

.intxt {
	position: relative;
	float: left;
	width: 100%;
}

.sns-people {
	border: 1px solid #d9dadb;
	border-bottom: 0;
	border-top-color: #ebecef;
	margin: 0 20px;
}

.sns-people:first-child {
	border-top-color: #d9dadb;
	border-radius: 3px 3px 0 0;
	margin-top: 20px;
}

.sns-people dt {
	position: relative;
	padding: 15px 17px;
	line-height: 40px;
}

.sns-people [class ^="ic-"] {
	background: url(images/site/onboarding.png) no-repeat;
	background-size: 430px 500px;
}

.sns-people [class ^="ic-"] {
	display: inline-block;
	width: 40px;
	height: 40px;
	border-radius: 3px;
	vertical-align: middle;
	margin-right: 7px;
}

.sns-people .ic-fb {
	background-position: -172px -313px;
	background-color: #526996;
}

.sns-people dt span {
	display: inline-block;
	line-height: 18px;
	vertical-align: middle;
	font-size: 13px;
	color: #92959c;
}

.sns-people dt span b {
	display: block;
	color: #393d4d;
}

button {
	cursor: pointer;
	vertical-align: middle;
}

.btns-gray-embo,a.btns-gray-embo {
	display: inline-block;
	text-shadow: 0 1px 0 #fff;
	color: #393d4d;
	font-weight: bold;
	padding: 0 13px;
	height: 30px;
	line-height: 28px;
	font-size: 13px;
	border: 1px solid #959595;
	border-color: #c1c1c1 rgb(180, 180, 180) rgb(163, 163, 163);
	box-shadow: inset 0 1px 0px rgb(252, 252, 252), 0 1px 1px
		rgba(0, 0, 0, 0.1);
	background: -webkit-linear-gradient(top, rgb(253, 253, 253), #f0f0f0 );
	background: -ms-linear-gradient(top, #fcfcfc, #f0f0f0);
	background: -moz-linear-gradient(top, #fcfcfc, #f0f0f0);
	background: -o-linear-gradient(top, #fcfcfc, #f0f0f0);
	filter: progid : DXImageTransform.Microsoft.gradient ( startColorstr =
		'#fcfcfc', endColorstr = '#f0f0f0' );
	border-radius: 3px;
}

.sns-people dt .btns-gray-embo {
	position: absolute;
	top: 50%;
	right: 15px;
	margin-top: -15px;
}

.sns-people .ic-tw {
	background-position: -212px -392px;
	background-color: #4bace2;
}

.sns-people .ic-gm {
	background-position: -253px -351px;
	background-color: #c0cdd2;
}

.sns-notify {
	border: 1px solid #d9dadb;
	border-top-color: #ebecef;
	border-radius: 0 0 3px 3px;
	margin: 0 20px 20px;
	font-size: 12px;
	padding: 17px 18px;
	line-height: 16px;
	color: #92959c;
}
-->
</style>
<script	src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
FB.init({
	    appId:'<?php echo $this->config->item('facebook_app_id');?>',
	    cookie:true,
	    status:true,
	    xfbml:true,
		oauth : true
    });

$('button.twitter').click(function() {
	var loc = baseURL;
	var param = {'location':loc};
	var popup = window.open(null, '_blank', 'height=400,width=800,left=250,top=100,resizable=yes', true);			
  var $btn = $(this);
  $.post(
		baseURL+'site/user/find_friends_twitter',
		param, 
		function(json){
			if (json.status_code==1) {
				popup.location.href = json.url;						
				}
			else if (json.status_code==0) {
				alert(json.message);
			}  
		},
		'json'
	);
});

$('button.facebook').click(function() {
	FB.ui({
	    method: 'apprequests',
	    message: 'Invites you to join on <?php echo $siteTitle;?> (<?php echo base_url();?>?ref=<?php echo $userDetails->row()->user_name;?>)'
	});
    });
$('button.gmail').click(function() {
  var loc = location.protocol+'//'+location.host;
 var param = {'location':loc};
	var popup = window.open(null, '_blank', 'height=550,width=900,left=250,top=100,resizable=yes', true);
  var $btn = $(this);
	$.post(
		baseURL+'site/user/find_friends_gmail',
		param, 
		function(json){
			if (json.status_code==1) {
				popup.location.href = json.url;	
			}
			else if (json.status_code==0) {
				alert(json.message);
			}  
		},
		'json'
	);
});
</script>
