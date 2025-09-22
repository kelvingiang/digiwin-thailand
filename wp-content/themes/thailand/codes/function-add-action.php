<?php
/* =========================================================
customerlogo SAO KHI THÊM MỚI SẼ TỰ QUAY TRANG TRƯỚC ĐÓ 
========================================================= */
add_filter('redirect_post_location', function ($location, $post_id) {
    // 只處理你的 Custom Post Type
    $post_type = get_post_type($post_id);

    if (
        $post_type === 'post'
        || $post_type === 'news'
        || $post_type === 'industry'
        || $post_type === 'slider'
        || $post_type === 'customerlogo'
        
    ) {
        return admin_url("edit.php?post_type={$post_type}");
    }

    return $location;
}, 10, 2);


/* =========================================================
// chi doi ten mac dinh cua POST sang 1 ten moi  =========================================
========================================================= */
add_action('init', 'cp_change_post_object');
// Change dashboard Posts to News
function cp_change_post_object()
{
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
    $labels->name = '產品';
    $labels->singular_name = '產品';
    $labels->add_new = '新增';
    $labels->add_new_item = '新增';
    $labels->edit_item = '編輯';
    $labels->new_item = '產品';
    $labels->view_item = '';
    $labels->search_items = '搜索';
    $labels->not_found = '找到任何資料';
    $labels->not_found_in_trash = '回收桶中未找到任何資料';
    $labels->all_items = '全部';
    $labels->menu_name = '產品';
    $labels->name_admin_bar = '產品';
}

/* =========================================================
// CHỈNH SỬA CÁC CỘT MẶC ĐỊNH TRONG TABLE ===================================
========================================================= */
add_filter('manage_posts_columns', 'set_custom_edit_columns');
function set_custom_edit_columns($columns)
{
    //unset($columns['author']);
    //            unset($columns['categories']);
    unset($columns['tags']);
    unset($columns['comments']);
    unset($columns['date']);
    // $columns['content'] = __('內容');
    // $columns['author'] = __('Author');
    // $columns['category'] = __('Category');
    $columns['home'] = __('首頁');
    // $columns['langguage'] = __('Langguage');
    // $columns['setorder'] = __('Show Order');
    //$columns['date'] = __('日期');
    //$columns['publisher'] = __('Publisher', 'your_text_domain');
    $columns['create_date'] = __('創建日期');
    return $columns;
}

add_action('manage_posts_custom_column', 'Custom_Post_RenderCols');
function Custom_post_RenderCols($columns)
{
    global $post;
    switch ($columns) {

        case 'home':
            if ((get_post_meta($post->ID, '_meta_box_home', true))) {
                echo "<div class='show-home'></div>";
            }
            break;
        case 'category':
            $terms = wp_get_post_terms($post->ID, 'solutions_category');
            if (count($terms) > 0) {
                foreach ($terms as $key => $term) {
                    echo '<a href=' . custom_redirect($term->slug) . '&' . $term->taxonomy . '=' . $term->slug . '>' . $term->name . '</a></br>';
                }
            }
            break;
        case 'langguage':
            _e(get_post_meta($post->ID, '_metabox_langguage', true));
            break;

        case 'setorder':
            echo get_post_meta($post->ID, '_metabox_order', true);
            break;

        case 'create_date':
            echo get_the_date('m-d-Y');
            break;

        default:
            break;
    }
}

/* =========================================================
// THIẾT LẬP NGÔN NGỮ  ==================================================================================
========================================================= */
add_filter('gettext', 'change_translate_text', 20);
function change_translate_text($translated)
{
    if ($_SESSION['languages'] == 'cn') {
        $languages = 'zh_TW';
    } else {
        $languages = 'vi_VN';
    }

    if (is_admin()) {
        $file = dirname(dirname(dirname(dirname(__FILE__)))) . "/languages/admin_languages/data.php";
        // $file = DIR_LANGUAGES . 'admin_language/data.php';
    } else {
        $file = dirname(dirname(dirname(dirname(__FILE__)))) . "/languages/{$languages}/data.php";
    }
    include_once $file;

    $data = getTranslate();
    if (isset($data[$translated])) {
        return $data[$translated];
    }
    return $translated;
}
