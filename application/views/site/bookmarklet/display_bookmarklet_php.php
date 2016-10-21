<!DOCTYPE html>
<html>
<head>
	<title><?php echo $siteTitle;?></title>
	<link rel="stylesheet" href="css/site/fancyy-clone-style.css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<style type="text/css">
body{
	float: left;
	border: 1px solid rgb(151, 146, 146);
	box-shadow: 0 0 10px rgb(211, 204, 204);
	outline:none;
	height: 508px;
	width: 328px;
	margin:0;
}
.top_head {
	float: left;
	width: 308px;
	height: 20px;
	padding: 10px;
	background-color: #262932;
	margin-bottom: 10px;
}
.post_product .img button {
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
	border: 1px solid #CFCFCF;
	box-shadow: 0 1px 0 #F2F2F2;
	float: left;
	height: 23px;
	text-align: center;
	vertical-align: middle;
	width: 40px;
	border-radius: 0 3px 3px 0;
}
.start_btn_1 {
	font-size: 15px !important;
	font-weight: normal !important;
	margin: 5px !important;
	padding: 12px 30px !important;
	width: 220px !important;
	background-color: #1197D4 !important;
	border: none !important;
	cursor: pointer;
	color: #FFFFFF !important;
	text-transform: uppercase !important;
	border-radius: 5px;
}
.start_btn_1:hover {
	background: #0D75A5 !important;
}
.noimg {
	float: left;
	width: 100%;
	text-align: center;
	margin-top: 50px;
	font-weight: bold;
	color: black;
	font-size: 20px;
}
</style>


<script type="text/javascript">

