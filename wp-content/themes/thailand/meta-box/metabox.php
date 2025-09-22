<?php

class Meta_Box_Main
{

    private $_meta_box_name = 'main_meta_box_options';
    private $_meta_box_options = array();

    public function __construct()
    {
        $defaultOption = array(
            'meta_box_web' => TRUE,
            'meta_box_home' => TRUE,
        );

        $this->_meta_box_options = get_option($this->_meta_box_name, $defaultOption);
        $this->meta_box_web();
        $this->meta_box_home();
        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    public function meta_box_web()
    {
        if ($this->_meta_box_options['meta_box_web']) {
            require_once(DIR_META_BOX . 'metabox-web.php');
            new meta_box_web();
        }
    }

    public function meta_box_home()
    {
        if ($this->_meta_box_options['meta_box_home']) {
            require_once(DIR_META_BOX . 'metabox-home.php');
            new meta_box_home();
        }
    }


    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer()
    {
        ob_start();
    }
}
