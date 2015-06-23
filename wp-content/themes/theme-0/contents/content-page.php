<?php 

global $post;
$subtitle = get_post_meta($post->ID, '__subtitle', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1 class="entry-title">
		<?php the_title(); ?>
	</h1>
	<div class="border-red"></div>
	
	<?php if ( isset($subtitle) && strlen($subtitle) > 0 ) { ?>
	<div class="entry-sub-title">
		<p><?php echo $subtitle; ?></p>
	</div>
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
