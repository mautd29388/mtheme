<?php

function mTheme_widgets_init() {
	register_sidebar( array(
			'name' => __ ( 'Sidebar Blog', 'mTheme' ),
			'id' => 'primary',
			'description' => __ ( '', 'mTheme' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>' 
	) );
	
	register_sidebar( array(
			'name' => __ ( 'Slider on Homepage', 'mTheme' ),
			'id' => 'slider',
			'description' => __ ( '', 'mTheme' ),
			'before_widget' => '<div class="banner">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
	) );
	
	register_sidebar( array(
		'name' => __ ( 'Top Content', 'mTheme' ),
		'id' => 'top-content',
		'description' => __ ( '', 'mTheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	) );
	
	register_sidebar( array(
			'name' => __ ( 'Footer', 'mTheme' ),
			'id' => 'footer',
			'description' => __ ( '', 'mTheme' ),
			'before_widget' => '<div id="%1$s" class="col-xs-12 col-md-3 widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="push-down-25">',
			'after_title' => '</h5>'
	) );
	
}
add_action( 'widgets_init', 'mTheme_widgets_init' );


/**
 * Adds Upcoming Classes widget.
 */
class Upcoming_Classes_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'upcoming-classes', 'description' => __( 'Show Upcoming classes', 'mTheme' ) );

		$control_ops = array( 'id_base' => 'upcoming-classes' );

		$this->WP_Widget( 'upcoming-classes', __( 'Upcoming Classes', 'mTheme' ), $widget_ops, $control_ops );
		
	}

	public function widget( $args, $instance ) {
		global $upcoming_classes;
		
		echo $args['before_widget']; 
		
		$tomorrow	= strtotime( "tomorrow" );
		$now 		= strtotime("now");
		
		$query_args = array(
				'post_type' => 'mclasses',
				'posts_per_page' => '-1',
				'meta_query' => array(
						'relation' => 'AND',
						array(
								'key'		=> '__start',
								'value'		=> date('Y-m-d', $now),
								'type'		=> 'DATE',
								'compare'	=> '<',
						),
						array(
								'key'		=> '__end',
								'value'		=> date('Y-m-d', $tomorrow),
								'type'		=> 'DATE',
								'compare'	=> '>',
						),
				),
		);
		
			
		$upcoming_classes['query'] = new WP_Query( $query_args );
		
		$upcoming_classes['instance'] = $instance;
		
		ob_start();
		
		get_template_part('contents/shortcodes/upcoming-classes', '');
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		wp_reset_postdata();
		
		echo $html;
		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Upcoming Classes', 'mTheme' );
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
		$style    = $instance['style'];
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __( 'Number of Classes:', 'mTheme' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" size="3" value="<?php echo $number; ?>" ></p>
		
		<p><label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php echo __( 'Style:', 'mTheme' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
			<option value="style_v1" <?php echo $style == 'style_v1' ? 'selected="selected"' : ''; ?>>Style v1</option>
			<option value="style_v2" <?php echo $style == 'style_v2' ? 'selected="selected"' : ''; ?>>Style v2</option>
		</select>
		<?php 
	}

	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] =	$new_instance['number'];
		$instance['style'] =	$new_instance['style'];

		return $instance;
	}

} // class Upcoming Classes

// register Widget
function register_mTheme_widget() {
	register_widget( 'Upcoming_Classes_Widget' );
}
add_action( 'widgets_init', 'register_mTheme_widget' );
