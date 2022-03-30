<?php
/**
 * Template Name: Flexible Content
 * Description: The Flexible Content allows for pages that have various movable sections
 */

?>


<?php get_header(); ?>

<div class="container-page">
	<div id="main">

		<?php while(have_posts()): the_post() ?>

            <?php include( dirname( __FILE__ ) . '/../includes/acf-flexible-content.php' ); ?>

		<?php endwhile; ?>


	</div>
</div>

<?php get_footer(); ?>

