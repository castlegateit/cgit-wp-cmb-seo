<?php

/*

Plugin Name: Castlegate IT WP CMB SEO
Plugin URI: http://github.com/castlegateit/cgit-wp-cmb-seo
Description: Simple SEO fields for titles, headings, and descriptions using Custom Meta Boxes.
Version: 1.0
Author: Castlegate IT
Author URI: http://www.castlegateit.co.uk/
License: MIT

*/

/**
 * Add SEO fields
 */
function cgit_seo_fields ($meta_boxes) {

    $fields = array(
        array(
            'id'   => 'seo_title',
            'name' => 'Title',
            'type' => 'text',
        ),
        array(
            'id'   => 'seo_heading',
            'name' => 'Heading',
            'type' => 'text',
        ),
        array(
            'id'   => 'seo_description',
            'name' => 'Description',
            'type' => 'text',
        ),
    );

    $meta_boxes[] = array(
        'id'      => 'cgit-wp-cmb-seo',
        'title'   => 'SEO',
        'pages'   => array('post', 'page'),
        'context' => 'side',
        'fields'  => $fields,
    );

    return $meta_boxes;

}

add_filter('cmb_meta_boxes', 'cgit_seo_fields');

/**
 * Edit title
 */
function cgit_seo_title ($title) {

    global $post;

    if ( class_exists('CMB_Meta_Box') && isset($post) && get_post_meta($post->ID, 'seo_title', TRUE) ) {
        $title = get_post_meta($post->ID, 'seo_title', TRUE);
    }

    return $title;

}

add_filter('wp_title', 'cgit_seo_title', 999);

/**
 * Add description
 */
function cgit_seo_description () {

    global $post;

    if ( class_exists('CMB_Meta_Box') && isset($post) && get_post_meta($post->ID, 'seo_description', TRUE) ) {
        $description = get_post_meta($post->ID, 'seo_description', TRUE);
        echo "<meta name='description' content='$description' />\n";
    }

}

add_action('wp_head', 'cgit_seo_description', 0);
