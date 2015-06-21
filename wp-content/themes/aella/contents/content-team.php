<?php 

global $team;
?>
<div class="aella-team">
	<?php while ( $team['query']->have_posts() ) : $team['query']->the_post(); ?>
	<article id="post-<?php the_ID(); ?>" class="aella-member member">
		<figure>
			<img alt="" src="<?php echo get_post_meta(get_the_ID(), '__avatar', true); ?>">
			<figcaption>
				<a href="<?php echo get_permalink(get_the_ID()); ?>" data-single-id="#single-member">Read More <i class="fa fa-angle-down"></i></a>
			</figcaption>
		</figure>
		<h3 class="entry-title">
			<a href="<?php echo get_permalink(get_the_ID()); ?>" data-single-id="#single-member"><?php the_title(); ?></a>
			<?php 
			$terms = get_the_terms( get_the_ID (), 'our_teams' );
			$our_teams = array();
			foreach ( $terms as $term ) {
				$our_teams[] = $term->name;
			}
			?>
			<small><?php echo join(' - ', $our_teams); ?></small>
		</h3>
	</article>
	<?php endwhile; ?>
</div>
<div id="single-member" class="single-member pageFixed">
				
</div>
