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

	if( $args['group_id'] ) {
		return (array) maybe_unserialize( get_post_meta( $args['group_id'], ACS_POST_META, true ) );
	} else {
		return array();
	}
}