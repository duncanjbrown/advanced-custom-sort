<?php
/**
 * @package  acs.integration
 */
add_action( 'restrict_manage_posts', 'acs_add_taxonomy_filters' );

/**
 * Add a taxonomy filter dropdown to the ACS summary page
 * @return void 
 */
function acs_add_taxonomy_filters() {
	global $typenow;
 
	if( ACS_POST_TYPE === $typenow ){
 	
 		$tax_slug = ACS_TAX;
		$taxonomy = get_taxonomy( ACS_TAX );
		$tax_name = $taxonomy->labels->name;
		$terms = get_terms( ACS_TAX );

		$selected = isset( $_REQUEST[ACS_TAX] ) ? $_REQUEST[ACS_TAX] : null;

		if( $terms ) {
			include( 'views/taxonomy-dropdown.php' );
		}

	}
}