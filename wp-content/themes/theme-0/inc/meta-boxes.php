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
					'title' => __ ( 'Setting Section', 'mTheme' ),
					'desc' => __ ( '', 'mTheme' ),
					'pages' => array (
							'page'
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							
							array(
									'id' => '__section',
									'label' => __ ( 'Section', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'std' => '',
									'type' => 'list-item',
									'settings' => array (
											
											array(
													'label' => __ ( 'Show Title', 'mTheme' ),
													'desc' => __ ( 'Select <code>On</code> if you want to display the Title.', 'mTheme' ),
													'std' => '',
													'type' => 'on-off',
											),
											
											// SubTitle
											array (
													'id' => 'subtitle',
													'label' => __ ( 'Sub Title Section', 'mTheme' ),
													'desc' => __ ( 'Please enter the Sub Title Section.', 'mTheme' ),
													'type' => 'textarea',
													'rows' => '3'
											), //End SubTitle
											
											// Select Section Name
											array (
													'id' => 'name',
													'label' => __ ( 'Name', 'mTheme' ),
													'desc' => __ ( 'Please choose the section for the home page', 'mTheme' ),
													'std' => '',
													'type' => 'select',
													'choices' => array (
															array (
																	'value' => '',
																	'label' => __ ( 'Select Section', 'mTheme' ),
															),
															array (
																	'value' => 'infoUs',
																	'label' => __ ( 'Our Info', 'mTheme' ),
															),
															array (
																	'value' => 'skills',
																	'label' => __ ( 'Skills', 'mTheme' ),
															),
															array (
																	'value' => 'portfolio',
																	'label' => __ ( 'Portfolio', 'mTheme' ),
															),
															array (
																	'value' => 'testimonials',
																	'label' => __ ( 'Testimonials', 'mTheme' ),
															),
															array (
																	'value' => 'feed',
																	'label' => __ ( 'Feed', 'mTheme' ),
															),
															array (
																	'value' => 'ourVision',
																	'label' => __ ( 'Our Vision', 'mTheme' ),
															),
															array (
																	'value' => 'whyTCUs',
																	'label' => __ ( 'Why to choose us', 'mTheme' ),
															),
															array (
																	'value' => 'awards',
																	'label' => __ ( 'Awards', 'mTheme' ),
															),
															array (
																	'value' => 'journal',
																	'label' => __ ( 'Journal', 'mTheme' ),
															),
															array (
																	'value' => 'contact',
																	'label' => __ ( 'Contact', 'mTheme' ),
															)
													)
											), // And Section Name
											
											// Background Section
											array(
													'id'          => 'background',
													'label'       => __( 'Background', 'mTheme' ),
													'desc'        => __( 'Select the background for the Section.', 'mTheme' ),
													'std'         => '',
													'type'        => 'background',
											), // End Background
											
											
											// Our info
											array (
													'id' => 'info_style',
													'label' => __ ( 'Style', 'mTheme' ),
													'desc' => __ ( 'Select a style for section Our info.', 'mTheme' ),
													'std' => 'style_v1',
													'type' => 'select',
													'choices' => array (
															array (
																	'value' => 'style_v1',
																	'label' => __ ( 'Style v1', 'mTheme' ),
															),
															array (
																	'value' => 'style_v2',
																	'label' => __ ( 'Style v2', 'mTheme' ),
															),
													),
													'condition'   => 'name:is(infoUs)',
											),
											array (
													'id' => 'info_content',
													'label' => __ ( 'Content', 'mTheme' ),
													'desc' => __ ( 'Please enter content.', 'mTheme' ),
													'type' => 'textarea',
													'rows' => '5',
													'condition'   => 'name:is(infoUs)',
											), 
											array (
													'id' => 'info_image',
													'label' => __ ( 'Image', 'mTheme' ),
													'type' => 'upload',
													'condition'   => 'name:is(infoUs),info_style:is(style_v2)',
											),
											// End Our info
											
											
											// Skills
											array (
													'id' => 'skills_style',
													'label' => __ ( 'Style', 'mTheme' ),
													'desc' => __ ( 'Select a style for section Skills.', 'mTheme' ),
													'std' => 'style_v1',
													'type' => 'select',
													'choices' => array (
															array (
																	'value' => 'style_v1',
																	'label' => __ ( 'Style v1', 'mTheme' ),
															),
															array (
																	'value' => 'style_v2',
																	'label' => __ ( 'Style v2', 'mTheme' ),
															),
													),
													'condition'   => 'name:is(skills)',
											),
											array (
													'id' => 'skills_detail',
													'label' => __ ( 'Detail', 'mTheme' ),
													'desc' => __ ( 'Select detail content for section Skills.', 'mTheme' ),
													'std' => '',
													'type' => 'select',
													'choices' => array (
															array (
																	'value' => 'style_v2',
																	'label' => __ ( 'Style v2', 'mTheme' ),
															),
													),
													'condition'   => 'name:is(skills)',
											),
											// End Skills
											
											
											// Portfolio
											array (
													'id' => 'portfolio_style',
													'label' => __ ( 'Style', 'mTheme' ),
													'desc' => __ ( 'Select a style for section Portfolio.', 'mTheme' ),
													'std' => 'style_v1',
													'type' => 'select',
													'choices' => array (
															array (
																	'value' => 'style_v1',
																	'label' => __ ( 'Style v1', 'mTheme' ),
															),
															array (
																	'value' => 'style_v2',
																	'label' => __ ( 'Style v2', 'mTheme' ),
															),
													),
													'condition'   => 'name:is(portfolio)',
											),
											array (
													'id' => 'portfolio_post_type',
													'label' => __ ( 'Portfolio', 'mTheme' ),
													'desc' => __ ( 'Select post for section Portfolio.', 'mTheme' ),
													'std' => '',
													'type' => 'custom-post-type-checkbox',
													'post_type'   => 'mportfolio',
													'condition'   => 'name:is(portfolio)',
											),
											// End Portfolio
											
											
											// Testimonials
											array (
													'id' => 'testimonials_post_type',
													'label' => __ ( 'Testimonials', 'mTheme' ),
													'desc' => __ ( 'Select post for section Testimonials.', 'mTheme' ),
													'std' => '',
													'type' => 'custom-post-type-checkbox',
													'post_type'   => 'mtestimonial',
													'condition'   => 'name:is(testimonials)',
											),
											// End Testimonials
											
											
											// Our Vision
											array (
													'id' => 'ourVision_content',
													'label' => __ ( 'Content', 'mTheme' ),
													'desc' => __ ( 'Please enter content.', 'mTheme' ),
													'type' => 'textarea',
													'rows' => '5',
													'condition'   => 'name:is(ourVision)',
											),
											array (
													'id' => 'ourVision_button_name',
													'label' => __ ( 'Button Name', 'mTheme' ),
													'desc' => __ ( 'Please enter Button Name.', 'mTheme' ),
													'type' => 'text',
													'condition'   => 'name:is(ourVision)',
											),
											array (
													'id' => 'ourVision_button_link',
													'label' => __ ( 'Button Link', 'mTheme' ),
													'desc' => __ ( 'Please enter Button Link.', 'mTheme' ),
													'type' => 'text',
													'condition'   => 'name:is(ourVision)',
											),
											// End Our Vision
											
											// Journal
											array (
													'id' => 'journal_style',
													'label' => __ ( 'Style', 'mTheme' ),
													'desc' => __ ( 'Select a style for section Journal.', 'mTheme' ),
													'std' => 'style_v1',
													'type' => 'select',
													'choices' => array (
															array (
																	'value' => 'style_v1',
																	'label' => __ ( 'Style v1', 'mTheme' ),
															),
															array (
																	'value' => 'style_v2',
																	'label' => __ ( 'Style v2', 'mTheme' ),
															),
													),
													'condition'   => 'name:is(journal)',
											),
											array (
													'id' => 'journal_post_type',
													'label' => __ ( 'Post', 'mTheme' ),
													'desc' => __ ( 'Select post for section Journal.', 'mTheme' ),
													'std' => '',
													'type' => 'custom-post-type-checkbox',
													'post_type'   => 'post',
													'condition'   => 'name:is(journal)',
											),
											// End Journal
									),
							)
					)
			), // End Home
			
			
			
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