var args = {'loc':parent.location}, hash, saving = false;
if(/^#tagger:/.test(hash=location.hash)) args = unparam(location.hash.substr(8));
/*window.addEventListener('message', receiveMessage, false);
function receiveMessage(event)
{
  alert (event.data);
  alert (event.origin);
  window.parent.postMessage("hi there yourself!  the secret response " +
          "is: rheeeeet!",
          event.origin);
}
window.postMessage("hello there!","*");
*/
function set_next(){
	$curPhoto = $('.photo-wrap.current ');
	$cur = $curPhoto.data('count');
	$cur++;
	$nextPhoto = $curPhoto.next();
	if($nextPhoto.hasClass('photo-wrap')){
		$curPhoto.hide().removeClass('current');
		$nextPhoto.show().addClass('current');
		$('.cur_ span').text($cur);
		$('#add_photo_url').val($nextPhoto.data('url'));
	}
}
function set_prev(){
	$curPhoto = $('.photo-wrap.current ');
	$cur = $curPhoto.data('count');
	$cur--;
	$prevPhoto = $curPhoto.prev();
	if($prevPhoto.hasClass('photo-wrap')){
		$curPhoto.hide().removeClass('current');
		$prevPhoto.show().addClass('current');
		$('.cur_ span').text($cur);
		$('#add_photo_url').val($prevPhoto.data('url'));
	}
}
function closeBookmarklet() {
	// $('#bookmarkletFrame', window.parent.document).remove();
	 //document.getElementById('bookmarklet-show').style.visibility = "hidden";	
	//send({cmd:'close'}); return false
	window.close();
}

if('postMessage' in window){
	$(window).on('message', function(event){
		var args = unparam(event.originalEvent.data);
		onMessage(args);
	});
} else {
	(function(){
		if(location.hash == hash || !/^#tagger:/.test(hash=location.hash)) return setTimeout(arguments.callee, 100);
		var args = unparam(hash.replace(/^#tagger:/, ''));
		onMessage(args);
	})();
}

function onMessage(args){
	if(saving) return;

	args.total = parseInt(args.total) || 0;
	args.idx = parseInt(args.idx) || 0;

	// no image...
	if(args.total === 0) return $('form.no_image').show().siblings('form').hide() && resize();

	// title
	$('#f-name').val(args.title);
	$('#f-tag_url').val(args.loc);

	$('a.img-pick').addClass('disabled');
	if(args.idx > 0) $('a.img-pick[did="0"]').removeClass('disabled');
	if(args.idx < args.total-1) $('a.img-pick[did="1"]').removeClass('disabled');

	$('form.add_thing').show().siblings('form').hide();
	$('#f-picked-image').load(resize).attr('src', args.src).attr('idx',args.idx);
};

function send(data){
	var p=window.parent,d=$.param(data),u=args.loc+'#tagger:'+d,l=args.loc.match(/^https?:\/\/[^\/]+/)[0];
	try{ p.postMessage(d,l) } catch(e1){ try{p.location.replace(u)}catch(e){p.location.href=u} };
};

function unparam(s){ var a={},i,c;s=s.split('&');for(i=0,c=s.length;i<c;i++)if(/^([^=]+?)(=(.*))?$/.test(s[i]))a[RegExp.$1]=decodeURIComponent(RegExp.$3||'');return a };
</script>
</head>
<body id="bookmarklet-show">
	<div class="top_head" >
		<a style="float:left;" target="parent" href="<?php echo base_url();?>"><img height="19px" src="<?php echo base_url();?>images/logo/<?php echo $logo;?>"/></a>
		<a style="float:right;font-weight: bold;color: #fff;font-size: 20px;" title="Close this" href="javascript:void(0)" onClick="closeBookmarklet();">X</a>
<!-- 		<a style="float:right;font-weight: bold;color: #fff;font-size: 20px;" title="Close this" href="javascript:window.parent.document.getElementById('bookmarkletFrame').parentNode.removeChild(window.parent.document.getElementById('bookmarkletFrame'))">X</a> -->
	</div>
	<div class="post_product" style="border-right:none; padding:0px 30px 10px 30px;">
	
	<?php 
	$images = array_filter($images);
	if (count($images)>0){
	?>
                                <dl>
                            <dd>
                                <div class="img">
                                    <?php 
                                    $i=0;
                                    foreach ($images as $img_row){
                                    	$i++;
                                    ?>
                                    <div data-count="<?php echo $i;?>" data-url="<?php echo $img_row;?>" class="photo-wrap <?php if ($i==1){echo 'current';}?>" style="display:<?php if ($i==1){echo 'block';}else {echo 'none';}?>;width:220px;height:220px;text-align:center;padding:10px;"><img style="max-width:200px;max-height: 190px;" class="photo" src="<?php echo $img_row;?>"></div>
                                    <?php 
                                    }
                                    ?>
                                    <span class="controls" style="display: block;margin: 5px;">
                                        <button class="prev" style="width: 40px;" onClick="set_prev();">Prev</button>
                                        <button class="next" style="width: 40px;" onClick="set_next();">Next</button>
                                        <span class="cur_" style="height: 23px;vertical-align: middle;margin-left: 5px;"><span>1</span> of <?php echo count($images);?></span>
                                    </span>
                                </div>
                                <div class="frm" style="float: left;margin: 5px;">
                                    <input type="hidden" value="<?php echo $images[0];?>" id="add_photo_url">
                                    <input type="hidden" value="<?php echo $uid;?>" id="uid">
                                    <label>Title</label>
                                    <div class="clear"></div>
                                    <input type="text" class="input-text" id="add_name" style="width: 240px;height: 10px;">
                                    <div class="clear"></div>
                                    <label>Web Link</label>
                                    <div class="clear"></div>
                                    <input type="text" class="input-text" placeholder="http://" id="add_link" style="width: 240px;height: 10px;">
                                    <div class="clear"></div>
                                    <?php if ($mainCategories->num_rows()>0){?>
                                    <label>Category</label>
                                    <div class="clear"></div>
                                        <select class="select-round selectBox categories_" id="add_category" style="width: 251px; padding:5px 10px 5px 5px; height: 30px;border: 1px solid #B4B9C7;">
                                        <option value="">Choose a category</option>
                                        <?php 
					                      foreach ($mainCategories->result() as $row){
					                      	if ($row->cat_name != ''){
					                      ?>
                                                                <option value="<?php echo $row->id;?>"><?php echo $row->cat_name;?></option>
                                          <?php 
					                      	}
					                      }
                                          ?>                      
										</select>
                                     <?php }?>                           
                                    <div class="clear"></div>
                                      </div>
                            </dd>
                        </dl>
                        <div class="btns-area">
                            <button class="start_btn_1" onClick="add_bookmarklet_product(this);">Add to <?php echo $siteTitle;?></button>
                        </div>
    <?php 
	}else {
    ?>     
    <p class="noimg">No images available</p>
    <?php }?>               
            </div>
    </body>
<script type="text/javascript">
function add_bookmarklet_product(evt){
	if($(evt).hasClass('adding'))return;
	$(evt).addClass('adding').text('Adding...');
	var title = $('#add_name').val();
	if(title==''){
		alert('Enter the title');
		$('#add_name').focus();
		$(evt).removeClass('adding').text('Add to <?php echo $siteTitle;?>');
	}else{
		var link = $('#add_link').val();
		var cat = $('#add_category').val();
		var image = $('#add_photo_url').val();
		var uid = $('#uid').val();
		$.ajax({
			type:'post',
			url:'<?php echo base_url();?>site/bookmarklet/add_bookmarklet_product',
			data:{title:title,link:link,cat:cat,image:image,uid:uid},
			dataType:'json',
			success:function(json){
				if(json.status_code == 1){
					alert('Product added successfully');
					$(evt).text('Added');
				}else{
					alert(json.message);
					$(evt).text('Add to <?php echo $siteTitle;?>');
				}
			},
			complete:function(){
				$(evt).removeClass('adding');
			}
		});
	}
}
</script>    
</html>
