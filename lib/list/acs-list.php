<?php

class ACS_List {

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
		$types = maybe_unserialize( get_post_meta( $this->post->ID, ACS_POST_TYPES_META, true ) );
		if( $types ) {
			return $types;
		} else {
			return array();
		}
	}

	/**
	 * Get the post IDs making up this group
	 * @return array
	 */
	public function get_posts() {
		$posts = maybe_unserialize( get_post_meta( $this->post->ID, ACS_POST_META, true ) );
		if( $posts ) {
			return $posts;
		} else {
			return array();
		}
	}
}
