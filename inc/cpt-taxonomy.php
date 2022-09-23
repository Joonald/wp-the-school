<?php

// Labels specify for the backend of wordpress
// function to add custom post type
function wp_the_school_register_custom_post_type() {
    // Staff CPT only supporting Title
    $labels = array(
        'name'               => _x( 'Staff Members', 'post type general name'  ),
        'singular_name'      => _x( 'Staff Member', 'post type singular name'  ),
        'menu_name'          => _x( 'Staff Members', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Staff Member', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Staff Member' ),
        'add_new_item'       => __( 'Add New Staff Member' ),
        'new_item'           => __( 'New Staff Member' ),
        'edit_item'          => __( 'Edit Staff Member' ),
        'view_item'          => __( 'View Staff Member'  ),
        'all_items'          => __( 'All Staff Members' ),
        'search_items'       => __( 'Search Staff Members' ),
        'parent_item_colon'  => __( 'Parent Staff' ),
        'not_found'          => __( 'No staff member found.' ),
        'not_found_in_trash' => __( 'No staff members found in Trash.' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staff-members' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title'),
    );

    register_post_type( 'wps-staff', $args );
    
}
add_action( 'init', 'wp_the_school_register_custom_post_type' );

// function to add taxonomies (helps organize content)
function wp_the_school_register_taxonomies() {
    // Adding Staff Taxonomy
    $labels = array(
        'name'              => _x( 'Staff Roles', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Role', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Roles' ),
        'all_items'         => __( 'All Staff Roles' ),
        'parent_item'       => __( 'Parent Staff' ),
        'parent_item_colon' => __( 'Parent Staff:' ),
        'edit_item'         => __( 'Edit Staff Roles' ),
        'update_item'       => __( 'Update Staff Roles' ),
        'add_new_item'      => __( 'Add New Staff Roles' ),
        'new_item_name'     => __( 'New Staff Roles' ),
        'menu_name'         => __( 'Staff Roles' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'staff-role' ),
    );

    register_taxonomy( 'wps-staff-roles', array( 'wps-staff' ), $args );
}
add_action( 'init', 'wp_the_school_register_taxonomies' );
