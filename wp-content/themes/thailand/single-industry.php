<?php get_header();
get_template_part('templates/template', 'menu');
  $url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
?>
<div class="single-head">
    <img src="<?php echo $url[0] ?>"/>
    <div class="single-head-text">
        <h2><?php echo get_post_meta($post->ID, '_meta_box_industry_title', true) ?></h2>
        <h3><?php echo get_post_meta($post->ID, '_meta_box_industry_summary', true) ?></h3>
    </div>
</div>

<div class="single-area">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="h2-title"><?php //the_title()  ?></div>
            <div class="single-content"><?php the_content() ?></div>
    <?php endwhile;
    endif; ?>
</div>

<?php get_footer(); ?>