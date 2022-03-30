<?php
/**
 * The template for displaying search results pages.
 *
 */

get_header(); ?>

    <div class="container-page">
        <div id="main">

            <?php

            $search_query = get_search_query();

            ?>

            <?php if (have_posts()) : ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <?php
                            global $wp_query;
                            $total_results = $wp_query->found_posts;

                            if ($search_query == '') {
                                echo '<h1 class="search" style="margin-bottom: 40px;">Search</h1>';
                                $total_results = 0;
                            } else {
                                echo '<h1 class="search">Search Results for: <span class="orange">' . $search_query . '</span></h1>';
                                echo 'Number of Results: <span class="orange">' . $total_results . '</span><br/><br/>';
                            }
                            ?>


                        </div>
                    </div>
                </div>

                <div class="container">

                    <form class="search-main" action="/" method="get" role="search" id="searchform">
                        <div class="row">
                            <div class="col-md-6 col-xs-9">

                                <input type="text" name="s" id="s" class="form-control form-search-input"/>


                            </div>

                            <div class="col-md-2 col-xs-3">

                                <input name="submit" type="submit" id="submit" class="submit btn btn-primary"
                                       value="Search">

                            </div>
                        </div>
                    </form>
                </div>

                <?php if ($total_results > 0): ?>

                    <div class="container">
                        <ul class="list-search">
                            <?php
                            // Start the loop.
                            while (have_posts()) : the_post();
                                ?>

                                <li>


                                    <div class="row">

                                        <div class="col-xl-9">
                                            <a href="<?php echo get_permalink(get_the_ID()); ?>"
                                               class="blog-title"><?php the_title(); ?></a><br/>


                                            <div class="container-excerpt">
                                                <p><?php echo get_excerpt(140) ?></p>
                                            </div>
                                        </div>
                                    </div>


                                </li>


                                <?php
                                esc_url(get_permalink());

                                // End the loop.
                            endwhile; ?>
                        </ul>

                        <?php gc_pagination(); ?>


                    </div>
                <?php endif; ?>

            <?php else: ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <?php
                            global $wp_query;
                            $total_results = $wp_query->found_posts;

                            echo '<h1 class="search">Search Results for: <span class="orange">' . $search_query . '</span></h1>';
                            echo 'Number of Results: <span class="orange">' . $total_results . '</span><br/><br/>';
                            ?>


                        </div>
                    </div>
                </div>

                <div class="container">

                    <form class="search-main" action="/" method="get" role="search" id="searchform">
                        <div class="row">
                            <div class="col-md-6 col-xs-9">

                                <input type="text" name="s" id="s" class="form-control form-search-input"/>


                            </div>

                            <div class="col-md-2 col-xs-3">

                                <input name="submit" type="submit" id="submit" class="submit btn btn-primary"
                                       value="Search">

                            </div>
                        </div>
                    </form>
                </div>
            <?php

            endif;
            ?>

        </div>
    </div>

<?php get_footer(); ?>