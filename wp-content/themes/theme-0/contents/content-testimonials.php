<?php 

global $testimonials;
?>
<div data-ride="carousel" class="carousel slide" id="carousel-testimonials" data-interval="5000">
	<div role="listbox" class="carousel-inner">
		<?php $i = 0; 
		while ( $testimonials['query']->have_posts() ) : $testimonials['query']->the_post(); 
			$i++; 
			$address = get_post_meta(get_the_ID(), '__address', true);
			?>
			<div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
				<article id="post-<?php the_ID(); ?>" class="testimonial">
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<h3 class="entry-title">
						<?php the_title(); ?>
						
						<?php if ( isset($address) && !empty($address) ) { ?>
						<small><?php echo $address; ?></small>
						<?php } ?>
					</h3>
				</article>
			</div>
		<?php endwhile; ?>
	</div>
	<a data-slide="prev" role="button" href="#carousel-testimonials" class="left carousel-control">
		<i class="fa fa-angle-left"></i>
	</a> 
	<a data-slide="next" role="button" href="#carousel-testimonials" class="right carousel-control">
		<i class="fa fa-angle-right"></i>
	</a> 
</div>
