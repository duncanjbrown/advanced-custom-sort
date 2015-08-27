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

	$query = new WP_Query( array(
		'post_status' => 'publish',
		'post__not_in' => $selected,
		'post_type' => get_post_types( array( 'exclude_from_search' => false ) ),
		'orderby' => 'title',
		'posts_per_page' => 10
	) );

	$candidates = $query->posts;

	include('views/input-meta-box.php');
}

add_action( 'save_post', acs_handle_post_update( 'acs_handle_input_meta_box' ) );

/**
 * @param  int $post_id
 * @return void
 */
function acs_handle_input_meta_box( $post_id, $postdata ) {
	if( isset( $postdata['acs_save_posts'] ) ) {
		$list = new ACS_List( $post_id );
		$list->update_posts( ( isset($postdata[ACS_POST_META])? $postdata[ACS_POST_META] : array() ) );
	}
}
