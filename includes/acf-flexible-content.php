<?php

function display_bg_style($image, $color)
{

    $str = '';

    if ($color) {
        $str = ' style="background-color: ' . $color . '"';
    }

    if ($image) {
        $str = ' style="background-image: url(' . urldecode($image) . ');"';
    }

    return $str;
}

function display_intro_section($title, $subtitle, $content)
{
    $str = '';

    if (strlen($title) > 0):
        $str = '<div class="container-section-intro">';
        $str .= '<h2 data-aos="fade-right" data-aos-delay="550"
        data-aos-duration="700"
        data-aos-easing="ease-in-out">' . $title . '</h2>';
        if ($subtitle):
            $str .= '<p class="subtitle">' . $subtitle . '</p>';
        endif;
        if ($content):
            $str .= $content;
        endif;

        $str .= '</div>';
    endif;

    return $str;
}


if (have_rows('sections')):

    $scroll_spy = '';
    $first_item = true;

    // loop through the rows of data
    while (have_rows('sections')) : the_row();

        // section globals and settings
        $title = get_sub_field('title');
        $section_id = preg_replace("/[^A-Za-z0-9 ]/", '', $title);
        $section_id = strtolower($section_id);
        $section_id = preg_replace('/[[:space:]]+/', '-', $section_id);
        $color_scheme = get_sub_field('color_scheme');
        $background_color = get_sub_field('background_color');
        $background_image = get_sub_field('background_image');

        /* HEADER SECTION WITH BACKGROUND //////////////////////////*/
        if (get_row_layout() == 'header_section'):

            $subtitle = get_sub_field('subtitle');
            $short = '';
            $background_class = get_sub_field('background_class');
            $mobile_offset_x = get_sub_field('mobile_offset_x');
            $section_id_css = '#' . $section_id;
            $background_gradient = '';
            $presentation = get_sub_field('presentation');
            $style = '';

            $background_css = '';


            if ($subtitle == '') {
                $short = 'short';
            }


            switch($background_class) {
                case 'teal-vertical-gradient':
                    $background_gradient = 'linear-gradient(180deg, rgba(155, 205, 212, 1) 0%, rgba(124, 191, 200, 1) 100%)';
                    break;
                case 'orange-vertical-gradient':
                    $background_gradient = 'linear-gradient(180deg, rgba(236, 154, 107, 1) 0%, rgba(230, 121, 62, 1) 100%)';
                    break;
                default:

            }


            // build background css
            if ($background_image && $background_gradient) {
                // image and gradient
                $background_css = 'background: url(' . $background_image['url'] . '), ' . $background_gradient;

            } elseif ($background_image && $background_color) {
                // image and just color
                $background_css = 'background: url(' . $background_image['url'] . '), ' . $background_color;
            } elseif ($background_gradient) {
                // just gradient
                $background_css = 'background: ' . $background_gradient;
            }
            else {
                    // just color
                    $background_css = $background_color;
                }
            ?>

            <style>
                <?php echo $section_id_css ?> {
                    background: <?php echo $background_color; ?>;
                    <?php echo $background_css ?>;
                    background-position: center center;
                    background-size: contain;
                    background-repeat: no-repeat;
                }

                @media only screen and (max-width: 1450px) {
                <?php echo $section_id_css ?> {
                        background-size: cover;
                        background-position-x: <?php echo $mobile_offset_x;?>;
                    }
                }


            </style>

            <section id="<?php echo $section_id ?>"
                     class="header-section <?php echo $background_class ?> <?php echo $presentation ?> <?php echo $short ?>"
                     style="<?php echo $style ?>;" id="<?php echo $section_id ?>">

                <div class="container">

                    <div class="container-feature" data-aos="fade-down" data-aos-delay="550"
                         data-aos-duration="700"
                         data-aos-easing="ease-in-out">

                        <h1><?php the_sub_field('title'); ?></h1>

                        <?php if ($subtitle !== ''): ?>

                            <p class="subtitle"><?php echo $subtitle; ?></p>

                        <?php endif; ?>

                    </div>

                </div>

            </section>

        <?php

        /* BASIC SECTION WITH BACKGROUND //////////////////////////*/
        elseif (get_row_layout() == 'basic_section'):

            $layout = get_sub_field('layout');
            $subtitle = get_sub_field('subtitle');

            if ($first_item == true) {
                $first_item = false;
            }
            ?>

            <section id="<?php echo $section_id ?>"
                     class="basic-section <?php echo $layout ?> <?php echo $color_scheme ?>" <?php echo display_bg_style(urlencode($background_image), $background_color) ?>>

                <div class="container">

                    <?php if ($layout == 'full_width'): // full width ?>

                        <?php if (strlen($title) > 0): ?>
                            <div class="container-section-intro">
                                <h2><?php the_sub_field('title'); ?></h2>

                                <?php if (strlen($subtitle) > 0): ?>

                                    <p class="subtitle"><?php the_sub_field('subtitle', false); ?></p>

                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php the_sub_field('content', true); ?>


                    <?php elseif ($layout == 'centered_offset'):  // centered-offset ?>

                        <?php
                        $class = '';

                        if (!get_sub_field('subtitle')) {
                            $class = ' margin-bottom-20';
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-10 offset-md-1">

                                <?php if (strlen($title) > 0): ?>
                                    <div class="container-section-intro<?php echo $class ?>">
                                        <h2><?php the_sub_field('title'); ?></h2>

                                        <p class="lead"><?php the_sub_field('subtitle', false); ?></p>
                                    </div>
                                <?php endif; ?>

                                <div>

                                    <?php the_sub_field('content', true); ?>

                                </div>

                            </div>
                        </div>


                    <?php elseif ($layout == 'text_left'):  // text left ?>

                        <h2><?php the_sub_field('title'); ?></h2>

                        <div class="container-text-left">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="copy">

                                        <?php if (get_sub_field('subtitle')): ?>
                                            <p class="lead"><?php the_sub_field('subtitle', true); ?></p>
                                        <?php endif; ?>

                                        <p><?php the_sub_field('content', true); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    $hero_image = get_sub_field('hero_image');
                                    $size = 'full';
                                    $arr = array(
                                        'class' => "img-fluid",
                                    );
                                    ?>
                                    <div class="hero-img hidden-sm hidden-xs">
                                        <?php if ($hero_image != ''): ?>
                                            <?php echo wp_get_attachment_image($hero_image, $size, 0, $arr); ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php
                                    $hero_image_mobile = get_sub_field('hero_image_mobile');
                                    $size = 'full';
                                    $arr = array(
                                        'class' => "img-fluid",
                                    );
                                    ?>
                                    <div class="hero-img hidden-md hidden-lg">
                                        <?php if ($hero_image_mobile != ''): ?>
                                            <?php echo wp_get_attachment_image($hero_image_mobile, $size, 0, $arr); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div>


                    <?php elseif ($layout == 'text_right'): // text right ?>

                        <div class="container">
                            <div class="container-section-intro">

                                <h2><?php the_sub_field('title'); ?></h2>

                            </div>
                        </div>

                        <div class="container container-text-right">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-1 hidden-sm hidden-xs">
                                    <?php
                                    $hero_image = get_sub_field('hero_image');
                                    $size = 'medium';
                                    $arr = array(
                                        'class' => "img-responsive",
                                    );
                                    ?>
                                    <div class="hero-img">
                                        <?php if ($hero_image != ''): ?>
                                            <?php echo wp_get_attachment_image($hero_image, $size, 0, $arr); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="copy">

                                        <?php if (get_sub_field('subtitle')): ?>
                                            <p class="lead"><?php the_sub_field('subtitle', false); ?></p>
                                        <?php endif; ?>

                                        <p><?php the_sub_field('content', false); ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-12 hidden-md hidden-lg">
                                    <?php
                                    $hero_image_mobile = get_sub_field('hero_image_mobile');
                                    $size = 'medium';
                                    $arr = array(
                                        'class' => "img-responsive",
                                    );
                                    ?>
                                    <div class="hero-img">
                                        <?php if ($hero_image_mobile != ''): ?>
                                            <?php echo wp_get_attachment_image($hero_image_mobile, $size, 0, $arr); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="gc-gallery">


                            </div>

                        </div>


                    <?php endif; ?>

                </div>

            </section>

        <?php

        /* BASIC SECTION WITH BACKGROUND AND CAROUSEL //////////////////////////*/
        elseif (get_row_layout() == 'basic_section_with_carousel'):

            $carousel_style = get_sub_field('carousel_style');

            ?>

            <section
                    class="basic-section-with-carousel <?php echo $color_scheme ?>" <?php echo display_bg_style(urlencode($background_image), $background_color) ?>
                    id="<?php echo $section_id ?>">

                <?php if (strlen($title) > 0): ?>
                    <div class="container">
                        <div class="container-section-intro">
                            <h2><?php the_sub_field('title'); ?></h2>

                            <p><?php the_sub_field('content', true); ?></p>

                        </div>
                    </div>
                <?php endif; ?>

                <?php
                // basic carousel
                if ($carousel_style == 'carousel-basic'): ?>

                    <div class="container">
                        <div class="carousel-basic">

                            <?php
                            $counter = 0;
                            while (have_rows('carousel')): the_row();
                                $image = get_sub_field('image');
                                ?>
                                <div class="carousel-cell">

                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">

                                    <div class="container-text">
                                        <h3><?php the_sub_field('title'); ?></h3>

                                        <p><?php the_sub_field('content', true); ?></p>
                                    </div>
                                </div>
                                <?php
                                $counter++;
                            endwhile;
                            ?>

                        </div>
                    </div>

                <?php endif; ?>

                <?php
                // inset carousel
                if ($carousel_style == 'carousel-inset'): ?>

                    <div class="container">
                        <div class="carousel-inset" id="carousel-<?php echo $section_id ?>">


                            <?php
                            $counter = 0;
                            while (have_rows('carousel')): the_row();
                                ?>
                                <div class="carousel-item" data-title="<?php the_sub_field('title'); ?>">
                                    <div class="carousel-item-inner">
                                        <?php the_sub_field('content', false); ?>
                                    </div>
                                </div>
                                <?php
                                $counter++;
                            endwhile;
                            ?>

                        </div>
                    </div>

                <?php endif; ?>

                <div class="container">

                    <?php the_sub_field('cta', false); ?>

                </div>


            </section>

        <?php

        /* BASIC SECTION LEFT RIGHT //////////////////////////*/
        elseif (get_row_layout() == 'basic_section_left_right'):

            $subtitle = get_sub_field('subtitle');
            $content = get_sub_field('content');

            ?>

            <section
                    class="basic-section-left-right <?php echo $color_scheme ?>" <?php echo display_bg_style(urlencode($background_image), $background_color) ?>
                    id="<?php echo $section_id ?>">

                <div class="container">

                    <h2 data-aos="fade-right"><?php echo $title ?></h2>

                    <p class="lead"><?php echo $subtitle ?></p>

                    <div class="container-left-right">

                        <?php

                        while (have_rows('subsection')): the_row();

                            $subtitle = get_sub_field('subtitle');
                            $copy = get_sub_field('copy');
                            $image = get_sub_field('image');
                            $image_left_override = get_sub_field('image_left_override');
                            $style = '';

                            if ($image_left_override == '1') {
                                $style = ' row-reverse';
                            }

                            $size = 'full';
                            $arr = array(
                                'class' => "img-responsive",
                            );

                            ?>
                            <div class="left-right<?php echo $style ?>">

                                <div>

                                    <h3><?php echo $subtitle; ?></h3>

                                    <p><?php echo $copy; ?></p>
                                </div>

                                <div>

                                    <?php if ($image != ''): ?>
                                        <?php echo wp_get_attachment_image($image, $size, 0, $arr); ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php
                        endwhile;
                        ?>

                    </div>


                </div>

            </section>


        <?php

        /* FULL WIDTH BACKGROUND  //////////////////////////*/
        elseif (get_row_layout() == 'full_width_background'):

            $parallax = get_sub_field('parallax');
            $container_parallax_style = '';
            $container_style = '';
            $parallax_image = '';

            /*			if ( strlen( $background_color ) > 0 ) {
                            $shadow = 'shadow';
                        }*/

            if ($parallax) {
                $container_parallax_style = 'parallax-window';
                $parallax_image = ' data-image-src="' . $background_image . '" data-parallax="scroll"';

            } else {
                $container_style = display_bg_style($background_image, $background_color);
            }

            ?>

            <section
                    class="basic-section section-full-width-background <?php echo $color_scheme ?> <?php echo $container_parallax_style ?>" <?php echo $container_style ?>
                    id="<?php echo $section_id ?>" <?php echo $parallax_image; ?>>

                <div class="container container-full-width-background">
                    <div class="inner-full-width-background">

                        <?php the_sub_field('content'); ?>

                    </div>
                </div>


            </section>

        <?php

        /* QUOTE SECTION  //////////////////////////*/
        elseif (get_row_layout() == 'quote_section'):
            $presentation = get_sub_field('presentation');
            ?>


            <section
                    class="quotes-section <?php echo $color_scheme ?>" <?php echo display_bg_style(false, $background_color) ?>
                    id="<?php echo $section_id ?>">

                <div class="container">

                    <?php if (strlen($title) > 0): ?>
                        <div class="container-section-intro">
                            <h2><?php the_sub_field('title'); ?></h2>

                            <?php if (get_sub_field('subtitle')): ?>
                                <p class="subtitle"><?php the_sub_field('subtitle', false); ?></p>
                            <?php endif; ?>

                            <?php if (get_sub_field('content')): ?>
                                <?php the_sub_field('content'); ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>


                <div class="container">

                    <div class="container-quotes <?php echo $presentation ?>">

                        <?php
                        while (have_rows('quotes')): the_row();

                            ?>
                            <div class="quote-item">

                                <blockquote><?php the_sub_field('quote'); ?></blockquote>

                                <div class="container-quote-source">
                                    <div class="source"><?php the_sub_field('source'); ?></div>
                                    <div class="source-title"><?php the_sub_field('source_title'); ?></div>
                                </div>
                            </div>

                        <?php

                        endwhile;

                        ?>
                    </div>
                </div>


            </section>

        <?php

        /* TAB SECTION  //////////////////////////*/
        elseif (get_row_layout() == 'tabs_section'):

            $random_number = substr(str_shuffle(MD5(microtime())), 0, 5);
            $tab_id = $random_number;

            ?>


            <section
                    class="tab-section <?php echo $color_scheme; ?>" <?php echo display_bg_style(false, $background_color) ?>
                    id="<?php echo $section_id ?>">

                <div class="container">

                    <div class="container-section-intro">
                        <h2><?php the_sub_field('title'); ?></h2>

                        <div class="tab-intro"><?php the_sub_field('content', true); ?></div>

                    </div>


                </div>

                <div class="container">

                    <ul id="tab-<?php echo $tab_id ?>" class="nav nav-tabs" role="tablist">

                        <?php

                        $counter = 0;

                        $first_class = 'active';

                        while (have_rows('tabs')): the_row();

                            $title = get_sub_field('title');
                            $title_id = strtolower($title);
                            $title_id = str_replace(' ', '-', $title_id);
                            $title_id = preg_replace("/[^A-Za-z0-9 ]/", '', $title_id);
                            $title_id = $title_id . '-' . $tab_id;

                            $title_id = addslashes($title_id); // for spec chars and quotes

                            $tab_content = get_sub_field('tab_content');

                            ?>
                            <li class="nav-item" role="presentation">
                                <button id="<?php echo $title_id ?>-tab" class="nav-link <?php echo $first_class ?>"
                                        role="tab" type="button" data-bs-toggle="tab"
                                        data-bs-target="#<?php echo $title_id ?>"
                                        aria-controls="<?php echo $title_id ?>"
                                        aria-selected="true"><?php echo $title; ?>
                                </button>
                            </li>
                            <?php
                            $counter++;

                            $first_class = '';

                        endwhile;

                        ?>

                    </ul>

                    <div id="tab-content-<?php echo $tab_id ?>" class="tab-content">

                        <?php

                        $counter = 0;

                        $first_class = 'show active';

                        while (have_rows('tabs')): the_row();

                            $title = get_sub_field('title');
                            $title_id = strtolower($title);
                            $title_id = str_replace(' ', '-', $title_id);
                            $title_id = preg_replace("/[^A-Za-z0-9 ]/", '', $title_id);
                            $title_id = $title_id . '-' . $tab_id;

                            $tab_content = get_sub_field('tab_content', true);

                            ?>
                            <div id="<?php echo $title_id; ?>" class="tab-pane fade <?php echo $first_class; ?>"
                                 role="tabpanel"
                                 aria-labelledby="<?php echo $title_id; ?>-tab"><?php echo $tab_content; ?></div>

                            <?php
                            $counter++;

                            $first_class = '';

                        endwhile;

                        ?>

                    </div>

                </div>

            </section>

        <?php

        /* ACCORDION SECTION  //////////////////////////*/
        elseif (get_row_layout() == 'accordion_section'):

            $random_number = substr(str_shuffle(MD5(microtime())), 0, 5);
            $accordion_id = $random_number;

            ?>


            <section
                    class="accordion-section <?php echo $color_scheme; ?>" <?php echo display_bg_style(false, $background_color) ?>
                    id="<?php echo $section_id ?>">

                <div class="container">

                    <div class="container-section-intro">
                        <h2><?php the_sub_field('title'); ?></h2>

                        <div class="tab-intro"><?php the_sub_field('content', true); ?></div>

                    </div>

                </div>

                <div class="container">

                    <div class="accordion" id="accordion<?php echo $accordion_id; ?>">


                        <div class="container-accordion row">

                            <?php
                            $i = 0;
                            $count = count(get_sub_field('items'));
                            $break_point = ceil($count / 3);
                            $start = true;


                            echo '<div>';

                            while (have_rows('items')): the_row();

                                $title = get_sub_field('title');
                                $accordion_content = get_sub_field('accordion_content');

                                if ($i % $break_point == 0) {
                                    echo '</div><div class="col-lg-4">';
                                }
                                ?>

                                <article class="accordion-item">
                                    <div class="title"><?php echo $title ?></div>
                                    <div class="accordion-content">
                                        <?php echo $accordion_content ?>
                                    </div>

                                </article>

                                <?php
                                $i++;
                            endwhile;
                            echo '</div>';
                            ?>


                        </div>

                    </div>

            </section>

        <?php


        endif;

    endwhile;

else :

    // no layouts found

endif;

?>