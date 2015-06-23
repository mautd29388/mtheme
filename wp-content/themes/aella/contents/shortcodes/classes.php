<?php 

	global $classes;

	$week_next	= strtotime( "next monday" );
	$week_start	= strtotime( "previous monday" );
	$week_previous	= strtotime( "-7days today");
	if ( $week_start == $week_previous ) { 
		$week_start = strtotime( "today" );
	}
	
	$classes_posts = array();
	while ( $classes['query']->have_posts() ) : $classes['query']->the_post(); 
	
		$__start	= get_post_meta(get_the_ID(), '__start', true);
		$__end	= get_post_meta(get_the_ID(), '__end', true);
		$__repeat 	= get_post_meta(get_the_ID(), '__repeat', true);
		
		if ( isset($__start) && !empty($__start) ) {
			
			$start = strtotime($__start);
			if ( $__repeat == 'weekly' ) {
				$__repeat_days = get_post_meta(get_the_ID(), '__repeat_days', true);
				$key = strtotime(date('H:i:s', $start));
				
				if ( is_array($__repeat_days) && isset($__repeat_days[0]) && $__repeat_days[0] == 'all') {
					
					if ( isset($__end) && !empty($__end) && strtotime($__end) < $week_next ) {
						$__week_end = strtotime($__end);
					} else {
						$__week_end = $week_next;
					}
					
					if ( $week_start > $start ) {
						$__week_start = $week_start;
					} else {
						$__week_start = $start;
					}
					
					for ($date = $__week_start; $date < $__week_end; $date = strtotime("+1 day", $date)) {
						$__classes_post = array(
								'date'	=> $date,
								'id'	=> get_the_ID(),
						);
						
						$classes_posts[$key][] = $__classes_post;
					}
					
				} elseif ( is_array($__repeat_days) ) {
					
					if ( $start < $week_start  ) {
						$__week_start = $week_start;
					} else {
						$__week_start = $start;
					}
					
					$__day = date('N', $__week_start);
					foreach ( $__repeat_days as $day ) {
						
						if ( $__day <=  $day ) { 
							$day = $day - 1;
							$__classes_post = array(
									'date'	=> strtotime("+$day day", $week_start) ,
									'id'	=> get_the_ID(),
							);
							$classes_posts[$key][] = $__classes_post;
						}
					}
				}
				
			} elseif ( $__repeat == 'customize' ) {
				
				$key = strtotime(date('H:i:s', $start));
				$__classes_post = array(
						'date'	=> $start ,
						'id'	=> get_the_ID(),
				);
				$classes_posts[$key][] = $__classes_post;
				
				$__customize = get_post_meta(get_the_ID(), '__customize', true);
				if ( is_array($__customize) && count($__customize) > 0 ) {
					
					foreach ( $__customize as $day ) {
						$date = strtotime($day["date"]);
						if ( $date > $start ) {
							$key = strtotime(date('H:i:s', $date));
							$__classes_post = array(
									'date'	=> $date ,
									'id'	=> get_the_ID(),
							);
							$classes_posts[$key][] = $__classes_post;
						}
					}
				}
			
			} else {
				
				if ( $start < $week_start ) {
					return false;
				
				} else {
					$key = strtotime(date('H:i:s', $start));
						
					$__classes_post = array(
							'date'	=> $start,
							'id'	=> get_the_ID(),
					);
						
					$classes_posts[$key][] = $__classes_post;
				}
			} 
		}
	
	endwhile;
	
	$week = array();
	$week[1] = 'MONDAY';
	$week[2] = 'TUESDAY';
	$week[3] = 'WEDNESDAY';
	$week[4] = 'THURSTDAY';
	$week[5] = 'FRIDAY';
	$week[6] = 'SATURDAY';
	$week[7] = 'SUNDAY';
	
	$classes_cats = get_terms('mclasses_cat');
	?>
	<div class="search-class">
		<div class="js-filter-days-classes pull-right pull-up-80">
			<a data-value="TODAY" href="">TODAY</a>
			<a data-value="ALL" href="" class="active">THIS WEEK</a>
			<select class="js-filter-classes-type">
				<option value="all">ALL</option>
				<?php foreach ( $classes_cats as $classes_cat ) { ?>
				<option value="<?php echo $classes_cat->slug?>"><?php echo $classes_cat->name; ?></option>
				<?php } ?>
	    	</select>
		</div>
		
		<div class="table-responsive">
			<table class="schedule pull-down-125 width-100">
				<tr class="form-headline">
					<td></td>
					<?php foreach ( $week as $key => $day ) { ?>
					<td class="day-filter" data-day="<?php echo $day; ?>"><?php echo $day; ?></td>
					<?php } ?>
				</tr>
				<?php if ( count($classes_posts) > 0 ) { 
					ksort($classes_posts);
					foreach ( $classes_posts as $key => $__classes_posts ) { ?>
						<tr>
								<td class="vertical-middle"><?php echo date('H:i', $key); ?></td>
								<?php foreach ( $week as $key => $day ) { ?>
								<td class="day-filter" data-day="<?php echo $day; ?>">
									<?php foreach ( $__classes_posts as $classes_post ) {
										if ( date('N', $classes_post['date']) == $key ) { 
	
											$terms = get_the_terms( $classes_post['id'], 'mclasses_cat' );
											$classes_cat_slug = array();
											foreach ( $terms as $term ) {
												$classes_cat_slug[] = $term->slug;
											}
											?>
										<a href="<?php echo get_permalink($classes_post['id']); ?>" data-toggle="modal" data-target="#classes-modal-<?php echo $classes_post['id']; ?>" data-class="<?php echo join(' ', $classes_cat_slug); ?>" class="single-class <?php echo join(' ', $classes_cat_slug); ?>">
											<?php echo get_the_title($classes_post['id']); ?></a>
											
										<!-- Modal -->
										<div class="modal fade" id="classes-modal-<?php echo $classes_post['id']; ?>" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"
															aria-hidden="true">&times;</button>
													</div>
													<div class="modal-body">
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<!-- /.modal -->
											
										<?php }
									} ?>
								</td>
								<?php } ?>
							</tr>
					
				<?php }
				} ?>
			</table>
		</div>
	</div>
