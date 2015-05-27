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