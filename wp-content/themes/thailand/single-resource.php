<?php get_header();
get_template_part('templates/template', 'menu');
?>
<div class="single-area">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!-- <?php // if (has_post_thumbnail()) : 
                    ?>
                <img class="item-img" src="<?php // the_post_thumbnail_url() 
                                            ?>" srcset="<?php // the_post_thumbnail_url() 
                                                        ?>" />
            <?php  // endif 
            ?> -->
            <div class="single-title">
                <?php $terms = get_the_terms(get_the_ID(), 'resource_category');?></div>
            <div class="single-content" style="margin-top: <?php echo $terms[0]->slug == 'case-studies' ? '3rem' : '0' ?>;"> <?php the_content() ?></div>
    <?php endwhile;
    endif; ?>
</div>
<?php get_template_part('templates/template', 'single-more'); ?>
<?php get_footer(); ?>