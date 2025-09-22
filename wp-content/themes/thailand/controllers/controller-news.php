<?php

class Controller_News
{

    public function __construct()
    {
        add_action('init', array($this, 'create_post'));
        add_action('manage_edit-news_columns', array($this, 'manage_columns'));
        add_action('manage_news_posts_custom_column', array($this, 'render_columns'));

        // add_filter('manage_edit-news_sortable_columns', array($this, 'sortable_views_columns'));
        // add_filter('request', array($this, 'sort_views_columns'));
    }

    public function create_post()
    {
        $labels = array(
            'name' => __('News'),
            'singular_name' => __('News'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add Item'),
            'edit_item' => __('Edit'),
            'new_item' => __('Add Item'),
            'all_items' => __('All Item'),
            'view_item' => __('View Item'),
            'search_items' => __('Search'),
            'not_found' => __('No slides found.'),
            'not_found_in_trash' => __('No found in Trash.'),
            'parent_item_colon' => '',
            'menu_name' => __('News')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => TRUE,
            'menu_icon' => PART_ICON . 'icon-link.png',
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array('title', 'thumbnail', 'editor'),
        );
        register_post_type('news', $args);
    }

    //==== QUAN LY COT HIEN THI TRON BANG   
    public function manage_columns($col)
    {
        unset($col['create_date']);
        $col['cate'] = __('Category');
        $col['create_date'] = __('Create Date');
        return $col;
    }

    //==== HIEN THI NOI DUNG TRONG COT
    public function render_columns($col)
    {
          if ($col == 'cate') {
            global $post;
            $terms = wp_get_post_terms($post->ID, 'news_category');

            if (count($terms) > 0) {
                foreach ($terms as $key => $term) {
                    echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                }
            }
        }
    }

    //====== SAP SEP THEO TRINH TU
    public function sortable_views_columns($col) {}

    public function sort_views_columns($col) {}
}
