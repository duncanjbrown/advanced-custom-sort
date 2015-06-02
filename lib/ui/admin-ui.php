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

	// only load on the ACS 'List' post pages
	if ( is_acs_page() ) {
    	acs_enqueue_scripts();
    	acs_add_metaboxes();
	}
}

function acs_enqueue_scripts() {
	wp_enqueue_script( 'underscore' );
	wp_enqueue_script( 'acs-jst', ACS_PLUGIN_URI . '/js/jst.js', false, false, true );
	wp_enqueue_script( 'acs-ui', ACS_PLUGIN_URI . '/js/functions.input.js', false, false, true );
	wp_enqueue_style( 'acs-ui-css', ACS_PLUGIN_URI . '/css/style.input.css' );

    wp_localize_script( 'acs-ui', 'ACS', array( 'fieldName' => ACS_POST_META ) );
}

function acs_add_metaboxes() {
	add_meta_box('acs_input', 'List Contents', 'acs_input_meta_box', 'acs', 'normal', 'high');
}

function is_acs_page() {
	global $pagenow;
	global $typenow;

	return in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) && ACS_POST_TYPE === $typenow;
}
