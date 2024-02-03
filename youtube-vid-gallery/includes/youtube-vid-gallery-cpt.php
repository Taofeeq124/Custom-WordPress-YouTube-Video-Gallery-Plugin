<?php

// Custom post type registration function
function yvg_register_video() {

    // Filterable singular and plural names for better customization
    $singular_name = apply_filters('yvg_label_single', 'video');
    $plural_name   = apply_filters('yvg_label_plural', 'videos');

    // Labels for the custom post type
    $labels = array(
        'name'               => $plural_name,
        'singular_name'      => $singular_name,
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New ' . $singular_name,
        'edit'               => 'Edit',
        'edit_item'          => 'Edit ' . $singular_name,
        'new_item'           => 'New ' . $singular_name,
        'view'               => 'View',
        'view_item'          => 'View ' . $singular_name,
        'search_item'        => 'Search ' . $plural_name,
        'not_found'          => 'No ' . $plural_name,
        'not_found_in_trash' => 'No ' . $plural_name . ' found',
        'menu_name'          => $plural_name
    );

    // Arguments for the custom post type
    $args = array(
        'labels'             => $labels,
        'description'        => 'Video by category',
        'taxonomies'         => array('category'), // Enable category taxonomy
        'public'             => true, // Show the post type in front-end
        'show_in_menu'       => true, // Show in the admin menu
        'menu_position'      => 5, // Menu position
        'menu_icon'          => 'dashicons-video-alt', // Icon for the menu
        'show_in_nav_menus'  => true, // Show in navigation menus
        'capability_type'    => 'post', // Capability type
        'supports'           => array('title') // Supported features
    );

    // Register Post Type
    register_post_type('video', $args);
}

// Hook into the init action to register the custom post type
add_action('init', 'yvg_register_video');

?>


<!--

php

<?php

// Custom post type registration function
function yvg_register_video() {

    // Filterable singular and plural names for better customization
    $singular_name = apply_filters('yvg_label_single', 'video');
    $plural_name   = apply_filters('yvg_label_plural', 'videos');

    // Labels for the custom post type
    $labels = array(
        'name'               => $plural_name,
        'singular_name'      => $singular_name,
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New ' . $singular_name,
        'edit'               => 'Edit',
        'edit_item'          => 'Edit ' . $singular_name,
        'new_item'           => 'New ' . $singular_name,
        'view'               => 'View',
        'view_item'          => 'View ' . $singular_name,
        'search_item'        => 'Search ' . $plural_name,
        'not_found'          => 'No ' . $plural_name,
        'not_found_in_trash' => 'No ' . $plural_name . ' found',
        'menu_name'          => $plural_name
    );

    // Arguments for the custom post type
    $args = array(
        'labels'             => $labels,
        'description'        => 'Video by category',
        'taxonomies'         => array('category'), // Enable category taxonomy
        'public'             => true, // Show the post type in front-end
        'show_in_menu'       => true, // Show in the admin menu
        'menu_position'      => 5, // Menu position
        'menu_icon'          => 'dashicons-video-alt', // Icon for the menu
        'show_in_nav_menus'  => true, // Show in navigation menus
        'capability_type'    => 'post', // Capability type
        'supports'           => array('title') // Supported features
    );

    // Register Post Type
    register_post_type('video', $args);
}

// Hook into the init action to register the custom post type
add_action('init', 'yvg_register_video');

?>


Explanation:

    This code registers a custom post type named 'video' in WordPress.
    The custom post type labels are defined with filterable singular and plural names for easy customization.
    The labels array defines various labels for the custom post type, such as 'add_new', 'edit', 'view', etc.
    The arguments array specifies the details of the custom post type, including its description, taxonomy, visibility, menu settings, capabilities, and supported features.
    The register_post_type() function registers the custom post type with the specified name 'video' and arguments.
    Finally, the add_action() function hooks into the 'init' action to call the yvg_register_video() function when WordPress initializes.

-->