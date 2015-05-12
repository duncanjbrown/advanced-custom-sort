<?php

class ACS_List {

	var $post_id;

	/**
	 * Accepts a post_id
	 */
	function __construct( $post_id ) {
		$this->post_id = $post_id;
	}

	/**
	 * Get the post IDs making up this group
	 * @return array
	 */
	public function get_posts() {
		$posts = maybe_unserialize( get_post_meta( $this->post_id, ACS_POST_META, true ) );
		if( $posts ) {
			return $posts;
		} else {
			return array();
		}
	}

	public function get_wp_query() {
		return new WP_Query([
			'post__in' => $this->get_posts(),
			'post_type' => get_post_types( array( 'exclude_from_search' => false ) ),
		]);
	}

	/**
	 * Update the post ids
	 * @param  array $post_ids
	 * @return void
	 */
	public function update_posts( $post_ids ) {
		update_post_meta( $this->post_id, ACS_POST_META, $post_ids );
	}

	/**
	 * Update the post types
	 * @param  array $types
	 * @return void
	 */
	public function update_post_types( $types ) {
		update_post_meta( $this->post_id, ACS_POST_TYPES_META, $types );
	}
}
