<?php

class Meta_Box_summary
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'create'));
        add_action('save_post', array($this, 'save'));
    }

    public function create()
    {
        $id = 'admin-metabox-summary';
        $title = __('Summary');
        $callback = array($this, 'display');
        add_meta_box($id, $title, $callback, array('post','resource'));
    }

    public function display($post)
    {
        $action = 'admin-metabox-data';
        $name = 'admin-metabox-data-nonce';
        wp_nonce_field($action, $name);
?>
        <div class="row-one-column">
   
            <div class="cell-text">
                <textarea name="txt-summary" id="txt-summary" class="my-input" style="width:100%; height: 80px;"><?php echo get_post_meta($post->ID, '_meta_box_summary', true) ?></textarea>
            </div>
        </div>
<?php
    }

    public function save($post_id)
    {
        if (!empty($_POST['txt-summary'])) {
            update_post_meta($post_id, '_meta_box_summary', $_POST['txt-summary']);
        }
    }
}
