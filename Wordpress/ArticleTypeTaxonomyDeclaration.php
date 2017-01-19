<?php

/**
 * Here we add a custom taxonomy for 'article' content type
 */

add_action('init', function () {

    register_taxonomy('article_type', array('article'), array(
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
    ));

});