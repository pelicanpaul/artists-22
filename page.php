<?php get_header(); ?>

<div id="main">

    <div class="container">

    <?php while (have_posts()): the_post() ?>

        <h1><?php the_title() ?></h1>
        <?php
        // check if the post has a Post Thumbnail assigned to it.
        if (has_post_thumbnail()) {
            the_post_thumbnail('full');
        }
        ?>

    <div class="container-content-page">

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

