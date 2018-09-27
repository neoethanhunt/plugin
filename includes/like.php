<?php


function li_user_has_liked_post($user_id, $post_id) {

	
	$liked = get_user_option('li_user_likes', $user_id);
	if(is_array($liked) && in_array($post_id, $liked)) {
		return true; 
	}
	return false; 
}


function li_store_liked_id_for_user($user_id, $post_id) {
	$liked = get_user_option('li_user_likes', $user_id);
	if(is_array($liked)) {
		$liked[] = $post_id;
	} else {
		$liked = array($post_id);
	}
	update_user_option($user_id, 'li_user_likes', $liked);
}


function li_mark_post_as_liked($post_id, $user_id) {

	
	$like_count = get_post_meta($post_id, '_li_like_count', true);
	if($like_count)
		$like_count = $like_count + 1;
	else
		$like_count = 1;
	
	if(update_post_meta($post_id, '_li_like_count', $like_count)) {	
	
		li_store_liked_id_for_user($user_id, $post_id);
		return true;
	}
	return false;
}


function li_get_like_count($post_id) {
	$like_count = get_post_meta($post_id, '_li_like_count', true);
	if($like_count)
		return $like_count;
	return 0;
}


function li_process_like() {
	if ( isset( $_POST['item_id'] ) && wp_verify_nonce($_POST['like_it_nonce'], 'like-nonce') ) {
		if(li_mark_post_as_liked($_POST['item_id'], $_POST['user_id'])) {
			echo 'liked';
		} else {
			echo 'failed';
		}
	}
	die();
}
add_action('wp_ajax_like_it', 'li_process_like');