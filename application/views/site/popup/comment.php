<div class="popup add-cmt ly-title" style="display:none;">
	<p class="ltit"><?php if($this->lang->line('header_add_comment') != '') { echo stripslashes($this->lang->line('header_add_comment')); } else echo "Add a Comment"; ?></p>
	<div class="ltxt">
		<p class="figcaption"></p>
		<textarea placeholder="<?php if($this->lang->line('header_write_comment') != '') { echo stripslashes($this->lang->line('header_write_comment')); } else echo "Write a comment..."; ?>"></textarea>
	</div>
	<div class="btn-area">
		<small><?php if($this->lang->line('header_use_at') != '') { echo stripslashes($this->lang->line('header_use_at')); } else echo "Use @ to mention someone"; ?></small>
		<button class="btn-done"><?php if($this->lang->line('header_post_comment') != '') { echo stripslashes($this->lang->line('header_post_comment')); } else echo "Post Comment"; ?></button>
	</div>
	<button title="Close" class="ly-close"><i class="ic-del-black"></i></button>
</div>