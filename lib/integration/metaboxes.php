<?php
/**
 * @package  acs.integration
 */

/**
 * Generate the metabox for inputting the connections
 * @return void 
 */
function acs_input_meta_box() {
	global $post;

	$group = new ACS_Group( $post );

	$selected = $group->get_posts();
    $post_types = $group->get_allowed_post_types();

	$query = new WP_Query( array(
		'post_status' => 'publish',
		'post_type' => $post_types ? $post_types : get_post_types( array( 'exclude_from_search' => false ) ),
		'orderby' => 'title',
	) );

	$candidates = $query->posts;

	include('views/input-meta-box.php');
}


/**
 * Generate the metabox for setting the options
 * @return void 
 */
function acs_options_meta_box() {

	global $post;
	$group = new ACS_Group( $post );

	$candidate_post_types = get_post_types( array( 'exclude_from_search' => false ) );
	$allowed_post_types = $group->get_allowed_post_types();

	include('views/options-meta-box.php');
}


add_action( 'admin_init', acs_handle_post_update( 'acs_handle_input_meta_box' ) );
add_action( 'admin_init', acs_handle_post_update( 'acs_handle_options_meta_box' ) );

/**
 * @param  int $post_id 
 * @return void          
 */
function acs_handle_input_meta_box( $post_id ) {
	if ( isset($_POST['acs_save_posts'] ) && $_POST['acs_save_posts'] == 'true' ) {
	    $post_order = $_POST['acs']['post_order'];
	    update_post_meta( $post_id, 'post_order', serialize( $post_order ) );
	}
}

/**
 * @param  int $post_id 
 * @return void          
 */
function acs_handle_options_meta_box( $post_id )  {
	if( isset( $_POST['acs_save_options'] ) && $_POST['acs_save_options'] == 'true' ) 	{
	    $options = $_POST['acs'][ACS_OPTIONS_META];
	    update_post_meta($post_id, ACS_POST_TYPES_META, serialize( (array) $options[ACS_POST_TYPES_META] ) );
	}
}