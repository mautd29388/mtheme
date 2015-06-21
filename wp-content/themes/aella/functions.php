<?php

if ( ! isset( $content_width ) ) $content_width = 900;

add_action( 'after_setup_theme', 'mTheme_setup' );
function mTheme_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 900, 500, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'mTheme' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video'
	) );

}

// TGM-Plugin-Activation
require_once (trailingslashit ( get_template_directory () ) . 'inc/TGM-Plugin-Activation/load.php');

// Custom Function
require( trailingslashit( get_template_directory() ) . 'inc/function.php' );


add_action ( 'wp_enqueue_scripts', 'mTheme_scripts' );
function mTheme_scripts() {
	
	// Load Style
	wp_enqueue_style ( 'mTheme-font-awesome', trailingslashit( get_template_directory_uri () ) . 'assets/css/bootstrap.css' );
	wp_enqueue_style ( 'mTheme-nivo', trailingslashit( get_template_directory_uri () ) . 'assets/css/bootstrap-theme.min.css' );
	wp_enqueue_style ( 'mTheme-bootstrap', trailingslashit( get_template_directory_uri () ) . 'assets/css/jqueryui/jquery-ui-1.10.3.custom.css' );
	wp_enqueue_style ( 'mTheme-smoothDivScroll', trailingslashit( get_template_directory_uri () ) . 'assets/css/main.css' );
	wp_enqueue_style ( 'mTheme-main', trailingslashit( get_template_directory_uri () ) . 'assets/css/main.css' );
	wp_enqueue_style ( 'mTheme-responsive', trailingslashit( get_template_directory_uri () ) . 'assets/css/responsive.css' );
	wp_enqueue_style ( 'mTheme-color', trailingslashit( get_template_directory_uri () ) . 'assets/css/color/default.css' );
	
	wp_enqueue_style ( 'mTheme-style', get_stylesheet_uri() );
	
	
	// Load Script
	wp_enqueue_script ( 'modernizr-js', trailingslashit( get_template_directory_uri () ) . 'assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js' );
	wp_enqueue_script ( 'jquery-custom-js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', array (''), null, true );
	wp_enqueue_script ( 'mousewheel-js', trailingslashit( get_template_directory_uri () ) . 'assets/js/build/production.js', array ('jquery'), null, true );

	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
}	