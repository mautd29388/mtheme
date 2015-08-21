<?php
/**
 * Template Name: Home Page
 */

get_header(); 
?>
<section class="section-home">
	<?php
	
	// Start the loop.
	while ( have_posts() ) : the_post(); 
	
		the_content(); 
		//$maps = new mTheme_Map;
		//echo $maps->render_store_locator();
		
	// End the loop.
	endwhile;
	?>
</section>
<?php get_footer(); ?>