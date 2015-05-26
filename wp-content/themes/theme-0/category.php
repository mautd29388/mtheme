<?php

get_header(); 

global $wp_query;
?>
<section id="blog" class="blog blog-post">

	<h1 class="entry-title">
		<?php single_cat_title(); ?>
	</h1>
	<div class="entry-sub-title">
		<?php the_archive_description( '<p>', '</p>' ); ?>
	</div>
	<div id="isotopeBlog" class="isotopeContainer isotopeBlog">
	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		// Include the page content template.
		get_post_format();
		get_template_part( 'contents/content', '' );

	// End the loop.
	endwhile;
	?>
	</div>
	<a id="loadmore" href="<?php next_posts($wp_query->max_num_pages); ?>"></a>
	<div class="loading">
		<i class="fa fa-spin fa-refresh"></i>
	</div>
</section>
<?php get_footer(); ?>
