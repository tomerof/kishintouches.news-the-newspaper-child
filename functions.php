<?php
/**
 * @package 	WordPress
 * @subpackage 	The Newspaper Child
 * @version		1.0.0
 * 
 * Child Theme Functions File
 * Created by CMSMasters
 * 
 */


function the_newspaper_child_enqueue_styles() {
    wp_enqueue_style('the-newspaper-child-style', get_stylesheet_uri(), array(), '1.0.2', 'screen, print');
}

add_action('wp_enqueue_scripts', 'the_newspaper_child_enqueue_styles', 11);


function force_post_layout_settings($post_id) {
    // Only run for standard 'post' type, not pages or projects
    if (get_post_type($post_id) != 'post') {
        return;
    }

    // 1. Force Right Sidebar Layout
    // Key: cmsmasters_layout | Value: r_sidebar
    update_post_meta($post_id, 'cmsmasters_layout', 'r_sidebar');

    // 2. Force the specific "Post Sidebar"
    // Key: cmsmasters_sidebar_id | Value: post-sidebar 
    // Note: Verify 'post-sidebar' matches the ID in Theme Settings > Elements
    update_post_meta($post_id, 'cmsmasters_sidebar_id', 'post-sidebar');
}

// Fire the function whenever a post is created or updated
add_action('save_post', 'force_post_layout_settings');

?>