<?php
/* them menu co phan khai bao thay doi ngon ngu o phan __  thong qua textdomain */
register_nav_menu('computer-menu', __('網頁導航')); // goi menu de show
register_nav_menu('mobile-menu', __('手機導航')); // goi menu de show

function suite_menu($slug)
{
    $menu = array(
        'theme_location' => $slug, // chon menu dc thiet lap truoc
        'container' => 'nav', // tap html chua menu nay
        'container_class' => 'primary-menu', // class cua mennu
        'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
    );

    wp_nav_menu($menu);
}

function mobile_menu($slug)
{
    $menu = array(
        'theme_location' => $slug, // chon menu dc thiet lap truoc
        'container' => 'nav', // tap html chua menu nay
        'container_class' => 'second-menu', // class cua mennu
        // 'container_id' => 'nav-mobile-menu', // class cua mennu
        'items_wrap' => '<ul id="%1$s" class="%2$s sf-mobile-menu">%3$s</ul>'
    );
    wp_nav_menu($menu);
}


// tự thêm item vào trong menu dc định thiết lập trong admin ==============
// add_filter('wp_nav_menu_items', function ($items, $args) {
//     if ($args->theme_location === 'computer-menu') {
//         $li_first = '<li class="menu-item custom-link first"><a href='.home_url().'><i class="fa fa-home"></i></a></li>';
//         $li_last  = '<li class="menu-item custom-link last"><a href="'.home_url('contact').'"><i class="far fa-address-book"></i></a></li>';

//         $items = $li_first . $items . $li_last;
//     }
//     return $items;
// }, 10, 2);

// 允許 HTML 在選單文字中顯示===================================
add_filter('wp_nav_menu', 'allow_menu_html');
function allow_menu_html($menu){
    return do_shortcode($menu);
}

// // 載入 Font Awesome add thêm font vào 
function load_fontawesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'load_fontawesome' );
