<div class="row-page-title">網站設定</div>
<form name="f-info" id="f-info" method="post">

    <div class="row-two-column">
        <div class="col">
            <div class="cell-title">公司名稱</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-company-name"
                    name="txt-company-name"
                    class="my-input"
                    value="<?php echo get_option('company_name') ?>" />
            </div>
        </div>
        <div class="col">
            <div class="cell-title">公司地址</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-company-address"
                    name="txt-company-address"
                    class="my-input"
                    value="<?php echo get_option('company_address') ?>" />
            </div>
        </div>
    </div>
    <hr>
    <div class="row-title-group">中文聯絡</div>
    <div class="row-four-column">
        <div class="col">
            <div class="cell-title">姓名</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-chinese-name"
                    name="txt-chinese-name"
                    class="my-input"
                    value="<?php echo get_option('chinese_name') ?>" />
            </div>
        </div>

        <div class="col">
            <div class="cell-title">E-mail</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-chinese-email"
                    name="txt-chinese-email"
                    class="my-input"
                    value="<?php echo get_option('chinese_email') ?>" />
            </div>
        </div>
        <div class="col">
            <div class="cell-title">電話</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-chinese-phone"
                    name="txt-chinese-phone"
                    class="my-input"
                    value="<?php echo get_option('chinese_phone') ?>" />
            </div>
        </div>

        <div class="col">
            <div class="cell-title">WeChat</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-chinese-we-chat"
                    name="txt-chinese-we-chat"
                    class="my-input"
                    value="<?php echo get_option('chinese_we_chat') ?>" />
            </div>
        </div>
    </div>
    <hr>
    <div class="row-title-group">泰文聯絡</div>
    <div class="row-four-column">
        <div class="col">
            <div class="cell-title">姓名</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-thailand-name"
                    name="txt-thailand-name"
                    class="my-input"
                    value="<?php echo get_option('thailand_name') ?>" />
            </div>
        </div>

        <div class="col">
            <div class="cell-title">E-mail</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-thailand-email"
                    name="txt-thailand-email"
                    class="my-input"
                    value="<?php echo get_option('thailand_email') ?>" />
            </div>
        </div>
        <div class="col">
            <div class="cell-title">電話</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-thailand-phone"
                    name="txt-thailand-phone"
                    class="my-input"
                    value="<?php echo get_option('thailand_phone') ?>" />
            </div>
        </div>

        <div class="col">
            <div class="cell-title">辦公時間</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-office-hours"
                    name="txt-office-hours"
                    class="my-input"
                    value="<?php echo get_option('office_hours') ?>" />
            </div>
        </div>
    </div>

    <div class="row-one-column">
        <div class="col">
            <div class="cell-title">公司簡介</div>
            <div class="cell-text">
                <?php wp_editor(
                    get_post_meta('1', '_about_us', true),
                    'txt-about-us',
                    array('wpautop' => TRUE, 'editor_height' => '300px')
                ); ?>
            </div>
        </div>
    </div>

    <hr>

    <div class="row-two-column">
        <div class="col">
            <div class="cell-title">首次加載</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-first-load"
                    name="txt-first-load"
                    class="my-input type-number"
                    value="<?php echo get_option('first_load') ?>" />
            </div>
        </div>

        <div class="col">
            <div class="cell-title">更多加載</div>
            <div class="cell-text">
                <input type="text"
                    id="txt-more-load"
                    name="txt-more-load"
                    class="my-input type-number"
                    value="<?php echo get_option('more_load') ?>" />
            </div>
        </div>
    </div>



    <div class="row-btn">
        <input type="submit" name="btn-submit" id="btn-submit" class="button button-primary button-large" value="<?php echo _e('Submit') ?>" />
    </div>
</form>