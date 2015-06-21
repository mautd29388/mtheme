<?php
/**
 * Template Name: Frontpage
 */

get_header(); 
?>

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post(); ?>
	
	<div class="container pull-up-60 upper-content">
	<?php the_content(); 
	//$maps = new mTheme_Map;
	//echo $maps->render_store_locator();
	?>
	</div>
	<?php 
	// End the loop.
	endwhile;
	?>
<?php get_footer(); ?>