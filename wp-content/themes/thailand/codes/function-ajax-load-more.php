<?php
// enqueue + localize
function my_ajax_localize_data()
{
    // 用 wp_localize_script 的方式不適用於 inline script
    // 改成在 header 或 footer 直接輸出 JS 變數
?>
    <script type="text/javascript">
        var my_ajax_object = {
            ajax_url: '<?php echo admin_url('admin-ajax.php'); ?>',
            nonce: '<?php echo wp_create_nonce('load_more_posts_nonce'); ?>'
        };
    </script>
    <?php
}
add_action('wp_footer', 'my_ajax_localize_data'); // 建議加在 footer


// AJAX handler（含 nonce 檢查）
add_action('wp_ajax_load_more_posts', 'my_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'my_load_more_posts');

function my_load_more_posts()
{
    // 若你有 localize 傳 nonce，這行會檢查安全性；若不想用可以註解掉
    check_ajax_referer('load_more_posts_nonce', 'security');

    $count = get_option('more_load'); // 每次載入筆數
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $cate   = isset($_POST['cate']) ? sanitize_text_field($_POST['cate']) : '';

    $args = array(
        'post_type'      => array('resource', 'news'),
        'posts_per_page' => $count,
        // 'resource_category' => $cate,
        'offset'         => $offset,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    // 如果有分類參數，就自動偵測屬於哪個 taxonomy
    if (!empty($cate)) {
        if (term_exists($cate, 'resource_category')) {
            $taxonomy = 'resource_category';
        } elseif (term_exists($cate, 'news_category')) {
            $taxonomy = 'news_category';
        } else {
            $taxonomy = ''; // 若兩邊都找不到
        }

        if ($taxonomy) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => $cate,
                ),
            );
        }
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        $stt = $offset + 1;
        while ($query->have_posts()) :
            $query->the_post();

    ?>
            <div class="item animation-item" data-id="<?php echo $stt; ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <a class="my-link" href="<?php echo get_the_permalink() ?>">
                        <img class="item-img" src="<?php the_post_thumbnail_url() ?>" srcset="<?php the_post_thumbnail_url() ?>" />
                    </a>
                <?php endif ?>
                <div class="item-title">
                    <a class="my-link" href="<?php echo get_the_permalink() ?>">
                        <?php the_title() ?>
                    </a>
                </div>
                <div class="item-date">
                    <?php echo get_the_date() ?>
                </div>
                <div class="item-summary">
                    <?php echo get_post_meta(get_the_ID(), '_meta_box_summary', true) ?>
                </div>
            </div>
<?php
            $stt++;
        endwhile;
        wp_reset_postdata();
    else :
        echo 'no-more';
    endif;
    wp_die();
}


function my_ajax_form_submit_handler()
{
    // 1. Kiểm tra nonce (nên có để tăng cường bảo mật - đã bỏ qua ở đây cho đơn giản)

    // 2. Lấy dữ liệu từ form
    $name    = sanitize_text_field($_POST['user_name']);
    $address = sanitize_text_field($_POST['user_address']);
    $phone   = sanitize_text_field($_POST['user_phone']);

    // 3. Xử lý dữ liệu
    // Ví dụ: Lưu dữ liệu vào một post type tùy chỉnh, gửi email, hoặc lưu vào bảng database riêng.

    // Giả lập việc xử lý thành công
    if (! empty($name) && ! empty($phone)) {
        // Trả về phản hồi thành công (dùng wp_send_json_success)
        wp_send_json_success('Cảm ơn ' . $name . ', chúng tôi đã nhận thông tin của bạn!');
    } else {
        // Trả về phản hồi thất bại (dùng wp_send_json_error)
        wp_send_json_error('Vui lòng điền đầy đủ Tên và Điện thoại.');
    }

    // Luôn luôn kết thúc bằng wp_die()
    wp_die();
}

// Thiết lập WordPress hooks
// Lắng nghe cho người dùng đã đăng nhập:
add_action('wp_ajax_my_ajax_form_submit', 'my_ajax_form_submit_handler');
// Lắng nghe cho người dùng CHƯA đăng nhập:
add_action('wp_ajax_nopriv_my_ajax_form_submit', 'my_ajax_form_submit_handler');
