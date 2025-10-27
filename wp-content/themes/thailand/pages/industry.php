<?php /*  Template Name: Industry Page */
get_header();
get_template_part('templates/template', 'menu');
get_template_part('templates/template', 'slider');

global $wp;
$param = $wp->query_vars;
$cate = $param['cate'];
$category = '';
switch ($cate) {
    case 'case-studies':
        $category = 'Case Studies';
        break;
    case 'events':
        $category = 'Events';
        break;
    case 'articles':
        $category = 'Articles';
        break;
}
$arr = array(
    'post_type' => 'resource',
    'resource_category' => $cate,
    'posts_per_page' => get_option('first_load'),
    'orderby'        => 'date',
    'order'          => 'DESC'
);

$wp_query = new WP_Query($arr);
?>
<div class="h2-title">
    <h2><?php echo $category ?></h2>
</div>
<div class="article-list" data-cate="<?php echo $cate ?>">
    <?php
    if ($wp_query->have_posts()) :
        $stt = 1;
        while ($wp_query->have_posts()) :
            $wp_query->the_post();
    ?>
            <div class="item" data-id="<?php echo $stt ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <img class="item-img" src="<?php the_post_thumbnail_url() ?>" srcset="<?php the_post_thumbnail_url() ?>" />
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
                    <?php the_content() ?>
                </div>
            </div>
    <?php
            $stt++;
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>
<script>
    // === 頁面初始也先綁定一次 ===
    jQuery(document).ready(function() {
        bindHoverAnimation();
    });
    // === 初始綁定 hover 動畫 ===
    function bindHoverAnimation() {
        jQuery('.article-list .item').off('mouseover mouseout'); // 防重複綁定
        jQuery('.article-list .item').on('mouseover', function() {
            jQuery(this).addClass('itemMouseOver').removeClass('itemMouseLeave');
        });
        jQuery('.article-list .item').on('mouseout', function() {
            jQuery(this).addClass('itemMouseLeave').removeClass('itemMouseOver');
        });
    }

    // === 初始進場動畫 ===
    function animateNewItems($items) {
        $items.addClass('animation-item');
        $items.each(function(i, el) {
            setTimeout(() => {
                jQuery(el).addClass('animation-show');
            }, i * 150); // 每個延遲 0.15 秒
        });

        // 動畫跑完後移除 class，避免 hover 衝突
        setTimeout(() => {
            $items.removeClass('animation-show animation-item');
        }, 2000);
    }

    // === AJAX 加載完成後使用 ===
    function onAjaxLoad(newHtml) {
        const $newItems = jQuery(newHtml).appendTo('.article-list');
        animateNewItems($newItems);
        bindHoverAnimation();
    }

    // ==================== chức năng load thêm data khi thanh cuốn xuống còn 30px
    jQuery(function($) {
        let page = 2;
        let loading = false;

        // 取得 ajax url（有 fallback）
        function getAjaxUrl() {
            if (typeof my_ajax_object !== "undefined" && my_ajax_object.ajax_url)
                return my_ajax_object.ajax_url;
            if (typeof ajaxurl !== "undefined") return ajaxurl; // 有些情況 admin 設定會出現
            return window.location.origin + "/wp-admin/admin-ajax.php"; // 最後手段
        }
        const ajaxUrl = getAjaxUrl();
        const nonce =
            typeof my_ajax_object !== "undefined" && my_ajax_object.nonce ?
            my_ajax_object.nonce :
            "";

        $(window).on("scroll", function() {
            if (loading) return;

            if (
                $(window).scrollTop() + $(window).height() >=
                $(document).height() - 30
            ) {
                loading = true;
                // 🔹 找出目前最後一個 item 的 data-id
                let lastID = $(".article-list .item").last().data("id") || 0;
                let cate = $(".article-list ").data("cate") || 0;

                $.ajax({
                    url: ajaxUrl,
                    type: "POST",
                    data: {
                        action: "load_more_posts",
                        page: page,
                        offset: lastID, // 把最後一筆 ID 傳給後端
                        cate: cate,
                        security: nonce,
                    },
                    success: function(response) {
                        if (response.trim() !== "no-more") {
                            // $(".article-list").append(response);
                            onAjaxLoad(response); // 使用動畫載入函式
                            page++;
                            loading = false;
                        } else {
                            // 沒資料時可以選擇解除監聽
                            $(window).off("scroll");
                        }
                    },
                    error: function(xhr) {
                        // console.error('load more error', xhr);
                        loading = false;
                        console.log(xhr.responseText);
                    },
                });
            }
        });
    });
</script>

<?php get_footer(); ?>