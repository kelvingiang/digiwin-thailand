<?php
get_header();
get_template_part('templates/template', 'menu');
get_template_part('templates/template', 'slider');
?>
<!--- ABOUT US ------------------------------------------ ------------>
<div id="home-about-us">
    <div class="clip">
        <iframe
            src="https://www.youtube.com/embed/8o0N5EDtSrs"
            title="We Are Digiwin Software"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    <div class="about-us">
        <?php echo get_post_meta('1', '_about_us', true) ?>
    </div>
</div>

<!--- INDUSTRIES        ----------------------------------- ------------>
<div id="home-industries">
    <div class="item-title">Industries</div>
    <div class="item animation-item">
        <a href="<?php echo home_url('/industry/metal/'); ?>">
            <div class="img-style">
                <img src="<?php echo PART_IMAGES . 'home/meta.png' ?>" />
                <div class="text-style">Meta</div>
            </div>
        </a>
    </div>
    <div class="item animation-item">
        <a href="<?php echo home_url('/industry/plastic/'); ?>">
            <div class="img-style">
                <img src="<?php echo PART_IMAGES . 'home/plastic.png' ?>" />
                <div class="text-style">Plastic</div>
            </div>
        </a>
    </div>
    <div class="item animation-item">
        <a href="<?php echo home_url('/industry/furniture/'); ?>">
            <div class="img-style">
                <img src="<?php echo PART_IMAGES . 'home/furniture.png' ?>" />
                <div class="text-style">Furniture</div>
            </div>
        </a>
    </div>
    <div class="item animation-item">
        <a href="<?php echo home_url('/industry/automotive-parts/'); ?>">
            <div class="img-style">
                <img src="<?php echo PART_IMAGES . 'home/automotive.png' ?>" />
                <div class="text-style">Automotive</div>
            </div>
        </a>
    </div>
</div>

<!-- PRODUCTS ------------------------------------------------------------>
<div id="home-products">
    <div class="item-title">Products</div>
    <div class="item animation-item">
        <img src="<?php echo PART_IMAGES . 'home/erp.png' ?>" />
        <div class="pro-title">ERP</div>
        <div class="pro-name">
            <a href="<?php echo home_url('/workflowerp-igp/'); ?>">
                Enterprise Resource Planning
            </a>
        </div>
    </div>
    <div class="item animation-item">
        <img src="<?php echo PART_IMAGES . 'home/mes.png' ?>" />
        <div class="pro-title">MES</div>
        <div class="pro-name">
            <a href="<?php echo home_url('/smes/'); ?>">
                Manufacturing Executive System
            </a>
        </div>
    </div>
    <div class="item animation-item">
        <img src="<?php echo PART_IMAGES . 'home/wms.png' ?>" />
        <div class="pro-title">WMS</div>
        <div class="pro-name">
            <a href="<?php echo home_url('/sfls/'); ?>">
                Warehouse Management System
            </a>
        </div>
    </div>
</div>

<div id="home-news">
    <?php get_template_part('templates/template', 'home-news'); ?>
</div>

<?php get_template_part('templates/template', 'footer');
get_footer();
