<?php

get_header(); 
?>
<section id="single-gallery" class="single-gallery pageFixed in">
	<div class="pageFixed-inner">
		<div class="pullUp">
			<a id="pullUp" href="#">
				<i class="fa fa-angle-up"></i> 
			</a>
		</div>
		
		<div data-ride="carousel" class="carousel slide carousel-gallery" id="carousel-single-gallery" data-interval="false">
			<div role="listbox" class="carousel-inner">
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php 
					$previous = get_previous_post();
					$next = get_next_post();
					?>
				
					<?php if ( $next ) { ?>
					<div class="item" data-url="<?php echo get_permalink($next->ID); ?>">
					</div>
					<?php } ?>
					
					<div class="item active">
						<?php get_template_part( 'contents/content', 'portfolio-single' ); ?>
					</div>
					
					<?php if ( $previous ) { ?>
					<div class="item" data-url="<?php echo get_permalink($previous->ID); ?>">
					</div>
					<?php } ?>
					
				<?php endwhile; ?>
			</div>
			<a data-slide="prev" role="button" href="#carousel-single-gallery" class="left carousel-control">
				<i class="fa fa-angle-left"></i>
			</a> 
			<a data-slide="next" role="button" href="#carousel-single-gallery" class="right carousel-control">
				<i class="fa fa-angle-right"></i>
			</a> 
		</div>
	</div>
</section>
<?php get_footer(); ?>
