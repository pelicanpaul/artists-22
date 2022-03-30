<?php
/**
 * Template Name: Home
 * Description: Home with The Flexible Content allows for pages that have various movable sections
 */

?>


<?php get_header(); ?>

<div class="container-page">
    <div id="main">

        <?php while (have_posts()):
            the_post() ?>

            <?php

            // Violator
            $violator = get_field('violator');
            $content = $violator['content'];
            $background_color = $violator['background_color'];

            if (strlen($content) > 0):

                ?>


                <section class="violator" aria-label="Announcement Section"
                         style="background-color: <?php echo $background_color ?>">
                    <div class="container">
                        <?php echo $content ?>
                        <a href="#" class="close-violator">X</a>
                    </div>
                </section>


            <?php endif; ?>

            <?php

            // Hero Section

            $hero = get_field('hero');

            if ($hero):
                $title = $hero['title'];
                $subtitle = $hero['subtitle'];
                $cta_text = $hero['cta_text'];
                $url = $hero['url'];
                $hero_images = $hero['hero_images']; // repeater array
                $call_out_boxes = $hero['call_out_boxes']; // repeater array

            //
                $rand_img = rand(1,count($hero_images ));
                $images_style = $hero['images_style'];
                $hero = $hero_images[$rand_img - 1]['image']['url'];
                ?>

            <?php if($images_style == 'random') : ?>

                <style>

                   section.section-home-hero {
                        background: url(<?php echo $hero; ?>) top center no-repeat #000;
                       background-size: contain;
                    }

                </style>

           <?php endif; ?>


                <section class="section-home-hero" id="section-home-hero" aria-label="Hero Section">

                    <?php if($images_style == 'slideshow') : ?>

                        <div class="container-slideshow">
                            <div class="container-hero-images">
                                <?php

                                foreach ( $hero_images as $item ) {
                                    $image = $item['image'];
                                    ?>
                                    <div class="inner-hero-images"
                                         style="background-image: url(<?php echo $image['url'] ?>)"></div>
                                    <?php
                                }

                                ?>

                            </div>
                        </div>

                    <?php endif; ?>

                    <div class="container-copy">

                        <div class="container">

                            <div class="copy-inner"><?php the_content() ?></div>

                        </div>

                    </div>




                </section>


            <?php endif; ?>

        <?php include(dirname(__FILE__) . '/../includes/acf-flexible-content.php'); ?>



        <?php endwhile; ?>


    </div>
</div>

<?php get_footer(); ?>

