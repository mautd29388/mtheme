<?php
if ( !mTheme_is_ajax() ) {
	get_header(); ?>
	<section id="single" class="single-classes">
		<div class="container">
<?php } ?>
			<?php while ( have_posts() ) : the_post(); 
			
			$__duration = get_post_meta(get_the_ID(), '__duration', true);
			$__locations = get_post_meta(get_the_ID(), '__locations', true);
			$__trainer = get_post_meta(get_the_ID(), '__trainer', true);
			$__level = get_post_meta(get_the_ID(), '__level', true);
			?>
			<div class="row">
				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="inner-left-60 inner-60-sm inner-10-xs">
						<h2><?php the_title(); ?></h2>
						<ol class="tags">
							<?php if ( isset($__duration) && !empty($__duration) ) { 
								$hour = floor($__duration/60);
								$minute = $__duration%60;
								?>
							<li>
								<span class="meta">
								<?php echo $hour < 1 ? '' : $hour == 1 ? '1 hour' : $hour . ' hours'; ?>
								<?php echo $minute > 0 ? $minute . ' minutes' : ''; ?>
								</span> 
							<i class="fa fa-clock-o"></i>DURATION</li>
							<?php } ?>
							
							<li><span class="meta">Class#3</span> <i
								class="fa fa-map-marker"></i>LOCATION</li>
								
							<?php if ( is_array($__trainer) && count($__trainer) > 0 ) { 
								$trainers = array();
								foreach ($__trainer as $trainer) {
									$trainers[] = get_the_title($trainer);
								}
								?>
							<li><span class="meta"><?php echo join(' - ', $trainers); ?></span> <i
								class="fa fa-user"></i>TRAINER</li>
							<?php } ?>
							
							<li>
								<div class="training-progress">
									<?php 
									$color = '';
									for ( $i = 1; $i < 10; $i++ ) { 
										if ( $__level >= $i && $i <= 3 ) {
											$color = 'yellow';
											
										} elseif ( $__level >= $i && $i <= 6 ) {
											$color = 'green';
											
										} elseif ( $__level >= $i && $i <= 9 ) {
											$color = 'red';
											
										} else $color = 'grey';
										?>
										<div class="bubble <?php echo $color; ?>">&nbsp;</div>
									<?php } ?>
								</div> <!-- /.training-progress --> <i class="fa fa-bar-chart-o"></i>LEVEL
							</li>
						</ol>
					</div>
				</div>
				<!-- /.col-md-8 -->
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="col-md-4 col-xs-12 col-sm-12 align-c hidden-xs hidden-sm">
					<div class="image-centered pull-up-70">
						<?php the_post_thumbnail('fullsize');?>
					</div>
				</div>
				<?php } ?>
				<!-- /.col-md-4 -->
			</div>
			<!-- /.row -->
			<div class="inner-60 inner-60-sm inner-10-xs">
				<?php the_content(); ?>
			</div>
			<?php endwhile; ?>
<?php if ( !mTheme_is_ajax() ) { ?>
		</div>
	</section>
	<?php get_footer(); 
} ?>
