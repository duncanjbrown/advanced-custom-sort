<?php
/**
 * @package  acs.integration
 */

/**
 * Generate the metabox for creating connections
 * @return void
 */
function acs_input_meta_box() {
	global $post;

	$list = new ACS_List( $post->ID );

	$selected = $list->get_posts();
    $post_types = $list->get_allowed_post_types();

	$query = new WP_Query( array(
		'post_status' => 'publish',
		'post__not_in' => $selected,
		'post_type' => $post_types ? $post_types : get_post_types( array( 'exclude_from_search' => false ) ),
		'orderby' => 'title',
	) );

	$candidates = $query->posts;

	include('views/input-meta-box.php');
}


/**
 * Generate the metabox for setting the post types
 * @return void
 */
function acs_options_meta_box() {

	global $post;
	$list = new ACS_List( $post->ID );

	$candidate_post_types = get_post_types( array( 'exclude_from_search' => false ) );
	$allowed_post_types = $list->get_allowed_post_types();

	include('views/options-meta-box.php');
}


add_action( 'save_post', acs_handle_post_update( 'acs_handle_input_meta_box' ) );
add_action( 'save_post', acs_handle_post_update( 'acs_handle_options_meta_box' ) );

/**
 * @param  int $post_id
 * @return void
 */
function acs_handle_input_meta_box( $post_id, $postdata ) {
    if( isset( $postdata[ACS_POST_META] ) ) {
    	$list = new ACS_List( $post_id );
	    $list->update_posts( $postdata[ACS_POST_META] );
	}
}

/**
 * @param  int $post_id
 * @return void
 */
function acs_handle_options_meta_box( $post_id, $postdata )  {
	if( isset( $postdata[ACS_POST_TYPES_META] ) ) {
    	$list = new ACS_List( $post_id );
	    $list->update_post_types( $postdata[ACS_POST_TYPES_META] );
	}
}
