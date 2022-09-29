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
    
    // Student CPT Block Editor - p block and button - tempalte lock all
    $labels = array(
        'name'                  => _x( 'The Class', 'post type general name'  ),
        'singular_name'         => _x( 'Student', 'post type singular name'  ),
        'menu_name'             => _x( 'Student', 'admin menu'  ),
        'name_admin_bar'        => _x( 'Student', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'Student' ),
        'add_new_item'          => __( 'Add New Student' ),
        'new_item'              => __( 'New Student' ),
        'edit_item'             => __( 'Edit Students' ),
        'view_item'             => __( 'View Students'  ),
        'all_items'             => __( 'All Students' ),
        'archives'              => __( 'Student Archives'),
        'search_items'          => __( 'Search Students' ),
        'parent_item_colon'     => __( 'Parent Students' ),
        'not_found'             => __( 'No students found.' ),
        'not_found_in_trash'    => __( 'No students in Trash.' ),
        'insert_into_item'   	=> __( 'Insert into work'),
        'uploaded_to_this_item' => __( 'Uploaded to this work'),
        'filter_item_list'   	=> __( 'Filter works list'),
        'items_list_navigation' => __( 'Student list navigation'),
        'items_list'         	=> __( 'Students list'),
        'featured_image'     	=> __( 'Student featured image'),
        'set_featured_image' 	=> __( 'Set student featured image'),
        'remove_featured_image' => __( 'Remove student featured image'),
        'use_featured_image' 	=> __( 'Use as featured image'),
    );
    
    $argss = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'student' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-universal-access',
        'supports'           => array( 'title', 'editor', 'thumbnail'),
        'template'           => array( array( 'core/paragraph' ), array( 'core/buttons') ),
        'template_lock'      => 'all',
    );

    register_post_type( 'wps-student', $argss );
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

    // register student taxonomy
    $labels = array(
        'name'              => _x( 'Student Specialties', 'taxonomy general name' ),
        'singular_name'     => _x( 'Student Specialty', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Student Specialties' ),
        'all_items'         => __( 'All Student Specialties' ),
        'parent_item'       => __( 'Parent Specialty' ),
        'parent_item_colon' => __( 'Parent Specialty:' ),
        'edit_item'         => __( 'Edit Student Specialty' ),
        'update_item'       => __( 'Update Student Specialties' ),
        'add_new_item'      => __( 'Add New Student Specialties' ),
        'new_item_name'     => __( 'New Student Specialty' ),
        'menu_name'         => __( 'Student Specialty' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'student-specialty' ),
    );

    register_taxonomy( 'wps-student-specialty', array( 'wps-student' ), $args );

}
add_action( 'init', 'wp_the_school_register_taxonomies' );
