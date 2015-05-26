<?php
/**
 * Initialize the custom Meta Boxes. 
 */
add_action( 'admin_init', 'custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types in theme-options.php.
 *
 * @return    void
 * @since     2.3.0
 */
function custom_meta_boxes() {
  
 /**
	 * Create a custom meta boxes array that we pass to
	 * the OptionTree Meta Box API Class.
	 */
	$my_meta_box = array(
			
			// Home
			array (
					'id' => 'home-metabox',
					'title' => __ ( 'Home Config', 'mTheme' ),
					'desc' => __ ( '', 'mTheme' ),
					'pages' => array (
							'page'
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							// Style
							array (
									'id' => '__style',
									'label' => __ ( 'Style', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'std' => '',
									'type' => 'select',
									'choices' => array (
											array (
													'value' => '',
													'label' => __ ( 'Select Style', 'mTheme' ),
											),
											array (
													'value' => 'style_v1',
													'label' => __ ( 'Style v1', 'mTheme' ),
											),
											array (
													'value' => 'style_v2',
													'label' => __ ( 'Style v2', 'mTheme' ),
											),
											array (
													'value' => 'style_v3',
													'label' => __ ( 'Style v3', 'mTheme' ),
											),
											array (
													'value' => 'style_v4',
													'label' => __ ( 'Style v4', 'mTheme' ),
											)
									)
							), //End Style
							
							
							// Slider
							array(
									'id' => '__slider',
									'label' => __ ( 'Slider', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'std' => '',
									'type' => 'list-item',
									'settings' => array (
											array (
													'id' => 'image',
													'label' => __ ( 'Image', 'mTheme' ),
													'desc' => '',
													'std' => '',
													'type' => 'upload',
													'operator' => 'and'
											),
											array (
													'label' => 'Portfolio',
													'id' => 'portfolio',
													'std'         => '',
													'type'        => 'custom-post-type-select',
													'section'     => 'option_types',
													'post_type'   => 'mportfolio',
													'operator'    => 'and'
											)
									),
							) // End Slider
					)
			), // End Home
			
			
			// Sub Title
			array (
					'id' => 'subtitle-metabox',
					'title' => __ ( 'Sub Title', 'mTheme' ),
					'desc' => __ ( 'Please enter the code embedded here', 'mTheme' ),
					'pages' => array (
							'page'
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							array (
									'id' => '__subtitle',
									'type' => 'textarea',
									'rows' => '5'
							)
					)
			),
			
			// Embed
			array (
					'id' => 'embed-metabox',
					'title' => __ ( 'Embed Code', 'mTheme' ),
					'desc' => __ ( 'Please enter the code embedded here', 'mTheme' ),
					'pages' => array (
							'page' 
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							array (
									'id' => '__embed',
									'type' => 'textarea',
									'rows' => '5' 
							) 
					) 
			),
			
			// Gallery
			array (
					'id' => 'gallery-metabox',
					'title' => __ ( 'Gallery', 'mTheme' ),
					'desc' => __ ( 'Upload gallery image', 'mTheme' ),
					'pages' => array (
							'mportfolio'
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							array (
									'id' => '__gallery',
									'type' => 'gallery'
							)
					)
			),
			
			
			/**
			 * Metabox Teams
			 * */
			// Avatar
			array (
					'id' => 'avatar-metabox',
					'title' => __ ( 'Avatar', 'mTheme' ),
					'desc' => __ ( 'Upload avatar image', 'mTheme' ),
					'pages' => array (
							'mmember',
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							array (
									'id' => '__avatar',
									'type' => 'upload'
							)
					)
			),
			
			// Social
			array (
					'id' => 'social-metabox',
					'title' => __ ( 'Social', 'mTheme' ),
					'desc' => __ ( 'Social', 'mTheme' ),
					'pages' => array (
							'mmember',
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							array (
									'id' => '__social',
									'type' => 'list-item',
									'settings' => array (
											array (
													'id' => 'icons_social',
													'label' => 'Choose social',
													'desc' => '',
													'std' => '',
													'type' => 'select',
													'rows' => '',
													'post_type' => '',
													'taxonomy' => '',
													'class' => '',
													'choices' => array (
															array (
																	'value' => 'fa-facebook',
																	'label' => 'Facebook',
															),
															array (
																	'value' => 'fa-twitter',
																	'label' => 'Twitter',
															),
															array (
																	'value' => 'fa-pinterest',
																	'label' => 'Pinterest',
															),
															array (
																	'value' => 'fa-google-plus',
																	'label' => 'Google+',
															),
															array (
																	'value' => 'fa-tumblr',
																	'label' => 'Tumblr',
															),
															array (
																	'value' => 'fa-stumbleupon',
																	'label' => 'Stumbleupon',
															),
															array (
																	'value' => 'fa-dribbble',
																	'label' => 'Dribbble',
															),
															array (
																	'value' => 'fa-linkedin',
																	'label' => 'LinkedIn',
															),
															array (
																	'value' => 'fa-youtube',
																	'label' => 'Youtube',
															)
													)
											),
											array (
													'label' => 'URL Social',
													'id' => 'url_social',
													'type' => 'text',
													'desc' => '',
													'std' => '',
													'rows' => '',
													'post_type' => '',
													'taxonomy' => '',
													'class' => ''
											)
									),
									'std' => array(
											array(
													'title' => 'Facebook',
													'icons_social' => 'fa-facebook',
													'url_social' => '#'
											),
											array(
													'title' => 'Twitter',
													'icons_social' => 'fa-twitter',
													'url_social' => '#'
											),
									),
							)
					)
			),
			
			/**
			 * Testimonials
			 */ 
			// Address			
			array (
					'id' => 'address-metabox',
					'title' => __ ( 'Address', 'mTheme' ),
					'desc' => __ ( 'Please enter the code embedded here', 'mTheme' ),
					'pages' => array (
							'mtestimonial',
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							array (
									'id' => '__address',
									'type' => 'text',
							)
					)
			),
	);
  
	/**
	 * Register our meta boxes using the 
     * ot_register_meta_box() function.
     */
	if ( function_exists( 'ot_register_meta_box' ) )
  
		foreach ( $my_meta_box as $meta_box ) {
			ot_register_meta_box( $meta_box );
		}

}



/**
 * Script Metabox
 */
function mTheme_admin_scripts($hook) {
	$metaboxes = array (
			'embed-metabox' => 'default',
			'home-metabox' => 'page-templates/page-home.php',
	);

	if ('post.php' != $hook && 'post-new.php' != $hook) {
		return;
	}

	$formats = $ids = array ();
	foreach ( $metaboxes as $id => $value ) {
		$formats [$value] = $id;
		array_push ( $ids, "#" . $id );
	}

	wp_register_script ( 'mTheme-admin-script', get_template_directory_uri () . '/assets/js/admin.js', array (
	'jquery'
			), '20140616', true );

	$translation_array = array (
			'formats' => $formats,
			'ids' => implode ( ',', $ids )
	);
	wp_localize_script ( 'mTheme-admin-script', 'custom_metabox', $translation_array );

	wp_enqueue_script ( 'mTheme-admin-script' );
}
add_action ( 'admin_enqueue_scripts', 'mTheme_admin_scripts' );