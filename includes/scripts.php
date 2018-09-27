<?php

function li_front_end_js() {
	if(is_user_logged_in()) {
		wp_enqueue_script('like', LI_BASE_URL . '/includes/js/like.js', array( 'jquery' ) );
		wp_localize_script( 'like', 'like_it_vars', 
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce('like-nonce'),
				'already_liked_message' => __('You have already liked this item.', 'like_it'),
				'error_message' => __('Sorry, there was a problem processing your request.', 'like_it')
			) 
		);	
	}
}
add_action('wp_enqueue_scripts', 'li_front_end_js');