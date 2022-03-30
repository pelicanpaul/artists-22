<?php get_header(); ?>

<div class="container-page container-first-row">
    <div id="main">
        <div class="container-content-simple">

            <div class="container-breadcrumbs">

                <div class="container">
                    <?php get_breadcrumb(); ?>
                </div>

            </div>


            <div class="container" id="container-blog-single">

                <?php while (have_posts()): the_post() ?>

                    <?php $post_categories = get_the_category_list(', ', get_the_ID()); ?>

                    <div class="row">
                        <div class="col-xl-9">
                            <h1><?php the_title() ?></h1>
                            <ul class="blog-item-info">
                                <li><span class="blog-date"> <?php the_time('F j, Y'); ?>, </span></li>
                                <!-- <li><span class="blog-author"> By <?php /*the_author(); */ ?></span></li>-->
                                <li class="clear-left"><span
                                            class="blog-categories"> <?php echo $post_categories; ?></span></li>
                            </ul>

                            <!--                         <ul class="social">
                                                         <li class="facebook"><a href="http://www.facebook.com/" target="_blank">Facebook</a></li>
                                                         <li class="twitter"><a href="https://twitter.com/" target="_blank">Twitter</a></li>
                                                         <li class="linkedin"><a href="http://www.linkedin.com/" target="_blank">LinkedIn</a></li>
                                                     </ul>-->

                            <div class="blog-content">

                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } ?>

                                <?php the_content(); ?>
                            </div>
                            <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif;
                            ?>

                        </div>

                        <div class="col-xl-3">

                            <?php if (is_active_sidebar('primary_sidebar')) : ?>
                                <?php dynamic_sidebar('primary_sidebar'); ?>
                            <?php endif; ?>

                        </div>
                    </div>


                <?php endwhile; ?>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

