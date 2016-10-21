$(function() {
    var $summary = $('#summary'), $coverImg = $('#coverImg');
    var preventDefault = function(e) {
        if (e.which === 1) e.preventDefault();
    }

    var clicked = false;
    $('.menu-title, .menu-content').click(function(e) {
        $(this).closest('.menu-container').toggleClass('opened');
        if($(this).hasClass('menu-title')) e.preventDefault();
        clicked = true;
    });
    $(document).click(function(e) {
        if (e.which === 1) {
            if (clicked) {
                clicked = false;
                return;
            }
            $('.menu-container').removeClass('opened');
        }
    });
    $(document).on({
        click : function(e) {
            e.preventDefault();
            var $this = $(this), login_require = $this.attr('require_login'), url, params = {};

            if (typeof(login_require) != undefined && login_require === 'true')  return require_login();
            if ($this.hasClass('loading')) return;

            $this.addClass('loading');
           
            var isFollow = $this.hasClass('follow');

            $this.data('old', $this.attr('class'));
            if (isFollow) {
                $this.attr('class', 'btn-follow following');
            } else {
                $this.attr('class', 'btn-follow follow');
            }

            if($this.attr('aid')) {
                params.lid  = $this.attr('lid');
                params.aid = $this.attr('aid');
                url  = isFollow ? baseURL+'site/searchShop/follow_list' : baseURL+'site/searchShop/unfollow_list';
            } else if($this.attr('lid')) {
                params.lid  = $this.attr('lid');
                url  = isFollow ? baseURL+'site/user/follow_list' : baseURL+'site/user/unfollow_list';
            }else {
                params.user_id = $this.attr('uid');
                if($this.attr('eid')) params.directory_entry_id = $this.attr('eid');
                url  = isFollow ? baseURL+'site/user/add_follow' : baseURL+'site/user/delete_follow';
            }


            $.ajax({
                type : 'post',
                url  : url,
                data : params,
                dataType : 'json',
                success : function(json){
                    if (json.status_code != 1) {
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

    var drag = function(e) {
        if (e.which !== 1 || $(this).hasClass('dragging')) return;
        e.preventDefault();
        var $this = $(this);
        var $li = $this.closest('li');

        var $parent = $li.parent();
        var itemCount = $parent.find('li:visible').length;
        var $clone = $li.clone().addClass('dragging').appendTo($parent);

        $li.addClass('hint-drop');

        var pad = 10;
        var LEFT_LIMIT = 104 - pad; // depends on css
        var RIGHT_LIMIT = 804 + pad; // depends on css
        var TOP_LIMIT = 104 - pad; // depends on css
        var BOTTOM_LIMIT = $parent.height() - 176 + pad; // depends on css
        var parentOffset = $parent.offset();
        var getIndexByOffset = function (x, y) {
            var BLOCK_WIDTH = 230;
            var BLOCK_HEIGHT = 300;
            var idx = Math.min(Math.floor(x / BLOCK_WIDTH), 3) + Math.floor(y / BLOCK_HEIGHT) * 4;
            if (idx == 0) idx = 1;
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
                $li.insertAfter($parent.children('li').eq(targetIdx));
            } else if (srcIdx > targetIdx) {
                $li.insertBefore($parent.children('li').eq(targetIdx));
            }
        };
        var handleUp = function() {
            $('body').off('mousemove', handleMove).css('cursor','auto');
            $clone.remove();
            $li.removeClass('hint-drop');
            $li = null;
            $parent = null;
            $clone = null;
        };
        handleMove(e);
        $('body').on('mousemove', handleMove).one('mouseup', handleUp).css('cursor','move');
    }
    var orignal_item_ids = [], changed_item_ids = [];
   $summary.find('.btn-organize-list').click(function(e) {
        e.preventDefault();

        $.infiniteshow.option('disabled', true);
        $('.viewer .normal').click();

        $('#content').addClass('edit');
        $('#organize-list').slideDown(200);

        var $list = $('ol.stream');
        $list.children('li[tid]').each(function(){ orignal_item_ids.push( $(this).attr('tid') ) });
        $list.data('rollback', $list.html())
        $list.find('a').on('click', preventDefault);

        $list.on('dragstart', preventDefault);
        $list.on('mousedown','.figure-img', drag);

    });

    $('#organize-list').on('click', 'a',function(e) {
        e.preventDefault();
        $('#content').removeClass('edit');
        $('#organize-list').slideUp(200);

        var $list = $('ol.stream');
        $list.find('a').off('click', preventDefault);
        $list.off('dragstart', preventDefault);
        $list.off('mousedown', drag);

        if (this.id === 'edit-list-done') {
            //for timeline
            $('#stream-first-item_').removeAttr('id');
            $('ol.stream > li:first-child').attr('id','stream-first-item_');
            $('#stream-latest-item_').removeAttr('id');
            $('ol.stream > li:last-child').attr('id','stream-latest-item_');
            //endfor timeline

            $('ol.stream > li[tid]').each(function(){ changed_item_ids.push( $(this).attr('tid') )});
            if(orignal_item_ids.join(',') == changed_item_ids.join(',')) return;

            var params = {
                lid  : $(this).attr('lid'),
                loid : $(this).attr('loid'),
                delete_items   : '',
                remain_items   : changed_item_ids.join(','),
                original_items : orignal_item_ids.join(',')
            };

            $.ajax({
                type : 'post',
                url  : '/organize_list_items.xml',
                data : params,
                dataType : 'xml',
                success  : function(xml){
                    var $xml = $(xml), $st = $xml.find('status_code'), $msg = $xml.find('message');
                    if(!$st.length) return;
                    if($st.text() == 1){
                        //success
                    } else if($st.text() == 0){
                        if($msg.length) alert($msg.text());
                    }
                },
                complete : function(){
                    $.infiniteshow.option('disabled', false);
                }
            });

        } else if (this.id === 'edit-list-cancel') {
            $list.html($list.data('rollback'));
            $.infiniteshow.option('disabled', false);
        }
    });
    $('#form-cover').on({
        upload_begin : function(e){
            $("#save_profile_image").addClass('progress').css('width','1%');
        },
        upload_complete : function(event,json){
            if (json.status_code != undefined && json.status_code == 1) {
                var image = json.image, $this = $(this)
                if (image.width < 970 || image.height < 150) {
                    $this.trigger('reset');
                    $this.find('.ltit').addClass('try').end().find('.msg').show();
                    return false;
                }
                $.dialog('upload-cover').close();
                $this.trigger('reset')
                $('#coverImage').removeClass('add image').addClass('loading');
                $.get(
                    '/update_cover_image.json?object_id=' + $summary.attr('lid'),
                    function(json){
                        if (json.status_code != undefined && json.status_code == 1) {
                            var url = json.image_url;

                            $coverImg.css('top',0).one('load', function() {
                                $('#coverImage').removeClass('loading').addClass('image');
                                $(this).hide().fadeIn('slow');
                            }).attr('src', url);
                        }
                        else if (json.status_code != undefined && json.status_code == 0) {
                            if(json.message != undefined)
                                alert(json.message);
                        }
                    },
                    "json"
                );
            }
            else if (json.status_code != undefined && json.status_code == 0) {
                if(json.message != undefined)
                    alert(json.message);
                $(this).trigger('reset')
            }

        },
        reset : function(){
            var $bar = $("#save_profile_image");
            $bar.removeClass('progress').width($bar.data('org-width'))
            $(this).find('.ltit').removeClass('try').end().find('.msg').hide();
        },
        submit : function(event) {
            var $this=$(this), isUpload = $this.find('.method.image').hasClass('current');

            if (isUpload) {
                var file_form = $('#uploadcover')[0], $indicator, progress_id, file,filename,extension, filelist;
                filelist = file_form.files || (file_form.value ? [{name:file_form.value}] : []);
                if(filelist && filelist.length) file = filelist[0];

                if(!file){
                    alert(gettext('Please select a file to upload'));
                    return false;
                }

                if(!/([^\\\/]+\.(jpe?g|png|gif))$/i.test(file.name||file.filename)){
                    alert(gettext('The image must be in one of the following formats: .jpeg, .jpg, .gif or .png.'));
                    return false;
                }

                filename  = RegExp.$1;
                extension = RegExp.$2;

                $this.trigger('upload_begin');

                function onprogress(cur,len){
                    var prog = Math.max(Math.min(cur/len*100,100),0).toFixed(1);
                    $this.find('.progress').css('width', (488 * (prog) / 100).toFixed(0) +'px');
                };

                if(!window.FileReader || !window.XMLHttpRequest) {
                    var null_counter = 0, completed = false;

                    progress_id = parseInt(Math.random()*10000);
                    document.cookie = 'X-Progress-ID='+progress_id+'; path=/';
                    window._upload_image_callback = function(json){ completed = true; $this.trigger('upload_complete',json); };

                    function get_progress(){
                        $.ajax({
                            type : 'get',
                            url  : '/get_upload_progress.json',
                            data : {'X-Progress-ID':progress_id},
                            dataType : 'json',
                            success  : function(json){
                                if(!json) return;
                                if(json.uploaded + 1000 >= json.length) json.uploaded = json.length;
                                onprogress(json.uploaded, json.length);
                            },
                            complete : function(xhr){
                                if(completed || null_counter > 10) return;
                                if(xhr.responseText == 'null') null_counter++;
                                setTimeout(get_progress, 500);
                            }
                        });
                    };
                    setTimeout(get_progress, 300);
                    return true;
                }

                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e){ onprogress(e.loaded, e.total)}, false);
                xhr.onreadystatechange = function(e){
                    if(xhr.readyState !== 4) return;
                    if(xhr.status === 200){
                        // success
                        var data = xhr.responseText, json;
                        try {
                            if(window.JSON) json = window.JSON.parse(data);
                        } catch(e){
                            try { json = new Function('return '+data)(); } catch(ee){ json = null };
                        }

                        $this.trigger('upload_complete', json);
                    }
                };

                xhr.open('POST', '/upload_list_cover_image.json?max_width=1940&filename=' + filename, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.setRequestHeader('X-Filename', filename);
                xhr.send(file);
            } else {
                var url = $("#uploadcoverUrl").val().trim();
                if(!url.length) {
                    alert(gettext('Please enter a image url.'));
                    return false;
                }
                if (!/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url)) {
                    alert(gettext('Please enter a valid image url.'));
                    return false;
                }
                $this.trigger('upload_begin');

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function(e){
                    if(xhr.readyState !== 4) return;
                    if(xhr.status === 200){
                        // success
                        var data = xhr.responseText, json;
                        try {
                            if(window.JSON) json = window.JSON.parse(data);
                        } catch(e){
                            try { json = new Function('return '+data)(); } catch(ee){ json = null };
                        }
                        $this.find('.progress').css('width', '488px');

                        setTimeout(function() {
                            $this.trigger('upload_complete', json);
                        }, 300);
                    }
                };
                xhr.open('POST', '/upload_list_cover_image.json?max_width=1940&url=' + url, true);
                xhr.send();
            }
            return false;
        }
    })
    $('#save_profile_image').on('click',function(e){
        if($(this).hasClass('progress')) return false;
        $('#form-cover').trigger('submit');
        preventDefault(e);
    });

    $('.guide-line h5').hover(
        function(e){
            $(this).parent().find('dl').show();
        },
        function(e){
            $(this).parent().find('dl').hide();
        }
    ).click(function() {
        $(this).parent().find('dl').toggle();
    });

    $summary.find('.btn-upload-cover').click(function(e) {
        $.dialog('upload-cover').open();
        var w = $('#save_profile_image').outerWidth();
        $('#save_profile_image').width(w).data('org-width', w).addClass('ani');
        $('#form-cover').trigger('reset');
        e.preventDefault()

    });

    $summary.find('.btn-delete-cover').click(function(e) {
        if (window.confirm(gettext('Are you sure?'))){
            $('#coverImage').removeClass('image').addClass('loading');
            $.post(
                '/delete_cover_image.json',
                {
                    object_id : $('#summary').attr('lid'),
                    object_type : 'fancylist'
                }, // parameters
                function(response){
                    if (response.status_code != undefined && response.status_code == 1) {
                        $('#coverImage').removeClass('loading').addClass('add').find('.add').hide().fadeIn('slow', function() {$(this).removeAttr('style')});
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


    $('.list .vcard .note a').hover(
        function() {
            $('.list .vcard .note .show-contributors').show();
            if ($('.list .vcard .note .show-contributors').height()>$(this).parents('#summary').height()-30) {
                $('.list .vcard .note .show-contributors').addClass('row');
            }
        },
        function() {
            $('.list .vcard .note .show-contributors').hide();
        }
    );

    $summary.find('.inner-wrapper').hover(
        function() {
            if($summary.hasClass('reposition')) {
                $summary.find('.cover .menu-container').hide();
                return;
            }
            $summary.find('.cover .menu-container').removeClass('opened').show();
        },
        function() {
            if($('#summary').hasClass('reposition')) {
                $summary.find('.cover .menu-container').hide();
                return;
            }
            $summary.find('.cover .menu-container').hide();
        }
    ).mousemove(function(){
        if($summary.hasClass('reposition')) {
            $summary.find('.cover .menu-container').hide();
            return;
        }
        $summary.find('.cover .menu-container').show();
    });
    var coverDrag = function(e) {
        var $this = $(this);
        if (e.which !== 1 || $this.hasClass('moving')) return;
        $this.addClass('moving');
        e.preventDefault();

        var startY = e.pageY;
        var limit = - ($coverImg.height() - $this.find('.image').height());
        var orgY = parseInt($coverImg.css('top'));

        var handleMove = function(e) {
            var y = e.pageY - startY + orgY;
            if (y > 0) y = 0;
            else if (y < limit) y = limit;
            $coverImg.css('top', y + 'px');
        };
        var handleUp = function() {
            $('body').off('mousemove', handleMove);
            $this.removeClass('moving');
        };
        handleMove(e);
        $('body').on('mousemove', handleMove).one('mouseup', handleUp);
    }
    var orgCoverTop;
    $summary.find('.btn-reposition-cover').click(function(e) {
        orgCoverTop = $coverImg.css('top');
        $summary.addClass('reposition');
        $summary.find('div.reposition').hide().slideDown('fast');
        $summary.on('mousedown', coverDrag);
        $summary.on('mousedown', preventDefault);
        preventDefault(e);
    });

    var stopCoverDrag = function(e) {
        $summary.off('mousedown', coverDrag);
        $summary.off('mousedown', preventDefault);
        preventDefault(e);
        $summary.find('div.reposition').slideUp('fast', function() {
            $summary.removeClass('reposition');
        });
    }
    $('#repositionSave').click(function(e){
        $.get(
            '/reposition_cover_image.json?object_id=' + $summary.attr('lid') + '&offset_y=' + parseInt($coverImg.css('top')),
            function(json){
                if (json.status_code != undefined && json.status_code == 1) {

                }
                else if (json.status_code != undefined && json.status_code == 0) {
                    if(json.message != undefined)
                        alert(json.message);
                }
            },
            "json"
        );
        stopCoverDrag(e);
    });
    $('#repositionCancel').click(function(e){
        $coverImg.css('top', orgCoverTop);
        stopCoverDrag(e);
    });
})

