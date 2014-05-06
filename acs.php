<?php
/*
Plugin Name: Advanced Custom Sort
Plugin URI: http://uproot.us/advanced-custom-sort/
Description: Create groups of custom-ordered posts.
Version: 1.2.2
Author: Matt Gibbs
Author URI: http://uproot.us/
License: GPL
Copyright: Matt Gibbs
*/

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

        // add actions
        add_action('init', array($this, 'init'));
        add_action('admin_head', array($this, 'admin_head'));
        add_action('admin_footer', array($this, 'admin_footer'));
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_notices', array($this, 'admin_message'));
        add_action('save_post', array($this, 'save_post'));

        // add filters
        add_filter('posts_orderby', array($this, 'posts_orderby'));

        // add js
        add_action('admin_print_scripts', array($this, 'admin_print_scripts'));

        // load translations
        load_plugin_textdomain('acs', false, $this->path . '/lang');
    }


    /*--------------------------------------------------------------------------------------
    *
    *	upgrade
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    * 
    *-------------------------------------------------------------------------------------*/

    function upgrade()
    {
        include('core/upgrade.php');
    }


    /*--------------------------------------------------------------------------------------
    *
    *	init
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    * 
    *-------------------------------------------------------------------------------------*/

    function init()
    {
        include('core/actions/init.php');
    }


    /*--------------------------------------------------------------------------------------
    *
    *	admin_menu
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    * 
    *-------------------------------------------------------------------------------------*/

    function admin_menu()
    {
        add_options_page(__('Adv Custom Sort', 'acs'), __('Adv Custom Sort', 'acs'), 'manage_options', 'edit.php?post_type=acs');
    }


    /*--------------------------------------------------------------------------------------
    *
    *	admin_head
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    * 
    *-------------------------------------------------------------------------------------*/

    function admin_head()
    {
        include('core/actions/admin_head.php');
    }


    /*--------------------------------------------------------------------------------------
    *
    *	admin_footer
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    * 
    *-------------------------------------------------------------------------------------*/

    function admin_footer()
    {
        if ('acs' == $GLOBALS['post_type'] && 'edit.php' == $GLOBALS['pagenow'])
        {
            include('core/actions/admin_footer.php');
        }
    }


    /*--------------------------------------------------------------------------------------
    *
    *	admin_message
    *
    *	@author Matt Gibbs
    *	@since 1.0.3
    * 
    *-------------------------------------------------------------------------------------*/

    function admin_message($msg = null)
    {
        if (null != $msg)
        {
            echo '<div id="message" class="updated"><p>' . $msg . '</p></div>';
        }
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
    *	save_post
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    * 
    *-------------------------------------------------------------------------------------*/

    function save_post($post_id)
    {
        // skip autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        {
            return $post_id;
        }

        if (!wp_verify_nonce($_POST['ei_noncename'], 'ei-n'))
        {
            return $post_id;
        }

        if (wp_is_post_revision($post_id))
        {
            $post_id = wp_is_post_revision($post_id);
        }

        include('core/actions/input_save.php');
        include('core/actions/options_save.php');
    }


    /*--------------------------------------------------------------------------------------
    *
    *	get_post_ids
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    * 
    *-------------------------------------------------------------------------------------*/

    function get_post_ids($group_name, $opts = array())
    {
        global $wpdb;

        $defaults = array(
            'output' => 'array',
        );

        $opts = array_merge($defaults, $opts);

        $group_name = mysql_real_escape_string($group_name);
        $group_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '$group_name' AND post_type = 'acs' LIMIT 1");
        $posts = get_post_meta($group_id, 'post_order', true);
        $array = (array) unserialize($posts);

        if ($opts['output'] == 'string')
        {
            return implode(',', $array);
        }
        return $array;
    }


    /*--------------------------------------------------------------------------------------
    *
    *	query_posts
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    * 
    *-------------------------------------------------------------------------------------*/

    function query_posts($opts = array())
    {
        global $wpdb;

        $orderby = false;
        $post_ids = array();
        $group_name = isset($opts['group_name']) ? $opts['group_name'] : false;

        if ($group_name)
        {
            $post_ids = $this->get_post_ids($group_name);

            if (!empty($post_ids))
            {
                $orderby = "FIELD($wpdb->posts.ID," . implode(',', $post_ids) . ')';
            }
        }

        // Save custom order for posts_orderby filter
        $this->orderby = $orderby;

        $defaults = array(
            'post_type' => 'any',
            'post__in' => $post_ids,
            'order' => 'ASC',
            'posts_per_page' => -1,
            'ignore_sticky_posts' => true,
        );

        $opts = array_merge($defaults, $opts);

        query_posts($opts);
    }


    /*--------------------------------------------------------------------------------------
    *
    *	_input_meta_box
    *
    *	@author Matt Gibbs
    *	@since 1.0.0
    * 
    *-------------------------------------------------------------------------------------*/

    function _input_meta_box()
    {
        include('core/admin/input_meta_box.php');
    }


    /*--------------------------------------------------------------------------------------
    *
    *	_options_meta_box
    *
    *	@author Matt Gibbs
    *	@since 1.0.8
    *
    *-------------------------------------------------------------------------------------*/

    function _options_meta_box()
    {
        include('core/admin/options_meta_box.php');
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
