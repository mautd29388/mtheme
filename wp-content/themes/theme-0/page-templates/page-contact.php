<?php
/**
 * Template Name: Contact Template
 */

get_header();
?>
<section class="page-contact">

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();


		global $post;
		$subtitle = get_post_meta($post->ID, '__subtitle', true);
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<h1 class="entry-title">
				<?php if ( intval($post->post_parent) > 0 ) { ?>
					<small><?php echo get_the_title($post->post_parent); ?></small> 
				<?php } ?>
				<?php the_title(); ?>
			</h1>
			
			<?php if ( isset($subtitle) && strlen($subtitle) > 0 ) { ?>
			<div class="entry-sub-title">
				<p><?php echo $subtitle; ?></p>
			</div>
			<?php } ?>
			<div id="map_canvas"></div>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		
		</article>
		<!-- #post-## -->

		<?php 
	// End the loop.
	endwhile;
	?>
</section>
<?php get_footer(); ?>

