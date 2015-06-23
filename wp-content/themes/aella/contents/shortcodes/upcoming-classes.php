<?php 

	global $upcoming_classes;

	$instance = $upcoming_classes['instance'];
	$tomorrow	= strtotime( "tomorrow" );
	$now 		= strtotime("now");
	
	while ( $upcoming_classes['query']->have_posts() ) : $upcoming_classes['query']->the_post(); 
	
		$__start	= get_post_meta(get_the_ID(), '__start', true);
		$__end	= get_post_meta(get_the_ID(), '__end', true);
		$__repeat 	= get_post_meta(get_the_ID(), '__repeat', true);
		
		if ( isset($__start) && !empty($__start) ) {
				
			$start = strtotime($__start);
			if ( $__repeat == 'weekly' ) {
				$__repeat_days = get_post_meta(get_the_ID(), '__repeat_days', true);
				
				if ( is_array($__repeat_days) && isset($__repeat_days[0]) && $__repeat_days[0] == 'all') {
					$date = date( 'Y-m-d', $now) . ' ' . date('H:i:s', $start);
					$date = strtotime( "$date" );
					$__classes_post = array(
							'date'	=> $date,
							'id'	=> get_the_ID(),
					);
					if ( $date >= $now && $date < $tomorrow) {
						$classes_posts[$date][] = $__classes_post;
					}
						
				} elseif ( is_array($__repeat_days) ) {
						
					$__day = date('N', $now);
					
					if ( in_array( $__day, $__repeat_days) ) {
						
						$day = $__day - 1;
						$date = strtotime("+$day day", $start);
						$__classes_post = array(
								'date'	=> $date,
								'id'	=> get_the_ID(),
						);
						
						if ( $date >= $now && $date < $tomorrow) {
							$classes_posts[$date][] = $__classes_post;
						}
					}
				}
		
			} elseif ( $__repeat == 'customize' ) {
		
				$__classes_post = array(
						'date'	=> $start ,
						'id'	=> get_the_ID(),
				);
				
				if ( $start >= $now && $start < $tomorrow) {
					$classes_posts[$start][] = $__classes_post;
				}
		
				$__customize = get_post_meta(get_the_ID(), '__customize', true);
				if ( is_array($__customize) && count($__customize) > 0 ) {
						
					foreach ( $__customize as $day ) {
						$date = strtotime($day["date"]);
						if ( $date > $start ) {
							$__classes_post = array(
									'date'	=> $date ,
									'id'	=> get_the_ID(),
							);
							
							if ( $date >= $now && $date < $tomorrow) {
								$classes_posts[$date][] = $__classes_post;
							}
						}
					}
				}
					
			} else {
		
				if ( $start < $now ) {
					return false;
		
				} else {
					$__classes_post = array(
							'date'	=> $start,
							'id'	=> get_the_ID(),
					);
		
					if ( $start >= $now && $start < $tomorrow) {
						$classes_posts[$start][] = $__classes_post;
					}
				}
			}
		}
		
	endwhile;
	
	if ( count($classes_posts) > 0 ) {
		ksort($classes_posts);
	}
	$classes_posts = array_slice($classes_posts, 0, $instance['number']);
	
	if ( $instance['style'] == 'style_v1' ) {
	?>
		<ul class="horizontal-timetable timetable"> 
		<?php foreach ( $classes_posts as $__classes_posts ) { ?>
			<?php foreach ( $__classes_posts as $classes_post ) { ?>
			<li class="time">
                <div class="data">
                  <span class="title"><?php echo get_the_title($classes_post['id']); ?></span>
                  <a href="<?php echo get_permalink($classes_post['id']); ?>"><?php echo date('H:i', $classes_post['date']); ?></a>
                  <!-- /.additional-data -->
                </div>
                <!-- /.data -->
              </li>
              <?php }
		} ?>
		</ul>
	<?php } else { ?>
		<div class="background-grey">
			<ul class="vertical-timetable timetable">
			<?php foreach ( $classes_posts as $__classes_posts ) { ?>
				<?php foreach ( $__classes_posts as $classes_post ) { ?>
				<li class="time">
	                <div class="data">
	                  <span class="title"><?php echo get_the_title($classes_post['id']); ?></span>
	                  <a href="<?php echo get_permalink($classes_post['id']); ?>"><?php echo date('H:i', $classes_post['date']); ?></a>
	                  <!-- /.additional-data -->
	                </div>
	                <!-- /.data -->
	              </li>
	              <?php }
			} ?>
			</ul>
		</div>
	<?php }
