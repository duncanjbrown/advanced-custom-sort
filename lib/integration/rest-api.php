<?php
/**
 *
 */
add_filter( 'rest_prepare_acs', function( $data, $list ) {
	$acs_list = new ACS_List($list->ID);
	$ids = $acs_list->get_posts();

	foreach( $ids as $id ) {
		$data->add_link(
			'http://acs.list/member',
			rest_url( '/wp/v2/'.get_post_type( $id ). '/' . $id ),
			['embeddable' => true]
		);
	}
	return $data;
}, 10, 2);
