<?php
/**
 * @package  acs
 */

/**
 * Require the .php files in a directory
 * @param  string $path
 * @return void
 */
function acs_include( $path ) {
	$path = ACS_PLUGIN_PATH . '/' . $path;
	foreach (glob($path."/*.php") as $filename) {
	    include $filename;
	}
}

/**
 * Get ready to do boilerplate POST handling repeatedly
 * @param  callable $callback
 * @return void
 */
function acs_handle_post_update( $callback ) {
	return function( $post_id ) use ( $callback ) {

	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	        return;
	    }

	    if( !isset( $_POST['ei_noncename'] ) ) {
	    	return;
	    }

	    if ( !wp_verify_nonce( $_POST['ei_noncename'], 'ei-n' ) ) {
	        return;
	    }

	    if ( wp_is_post_revision( $post_id ) ) {
	        $post_id = wp_is_post_revision($post_id);
	    }

	    call_user_func( $callback, $post_id );
	};
}
