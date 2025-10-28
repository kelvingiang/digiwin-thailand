<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php blankslate_schema_type(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link type="image/x-icon" href="/favicon.ico" rel="icon"> <!-- icon show on web title -->
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />
    <link href="<?php echo get_template_directory_uri(); ?>/images/icon/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/images/icon/touch.png" rel="apple-touch-icon-precomposed">
    <?php wp_head(); ?>

    <script id="_bownow_ts">
        var _bownow_ts = document.createElement('script');
        _bownow_ts.charset = 'utf-8';
        _bownow_ts.src = 'https://contents.bownow.jp/js/UTC_373f6c2fd8a84cc0e8f9/trace.js';
        document.getElementsByTagName('head')[0].appendChild(_bownow_ts);
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-K84V5MS');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K84V5MS"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="wrapper" class="hfeed">
        <header id="header" role="banner">
        </header>
        <div id="container">
            <main id="content" role="main">