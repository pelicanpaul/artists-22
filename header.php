<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php include 'includes/icons.php';  ?>

    <title><?php wp_title(); ?></title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css"
          integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css"
          integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>

	<?php

    if (class_exists('ACF')) {

        $css = get_field('css', get_the_ID());

        if ($css): ?>

            <style>

                <?php echo $css ?>

            </style>

        <?php endif;
    }

?>

</head>

<body <?php body_class(); ?>>

<div class="page-wrapper">


    <header>
        <div class="container container-menus" id="main-menu">
            <nav class="navbar navbar-expand-xl navbar-light" role="navigation">

                <a class="navbar-brand" href="<?php echo home_url(); ?>">
                    <?php get_header_image(); ?>
                    <?php if (get_header_image() != ''): ?>
                        <img src="<?php header_image(); ?>" class="img-responsive logo"
                             alt="<?php bloginfo('name'); ?>"/>
                    <?php else: ?>
                        <h1><?php bloginfo('name'); ?></h1>
                    <?php endif; ?>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-navbar-collapse-1" aria-controls="bs-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
                        <span class="navbar-toggler-icon">
                            <span class="menu-icon-line-1 menu-icon-line"></span>
                            <span class="menu-icon-line-2 menu-icon-line"></span>
                            <span class="menu-icon-line-3 menu-icon-line"></span>
                        </span>
                </button>

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'depth' => 3,
                    'container' => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'bs-navbar-collapse-1',
                    'menu_class' => 'nav navbar-nav',
                    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                    'walker' => new WP_Bootstrap_Navwalker(),
                ));
                ?>
            </nav>
        </div>
    </header>



