<?php 

$socials = get_post_meta(get_the_ID(), '__social', true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="entry-thumbnail">
		<?php the_post_thumbnail('fullsize'); ?>
	</figure>
	<?php } ?>
	
	<h2 class="entry-title">
		<?php the_title(); ?>
		<?php 
		$terms = get_the_terms( get_the_ID (), 'our_teams' );
		$our_teams = array();
		foreach ( $terms as $term ) {
			$our_teams[] = $term->name;
		}
		?>
		<small><?php echo join(' - ', $our_teams); ?></small>
	</h2>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	
	<?php if (  is_array($socials) && count($socials) > 0 ) { ?>
	<ul class="social">
		<?php foreach ( $socials as $social ) { ?>
		<li><a href="<?php echo $social['url_social']; ?>"><i class="fa <?php echo $social['icons_social']; ?>"></i></a></li>
		<?php } ?>
	</ul>
	<?php } ?>
	
</article>
<!-- #post-## -->
