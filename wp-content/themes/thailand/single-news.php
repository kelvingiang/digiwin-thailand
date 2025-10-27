<?php get_header();
get_template_part('templates/template', 'menu');
  $url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
?>
<div class="single-area">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="single-title" style="color: #a51221;"><?php the_title()  ?></div>
            <div class="single-content" style="margin-top: 5rem;"><?php the_content() ?></div>
    <?php endwhile;
    endif; ?>
</div>
<?php get_template_part('templates/template', 'single-more'); ?>
<?php get_footer(); ?>