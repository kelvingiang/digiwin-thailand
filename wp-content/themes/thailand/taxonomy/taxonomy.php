<?php

class Taxonomy_Main
{

    private $_taxonomy_name = 'main_taxonomy_options';
    private $_taxonomy_options = array();

    public function __construct()
    {
        $defaultOption = array(
            'taxonomy_news' => true,
            'taxonomy_resource' => true,
            'taxonomy_slider' => true,
        
        );

        $this->_taxonomy_options = get_option($this->_taxonomy_name, $defaultOption);

        $this->taxonomy_news();
        $this->taxonomy_resource();
        $this->taxonomy_slider();

    }


    public function taxonomy_news()
    {
        if ($this->_taxonomy_options['taxonomy_news'] == true) {
            require_once(DIR_TAXONOMY . 'taxonomy-news.php');
            new taxonomy_news();
        }
    }

     public function taxonomy_resource()
    {
        if ($this->_taxonomy_options['taxonomy_resource'] == true) {
            require_once(DIR_TAXONOMY . 'taxonomy-resource.php');
            new taxonomy_resource();
        }
    }

        public function taxonomy_slider()
    {
        if ($this->_taxonomy_options['taxonomy_slider'] == true) {
            require_once(DIR_TAXONOMY . 'taxonomy-slider.php');
            new taxonomy_slider();
        }
    }

}
