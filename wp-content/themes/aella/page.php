<?php

get_header(); 
?>
<section class="section-page">

	<?php while ( have_posts() ) : the_post(); ?>
		<div class="container">
		<?php get_template_part( 'contents/content', 'page' ); ?>		
		</div>
	<?php endwhile; ?>
	
</section>
<?php get_footer(); ?>
