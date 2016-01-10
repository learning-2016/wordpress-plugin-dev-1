<?php
/**
 * @package Erwin
 * @version 1.0
 */
/*
Plugin Name: Erwin
Plugin URI: http://fashionsponge.com
Description: Rock in roll to the world
Author: Jesus Erwin Suarez
Version: 1.0
Author URI: http://erwin.com  
src: https://www.youtube.com/watch?v=7v6IbmhYC8Y&feature=iv&src_vid=Aof-WX7gACc&annotation_id=annotation_3860539885
*/

/**
* Post Popularity Counter
*/ 
function my_popular_post_views($postID) { 
	$total_key = 'views';
	// Get current 'views' field
	$total = get_post_meta( $postID, $total_key, true);
	// If current 'views'field is empty, set it to zero
	if( $total == '') {
		delete_post_meta( $postID, $total_key );
		add_post_meta( $postID, $total_key, '1');
	} else {
		// If current 'views' field has a value, add 1 to that value
		$total++;
		update_post_meta( $postID, $total_key, $total );
	}
} 


/**
* Dynamically inject counter into single posts 
*/
function my_count_popular_posts($post_id) {
	// Check that this is a single post and that the user is a visitor
	if( !is_single() ) return;
	if( !is_user_logged_in() ) {
		// Get the post ID
		if( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		// Run Post Popularity Counter on post
		my_popular_post_views($post_id);
	} 
}
 
add_action( 'wp_head', 'my_count_popular_posts');

