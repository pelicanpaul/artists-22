<?php get_header(); ?>

<div id="main">

    <div class="container">

    <?php while (have_posts()): the_post() ?>



    <div class="container-content-page">

        <h1><?php the_title() ?></h1>

        <?php the_content(); ?>

    </div>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif; ?>


    <?php endwhile; ?>

    </div>
</div>


<?php get_footer(); ?>

