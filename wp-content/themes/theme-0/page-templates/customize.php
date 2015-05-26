<?php
/**
 * Template Name: Customize Template
 */

get_header();
?>
<section class="section-page">

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();


		global $post;
		$subtitle = get_post_meta($post->ID, '__subtitle', true);
		$embed = get_post_meta($post->ID, '__embed', true);
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
			
			<?php if ( isset($embed) && strlen($embed) > 0 ) { ?>
			<div class="entry-embed entry-video">
				<?php echo $embed; ?>
			</div>
			
			<?php } elseif ( has_post_thumbnail() ) { ?>
			<figure class="entry-thumbnail">
				<?php the_post_thumbnail('fullsize'); ?>
			</figure>
			<?php } ?>
			
			<div class="entry-content-custom">
				<?php the_content(); ?>
			</div>
		
		</article>
		<!-- #post-## -->

		<?php 
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	// End the loop.
	endwhile;
	?>
</section>
<?php get_footer(); ?>

