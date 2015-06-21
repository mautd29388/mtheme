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