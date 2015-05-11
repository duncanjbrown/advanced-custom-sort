<?php
/*
Plugin Name: Advanced Custom Sort
Plugin URI: http://uproot.us/advanced-custom-sort/
Description: Create groups of custom-ordered posts.
Version: 1.3.0
Author: Matt Gibbs, Duncan Brown
Author URI: http://uproot.us/
License: GPL
Copyright: Matt Gibbs
*/

define( 'ACS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'ACS_PLUGIN_URI', plugin_dir_url( __FILE__ ) );

set_include_path(get_include_path() . PATH_SEPARATOR . ACS_PLUGIN_PATH);

include( 'lib/helpers.php' );

// Saving and loading data; displaying metaboxes
acs_include( 'lib/integration' );

// Scripts etc, admin tools
acs_include( 'lib/ui' );

// the list itself
acs_include( 'lib/list' );

add_action('admin_print_scripts', function() {
    // jquery
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
} );
