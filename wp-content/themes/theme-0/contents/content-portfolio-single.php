<?php 

$gallery = get_post_meta(get_the_ID(), '__gallery', true);
$attachment_ids = explode(',', $gallery);

$terms = get_the_terms( get_the_ID (), 'mportfolio_cat' );
$portfolio_cat_name = array();
foreach ( $terms as $term ) {
	$portfolio_cat_name[] = $term->name;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( isset($attachment_ids) && is_array($attachment_ids) && count($attachment_ids) > 0 ) { ?>
	<div class="entry-thumbnail">
		<div class="entry-thumbnail-inner">
			<?php foreach ( $attachment_ids as $attachment_id ) {
				
				echo wp_get_attachment_image($attachment_id);
				
			} ?>
		</div>
	</div>
	<?php }?>
	<h2 class="entry-title">
		<?php the_title(); ?>
		<small><?php echo join(' - ', $portfolio_cat_name); ?></small>
	</h2>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
									
</article>
<!-- #post-## -->
