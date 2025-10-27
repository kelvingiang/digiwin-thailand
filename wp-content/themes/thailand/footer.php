</main>

</div>

</div>
<?php wp_footer(); ?>

<div id="back-top-wrapper">
    <a id="back-top">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>

<script type="text/javascript">
    //==========================================================================

    // TAO HIEU UNG KHI CUON NOI DUNG TRAN WEB
    function myCheck1(element) {
        // LAY VI TRI TOP VA BOTTOM CUA ELEMENT
        var rect = element.getClientRects()[0];
        // XAC DINH DO CAO CUA MAN HINH
        var heightScreen = window.innerHeight;

        if (!(rect.bottom < 0 || rect.top > heightScreen)) {
            element.classList.add("animation-show");
        }
    }


    function Animation_show() {
        // LAY TAT CA CAC DOI TUONG CO CLASS LA .show-on-scroll
        // 每次重新抓最新的 .animation-item
        var MyanimationElements = document.querySelectorAll(".animation-item");
        MyanimationElements.forEach((el) => {
            myCheck1(el);
        });
        // CHAY VONG LAP DE THEM CLASS
        MyanimationElements.forEach((el) => {
            myCheck1(el);
        });
    }
    var prevScrollPos = window.pageYOffset;

    window.onscroll = function() {
        // PHAN AN HIEN MENU 
        menuAnimation();

        // KIEM TRA HEADER KHAC NONE MOI THUC HIEN
        if (document.querySelector('.animation-item')) {
            Animation_show();
        }

        // PHAN AN HIEN HEADER TRONG MOBILE STYLE
        var currentScrollPos = window.pageYOffset;
        prevScrollPos = currentScrollPos;
    }

    // 禁止右鍵選單，這樣用戶無法透過右鍵選取「複製」功能
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    //禁止快捷鍵，如 Ctrl+C 來複製內容。
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && (e.key === 'c' || e.key === 'a' || e.key === 'x')) {
            e.preventDefault();
        }
    });

    //禁止用戶拖拽文本或圖片來進行複製。
    document.addEventListener('dragstart', function(e) {
        e.preventDefault();
    });

    //禁止 F12（開發者工具），避免部分用戶檢視網站代碼。
    //   document.addEventListener('keydown', function(e) {
    //     if (e.key === 'F12') {
    //       e.preventDefault();
    //     }
    //   });

    jQuery(function() {
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > 100) {
                jQuery("#back-top").fadeIn("fast");
            } else {
                jQuery("#back-top").fadeOut(1500);
            }
        });
        // scroll body to 0px on click
        jQuery("#back-top").click(function() {
            jQuery("body,html").stop(false, false).animate({
                    scrollTop: 0,
                },
                1000
            );
            return false;
        });
    });
</script>
</body>

</html>