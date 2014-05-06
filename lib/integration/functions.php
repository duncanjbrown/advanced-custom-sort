<?php
/**
 * @package  acs.integration
 */

/**
 * Get a group of post IDs
 *
 * Allowed options:
 * 		'group_id' => (int) the id of the group you want
 * 		'fields' => 'ids', what you want back from the group
 * 
 * @param  array $args options (see above)
 * @return array
 */
function acs_get_group( $args ) {

	$defaults = array(
		'group_id' => NULL,
		'fields' => 'ids'
	);

	$args = wp_parse_args( $args, $defaults );

	$query = new WP_Query ( array( 
		'post_type' => ACS_POST_TYPE,
		'posts_per_page' => 1,
		'fields' => 'ids',
		'post__in' => array( $args['group_id'] )
	) );

	$post = reset( $query->posts );

	if( $post ) {
		return (array) maybe_unserialize( get_post_meta( $post->ID, ACS_POST_META, true ) );
	} else {
		return array();
	}

}