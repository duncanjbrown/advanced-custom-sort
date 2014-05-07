<?php
/**
 * @package  acs.groups
 */

class ACS_Group {

	/**
	 * @var WP_Post
	 */
	var $post;

	/**
	 * Accepts a post object 
	 * @param WP_Post $post 
	 */
	function __construct( $post ) {
		$this->post = $post;
	}

	/**
	 * Get the post types allowed for this group
	 * @return array
	 */
	public function get_allowed_post_types() {
		return (array) maybe_unserialize( get_post_meta( $post->ID, ACS_POST_TYPES_META, true ) );
	}

	/**
	 * Get the post IDs making up this group
	 * @return array
	 */
	public function get_posts() {
		$posts = get_post_meta( $this->post->ID, ACS_POST_TYPE, true );
		return (array) maybe_unserialize( $posts );
	}
}