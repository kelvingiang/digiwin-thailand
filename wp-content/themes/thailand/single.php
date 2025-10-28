<?php get_header();
get_template_part('templates/template', 'menu');
?>
<div class="post-area">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post-header">
                <?php if (has_post_thumbnail()) : ?>
                    <img class="post-thumbnail" src="<?php the_post_thumbnail_url() ?>" srcset="<?php the_post_thumbnail_url() ?>" />
                <?php endif  ?>
                <div class="post-title"><?php the_title()  ?></div>
                <div class="post-summary"><?php echo get_post_meta($post->ID, '_meta_box_summary', true) ?></div>
            </div>
            <div class="post-content">
                <?php the_content() ?>
            </div>

    <?php endwhile;
    endif; ?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {

        // setTimeout(function() {
        //     // Sử dụng animate() để di chuyển và làm rõ dần
        //     jQuery('.post-title').animate({
        //             // 1. Hiệu ứng Di chuyển: Chuyển từ top: 0% đã đặt trong CSS sang top: 50%
        //             top: '35%',
        //             // 2. Hiệu ứng Rõ dần: Chuyển từ opacity: 0 đã đặt trong CSS sang opacity: 1 (rõ hoàn toàn)
        //             opacity: 1
        //         },
        //         1000); // Thời gian của hiệu ứng, ví dụ: 'slow', 'fast', hoặc một số mili giây (ví dụ: 1000)
        // }, 1000); // 30000 mili giây = 30 giây trễ


        // setTimeout(function() {
        //     // Sử dụng animate() để di chuyển và làm rõ dần
        //     jQuery('.post-summary').animate({
        //             // 1. Hiệu ứng Di chuyển: Chuyển từ top: 0% đã đặt trong CSS sang top: 50%
        //             left: '10%',
        //             // 2. Hiệu ứng Rõ dần: Chuyển từ opacity: 0 đã đặt trong CSS sang opacity: 1 (rõ hoàn toàn)
        //             opacity: 1
        //         },
        //         1000); // Thời gian của hiệu ứng, ví dụ: 'slow', 'fast', hoặc một số mili giây (ví dụ: 1000)
        // }, 1200); // 30000 mili giây = 30 giây trễ

    });
</script>
<?php 
get_template_part('templates/template', 'footer');
get_footer(); ?>