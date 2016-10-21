<?php $this->load->view('site/templates/header');?>
<script src="js/image_crop/jquery.Jcrop.js"></script>
<script type="text/javascript">
  jQuery(function($){

    // Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        boundx,
        boundy,

        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),

        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    
    console.log('init',[xsize,ysize]);
    $('#target').Jcrop({
      onChange: updatePreview,
      onSelect: updatePreview,
      aspectRatio: xsize/ysize
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      // Store the API in the jcrop_api variable
      jcrop_api = this;

      // Move the preview into the jcrop container for css positioning
      $preview.appendTo(jcrop_api.ui.holder);
    });

    function updatePreview(c)
    {
      if (parseInt(c.w) > 0)
      {
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        $pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
      $('#x1').val(c.x);
      $('#y1').val(c.y);
      $('#x2').val(c.x2);
      $('#y2').val(c.y2);
      $('#w').val(c.w);
      $('#h').val(c.h);
    };


  });


  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('<?php if($this->lang->line('pls_sel_crop_region') != '') { echo stripslashes($this->lang->line('pls_sel_crop_region')); } else echo "Please select a crop region then press submit"; ?>.');
    return false;
  };

</script>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">
<link rel="stylesheet" href="css/image_crop/demo_files/demos.css" type="text/css" />
<link rel="stylesheet" href="css/image_crop/jquery.Jcrop.css" type="text/css" />
<style type="text/css">

/* Apply these styles only when #preview-pane has
   been placed within the Jcrop widget */
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}

/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width: 240px;
  height: 240px;
  overflow: hidden;
}

</style>
<!-- Section_start -->

<div class="lang-en no-subnav wider winOS">
	<div id="container-wrapper">
		<div class="container set_area">
			<div class="jc-demo-box" style="min-height:330px;">
				<h3 style="border-bottom: 1px dashed black;margin-bottom:20px;"><?php if($this->lang->line('crop_ur_photo') != '') { echo stripslashes($this->lang->line('crop_ur_photo')); } else echo "Crop your photo for better look"; ?></h3>
				  <img style="max-width: 600px;display:none;" src="images/users/<?php echo $userDetails->row()->thumbnail;?>" id="target" alt="<?php echo $userDetails->row()->full_name;?>" />
				  <div id="preview-pane" style="z-index:10  !important;">
					<div class="preview-container">
					  <img src="images/users/<?php echo $userDetails->row()->thumbnail;?>" class="jcrop-preview" alt="Preview" />
					</div>
				  </div>

				<form action="site/user/image_crop_process" method="post" onsubmit="return checkCoords();">
					<input type="hidden" id="x1" name="x1" />
					<input type="hidden" id="y1" name="y1" />
					<input type="hidden" id="x2" name="x2" />
					<input type="hidden" id="y2" name="y2" />
					<input type="hidden" id="w" name="w" />
					<input type="hidden" id="h" name="h" />
					<input type="submit" value="<?php if($this->lang->line('crop_image') != '') { echo stripslashes($this->lang->line('crop_image')); } else echo "Crop Image"; ?>" style="height:auto; margin-top:5px;" class="btn btn-large btn-inverse" />
				</form>
				<div class="clearfix"></div>

			</div>
			<?php $this->load->view('site/templates/side_footer_menu'); ?>
		</div>
		<!-- / container -->
	</div>
</div>
<?php $this->load->view('site/templates/footer');?>