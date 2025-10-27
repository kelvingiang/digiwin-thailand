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
            'meta_box_title' => TRUE,
            'meta_box_industry' => TRUE,
            'meta_box_summary' => TRUE,
        );

        $this->_meta_box_options = get_option($this->_meta_box_name, $defaultOption);
        $this->meta_box_web();
        $this->meta_box_home();
        $this->meta_box_title();
        $this->meta_box_industry();
        $this->meta_box_summary();
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

    public function meta_box_title()
    {
        if ($this->_meta_box_options['meta_box_title']) {
            require_once(DIR_META_BOX . 'metabox-title.php');
            new meta_box_title();
        }
    }

    public function meta_box_industry()
    {
        if ($this->_meta_box_options['meta_box_industry']) {
            require_once(DIR_META_BOX . 'metabox-industry.php');
            new meta_box_industry();
        }
    }

    public function meta_box_summary()
    {
        if ($this->_meta_box_options['meta_box_summary']) {
            require_once(DIR_META_BOX . 'metabox-summary.php');
            new meta_box_summary();
        }
    }

    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer()
    {
        ob_start();
    }
}
