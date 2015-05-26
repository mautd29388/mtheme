<?php

class mTheme_Post_Type {
	
	public function __construct(){
		
		add_action ( 'init', array( $this, 'mTheme_post_type') );
	}
	
	/**
	 * Register custom post types
	 */
	public function mTheme_post_type() {
		
		/**
		 * Post Type: Portfolio
		 */
		$labels = array (
				'name' => _x ( 'Portfolio', 'post type general name', 'mTheme' ),
				'singular_name' => _x ( 'Portfolio', 'post type singular name', 'mTheme' ),
				'add_new' => _x ( 'Add New', 'Portfolio', 'mTheme' ),
				'add_new_item' => __ ( 'Add New Portfolio', 'mTheme' ),
				'edit_item' => __ ( 'Edit Portfolio', 'mTheme' ),
				'new_item' => __ ( 'New Portfolio', 'mTheme' ),
				'view_item' => __ ( 'View Portfolio', 'mTheme' ),
				'search_items' => __ ( 'Search Portfolio', 'mTheme' ),
				'not_found' => __ ( 'No Portfolio found', 'mTheme' ),
				'not_found_in_trash' => __ ( 'No Portfolio found in Trash', 'mTheme' ),
				'parent_item_colon' => '',
				'menu_name' => _x ( 'Portfolio', 'Admin menu name', 'mTheme' ) 
		);
		
		$args = array (
				'labels' => $labels,
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'query_var' => true,
				'rewrite' => array (
						'slug' => 'portfolio' 
				),
				'capability_type' => 'post',
				'has_archive' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'menu_icon' => 'dashicons-lightbulb',
				'supports' => array (
						'title',
						'editor',
						'author',
						'thumbnail' 
				) 
		);
		
		register_post_type ( 'mportfolio', $args );
		
		// Initialize Category Taxonomy Labels
		$labels = array (
				'name' => _x ( 'Portfolio Categories', 'taxonomy general name', 'mTheme' ),
				'singular_name' => _x ( 'Category', 'taxonomy singular name', 'mTheme' ),
				'search_items' => __ ( 'Search Types', 'mTheme' ),
				'all_items' => __ ( 'All Categories', 'mTheme' ),
				'parent_item' => __ ( 'Parent Category', 'mTheme' ),
				'parent_item_colon' => __ ( 'Parent Category:', 'mTheme' ),
				'edit_item' => __ ( 'Edit Category', 'mTheme' ),
				'update_item' => __ ( 'Update Category', 'mTheme' ),
				'add_new_item' => __ ( 'Add New Category', 'mTheme' ),
				'new_item_name' => __ ( 'New Category Name', 'mTheme' ),
				'menu_name' => _x ( 'Categories', 'Admin menu name', 'mTheme' ) 
		);
		
		register_taxonomy ( 'mportfolio_cat', array (
				'mportfolio' 
		), array (
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'query_var' => true,
				'rewrite' => array (
						'slug' => 'portfolio-cat' 
				) 
		) );// End Category
		// End Portfolio
		
		/**
		 * Post Type: Our Team
		 */
		$labels = array (
				'name' => _x ( 'Our Members', 'post type general name', 'mTheme' ),
				'singular_name' => _x ( 'Our Members', 'post type singular name', 'mTheme' ),
				'add_new' => _x ( 'Add New', 'Member', 'mTheme' ),
				'add_new_item' => __ ( 'Add New Member', 'mTheme' ),
				'edit_item' => __ ( 'Edit Member', 'mTheme' ),
				'new_item' => __ ( 'New Member', 'mTheme' ),
				'view_item' => __ ( 'View Member', 'mTheme' ),
				'search_items' => __ ( 'Search Member', 'mTheme' ),
				'not_found' => __ ( 'No Member found', 'mTheme' ),
				'not_found_in_trash' => __ ( 'No Member found in Trash', 'mTheme' ),
				'parent_item_colon' => '',
				'menu_name' => _x ( 'Our Members', 'Admin menu name', 'mTheme' ) 
		);
		
		$args = array (
				'labels' => $labels,
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'query_var' => true,
				'rewrite' => array (
						'slug' => 'our-members' 
				),
				'capability_type' => 'post',
				'has_archive' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'menu_icon' => 'dashicons-groups',
				'supports' => array (
						'title',
						'editor',
						'author',
						'thumbnail' 
				) 
		);
		
		register_post_type ( 'mmember', $args );
		
		// Initialize Category Taxonomy Labels
		$labels = array (
				'name' => _x ( 'Our Teams', 'taxonomy general name', 'mTheme' ),
				'singular_name' => _x ( 'Our Teams', 'taxonomy singular name', 'mTheme' ),
				'search_items' => __ ( 'Search Types', 'mTheme' ),
				'all_items' => __ ( 'All Our Teams', 'mTheme' ),
				'parent_item' => __ ( 'Parent Team', 'mTheme' ),
				'parent_item_colon' => __ ( 'Parent Team:', 'mTheme' ),
				'edit_item' => __ ( 'Edit Team', 'mTheme' ),
				'update_item' => __ ( 'Update Team', 'mTheme' ),
				'add_new_item' => __ ( 'Add New Team', 'mTheme' ),
				'new_item_name' => __ ( 'New Team Name', 'mTheme' ) 
		);
		
		register_taxonomy ( 'our_teams', array (
				'mmember' 
		), array (
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'query_var' => true,
				'rewrite' => array (
						'slug' => 'our-teams' 
				) 
		) ); // End Category
		// End Team
		
		
		/**
		 * Post Type: Testimonials
		 */
		$labels = array (
				'name' => _x ( 'Testimonials', 'post type general name', 'mTheme' ),
				'singular_name' => _x ( 'Testimonials', 'post type singular name', 'mTheme' ),
				'add_new' => _x ( 'Add New', 'Testimonial', 'mTheme' ),
				'add_new_item' => __ ( 'Add New Testimonial', 'mTheme' ),
				'edit_item' => __ ( 'Edit Testimonial', 'mTheme' ),
				'new_item' => __ ( 'New Testimonial', 'mTheme' ),
				'view_item' => __ ( 'View Testimonial', 'mTheme' ),
				'search_items' => __ ( 'Search Testimonials', 'mTheme' ),
				'not_found' => __ ( 'No Portfolio found', 'mTheme' ),
				'not_found_in_trash' => __ ( 'No Testimonials found in Trash', 'mTheme' ),
				'parent_item_colon' => '',
				'menu_name' => _x ( 'Testimonials', 'Admin menu name', 'mTheme' )
		);
		
		$args = array (
				'labels' => $labels,
				'public' => true,
				'exclude_from_search' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'query_var' => true,
				'rewrite' => array (
						'slug' => 'testimonials'
				),
				'capability_type' => 'post',
				'has_archive' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'menu_icon' => 'dashicons-format-quote',
				'supports' => array (
						'title',
						'editor',
				)
		);
		
		register_post_type ( 'mtestimonial', $args );
	}
}

new mTheme_Post_Type();