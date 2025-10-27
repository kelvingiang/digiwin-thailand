<?php

class Meta_Box_Web
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create()
    {
        $id = 'admin-metabox-web';
        $title = __('Web Site');
        $callback = array($this, 'display');
        add_meta_box($id, $title, $callback, array('customerlogo','slider'));
    }

    public function display($post)
    {
        $action = 'admin-metabox-data';
        $name = 'admin-metabox-data-nonce';
        wp_nonce_field($action, $name);
?>
        <div class="row-one-column">
            <div class="cell-title"><?php _e('Web Site') ?></div>
            <div class="cell-text">
                <input type="text" name="txt-web" id="txt-web" class="my-input"
                    value="<?php echo get_post_meta($post->ID, '_meta_box_web', true) ?>" />
            </div>
        </div>
<?php
    }

    public function save($post_id)
    {
        // if (!empty($_POST['txt-web'])) {
            update_post_meta($post_id, '_meta_box_web', $_POST['txt-web']);
        // }
    }
}
