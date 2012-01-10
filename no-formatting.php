<?php
/*
Plugin Name: No Formatting
Plugin URI: 
Description: Removes WP template from a page
Version: 1.0
Author: Benjamin J. Balter
Author URI: http://ben.balter.com
License: GPL2
*/

/**
 * Hook to check for meta and call template filter
 */
function bb_no_formatting() {

	//if not a page or single post, kick
	if (!is_single() && !is_page() )
		return;
	
	//get current post ID
	global $wp_query;
	$post_id = $wp_query->post->ID;
	
	//Look for a "no_formatting" page meta
	$no_formatting = get_post_meta($post_id, 'no_formatting', true);
	
	//if the meta is set, call our template filter
	if ($no_formatting) {
		remove_filter( 'the_content', 'wpautop' );
		add_filter('template', 'bb_no_formatting_cb', 100);
		add_filter('single_template', 'bb_no_formatting_cb', 100);
		add_filter('page_template', 'bb_no_formatting_cb', 100);
		add_filter('post_template', 'bb_no_formatting_cb', 100);
	}
	
}

add_action('template_redirect', 'bb_no_formatting');

/**
 * Callback to replace the current template with our blank template
 */
function bb_no_formatting_cb() {
	return dirname(__FILE__) . '/template.php';
}