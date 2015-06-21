<?php 

global $portfolio, $wp_rewrite;

$portfolio_cat = get_terms('mportfolio_cat');

if ( $portfolio['layout'] == 'layout_3' ) {
?>

<div data-ride="carousel"
	class="carousel slide carousel-galleries_v3"
	id="carousel-galleries_v3" data-interval="false">
	<div role="listbox" class="carousel-inner">
		<?php $i == 0; 
		while ( $portfolio['query']->have_posts() ) : $portfolio['query']->the_post(); 
			$i++;
			?>
			<div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
				<article class="aella-gallery">
					<div class="gallery-inner">
						<figure>
							<?php 
							echo get_the_post_thumbnail( get_the_ID(), 'post-thumbnail' ); 
							
							$gallery = get_post_meta(get_the_ID(), '__gallery', true);
							$attachment_ids = explode(',', $gallery);
							
							if ( isset($attachment_ids) && is_array($attachment_ids) && count($attachment_ids) > 0 ) {
								$i = 0;
								foreach ( $attachment_ids as $attachment_id ) {
									$i++;
									echo wp_get_attachment_image($attachment_id, 'post-thumbnail');
									
									if ( $i >= 2 ) break;
								}
							}
							?>
							<figcaption>
								<a href="<?php echo get_permalink( get_the_ID() ); ?>"
									data-single-id="#single-gallery"></a>
							</figcaption>
						</figure>
						<h2 class="entry-title">
							<?php the_date('', '<small>', '</small>'); ?>
							<a href="<?php echo get_permalink( get_the_ID() ); ?>"
								data-single-id="#single-gallery"><?php the_title(); ?></a>
						</h2>
					</div>
				</article>
			</div>
			
		<?php endwhile; ?>
	</div>
	<a data-slide="prev" 
		role="button" href="#carousel-galleries_v3"
		class="left carousel-control"
		data-url="<?php echo previous_posts(false); ?>"> <i class="fa fa-angle-left"></i>
	</a> 
	<a data-slide="next" 
		role="button" 
		href="#carousel-galleries_v3"
		class="right carousel-control"
		data-url="<?php echo next_posts($portfolio['query']->max_num_pages, false); ?>"> <i class="fa fa-angle-right"></i>
	</a>
</div>
			
<?php } else { ?>

<div id="filters" class="filters">
	<span>Show from</span> <select name="filters">
		<option value="*">all types</option>
		<?php foreach ( $portfolio_cat as $term ) { ?>
		<option value="<?php echo '.' . $term->slug?>"><?php echo $term->name; ?></option>
		<?php } ?>
	</select>
</div>
<div id="isotopeGalleries" class="isotopeContainer isotopeGalleries">
	<?php while ( $portfolio['query']->have_posts() ) : $portfolio['query']->the_post(); 
	
		$terms = get_the_terms( get_the_ID (), 'mportfolio_cat' );
		$portfolio_cat = array();
		$portfolio_cat_name = array();
		foreach ( $terms as $term ) {
			$portfolio_cat[] = $term->slug;
			$portfolio_cat_name[] = $term->name;
		}
		?>
		<article id="post-<?php the_ID(); ?>" class="aella-gallery gallery <?php echo join(' ', $portfolio_cat); ?>">
			<div class="gallery-inner">
				<?php if ( has_post_thumbnail() ) { ?>
				<figure>
					<?php 
					if ( $portfolio['layout'] == 'layout_1' )
						echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); 
					elseif ( $portfolio['layout'] == 'layout_2' )
						echo get_the_post_thumbnail( get_the_ID(), 'medium' );
					
					?>
					<figcaption>
						<a href="<?php echo get_permalink( get_the_ID() ); ?>"
							data-single-id="#single-gallery">View Gallery <i
							class="fa fa-angle-down"></i></a>
					</figcaption>
				</figure>
				<?php } ?>
				<h2 class="entry-title">
					<a href="<?php echo get_permalink( get_the_ID() ); ?>"
						data-single-id="#single-gallery"><?php the_title(); ?></a> <small><?php echo join(' - ', $portfolio_cat_name); ?></small>
				</h2>
			</div>
		</article>
	<?php endwhile; ?>
</div>

<a id="loadmore" href="<?php echo $portfolio['next_posts']; ?>"></a>
<div class="loading">
	<i class="fa fa-spin fa-refresh"></i>
</div>

<?php } ?>

<div id="single-gallery" class="single-gallery pageFixed">

</div>

<?php 
$social = ot_get_option('single_social', '');
if ( !empty($social) ) {
?>
<div id="entry-social">
	<div class="entry-social clearfix">
		<?php echo $social; ?>
	</div>
</div>
<?php } ?>