<?php
/**
 * @package  acs.ui
 */

add_action( 'admin_head', 'acs_load_admin_ui' );

/**
 * Enqueue scripts and add metaboxes for the admin UI
 * @return void 
 */
function acs_load_admin_ui() {

	global $pagenow; 
	global $typenow;

	if (in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) {
	    if ( ACS_POST_TYPE === $typenow ) {
	    	wp_enqueue_script( 'acs-tiptip', ACS_PLUGIN_URI . '/js/tipTip/jquery.tipTip.js', false, false, true );
	    	wp_enqueue_script( 'acs-ui', ACS_PLUGIN_URI . '/js/functions.input.js', false, false, true );
	    	wp_enqueue_style( 'acs-ui-css', ACS_PLUGIN_URI . '/css/style.input.css' );
	        wp_enqueue_style( 'acs-tiptip-css', ACS_PLUGIN_URI . '/js/tipTip/tipTip.css' );

	        add_meta_box('acs_input', 'Group Posts', 'acs_input_meta_box', 'acs', 'normal', 'high');
	        add_meta_box('acs_options', 'Advanced Options', 'acs_options_meta_box', 'acs', 'normal', 'high');

	        add_options_page(__('Adv Custom Sort', 'acs'), __('Adv Custom Sort', 'acs'), 'manage_options', 'edit.php?post_type=acs');
	    }
	}
}