<?php
/**
 * Initialize the custom Theme Options.
 */
add_action ( 'init', 'customTheme_options' );

/**
 * Build the custom settings & update OptionTree.
 *
 * @return void
 * @since 2.3.0
 */
function customTheme_options() {
	
	/* OptionTree is not loaded yet, or this is not an admin request */
	if (! function_exists ( 'ot_settings_id' ) || ! is_admin ())
		return false;
	
	/**
	 * Get a copy of the saved settings array.
	 */
	$saved_settings = get_option ( ot_settings_id (), array () );
	
	/**
	 * Custom settings array that will eventually be
	 * passes to the OptionTree Settings API Class.
	 */
	$custom_settings = array (
			
			'sections' => array (
					array (
							'id' => 'general',
							'title' => __ ( 'General', 'mTheme' )
					),
					array (
							'id' => 'home',
							'title' => __ ( 'One Page', 'mTheme' )
					),
					array (
							'id' => 'portfolio',
							'title' => __ ( 'Portfolio', 'mTheme' )
					),
					array (
							'id' => 'typography',
							'title' => __ ( 'Typography', 'mTheme' )
					),
			),
			'settings' => array (
					
					// General
					array (
							'id' => 'logo',
							'label' => __ ( 'Logo', 'mTheme' ),
							'desc' => __ ( 'Select an image file for your logo.', 'mTheme' ),
							'std' => '',
							'type' => 'upload',
							'section' => 'general',
							'operator' => 'and'
					),
					array (
							'id' => 'style',
							'label' => __ ( 'Style', 'mTheme' ),
							'desc' => __ ( 'Select a style for the theme.', 'mTheme' ),
							'std' => 'style_v1',
							'type' => 'select',
							'section' => 'general',
							'operator' => 'and',
							'choices' => array (
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
					),
					
					array (
							'id' => 'footer_social_show',
							'label' => __ ( 'Show Footer Social', 'mTheme' ),
							'desc' => sprintf ( __ ( 'The On/Off option type displays a simple switch that can be used to turn things on or off. The saved return value is either %s or %s.', 'mTheme' ), '<code>on</code>', '<code>off</code>' ),
							'std' => '',
							'type' => 'on-off',
							'section' => 'general',
							'operator' => 'and'
					),
					array (
							'label' => __ ( 'Footer Social', 'mTheme' ),
							'id' => 'footer_social',
							'type' => 'list-item',
							'desc' => 'Manage your social Icons in the footer.',
							'settings' => array (
									array (
											'id' => 'icons_social',
											'label' => 'Choose social',
											'desc' => '',
											'std' => '',
											'type' => 'select',
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
								array(
										'title' => 'Pinterest',
										'icons_social' => 'fa-pinterest',
										'url_social' => '#'
								),
								array(
										'title' => 'Google',
										'icons_social' => 'fa-google-plus',
										'url_social' => '#'
								)
							),
							'section' => 'general'
					),
					array (
							'id' => 'copyright',
							'label' => __ ( 'Copyright', 'mTheme' ),
							'desc' => __ ( 'Enter the text that displays in the copyright bar. HTML markup can be used.', 'mTheme' ),
							'std' => '<strong>Folks Theme</strong> &copy; 2015. ALL RIGHTS RESERVED.',
							'type' => 'textarea-simple',
							'section' => 'general',
							'rows' => '10',
							'operator' => 'and'
					),
					
					
					// Home
					array (
							'label' => __ ( 'Skills', 'mTheme' ),
							'id' => 'skills',
							'type' => 'list-item',
							'desc' => 'Manage your skills.',
							'section' => 'home',
							'settings' => array (
								array(
										'id'          => 'image',
										'label'       => __( 'Image', 'mTheme' ),
										'desc'        => __( "Image used for Style v1", 'mTheme' ),
										'type'        => 'upload',
										'operator'    => 'and'
								),
								array(
										'id'          => 'numeric',
										'label'       => __( 'Numeric', 'mTheme' ),
										'desc'        => __( 'Numeric use for Style v2', 'mTheme' ),
										'std'         => '',
										'type'        => 'numeric-slider',
										'min_max_step'=> '0,100,1',
										'operator'    => 'and'
								),
							),
							'operator'    => 'and'
					),
					array (
							'label' => __ ( 'Awards', 'mTheme' ),
							'id' => 'awards',
							'type' => 'list-item',
							'desc' => 'Manage your Awards.',
							'section' => 'home',
							'settings' => array (
									array(
											'id'          => 'image',
											'label'       => __( 'Image', 'mTheme' ),
											'desc'        => __( '', 'mTheme' ),
											'type'        => 'upload',
											'operator'    => 'and'
									),
							),
							'operator'    => 'and'
					),
					// End Home
					
					
					// Portfolio
					array (
							'id' => 'portfolio_style',
							'label' => __ ( 'Style of Portfolio Page', 'mTheme' ),
							'desc' => __ ( 'Select a style for portfolio page.', 'mTheme' ),
							'std' => 'style_v1',
							'type' => 'select',
							'section' => 'portfolio',
							'operator' => 'and',
							'choices' => array (
									array (
											'value' => 'portfolio_v1',
											'label' => __ ( 'Portfolio v1', 'mTheme' ),
									),
									array (
											'value' => 'portfolio_v1',
											'label' => __ ( 'Portfolio v2', 'mTheme' ),
									),
									array (
											'value' => 'portfolio_v1',
											'label' => __ ( 'Portfolio v3', 'mTheme' ),
									),
									array (
											'value' => 'portfolio_v1',
											'label' => __ ( 'Portfolio v4', 'mTheme' ),
									),
							)
					),
					array(
							'id'          => 'portfolio_posts_per_page',
							'label'       => __( 'Number of Portfolio Items Per Page', 'mTheme' ),
							'desc'        => __( 'Insert the number of posts to display per page.', 'mTheme' ),
							'std'         => '12',
							'type'        => 'text',
							'section'     => 'portfolio',
							'operator'    => 'and'
					),
					// End Portfolio
						
					// Typography
					array (
							'id' => 'google_fonts',
							'label' => __ ( 'Google Fonts', 'mTheme' ),
							'desc' => sprintf ( __ ( 'The Google Fonts option type will dynamically enqueue any number of Google Web Fonts into the document %1$s. As well, once the option has been saved each font family will automatically be inserted into the %2$s array for the Typography option type. You can further modify the font stack by using the %3$s filter, which is passed the %4$s, %5$s, and %6$s parameters. The %6$s parameter is being passed from %7$s, so it will be the ID of a Typography option type. This will allow you to add additional web safe fonts to individual font families on an as-need basis.', 'mTheme' ), '<code>HEAD</code>', '<code>font-family</code>', '<code>ot_google_font_stack</code>', '<code>$font_stack</code>', '<code>$family</code>', '<code>$field_id</code>', '<code>ot_recognized_font_families</code>' ),
							'std' => '',
							'type' => 'google-fonts',
							'section' => 'typography',
							'operator' => 'and'
					),
					array (
							'id' => 'typography',
							'label' => __ ( 'Typography', 'mTheme' ),
							'desc' => __ ( 'These options will be added to <code>body</code>', 'mTheme' ),
							'std' => '',
							'type' => 'typography',
							'section' => 'typography',
							'operator' => 'and' 
					),
					array (
							'id' => 'featured_color',
							'label' => __ ( 'Featured Color', 'mTheme' ),
							'desc' => __ ( 'Choose featured color for the theme.', 'mTheme' ),
							'std' => '',
							'type' => 'colorpicker',
							'section' => 'typography',
							'operator' => 'and'
					)
					
			) 
	);
	
	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters ( ot_settings_id () . '_args', $custom_settings );
	
	/* settings are not the same update the DB */
	if ($saved_settings !== $custom_settings) {
		update_option ( ot_settings_id (), $custom_settings );
	}
	
	/* Lets OptionTree know the UI Builder is being overridden */
	global $ot_has_customTheme_options;
	$ot_has_customTheme_options = true;
}