<?php

add_action('init', function(){

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
        'rewrite'               => ['slug' => 'articles'],
        'query_var'             => false,
        'delete_with_user'      => true,
        'supports'              => ['title', 'editor', 'author', 'thumbnail', 'parent', 'custom-fields', 'comments',
                                    'revisions'],
        'show_in_rest'          => true,
        'rest_base'             => 'posts',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    ]);

    register_taxonomy('article_type', ['article'], [
        'hierarchical'      => true,
        'labels'            => [
            'name'              => __('Article Types'),
            'singular_name'     => __('Article Type'),
            'search_items'      => __('Search Article Types'),
            'all_items'         => __('All Article Types'),
            'parent_item'       => __('Parent Article Type'),
            'parent_item_colon' => __('Parent Article Type:'),
            'edit_item'         => __('Edit Article Type'),
            'update_item'       => __('Update Article Type'),
            'add_new_item'      => __('Add New Article Type'),
            'new_item_name'     => __('New Article Type Name'),
            'menu_name'         => __('Article Types'),
        ],
        'show_ui'           => true,
        'public'            => true,
        'query_var'         => true,
        'show_admin_column' => true,
    ]);

    /**
     * Here we tell that our Articles may have standard Wordpress tags.
     * But we use a trick. We reference to a system name declared in Smartling Content-Type descriptor and don't use simple strings.
     **/
  //  register_taxonomy('post_tag', ['article', 'post']);
});