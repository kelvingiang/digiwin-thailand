<?php
global $wp;
$param = $wp->query_vars;
if (empty($param)) {
    $pageName = 'home';
} else {
    $pageName = $param['pagename'];
}
$args = array(
    'post_type' => 'slider',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'tax_query'      => array(
        array(
            'taxonomy' => 'slider_category',   // 你的 taxonomy 名稱
            'field'    => 'slug',              // 可以用 'slug' 或 'term_id'
            'terms'    => $pageName,          // 比如只抓 slug = homepage 的分類
        ),
    ),
);
$wp_query = new WP_Query($args);

?>
<div id="slider">
    <div class="owl-carousel owl-theme">
        <?php if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) : $wp_query->the_post();
                $url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                $link = get_post_meta($post->ID, '_meta_box_web', true);
        ?>

                <div class="item">
                    <?php if (!empty($link)) : ?>
                        <a href="<?php echo get_post_meta($post->ID, '_meta_box_web', true); ?>">
                            <img src="<?php echo $url[0] ?>" alt="<?php echo the_title(); ?>">
                            <div class="owl-slider-title">
                                <h2><?php echo  get_post_meta(get_the_ID(), '_meta_box_title', true) ?></h2>
                            </div>
                            <div class="owl-slider-content">
                                <?php the_content(); ?>
                            </div>
                        </a>
                    <?php else : ?>
                        <img src="<?php echo $url[0] ?>" alt="<?php echo the_title(); ?>">
                        <div class="owl-slider-title">
                            <h2><?php echo  get_post_meta(get_the_ID(), '_meta_box_title', true) ?></h2>
                        </div>
                        <div class="owl-slider-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endif ?>
                </div>
        <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
</div>


<script>
    jQuery(document).ready(function() {
        jQuery('#slider .owl-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            autoplay: true,
            autoplayTimeout: 3000, // 3秒间隔切换幻灯片
            autoplaySpeed: 500,
            dots: true,
            autoplayHoverPause: true,
            items: 1,

        })
    });
</script>