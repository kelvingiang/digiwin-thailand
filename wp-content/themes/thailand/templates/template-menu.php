<div id="menu-computer-area">
    <div id="header-area">
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo PART_IMAGES . 'logo.png' ?>" />
            </a>
        </div>
        <div class="menu-computer">
            <!-- <div class="menu-first"></div> -->
            <?php suite_menu('computer-menu') ?>
            <!-- <div class="menu-last"></div> -->
        </div>
        <div></div>
    </div>

    <div id="header-area-scroll">
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo PART_IMAGES . 'logo.png' ?>" />
            </a>
        </div>
        <div class="menu-computer">
            <?php suite_menu('computer-menu') ?>
        </div>
        <div></div>
    </div>
</div>

<div id="menu-mobile-area">
    <div class="logo">
        <a href="<?php echo home_url(); ?>">
            <img src="<?php echo PART_IMAGES . 'logo.png' ?>" />
        </a>
    </div>
    <div class="menu-mobile">
        <i id="menu-icon" class="fas fa-bars"></i>
        <?php suite_menu('mobile-menu') ?>
    </div>
</div>

<script>
    const animationElements = document.querySelector("#header-area");
    // TAO HIEU UNG KHI CUON NOI DUNG TRAN WEB
    function showMenu(element) {
        if (window.innerWidth <= 767.98) {
            return; // 直接結束函式
        }
        // LAY VI TRI TOP VA BOTTOM CUA ELEMENT
        var rect = element.getClientRects()[0];
        // XAC DINH DO CAO CUA MAN HINH
        var heightScreen = window.innerHeight;

        if (rect.bottom < 0) {
            document.querySelector('#header-area-scroll').classList.add("start");
            document.querySelector('#header-area-scroll').classList.remove("close");
        } else {
            // kiểm tra class có tồn tại hay không bắng javascript =======
            if (document.querySelector('#header-area-scroll').classList.contains("start")) {
                document.querySelector('#header-area-scroll').classList.add("close");
            }
            document.querySelector('#header-area-scroll').classList.remove("start");

        }
    }

    function menuAnimation() {
        showMenu(animationElements);
    }

    // mobile menu =======================================================
    jQuery(document).ready(function() {

        jQuery(document).on('click', '#menu-icon', function() {
            const menu = jQuery('.primary-menu');
            if (menu.hasClass('start-menu-mobile')) {
                menu.addClass('end-menu-mobile').removeClass('start-menu-mobile');
            } else {
                menu.addClass('start-menu-mobile').removeClass('end-menu-mobile');
            }
        });

        jQuery('.menu-item-has-children').on('click', function() {
            let dd = jQuery(this).children('.sub-menu').css('display');
            if (dd == 'none') {
                jQuery('.sub-menu').slideUp('slow');
                jQuery(this).children('.sub-menu').slideDown('slow');
            }
        });
    });
</script>