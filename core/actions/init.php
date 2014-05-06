<?php

/*--------------------------------------------------------------------------------------
*
*	Create post type
*
*	@author Matt Gibbs
*	@since 1.0.0
* 
*-------------------------------------------------------------------------------------*/

$labels = array(
    'name' => __('Sort Groups', 'acs'),
    'singular_name' => __('Sort Group', 'acs'),
    'add_new' => __('Add New', 'acs'),
    'add_new_item' => __('Add New Sort Group', 'acs'),
    'edit_item' =>  __('Edit Sort Group', 'acs'),
    'new_item' => __('New Sort Group', 'acs'),
    'view_item' => __('View Sort Group', 'acs'),
    'search_items' => __('Search Sort Groups', 'acs'),
    'not_found' =>  __('No Sort Groups found', 'acs'),
    'not_found_in_trash' => __('No Sort Groups found in Trash', 'acs'),
);

register_post_type('acs', array(
    'labels' => $labels,
    'public' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'capability_type' => 'page',
    'hierarchical' => false,
    'supports' => array('title'),
));


/*--------------------------------------------------------------------------------------
*
*	Custom columns
*
*	@author Matt Gibbs
*	@since 1.0.0
* 
*-------------------------------------------------------------------------------------*/

function acs_columns_filter()
{
    return array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Title', 'acs'),
    );
}

add_filter('manage_edit-acs_columns', 'acs_columns_filter');
