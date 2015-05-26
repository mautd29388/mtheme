<?php 

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
	
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'mTheme' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'mTheme' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div>

</article>
<!-- #post-## -->
