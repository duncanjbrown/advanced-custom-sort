<?php 
/**
 * @package  acs
 */

/**
 * Require the .php files in a directory
 * @param  string $path 
 * @return void       
 */
function acs_include( $path ) {
	$path = ACS_PLUGIN_PATH . '/' . $path;
	foreach (glob($path."/*.php") as $filename) {
	    include $filename;
	}
}
