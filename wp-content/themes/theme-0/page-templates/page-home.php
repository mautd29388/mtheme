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
									<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
									<div class="subtitle"><?php echo $section['subtitle']; ?></div>
									<?php } ?>
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
							<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
							<div class="subtitle"><?php echo $section['subtitle']; ?></div>
							<?php } ?>
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
							<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
							<div class="subtitle"><?php echo $section['subtitle']; ?></div>
							<?php } ?>
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

				case testimonials: ?>
					<?php 
					$testimonials = $section['testimonials_post_type'];
					
					if ( !isset($testimonials) || !is_array($testimonials) || count($testimonials) < 1 ) return false;
					?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?> <?php echo $section['skills_style']; ?>">
						<div class="container">
							<?php if ( $section['show_title'] != 'off' ) { ?>
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
							<?php } ?>
							<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
							<div class="subtitle"><?php echo $section['subtitle']; ?></div>
							<?php } ?>
							<div id="carousel-testimonials" class="carousel slide" data-ride="carousel" data-interval="false">
		
								<!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">
									<?php $i= 0; 
									foreach ($testimonials as $testimonial_id ) { 
										$i++;
										$testimonial = get_post($testimonial_id);
										$url = get_post_meta($testimonial_id, 'mtestimonial', true);
										if ( !isset($url) || empty($url) ) $url = '#';
										?>
										<div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
											<aside>
												<div><?php echo $testimonial->post_content; ?></div>
												<a href="<?php  echo $url; ?>"><?php echo get_the_title($testimonial); ?></a>
											</aside>
										</div>
									<?php } ?>
								</div>
		
								<!-- Controls -->
								<a class="left carousel-control" href="#carousel-testimonials"
									role="button" data-slide="prev"> <span class="fa  fa-angle-left"></span>
								</a> <a class="right carousel-control" href="#carousel-testimonials"
									role="button" data-slide="next"> <span class="fa fa-angle-right"></span>
								</a>
							</div>
						</div>
					</section>
					<?php 
					break;
									
				case feed: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?>">
						<?php 
						$dribbble = $section['dribbble'];
						$twitter = $section['twitter'];
						$instagram = $section['instagram'];
						?>
						<div class="container">
							<?php if ( $section['show_title'] != 'off' ) { ?>
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
							<?php } ?>
							<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
							<div class="subtitle"><?php echo $section['subtitle']; ?></div>
							<?php } ?>
							<div class="row">
								<div class="col-sm-4">
									<h5 class="feedTitle">dribbble</h5>
									<div id="carousel-dribbble" class="carousel slide" data-ride="carousel" data-interval="5000" <?php echo isset($dribbble) && !empty($dribbble) ? 'data-dribbble="' . $dribbble . '"' : ''; ?>>
				
										<div class="carousel-inner" role="listbox">
											
										</div>
				
										<a class="left carousel-control" href="#carousel-dribbble"
											role="button" data-slide="prev"> <span class="fa  fa-angle-left"></span>
										</a> <a class="right carousel-control" href="#carousel-dribbble"
											role="button" data-slide="next"> <span class="fa fa-angle-right"></span>
										</a>
									</div>
								</div>
								
								<div class="col-sm-4">
									<h5 class="feedTitle">Twitter</h5>
									<aside>
										<?php echo isset($twitter) ? $twitter : ''; ?>
									</aside>
								</div>
								
								<div class="col-sm-4">
									<h5 class="feedTitle">Instagram</h5>
									<div id="instafeed"  <?php echo isset($instagram) && !empty($instagram) ? 'data-instagram="' . $instagram . '"' : ''; ?>></div>
								</div>
								
							</div>
						</div>
					</section>
					<?php 
					break;
										
				case ourVision: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?>">
						<div class="container">
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
							<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
							<div class="subtitle"><?php echo $section['subtitle']; ?></div>
							<?php } ?>
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
					
				case whyTCUs: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?>">
						<div class="container">
							<?php if ( $section['show_title'] != 'off' ) { ?>
							<div class="row">
								<div class="col-md-8">
									<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
									<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
									<div class="subtitle"><?php echo $section['subtitle']; ?></div>
									<?php } ?>
								</div>
							</div>
							<?php } ?>
							<div class="row">
								<?php if ( isset($section['whyTCUs_image']) && !empty($section['whyTCUs_image']) ) { ?>
								<div class="col-md-6">
									<figure>
										<img alt="" src="<?php echo $section['whyTCUs_image']; ?>">
									</figure>
								</div>
								<?php } ?>
								<?php if ( isset($section['whyTCUs_content']) && !empty($section['whyTCUs_content']) ) { ?>
								<div class="col-md-6">
									<?php echo $section['whyTCUs_content']; ?>
								</div>
								<?php } ?>
							</div>
							<?php if ( isset($section['whyTCUs_button_name']) && !empty($section['whyTCUs_button_name']) ) { ?>
							<div class="readMore dark">
								<div class="readMore-innder">
									<a href="<?php echo $section['whyTCUs_button_link']; ?>"><?php echo $section['whyTCUs_button_name']; ?> <span>→</span></a>
								</div>
							</div>
							<?php } ?>
						</div>
					</section>
					<?php 
					break;

				case awards: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?>">
						<div class="container">
							<?php if ( $section['show_title'] != 'off' ) { ?>
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
							<?php } ?>
							<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
							<div class="subtitle"><?php echo $section['subtitle']; ?></div>
							<?php } ?>
							
							<div class="row">
								<?php 
								$awards = ot_get_option('awards');
								
								if ( isset($awards) && is_array($awards) && count($awards) >0 ) {
									foreach ( $awards as $award ) { ?>
										<div class="col-sm-4">
											<figure>
												<img alt="" src="<?php echo $award['image']; ?>">
												<figcaption><?php echo $award['title']; ?></figcaption>
											</figure>
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
					
				case contact: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?>">
						<div class="container">
							<?php if ( $section['show_title'] != 'off' ) { ?>
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
							<?php } ?>
							<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
							<div class="subtitle"><?php echo $section['subtitle']; ?></div>
							<?php } ?>
							<?php if ( isset($section['contact_content']) && !empty($section['contact_content']) ) {
								echo do_shortcode($section['contact_content']);
							} ?>
						</div>
					</section>
					<?php 
					break;
					
				case test: ?>
					<section id="<?php echo $section['name']; ?>" class="<?php echo $section['name']; ?> <?php echo $section['skills_style']; ?>">
						<div class="container">
							<?php if ( $section['show_title'] != 'off' ) { ?>
							<h2 class="sectionTitle"><?php echo $section['title']; ?></h2>
							<?php } ?>
							<?php if ( isset($section['subtitle']) && !empty($section['subtitle']) ) { ?>
							<div class="subtitle"><?php echo $section['subtitle']; ?></div>
							<?php } ?>
							<div class="row">
							</div>
						</div>
					</section>
					<?php 
					break;
					
			}
		}
	}
	
	// End the loop.
	endwhile;
	?>
<?php get_footer(); ?>