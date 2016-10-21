	var track_load = 1; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	if(total_groups){}else{var total_groups=1;}
	if(total_groups == ''){}else{var total_groups=1;}
	if(ajax_load_url){}else{var ajax_load_url = ''};
	if(iniData && iniData != ''){
		var params=iniData;
	}else{
		var params={'group_no': track_load};
	}
//	$('#results').load("autoload_process.php", {'group_no':track_load}, function() {track_load++;}); //load first group
	
	$(window).scroll(function() { //detect page scroll
		
		if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
		{
			if(track_load <= total_groups && loading==false) //there's more data to load
			{
				loading = true; //prevent further ajax loading
				$('#infscr-loading').show(); //show loading image
				//var vmode = $('.figure.classic').css('display');
				//load data from the server using a HTTP POST request
				
				$.ajax({
						type:'post',
						url:ajax_load_url,
						data:params,
						success:function(data){
//							alert(data);		
					$(".stream").append(data); //append received data into the element
					$(".stream").trigger('itemloaded');
					//hide loading image
					$('#infscr-loading').hide(); //hide loading image once data is received
					
					track_load++; //loaded group increment
					loading = false; 
				
					},
					fail:function(xhr, ajaxOptions, thrownError) { //any errors?
						
						alert(thrownError); //alert with HTTP error
						$('#infscr-loading').hide(); //hide loading image
						loading = false;
					
					}
				});
				
			}
		}
	});
