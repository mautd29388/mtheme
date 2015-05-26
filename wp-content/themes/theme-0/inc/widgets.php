<?php

function mTheme_widgets_init() {
	register_sidebar( array(
			'name' => __ ( 'Primary Sidebar', 'mTheme' ),
			'id' => 'primary',
			'description' => __ ( '', 'mTheme' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>' 
	) );
	
}
add_action( 'widgets_init', 'mTheme_widgets_init' );