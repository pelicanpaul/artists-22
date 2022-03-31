<?php get_header(); ?>


<div class="container-page container-first-row">
	<div id="main">
		<div class="container-content-simple">
			<div class="container">

				<div class="row">
					<div class="col-md-8">

						<h1><?php the_title() ?></h1>

					</div>
					<div class="col-md-4">
						<?php if ( is_active_sidebar( 'primary_sidebar' ) ) : ?>
							<?php dynamic_sidebar( 'primary_sidebar' ); ?>
						<?php endif; ?>
					</div>
				</div>

				<hr />

				<section id="blog-items">

					<div class="row">
						<div class="col-md-12">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
							$post_categories = get_the_category_list( ', ', get_the_ID() );
							$the_title  = get_the_title();
							$the_title = strlen($the_title) > 80 ? substr($the_title,0,80)."..." : $the_title;
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

						<?php gc_pagination(); ?>

						</div>
					</div>
				</section>

			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>

