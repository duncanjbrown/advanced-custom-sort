<?php
/**
 * @package acs.integration
 */

add_action( 'init', function() {
    $labels = array(
        'name' => __('Lists', 'acs'),
        'singular_name' => __('List', 'acs'),
        'add_new' => __('Add New', 'acs'),
        'add_new_item' => __('Add New List', 'acs'),
        'edit_item' =>  __('Edit List', 'acs'),
        'new_item' => __('New List', 'acs'),
        'view_item' => __('View List', 'acs'),
        'search_items' => __('Search Lists', 'acs'),
        'not_found' =>  __('No Lists found', 'acs'),
        'not_found_in_trash' => __('No Lists found in Trash', 'acs'),
    );

    register_post_type( ACS_POST_TYPE, array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'page',
        'hierarchical' => false,
        'supports' => array('title'),
        'menu_icon' => 'dashicons-list-view'
    ));

    $labels = array(
        'name'              => _x( 'Collections', 'taxonomy general name' ),
        'singular_name'     => _x( 'Collection', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Collections' ),
        'all_items'         => __( 'All Collections' ),
        'parent_item'       => __( 'Parent Collection' ),
        'parent_item_colon' => __( 'Parent Collection:' ),
        'edit_item'         => __( 'Edit Collection' ),
        'update_item'       => __( 'Update Collection' ),
        'add_new_item'      => __( 'Add New Collection' ),
        'new_item_name'     => __( 'New Collection Name' ),
        'menu_name'         => __( 'Manage Collections' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false
    );

    register_taxonomy( ACS_TAX, array( 'acs' ), $args );
});
