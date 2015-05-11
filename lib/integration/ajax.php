<?php

add_action( 'wp_ajax_acs_search', function() {
	$term = $_GET['s'];
	$query = new WP_Query( ['s' => $term, 'posts_per_page' => 10 ] );
	$posts = array_map( function( $p ) {
		return [ 'id' => $p->ID, 'title' => $p->post_title ];
	}, $query->posts );

	echo json_encode( $posts );
	die();
} );
