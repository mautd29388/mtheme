<?php
/**
 * Template Name: Home Template
 */

get_header(); 
?>
<section id="portfolio" class="portfolio">

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post(); 
	
	$slider = get_post_meta( get_the_ID(), '__slider', true);
	
	if ( !is_array($slider) || count($slider) < 1 )
		return  false;
	
	?>

	<div class="slider-wrapper">	
		<div id="portfolio-slider" class="nivoSlider">
			<?php foreach ( $slider as $s ) { ?>
			<img alt="" src="<?php echo $s['image']; ?>" title="#nivoCaption-<?php echo $s['portfolio']; ?>">
			<?php } ?>
		</div>
		<?php foreach ( $slider as $s ) { ?>
		<div id="nivoCaption-<?php echo $s['portfolio']; ?>" class="nivo-html-caption">
			<h2 class="entry-title">
				<small><?php echo get_the_date( '', $s['portfolio'] ); ?></small>
				<a href="<?php echo get_permalink($s['portfolio']); ?>" data-single-id="#single-gallery"><?php echo get_the_title( $s['portfolio'] ); ?></a>
			</h2>
		</div>
		<?php } ?>
		            
		<a id="pullDown" class="pullDown" href="<?php echo get_permalink($slider[0]['portfolio']); ?>" data-single-id="#single-gallery" role="button">
			<i class="fa fa-angle-down"></i>
		</a>
	</div>
	<?php 
	// End the loop.
	endwhile;
	?>
</section>
<?php 
$social = ot_get_option('single_social', '');
if ( !empty($social) ) {
?>
<div id="entry-social">
	<div class="entry-social clearfix">
		<?php echo $social; ?>
	</div>
</div>
<?php } ?>
<section id="single-gallery" class="single-gallery pageFixed">
				
</section>
<?php get_footer(); ?>