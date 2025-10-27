<?php
class Controller_Resource
{

    public function __construct()
    {
        add_action('init', array($this, 'create_post'));
        add_action('manage_edit-resource_columns', array($this, 'manage_columns'));
        add_action('manage_resource_posts_custom_column', array($this, 'render_columns'));

        add_filter('manage_edit-resource_sortable_columns', array($this, 'sortable_views_column'));
        add_filter('request', array($this, 'sort_views_column'));
    }

    public function create_post()
    {
        $labels = array(
            'name' => __('Resource'),
            'singular_name' => __('Resource'),
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
            'menu_name' => __('Resource')
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
            'menu_position' => 2,
            'supports' => array('title', 'thumbnail', 'editor'),
        );
        register_post_type('resource', $args);
    }

    //==== QUAN LY COT HIEN THI TRON BANG   
    public function manage_columns($columns)
    {
        unset($columns['create_date']);
        unset($columns['home']);

        $columns['img'] = __('Image');
        $columns['cate'] = __('Category');
        $columns['create_date'] = __('Create Date');
        return $columns;
    }

    //==== HIEN THI NOI DUNG TRONG COT
    public function render_columns($columns)
    {
        global $post;
        switch ($columns) {
            case 'cate':
                $terms = wp_get_post_terms($post->ID, 'resource_category');
                if (count($terms) > 0) {
                    foreach ($terms as $key => $term) {
                        echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                    }
                }
                break;
            case 'img':
                if (has_post_thumbnail()) {
                    set_post_thumbnail_size(50, 0, false);
                    the_post_thumbnail();
                }
                break;
        }
    }

    //====== SAP SEP THEO TRINH TU
    public function sortable_views_column($newcolumn)
    {
        $newcolumn['setorder'] = 'setorder';
        $newcolumn['langguage'] = 'langguage';
        return $newcolumn;
    }

    public function sort_views_column($vars)
    {
        if (isset($vars['orderby']) && 'setorder' == $vars['orderby']) {
            $vars = array_merge(
                $vars,
                array(
                    'meta_key' => '_metabox_order', //Custom field key
                    'orderby' => '_metabox_order' //Custom field value (number)
                )
            );
        }


        if (isset($vars['orderby']) && 'langguage' == $vars['orderby']) {
            $vars = array_merge(
                $vars,
                array(
                    'meta_key' => '_metabox_langguage', //Custom field key
                    'orderby' => '_metabox_langguage' //Custom field value (number)
                )
            );
        }
        return $vars;
    }
}
