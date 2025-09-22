<?php

class Controller_Industry
{

    public function __construct()
    {
        add_action('init', array($this, 'create_post'));
        add_action('manage_edit-industry_columns', array($this, 'manage_columns'));
        add_action('manage_industry_posts_custom_column', array($this, 'render_columns'));

        add_filter('manage_edit-industry_sortable_columns', array($this, 'sortable_views_columns'));
        add_filter('request', array($this, 'sort_views_columns'));
    }

    public function create_post()
    {
        $labels = array(
            'name' => __('Industry'),
            'singular_name' => __('Industry'),
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
            'menu_name' => __('Industry')
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
            'menu_position' => 6,
            'supports' => array('title', 'thumbnail', 'editor'),
        );
        register_post_type('industry', $args);
    }

    //==== QUAN LY COT HIEN THI TRON BANG   
    public function manage_columns($col)
    {
        unset($col['create_date']);
        $col['create_date'] = __('Create Date');
        return $col;
    }

    //==== HIEN THI NOI DUNG TRONG COT
    public function render_columns($col)
    {
        global $post;
        if ($col == 'category') {
            global $post;
            $terms = wp_get_post_terms($post->ID, 'industry_category');

            if (count($terms) > 0) {
                foreach ($terms as $key => $term) {
                    echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                }
            }
        }
    }

    //====== SAP SEP THEO TRINH TU
    public function sortable_views_columns($col)
    {
        return $col;
    }

    public function sort_views_columns($col)
    {
        return $col;
    }
}
