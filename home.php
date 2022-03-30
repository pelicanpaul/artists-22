<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *

 */
?>

<?php get_header(); ?>


<div class="container-page container-first-row">
    <div id="main">

        <div class="container-header-blog">
            <div class="container-header">
                <div class="container">
                    <h1>Official Blog</h1>
                    <h3>Browsing: <?php single_cat_title(); ?></h3></div>

            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-xl-9">

                    <section id="blog-items">

                        <?php if (have_posts()) : while (have_posts()) : the_post();
                            $post_categories = get_the_category_list(', ', get_the_ID());
                            $the_title = get_the_title();
                            $the_title = strlen($the_title) > 80 ? substr($the_title, 0, 80) . "..." : $the_title;

                            $thumb = get_the_post_thumbnail_url();

                            if (strlen($thumb) == 0) {
                                $random_img = array();
                                $random_img[] = "/wp-content/uploads/2022/02/blog_6.jpg";
                                $random_img[] = "/wp-content/uploads/2022/02/blog_2.jpg";

                                $thumb = $random_img[rand(0, count($random_img) - 1)];
                            }

                            ?>

                            <article class="blog-item"
                                     style="background-image: url(<?php echo $thumb ?> ); background-size: cover; background-position: top center; background-repeat: no-repeat;">

                                <div class="container-blog-item">

                                    <div class="item-inner">
                                        <a href="<?php echo get_permalink(get_the_ID()); ?>"
                                           class="blog-title"><?php echo $the_title; ?></a><br/>

                                        <ul class="blog-item-info blog-item-info-archive">
                                            <li><span class="blog-date">  <?php the_time('F j, Y'); ?></span></li>
                                            <!-- <li><span class="blog-author">  <?php /*the_author(); */ ?></span></li>-->
                                            <li><span class="blog-categories">  <?php echo $post_categories; ?></span>
                                            </li>
                                        </ul>

                                        <div class="container-excerpt"> <?php the_excerpt(); ?></div>



                                    </div>


                                </div>


                            </article>


                        <?php endwhile;
                        else: ?>

                            <p>Sorry, no posts to list</p>

                        <?php endif; ?>


                    </section>

                    <?php gc_pagination(); ?>
                </div>

                <div class="col-xl-3">
                    <?php if (is_active_sidebar('primary_sidebar')) : ?>
                        <?php dynamic_sidebar('primary_sidebar'); ?>
                    <?php endif; ?>
                </div>
            </div>

            <hr/>


        </div>
    </div>
</div>

<?php get_footer(); ?>


