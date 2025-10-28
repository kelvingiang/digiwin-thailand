<?php /*  Template Name: Resource Page */
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


    jQuery(function($) {
        let page = 2;
        let loading = false;

        function getAjaxUrl() {
            if (typeof my_ajax_object !== "undefined" && my_ajax_object.ajax_url)
                return my_ajax_object.ajax_url;
            if (typeof ajaxurl !== "undefined") return ajaxurl;
            return window.location.origin + "/wp-admin/admin-ajax.php";
        }

        const ajaxUrl = getAjaxUrl();
        const nonce =
            typeof my_ajax_object !== "undefined" && my_ajax_object.nonce ?
            my_ajax_object.nonce :
            "";

        // ==================== chức năng load thêm data khi thanh cuốn xuống còn 30px
        $(window).on("scroll touchmove", function() {
            if (loading) return;

            const scrollY = window.scrollY || window.pageYOffset;
            const visibleHeight = window.innerHeight;
            const totalHeight = document.documentElement.scrollHeight;

            if (scrollY + visibleHeight >= totalHeight - 30) {
                loading = true;

                let lastID = $(".article-list .item").last().data("id") || 0;
                let cate = $(".article-list").data("cate") || 0;

                $.ajax({
                    url: ajaxUrl,
                    type: "POST",
                    data: {
                        action: "load_more_posts",
                        page: page,
                        offset: lastID,
                        cate: cate,
                        security: nonce,
                    },
                    success: function(response) {
                        if (response.trim() !== "no-more") {
                            onAjaxLoad(response);
                            page++;
                            loading = false;

                            // 若手機螢幕太短，自動再載入
                            if (document.documentElement.scrollHeight <= window.innerHeight + 30) {
                                $(window).trigger('scroll');
                            }
                        } else {
                            $(window).off("scroll touchmove");
                        }
                    },
                    error: function() {
                        loading = false;
                    }
                });
            }
        });
    });
</script>

<?php get_footer(); ?>