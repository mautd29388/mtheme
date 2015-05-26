<?php 

global $post;
$embed = get_post_meta($post->ID, '__embed', true);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( isset($embed) && strlen($embed) > 0 ) { ?>
	<div class="entry-embed entry-video">
		<?php echo $embed; ?>
	</div>
	
	<?php } elseif ( has_post_thumbnail() ) { ?>
	<figure class="entry-thumbnail">
		<?php the_post_thumbnail('fullsize'); ?>
	</figure>
	<?php } ?>
	
	<h1 class="entry-title">
		<?php the_title(); ?>
		<?php the_date('', '<small>', '</small>'); ?>
	</h1>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php the_tags('<div class="tags"><i class="fa">&#xf02c;</i>', ', ', '</div>'); ?>
	</div>

	<?php 
	$social = ot_get_option('single_social', '');
	if ( !empty($social) ) {
	?>
	<div class="entry-social clearfix">
		<?php echo $social; ?>
	</div>
	<?php } ?>
</article>
<!-- #post-## -->
