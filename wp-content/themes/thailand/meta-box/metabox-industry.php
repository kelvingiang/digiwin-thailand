<?php

class Meta_Box_Industry
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create()
    {
        $id = 'admin-metabox-title';
        $title = __('Industry');
        $callback = array($this, 'display');
        add_meta_box($id, $title, $callback, array('industry'));
    }

    public function display($post)
    {
        $action = 'admin-metabox-data';
        $name = 'admin-metabox-data-nonce';
        wp_nonce_field($action, $name);
?>
        <div class="row-one-column">
            <div class="cell-title">產業標題</div>
            <div class="cell-text">
                <input type="text" name="txt-industry-title" id="txt-industry-title" class="my-input"
                    value="<?php echo get_post_meta($post->ID, '_meta_box_industry_title', true) ?>" />
            </div>
        </div>

        <div class="row-one-column">
            <div class="cell-title">產業簡介</div>
            <div class="cell-text">
                <input type="text" name="txt-industry-summary" id="txt-industry-summary" class="my-input"
                    value="<?php echo get_post_meta($post->ID, '_meta_box_industry_summary', true) ?>" />
            </div>
        </div>
<?php
    }

    public function save($post_id)
    {
        if (!empty($_POST['txt-industry-title'])) {
            update_post_meta($post_id, '_meta_box_industry_title', $_POST['txt-industry-title']);
        }

         if (!empty($_POST['txt-industry-summary'])) {
            update_post_meta($post_id, '_meta_box_industry_summary', $_POST['txt-industry-summary']);
        }
    }
}
