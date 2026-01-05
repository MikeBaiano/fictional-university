<?php

function university_post_types() {
    // Event Post Type
    register_post_type( 'event', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
        'menu_icon' => 'dashicons-calendar',
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
    ) );
    
    // Program Post Type
    register_post_type( 'program', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'programs'),
        'menu_icon' => 'dashicons-awards',
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
    ) );
}

add_action('init', 'university_post_types');