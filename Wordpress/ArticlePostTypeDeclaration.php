<?php

/**
 * According to Wordpress docs we add post-based content-type that would have next features:
 * - top admin menu link
 * - left menu bar section
 * - category support
 * - custom taxonomy support
 */


add_action('init', function () {

    register_post_type('article', [
        'labels'                => [
            'name_admin_bar' => __('Article', 'add new from admin bar'),
            'name'           => __('Articles', 'post type general name'),
            'singular_name'  => __('Article'),
            'add_new'        => __('Add New', 'add new article'),
            'edit_item'      => __('Edit Article'),
            'view_item'      => __('View Article'),
        ],
        'public'                => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'map_meta_cap'          => true,
        'menu_position'         => 20,
        'hierarchical'          => false,
        'rewrite'               => [
            'slug' => 'articles',
        ],
        'query_var'             => false,
        'delete_with_user'      => true,
        'supports'              => ['title', 'editor', 'author', 'thumbnail', 'parent', 'custom-fields',
                                    'comments', 'revisions'],
        'show_in_rest'          => true,
        'rest_base'             => 'posts',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ]);

    /**
     * Here we tell that our Articles may have standard Wordpress tags.
     * But we use a trick. We reference to a system name declared in Smartling Content-Type descriptor and don't use simple strings.
     **/
    register_taxonomy(\Smartling\ContentTypes\ContentTypePostTag::WP_CONTENT_TYPE, ['article', 'post']);
});


