<?php


function li_like_link($like_text = null, $liked_text = null) {

	global $user_ID, $post;

	if( is_user_logged_in() ) {

		ob_start();
	
		
		$like_count = li_get_like_count( $post->ID );
		
		
		echo '<div class="like-wrapper">';
		
			$like_text = is_null( $like_text ) ? __( 'like It', 'like_it' ) : $like_text;
			$liked_text = is_null( $liked_text ) ? __( 'You have liked this', 'like_it' ) : $liked_text;
			
			
			if( ! li_user_has_liked_post( $user_ID, get_the_ID() ) ) {
				echo '<a href="#" class="like" data-post-id="' . esc_attr( get_the_ID() ) . '" data-user-id="' .  esc_attr( $user_ID ) . '">' . $like_text . '</a> (<span class="like-count">' . $like_count . '</span>)';
			} else {
				
				echo '<span class="liked">' . $liked_text . ' (<span class="like-count">' . $like_count . '</span>)</span>';
			}
		
		
		echo '</div>';
		
		
		$link = ob_get_clean();
	}
	return $link;
}

function li_display_like_link( $content ) {

	$types = apply_filters( 'li_display_like_links_on', array( 'post' ) );

	if( is_singular( $types ) && is_user_logged_in() ) {
		$content .= li_like_link();
	}
	return $content;
}
add_filter( 'the_content', 'li_display_like_link', 100 );