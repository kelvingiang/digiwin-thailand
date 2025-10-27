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
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="wrapper" class="hfeed">
        <header id="header" role="banner">
        </header>
        <div id="container">
            <main id="content" role="main">