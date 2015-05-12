<?php

/**
 * Get a list by its title
 * @param  string $title
 * @return ACS_List | null
 */
function acs_get_list( $title ) {
	$list = get_page_by_title( $title, OBJECT, ACS_POST_TYPE );
	if( $list ) {
		return new ACS_List( $list->ID );
	} else {
		return null;
	}
}
