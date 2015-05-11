<?php
/*
Plugin Name: Advanced Custom Sort
Plugin URI: http://uproot.us/advanced-custom-sort/
Description: Create groups of custom-ordered posts.
Version: 1.2.2
Author: Matt Gibbs, Duncan Brown
Author URI: http://uproot.us/
License: GPL
Copyright: Matt Gibbs
*/



define( 'ACS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'ACS_PLUGIN_URI', plugin_dir_url( __FILE__ ) );

set_include_path(get_include_path() . PATH_SEPARATOR . ACS_PLUGIN_PATH);

include( 'lib/helpers.php' );

acs_include( 'lib/integration' );
acs_include( 'lib/ui' );
acs_include( 'lib/group' );

$acs = new Acs();
$acs->version = '1.2.2';

class Acs
{
    public $dir;
    public $path;
    public $version;
    public $orderby;

    /*--------------------------------------------------------------------------------------
    *
    *	Constructor
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    *
    *-------------------------------------------------------------------------------------*/

    function __construct()
    {
        $this->path = (string) dirname(__FILE__);
        $this->dir = plugins_url('advanced-custom-sort');
        $this->orderby = false;

        // add filters
        add_filter('posts_orderby', array($this, 'posts_orderby'));

        // add js
        add_action('admin_print_scripts', array($this, 'admin_print_scripts'));

        // load translations
        load_plugin_textdomain('acs', false, $this->path . '/lang');
    }


    /*--------------------------------------------------------------------------------------
    *
    *	posts_orderby
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    *
    *-------------------------------------------------------------------------------------*/

    function posts_orderby($arg)
    {
        if ($this->orderby)
        {
            $arg = $this->orderby;

            $this->orderby = false;
        }
        return $arg;
    }

    /*--------------------------------------------------------------------------------------
    *
    *	admin_print_scripts
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    *
    *-------------------------------------------------------------------------------------*/

    function admin_print_scripts()
    {
        // jquery
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
    }
}
