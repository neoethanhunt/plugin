jQuery(document).ready( function($) {	
	$('.like').on('click', function() {	
		var $this = $(this);
		if($this.hasClass('liked')) {
			alert(like_it_vars.already_liked_message);
			return false;
		}	
		var post_id = $this.data('post-id');
		var user_id = $this.data('user-id');
		var post_data = {
			action: 'like_it',
			item_id: post_id,
			user_id: user_id,
			like_it_nonce: like_it_vars.nonce
		};
		$.post(like_it_vars.ajaxurl, post_data, function(response) {
			if(response == 'liked') {
				$this.addClass('liked');
				var count_wrap = $this.next();
				var count = count_wrap.text();
				count_wrap.text(parseInt(count) + 1);		
			} else {
				alert(like_it_vars.error_message);
			}
		});
		return false;
	});	
});