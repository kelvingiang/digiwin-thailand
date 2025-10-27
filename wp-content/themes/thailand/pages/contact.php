<?php /*  Template Name: Contact Page */
get_header();
get_template_part('templates/template', 'menu');
get_template_part('templates/template', 'slider');
?>
<div class="h2-title">
    <h2>Contact</h2>
</div>
<div class="contact-area">
    <div class="item local">
        <h3>Address</h3>
        <div>
            <p><?php echo get_option('company_address') ?></p>
        </div>
    </div>
    <div class="item email">
        <h3>E-mail</h3>
        <div>
            <p> For Chinese (中文)</p>
            <p> <?php echo get_option('chinese_email') ?></p>
        </div>
        <div>
            <p> For Thai (泰文)</p>
            <p> <?php echo get_option('thailand_email') ?></p>
        </div>

    </div>
    <div class="item phone">
        <h3>Call</h3>
        <div>
            <p> For Chinese (中文)</p>
            <p> <?php echo get_option('chinese_phone') ?></p>
        </div>
        <div>
            <p> For Thai (泰文)</p>
            <p> <?php echo get_option('thailand_phone') ?></p>
        </div>
    </div>
</div>
<?php
get_template_part('templates/template', 'form');
get_template_part('templates/template', 'footer');
get_footer(); ?>