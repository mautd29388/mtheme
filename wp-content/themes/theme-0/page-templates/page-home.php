<?php
/**
 * Template Name: Home Template
 */

get_header(); 
?>

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post(); 
	
	$sections = get_post_meta( get_the_ID(), '__section', true);
	
	if ( isset($sections) && is_array($sections) && count($sections) > 0 ) {
		
		foreach ( $sections as $section ) {
			
			switch ($section['name']) {
				case infoUs: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?>">
						<div class="container">
							<div class="row">
								<div class="col-sm-5">
									<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
								</div>
								<div class="col-sm-7">
									<aside>
										<p><?php echo $section['info_content']?></p>
										<div class="readMore">
											<div class="readMore-innder">
												<a href="#">Read More <span>&rarr;</span></a>
											</div>
										</div>
									</aside>
								</div>
							</div>
						</div>
					</section>
					<?php 
					break;
				
				case skills: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?> <?php echo $section['skills_style']; ?>">
						<div class="container">
							<?php if ( $section['show_title'] != 'off' ) { ?>
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
							<?php } ?>
							<div class="row">
								<?php 
								$skills = ot_get_option('skills');
								
								if ( isset($skills) && is_array($skills) && count($skills) >0 ) {
									foreach ( $skills as $skill ) { ?>
										<div class="col-sm-4">
											<?php if ( $section['skills_style'] == 'skills_v1' ) { ?>
											<figure>
												<img alt="" src="<?php echo $skill['image']; ?>">
											</figure>
											<?php } else { ?>
											<div class="circle" data-value="<?php echo $skill['numeric']; ?>" data-fill="#030320" >
												<strong></strong>
											</div>
											<?php } ?>
											<h5><?php echo $skill['title']; ?></h5>
										</div>
										<?php 
									} 
								}
								?>
							</div>
						</div>
					</section>
					<?php 
					break;
					
				case portfolio: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?> <?php echo $section['portfolio_style']; ?>">
						<?php if ( $section['show_title'] != 'off' ) { ?>
						<div class="container">
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
						</div>
						<?php } ?>
						
						<div class="portfolio-innner">
							<?php if ( $section['portfolio_style'] != 'portfolio_v2' ) { ?>
							<div class="container">
								<div class="row">
								<?php } ?>
									<?php 
									if ( isset($section['portfolio_post_type']) && 
											is_array($section['portfolio_post_type']) && 
											count($section['portfolio_post_type']) > 0 ) {
										
										foreach ( $section['portfolio_post_type'] as $portfolio_id ) {
											
											$terms = get_the_terms( $portfolio_id, 'mportfolio_cat' );
											
											$portfolio_cat_slug = array();
											$portfolio_cat_name = array();
											foreach ( $terms as $term ) {
												$portfolio_cat_slug[] = $term->slug;
												$portfolio_cat_name[] = $term->name;
											}
										?>
										<?php if ( $section['portfolio_style'] != 'portfolio_v2' ) { ?>
										<div class="col-sm-6 col-md-4 <?php echo join(' ', $portfolio_cat_slug); ?>">
										<?php } ?>	
											<article class="portfolio-post">
												<?php if ( has_post_thumbnail($portfolio_id) ) { ?>
												<figure>
													<a href="#portfolioModal"
														data-src="<?php echo wp_get_attachment_url($portfolio_id); ?>" title="<?php echo get_the_title($portfolio_id); ?>"
														data-toggle="modal">
														<?php 
														if ( $section['portfolio_style'] != 'portfolio_v2' ) 
															echo get_the_post_thumbnail($portfolio_id, 'thumbnail'); 
														
														else 
															echo get_the_post_thumbnail($portfolio_id, 'fullsize');
														?>
													</a>
												</figure>
												<?php } ?>
												
												<?php if ( $section['portfolio_style'] == 'portfolio_v3' ) { ?>
												<aside>
													<h4 class="workTitle">
														<a href="<?php echo get_permalink($portfolio_id); ?>"><?php echo get_the_title($portfolio_id); ?></a>
													</h4>
													<span class="entry-meta"> <?php echo join(', ', $portfolio_cat_name); ?></span>
												</aside>
												<?php } ?>
											</article>
										<?php if ( $section['portfolio_style'] != 'portfolio_v2' ) { ?>
										</div>
										<?php } ?>
									<?php }
									} ?>
								<?php if ( $section['portfolio_style'] != 'portfolio_v2' ) { ?>
								</div>
							</div>
							<?php } ?>
						</div>
						
						<?php if ( $section['portfolio_show_button'] == 'on' ) { ?>
						<div class="readMore dark">
							<div class="readMore-innder">
								<a href="<?php echo get_post_type_archive_link('mportfolio'); ?>"><?php echo $section['portfolio_button_name']; ?> <span>&rarr;</span></a>
							</div>
						</div>
						<?php } ?>
					</section>
					<?php 
					break;
					
				case test: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?> <?php echo $section['skills_style']; ?>">
						<div class="container">
							<?php if ( $section['show_title'] != 'off' ) { ?>
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
							<?php } ?>
							<div class="row">
							</div>
						</div>
					</section>
					<?php 
					break;
												
				case ourVision: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?>">
						<div class="container">
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
							<aside>
								<p><?php echo $section['ourVision_content']; ?></p>
								<div class="readMore light">
									<div class="readMore-innder">
										<a href="<?php echo $section['ourVision_button_link']; ?>"><?php echo $section['ourVision_button_name']; ?> <span>&rarr;</span></a>
									</div>
								</div>
							</aside>
						</div>
					</section>
					<?php 
					break;
					
				case label3:
					
					break;
			}
		}
	}
	
	// End the loop.
	endwhile;
	?>
<?php get_footer(); ?>