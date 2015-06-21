<?php 

global $post;
$subtitle = get_post_meta($post->ID, '__subtitle', true);
$embed = get_post_meta($post->ID, '__embed', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( !is_front_page() ) { 
		the_title('<h2 class="sectionTitle">', '</h2>'); 
	} ?>
	
	<?php if ( has_post_thumbnail() ) { ?>
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
