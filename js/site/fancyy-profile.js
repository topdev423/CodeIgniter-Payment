$(function() {
    var preventDefault = function(e) {
        if (e.which === 1) e.preventDefault();
    }
    var clicked = false;
    $('.menu-title, .menu-content').click(function(e) {
	$(this).closest('.menu-container').toggleClass('opened');
        if($(this).hasClass('menu-title')) e.preventDefault();
        clicked = true;
    });
    $(document).click(function() {
        if (clicked) {
            clicked = false;
            return;
        }
        $('.menu-container').removeClass('opened');
    });

    $('.delete').click(function(){

	if (!window.confirm('Are you sure?')) return false;
	var $this = $(this), params = {}, url;

	url = baseURL+'site/user/delete_user_list';
	
	params.lid = $this.attr('lid');
	params.uid = $this.attr('uid');

	$this.hide();
	$this.prev().disable();
	$.ajax({
	    type : 'post',
	    url  : url,
	    data : params,
	    dataType : 'json',
	    success  : function(json){
			if(json.status_code != 1) {
			    alert(json.message);
				$this.show();
			    $this.prev().disable(false);
			    return;
			}else{
				window.location = json.url;
			}
	    }
	});

	return false;
    });

    $(document).on('click', '.btn-follow', preventDefault).on({
        click : function(e) {
            e.preventDefault();
            var $this = $(this), login_require = $this.attr('require_login'), url, params = {};

            if (typeof(login_require) != undefined && login_require === 'true')  return require_login();
            if ($this.hasClass('loading')) return;

            $this.addClass('loading');

            var isLists = $this.closest('figure').hasClass('lists-frame');
            var isFollow = $this.hasClass('follow')

            $this.data('old', $this.attr('class'));
            if (isFollow) {
                $this.attr('class', 'btn-follow following');
            } else {
                $this.attr('class', 'btn-follow follow');
            }

            if(isLists) {
                params.lid  = $this.attr('lid');
                params.loid = $this.attr('loid');
                url  = isFollow ? '/follow_list.xml' : '/unfollow_list.xml';
            } else {
                params.user_id = $this.attr('uid');
                if($this.attr('eid')) params.directory_entry_id = $this.attr('eid');
                url  = isFollow ? '/add_follow.xml' : '/delete_follow.xml';
            }


            $.ajax({
                type : 'post',
                url  : url,
                data : params,
                dataType : 'xml',
                success : function(xml){
                    var $xml = $(xml), $st = $xml.find('status_code');
                    if (!$st.length || $st.text() != 1) {
                        $this.attr('class', $this.data('old'));
                    }
                },
                error:function (){
                    $this.attr('class', $this.data('old'));
                },
                complete : function(){
                    $this.removeClass('loading');
                }
            });
        },
        mouseenter : function(){
            if ($(this).hasClass('following'))
                $(this).attr('class', 'btn-follow unfollow');
        },
        mouseleave : function(){
            if ($(this).hasClass('unfollow'))
                $(this).attr('class', 'btn-follow following');
        }
    }, '.btn-follow');


    $('#user-photo-container').on('mouseover', function(e) {
	$(this).children('.btn-edit').show();
	return false;
    });

    $('#user-photo-container').on('mouseout', function(e) {
	$(this).children('.btn-edit').hide();
	return false;
    });

    $('#lists').on('mouseover','a.fig-image', function(e) {
	if ( $('.wrapper').hasClass('edit')) return;
	var t;
	var $imgs = $(this).find('img');
	if ($imgs.length > 1) {
	    var swap = function() {
		var $on = $imgs.filter('.on').removeClass('on');
		if ($on.index() < $imgs.length) {
		    $on.next().addClass('on');
		} else {
		    $imgs.eq(0).addClass('on');
		}
		t = setTimeout(swap, 1000);
	    };
	    var end = function() {
		$imgs.removeClass('on');
		$imgs.eq(0).addClass('on');
		clearTimeout(t);
		t = null;
		$imgs = null;

		$(document).off('mouseout', end);
	    };
	    $(document).on('mouseout', end);

	    swap();
	}
    });
    var drag = function(e) {
        if (e.which !== 1 || $(this).hasClass('dragging')) return;
        e.preventDefault();
        var $this = $(this);
        var $li = $this.closest('li');

        var $parent = $li.parent();
        var itemCount = $parent.find('li:visible').length;
        $parent.data('rollback', $parent.html());
        var $clone = $li.clone().addClass('dragging').appendTo($parent);

        $li.addClass('hint-drop');

        var pad = 10;
        var LEFT_LIMIT = 114 - pad; // depends on css
        var RIGHT_LIMIT = 566 + pad; // depends on css
        var TOP_LIMIT = 144 - pad; // depends on css
        var BOTTOM_LIMIT = $parent.height() - 156 + pad; // depends on css
        var parentOffset = $parent.offset();
        var getIndexByOffset = function (x, y) {
            var BLOCK_WIDTH = 200;
            var BLOCK_HEIGHT = 310;
            var idx = Math.min(Math.floor(x / BLOCK_WIDTH), 2) + Math.floor(y / BLOCK_HEIGHT) * 3;
            //if (idx == 0) idx = 1;
            return idx;
        };

        var handleMove = function(e) {
            var relX = e.pageX - parentOffset.left;
            var relY = e.pageY - parentOffset.top;
            relX = Math.min(Math.max(relX, LEFT_LIMIT), RIGHT_LIMIT);
            relY = Math.min(Math.max(relY, TOP_LIMIT), BOTTOM_LIMIT);
            $clone.css({left:relX, top:relY});

            var srcIdx = $li.index();
            var targetIdx = getIndexByOffset(relX, relY);
            targetIdx = Math.min(targetIdx, itemCount);

            if (srcIdx < targetIdx) {
                $li.insertAfter($parent.find('li').eq(targetIdx));
            } else if (srcIdx > targetIdx) {
                $li.insertBefore($parent.find('li').eq(targetIdx));
            }
        };
        var handleUp = function() {
            $('body').off('mousemove', handleMove).off('mouseup', handleUp).css('cursor','auto');
            $clone.remove();
            $li.removeClass('hint-drop');
            $li = null;
            $parent = null;
            $clone = null;
        };
        handleMove(e);
        $('body').on('mousemove', handleMove).on('mouseup', handleUp).css('cursor','move');
    }
    $('.usersection .btn-edit.organize').click(function(e) {
        e.preventDefault();
	$(this).parents('.wrapper').addClass('edit');
	$('#organize-lists').slideDown(200);
	$('#lists a').on('click', preventDefault);
	$('#lists').on('dragstart', preventDefault);
	$('#lists').on('mousedown','figure', drag);
    });

    $('#organize-lists').on('click', 'button',function(e) {
        e.preventDefault();
	$(this).parents('.wrapper').removeClass('edit');
        $('#organize-lists').slideUp(200);
	$('#lists a').off('click', preventDefault);
	$('#lists').off('dragstart', preventDefault);
	$('#lists').off('mousedown', drag);

        if (this.id === 'edit-list-done') {
            var list_ids = '';
            $('.vcard') .each(function(){
                var lid = $(this).attr('lid');
                if (lid != undefined) {
                    if (list_ids.length>0)
                        list_ids = list_ids + ','+lid;
                    else
                        list_ids = ''+lid;
                }
            });
            var param = {};
            param['update_lists']=list_ids;
            $.post("/organize_lists_new.xml",param, function(xml){
                if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {

                }
                else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
                    alert($(xml).find("message").text());
                }
            }, "xml");
        } else if (this.id === 'edit-list-cancel') {
            $('#lists').html($('#lists').data('rollback'));
        }
    });

    $("#save_profile_image").on('click',function(e){
        var $this = $(this), $file = $('#uploadavatar'), file = $file.attr('value'), $form = $('#form-photo')[0];
        if(!file){
        	alert('Choose a file to upload');
        	return false;
        }
        var $change_photo = $this.closest('.change-photo');
        $change_photo.addClass('uploading');
        return true;
/*        $.ajaxFileUpload( {
            url:baseURL+'site/user_settings/change_photo',
            secureuri:false,
            fileElementId:'uploadavatar',
            dataType: 'json',
            success: function (status)
            {
            	alert(status);
            	e.preventDefault();
                var $xml = $(xml), $st = $xml.find('status_code');
                $change_photo.removeClass('uploading none');

                if ($st.length>0 && $st.text()==1) {
                    var url = $xml.find('original_image_url').text();
		    $('#uploaded-photo, #user-photo').css('background-image', 'url(' + url + ')');
                    $form.reset();
                } else if ($st.length>0 && $st.text()==0) {
                    alert($xml.find("message").text());
                    return false;
                } else {
                    alert("Unable to upload file..");
                    return false;
                }
            },
            error: function (data, status, e)
            {
                $change_photo.removeClass('loading');

                alert(e);
                return false;
            }
        });

        $file.attr('value','');

        e.preventDefault()
 */   });

    $("#save_banner_image").on('click',function(e){
        var $this = $(this), $file = $('#uploadbanner'), file = $file.attr('value'), $form = $('#form-photo')[0];
        if(!file){
            alert('Choose a file to upload');
            return false;
        }
        var $change_photo = $this.closest('.change-photo');
        $change_photo.addClass('uploading');
        return true;
      });

    $('#delete_profile_image').live('click',function(e){
        if (window.confirm('Are you sure?')){
            var $change_photo = $(this).closest('.change-photo'), $form = $('#form-photo')[0];
            $change_photo.addClass('uploading');
            $.post(
                '/delete_profile_image2.json',
                {}, // parameters
                function(response){
                    if (response.status_code != undefined && response.status_code == 1) {
                        var url = response.user_image_url;
                        $('#uploaded-photo, #user-photo').css('background-image', 'url(' + url + ')');
                        $change_photo.removeClass('uploading');
                        $change_photo.addClass('none');
                        $form.reset();
                    }
                    else if (response.status_code != undefined && response.status_code == 0) {
                        if(response.message != undefined)
                            alert(response.message);
                    }
                },
                "json"
            );
            return false;
        }
        e.preventDefault()
    });

    var tooltip = function(target) {
        var $target = $(target);
        if (!$('#tooltip').length) {
            $('<span>').attr('id','tooltip').appendTo(document.body);
        }
        var $tooltip = $('#tooltip').show();

        $tooltip.text($target.text());
        var o = $target.offset();
        o.left = Math.round(o.left - ($tooltip.width() + 16 - $target.width()) / 2); //16:#tooltip's padding
        o.top = Math.round(o.top - ($tooltip.height() + 9));
        $('#tooltip').offset(o);
    };

    $('.tooltip').hover(function() {
    	tooltip(this);
    }, function() {
	    $('#tooltip').hide();
    }).click(function() {
	    $('#tooltip').toggle();
    });

});
$(document).ready(function(){
	$('.feature .figure-item img').each(function(){
		$(this).parents('.feature').find('.delete').css('margin-right',(640-$(this).width())/2+'px').end().find('.back').width($(this).width()).css('left',((640-$(this).width())/2)+'px');
	});
});
