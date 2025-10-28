<?php get_header();
get_template_part('templates/template', 'menu');
?>

<div id="page-404">
    <img src="<?php echo PART_IMAGES . '404.png' ?>" />
</div>


<?php
get_template_part('templates/template', 'footer');
get_footer();
