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
							'id' => 'portfolio',
							'title' => __ ( 'Portfolio', 'mTheme' )
					),
					array (
							'id' => 'contact',
							'title' => __ ( 'Contact', 'mTheme' )
					),
					array (
							'id' => 'typography',
							'title' => __ ( 'Typography', 'mTheme' )
					)
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
							'rows' => '',
							'post_type' => '',
							'taxonomy' => '',
							'min_max_step' => '',
							'class' => '',
							'condition' => '',
							'operator' => 'and'
					),
					array (
							'id' => 'style',
							'label' => __ ( 'Style', 'mTheme' ),
							'desc' => __ ( 'Select a style for the theme.', 'mTheme' ),
							'std' => 'style_v1',
							'type' => 'select',
							'section' => 'general',
							'rows' => '',
							'post_type' => '',
							'taxonomy' => '',
							'min_max_step' => '',
							'class' => '',
							'condition' => '',
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
					
					array(
							'id'          => 'single_social',
							'label'       => __( 'Social on Single Page', 'mTheme' ),
							'desc'        => __( 'The social will be displayed on single page', 'mTheme' ),
							'std'         => '',
							'type'        => 'textarea-simple',
							'section'     => 'general',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'min_max_step'=> '',
							'class'       => '',
							'condition'   => '',
							'operator'    => 'and'
					),
					
					array (
							'id' => 'footer_social_show',
							'label' => __ ( 'Show Footer Social', 'mTheme' ),
							'desc' => sprintf ( __ ( 'The On/Off option type displays a simple switch that can be used to turn things on or off. The saved return value is either %s or %s.', 'mTheme' ), '<code>on</code>', '<code>off</code>' ),
							'std' => '',
							'type' => 'on-off',
							'section' => 'general',
							'rows' => '',
							'post_type' => '',
							'taxonomy' => '',
							'min_max_step' => '',
							'class' => '',
							'condition' => '',
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
							'rows' => '',
							'post_type' => '',
							'taxonomy' => '',
							'class' => '',
							'section' => 'general'
					),
					array (
							'id' => 'copyright',
							'label' => __ ( 'Copyright', 'mTheme' ),
							'desc' => __ ( 'Enter the text that displays in the copyright bar. HTML markup can be used.', 'mTheme' ),
							'std' => '&copy; 2015 Aella Events',
							'type' => 'textarea',
							'section' => 'general',
							'rows' => '10',
							'post_type' => '',
							'taxonomy' => '',
							'min_max_step' => '',
							'class' => '',
							'condition' => '',
							'operator' => 'and'
					),
					
					// Portfolio
					array (
							'id' => 'portfolio_layout',
							'label' => __ ( 'Layout of Portfolio Page', 'mTheme' ),
							'desc' => __ ( 'Select a layout for portfolio page.', 'mTheme' ),
							'std' => 'layout_1',
							'type' => 'select',
							'section' => 'portfolio',
							'rows' => '',
							'post_type' => '',
							'taxonomy' => '',
							'min_max_step' => '',
							'class' => '',
							'condition' => '',
							'operator' => 'and',
							'choices' => array (
									array (
											'value' => 'layout_1',
											'label' => __ ( 'Layout 1', 'mTheme' ),
									),
									array (
											'value' => 'layout_2',
											'label' => __ ( 'Layout 2', 'mTheme' ),
									),
									array (
											'value' => 'layout_3',
											'label' => __ ( 'Layout 3', 'mTheme' ),
									),
							)
					),
					array(
							'id'          => 'portfolio_items',
							'label'       => __( 'Number of Portfolio Items Per Page', 'mTheme' ),
							'desc'        => __( 'Insert the number of posts to display per page.', 'mTheme' ),
							'std'         => '12',
							'type'        => 'text',
							'section'     => 'portfolio',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'min_max_step'=> '',
							'class'       => '',
							'condition'   => '',
							'operator'    => 'and'
					),
					// End Portfolio
						
					// Contact
					array(
							'id'          => 'latlng_contact',
							'label'       => __( 'Longitude and latitude of the map center', 'mTheme' ),
							'desc'        => __( 'Get this from <a href="https://maps.google.com/">Google Maps</a>, longitude and latitude separated by comma, like <code>40.724885,-74.00264</code> for the New York.', 'mTheme' ),
							'std'         => '37.278689, -121.896325',
							'type'        => 'text',
							'section'     => 'contact',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'min_max_step'=> '',
							'class'       => '',
							'condition'   => '',
							'operator'    => 'and'
					),
					array(
							'id'          => 'desc_contact',
							'label'       => __( 'Google Map Locations Description', 'mTheme' ),
							'desc'        => __( 'It used for the popup window', 'mTheme' ),
							'std'         => '<p>455 Larkspur Dr<br>San Jose, CA 92926-4601<br><br>+1-510-513-9461</p>',
							'type'        => 'textarea-simple',
							'section'     => 'contact',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'min_max_step'=> '',
							'class'       => '',
							'condition'   => '',
							'operator'    => 'and'
					),
					// End Contact
					
					// Typography
					array (
							'id' => 'google_fonts',
							'label' => __ ( 'Google Fonts', 'mTheme' ),
							'desc' => sprintf ( __ ( 'The Google Fonts option type will dynamically enqueue any number of Google Web Fonts into the document %1$s. As well, once the option has been saved each font family will automatically be inserted into the %2$s array for the Typography option type. You can further modify the font stack by using the %3$s filter, which is passed the %4$s, %5$s, and %6$s parameters. The %6$s parameter is being passed from %7$s, so it will be the ID of a Typography option type. This will allow you to add additional web safe fonts to individual font families on an as-need basis.', 'mTheme' ), '<code>HEAD</code>', '<code>font-family</code>', '<code>ot_google_font_stack</code>', '<code>$font_stack</code>', '<code>$family</code>', '<code>$field_id</code>', '<code>ot_recognized_font_families</code>' ),
							'std' => array (
									array (
											'family' => 'opensans',
											'variants' => array (
													'300',
													'300italic',
													'regular',
													'italic',
													'600',
													'600italic'
											),
											'subsets' => array (
													'latin'
											)
									)
							),
							'type' => 'google-fonts',
							'section' => 'typography',
							'rows' => '',
							'post_type' => '',
							'taxonomy' => '',
							'min_max_step' => '',
							'class' => '',
							'condition' => '',
							'operator' => 'and'
					),
					array (
							'id' => 'typography',
							'label' => __ ( 'Typography', 'mTheme' ),
							'desc' => __ ( 'These options will be added to <code>body</code>', 'mTheme' ),
							'std' => '',
							'type' => 'typography',
							'section' => 'typography',
							'rows' => '',
							'post_type' => '',
							'taxonomy' => '',
							'min_max_step' => '',
							'class' => '',
							'condition' => '',
							'operator' => 'and' 
					),
					array (
							'id' => 'featured_color',
							'label' => __ ( 'Featured Color', 'mTheme' ),
							'desc' => __ ( 'Choose featured color for the theme.', 'mTheme' ),
							'std' => '',
							'type' => 'colorpicker',
							'section' => 'typography',
							'rows' => '',
							'post_type' => '',
							'taxonomy' => '',
							'min_max_step' => '',
							'class' => '',
							'condition' => '',
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