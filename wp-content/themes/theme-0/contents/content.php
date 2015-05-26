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
		<a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_post_thumbnail('fullsize'); ?></a>
	</figure>
	<?php } ?>
	
	<h2 class="entry-title">
		<a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_title(); ?></a>
		<small><?php echo get_the_date(); ?></small>
	</h2>
	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>

</article>
<!-- #post-## -->
