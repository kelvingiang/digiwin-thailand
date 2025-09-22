<?php

class Controller_Main
{

    private $_controller_name = 'main_controller_options';
    private $_controller_options = array();

    public function __construct()
    {

        $defaultOption = array(
            'controller_setting' => true,
            'controller_customer_logo' => true,
            'controller_news' => true,
            'controller_industry' => true,
            'controller_resource' => true,
            'controller_slider' => true,
        );

        $this->_controller_options = get_option($this->_controller_name, $defaultOption);

        $this->page_setting();

        $this->post_news();
        $this->post_industry();
        $this->post_resource();
        $this->post_slider();
        $this->post_customer_logo();

        add_action('admin_init', array($this, 'do_output_buffer'));
    }

    public function page_setting()
    {
        if ($this->_controller_options['controller_setting']) {
            require_once(DIR_CONTROLLER . 'controller-setting.php');
            new Controller_Web_Setting();
        }
    }

    //================================================================================


    public function post_slider()
    {
        if ($this->_controller_options['controller_slider']) {
            require_once(DIR_CONTROLLER . 'controller-slider.php');
            new Controller_Slider();
        }
    }

    public function post_resource()
    {
        if ($this->_controller_options['controller_resource']) {
            require_once(DIR_CONTROLLER . 'controller-resource.php');
            new Controller_Resource();
        }
    }


    public function post_industry()
    {
        if ($this->_controller_options['controller_industry']) {
            require_once(DIR_CONTROLLER . 'controller-industry.php');
            new Controller_Industry();
        }
    }

    public function post_news()
    {
        if ($this->_controller_options['controller_news']) {
            require_once(DIR_CONTROLLER . 'controller-news.php');
            new Controller_News();
        }
    }

    public function post_customer_logo()
    {
        if ($this->_controller_options['controller_customer_logo']) {
            require_once(DIR_CONTROLLER . 'controller-customer-logo.php');
            new Controller_Customer_Logo();
        }
    }



    //=== FUNCTION NAY GIAI QUYET CHUYEN TRANG BI LOI 
    public function do_output_buffer()
    {
        ob_start();
    }
}
