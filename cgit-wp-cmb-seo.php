<?php

/*

Plugin Name: Castlegate IT WP CMB SEO
Plugin URI: http://github.com/castlegateit/cgit-wp-cmb-seo
Description: Simple SEO fields for titles, headings, and descriptions using Custom Meta Boxes.
Version: 1.1
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

    $meta_box = array(
        'id'      => 'cgit-wp-cmb-seo',
        'title'   => 'SEO',
        'pages'   => array('post', 'page'),
        'context' => 'side',
        'fields'  => $fields,
    );

    $meta_boxes[] = apply_filters('cgit_seo_fields', $meta_box);

    return $meta_boxes;

}

add_filter('cmb_meta_boxes', 'cgit_seo_fields');

/**
 * Edit title
 */
function cgit_seo_title ($title) {

    if ( ! class_exists('CMB_Meta_Box') ) {
        return $title;
    }

    global $post;

    if ( is_archive() ) {
        // Title for archives
        $title = post_type_archive_title('', false) . ' archives';
    } elseif ( isset($post) && get_post_meta($post->ID, 'seo_title', TRUE) ) {
        // Title for posts/pages
        $title = get_post_meta($post->ID, 'seo_title', TRUE);
    }

    return $title;

}

add_filter('wp_title', 'cgit_seo_title', 999);

/**
 * Add description
 */
function cgit_seo_description () {

    if ( ! class_exists('CMB_Meta_Box') ) {
        return FALSE;
    }

    global $post;

    if ( isset($post) && get_post_meta($post->ID, 'seo_description', TRUE) ) {
        $description = get_post_meta($post->ID, 'seo_description', TRUE);
        echo "<meta name='description' content='$description' />\n";
    }

}

add_action('wp_head', 'cgit_seo_description', 0);

/**
 * Generate heading
 *
 * This is a utility function for use in your theme. Because the heading could
 * appear anywhere on the page, the heading is not added to the site
 * automatically.
 */
function cgit_seo_heading ($sep = ': ') {

    if ( ! class_exists('CMB_Meta_Box') ) {
        return FALSE;
    }

    global $post;

    if ( isset($post) && get_post_meta($post->ID, 'seo_heading', TRUE) ) {
        return get_post_meta($post->ID, 'seo_heading', TRUE);
    } elseif ( is_page() || is_single() ) {
        return get_bloginfo('name') . $sep . get_the_title();
    } else {
        return get_bloginfo('name');
    }

}
