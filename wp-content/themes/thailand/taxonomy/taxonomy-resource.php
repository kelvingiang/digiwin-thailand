<?php

class Taxonomy_Resource
{

    private $prefix_name = 'option_resource_category_';

    public function __construct()
    {
        add_action('init', array($this, 'create_taxonomy'));

        //add_action('news_category_add_form_fields', array($this, 'add_form'));
        //add_action('news_category_edit_form_fields', array($this, 'edit_form'));

        add_filter("manage_edit-resource_category_columns", array($this, 'category_columns'), 10, 3);
        add_filter("manage_resource_category_custom_column", array($this, 'category_columns_manage'), 10, 3);

        //add_action('create_news_category', array($this, 'save_option'));
        //add_action('edited_news_category', array($this, 'save_option'));
       // add_action('delete_news_category', array($this, 'delete_option'));
    }

    public function create_taxonomy()
    {
        $labels = array(
            'name' => __('Categories'),
            'singular_name' => __('Categories'),
            'search_items' => __('Search Categories'),
            'all_items' => __('Categories'),
            'parent_item' => __('Parent Class'),
            'parent_item_colon' => __('Parent Class'),
            'edit_item' => __('Edit'),
            'update_item' => __('Update'),
            'add_new_item' => __('Add New'),
            'new_item_name' => __('Add New'),
            'menu_name' => __('Categories')
        );

        register_taxonomy('resource_category', 'resource', array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'taxonomy' => 'category',
            'rewrite' => array(
                'slug' => 'resource_category',
                'hierarchical' => true,
            )
        ));
    }

    public function add_form()
    {
?>
        <div class="form-field">
            <input type="hidden" name="cate_cn" id="cate_cn" value="" />
            <label for="cate_vn"> <?php _e('Name') ?> ( <?php _e('Vietnamese') ?>)</label>
            <input type="text" name="cate_vn" id="cate_vn" value="" />
        </div>
        <div class="form-field">
            <label for="cate_en"> <?php _e('Name') ?> ( <?php _e('English') ?>)</label>
            <input type="text" name="cate_en" id="cate_en" value="" />
        </div>
        <div class="form-field">
            <label for="cate_order"><?php _e('Show Order') ?></label>
            <input type="text" name="cate_order" id="cate_order" value="" />
        </div>
     
    <?php
    }

    public function edit_form($term)
    {
        // LAY GIA TRI TRONG OPTION TABLE
        $arr_value = get_option($this->prefix_name . $term->term_id);
    ?>
        <input type="hidden" name="cate_cn" id="cate_cn" value="<?php echo $arr_value['cate_active_cn']; ?>" />

        <tr class="form-field">
            <th scope="row" valign="top"> <label for="cate_vn"> <?php _e('Name') ?> (<?php _e('Vietnamese') ?> )</label></th>
            <td><input type="text" name="cate_vn" id="cate_vn" value="<?php echo $arr_value['cate_vn']; ?>" /></td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"> <label for="cate_en"><?php _e('Name') ?> ( <?php _e('English') ?> )</label> </th>
            <td> <input type="text" name="cate_en" id="cate_en" value="<?php echo $arr_value['cate_en']; ?>" /></td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"> <label for="cate_en"> <?php _e('Show Order') ?></label> </th>
            <td> <input type="text" name="cate_order" id="cate_order" value="<?php echo $arr_value['cate_order']; ?>" /></td>
        </tr>

        <script>
            jQuery('#name').focusout(function() {
                jQuery('#cate_cn').val(jQuery(this).val());
            });
        </script>
<?php
    }

    public function save_option($term_id)
    {
        $arr = array(
            'cate_cn' => $_POST['cate_cn'],
            'cate_vn' => $_POST['cate_vn'],
            'cate_en' => $_POST['cate_en'],
            'cate_order' => $_POST['cate_order'],
        );
        $option_name = $this->prefix_name . $term_id;
        $option_value = $arr;
        update_option($option_name, $option_value);
    }

    public function delete_option()
    {
        $param = getParams();
        delete_option($this->prefix_name . $param['tag_ID']);
    }

    public function category_columns()
    {
        $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            //            'description' => __('Description'),
           // 'vietnamese' => __('Vietnamese'),
            //'english' => __('English'),
            // 'order' => __('Show Order'),
            'slug' => __('Slug'),
            'posts' => __('Count')
        );

        return $new_columns;
    }

    public function category_columns_manage($out, $column_name, $theme_id)
    {
        $theme = get_term($theme_id, 'active_category');

        $strOption = get_option($this->prefix_name . $theme->term_id);
        switch ($column_name) {
            case 'order':
                echo isset($strOption['cate_order']) ? $strOption['cate_order'] : '0';
                break;
            case 'vietnamese':
                echo isset($strOption['cate_vn']) ? $strOption['cate_vn'] : '';
                break;
            case 'english':
                echo isset($strOption['cate_en']) ? $strOption['cate_en'] : '';
                break;
            default:
                break;
        }
        return $out;
    }
}
