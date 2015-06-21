<?php

get_header(); 

global $wp_query;
?>
<section id="blog" class="blog">
	<?php if ( is_home() && ! is_front_page() ) : ?>
	<h1 class="entry-title">
		<?php single_post_title(); ?>
	</h1>
	<div class="entry-sub-title">
		<?php the_archive_description( '<p>', '</p>' ); ?>
	</div>
	<?php endif; ?>
	
	<div class="">
	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		// Include the page content template.
		get_template_part( 'contents/content', '' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	// End the loop.
	endwhile;
	
	// Previous/next page navigation.
	the_posts_pagination( array(
		'prev_text'          => __( 'Previous page', 'mTheme' ),
		'next_text'          => __( 'Next page', 'mTheme' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'mTheme' ) . ' </span>',
		) );
	?>
	</div>
</section>
<?php get_footer(); ?>
