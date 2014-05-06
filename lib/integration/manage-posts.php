<?php
/**
 * @package  acs.integration
 */
add_action( 'restrict_manage_posts', 'acs_add_taxonomy_filters' );

function acs_add_taxonomy_filters() {
	global $typenow;
 
	// must set this to the post type you want the filter(s) displayed on
	if( ACS_POST_TYPE === $typenow ){
 	
 		$tax_slug = ACS_TAX;
		$taxonomy = get_taxonomy( ACS_TAX );
		$tax_name = $taxonomy->labels->name;
		$terms = get_terms( ACS_TAX );

		if( $terms ) {
			include( 'views/taxonomy-dropdown.php' );
		}

	}
}