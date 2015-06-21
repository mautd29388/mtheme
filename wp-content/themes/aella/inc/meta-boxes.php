<?php
/**
 * Initialize the custom Meta Boxes. 
 */
add_action ( 'admin_init', 'custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types in theme-options.php.
 *
 * @return void
 * @since 2.3.0
 */
function custom_meta_boxes() {
	
	global $wpdb;
	
	
	$wpsl_stores = $wpdb->get_results( 'SELECT * FROM '.$wpdb->wpsl_stores . ' WHERE active = 1', OBJECT );
	
	$locations = array();
	if ( isset($wpsl_stores) && is_array($wpsl_stores) ) {
		foreach ( $wpsl_stores as $wpsl_store ) {
			$locations[] = array (
								'value' => $wpsl_store->wpsl_id,
								'label' => $wpsl_store->store
							);
		}
	}
	
	/**
	 * Create a custom meta boxes array that we pass to
	 * the OptionTree Meta Box API Class.
	 */
	$my_meta_box = array (
			
			/**
			 * Metabox Trainers
			 */
			// Social
			array (
					'id' => 'social-metabox',
					'title' => __ ( 'Social', 'mTheme' ),
					'desc' => __ ( '', 'mTheme' ),
					'pages' => array (
							'mtrainers' 
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
																	'label' => 'Facebook' 
															),
															array (
																	'value' => 'fa-twitter',
																	'label' => 'Twitter' 
															),
															array (
																	'value' => 'fa-pinterest',
																	'label' => 'Pinterest' 
															),
															array (
																	'value' => 'fa-google-plus',
																	'label' => 'Google+' 
															),
															array (
																	'value' => 'fa-tumblr',
																	'label' => 'Tumblr' 
															),
															array (
																	'value' => 'fa-stumbleupon',
																	'label' => 'Stumbleupon' 
															),
															array (
																	'value' => 'fa-dribbble',
																	'label' => 'Dribbble' 
															),
															array (
																	'value' => 'fa-linkedin',
																	'label' => 'LinkedIn' 
															),
															array (
																	'value' => 'fa-youtube',
																	'label' => 'Youtube' 
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
									'std' => array (
											array (
													'title' => 'Facebook',
													'icons_social' => 'fa-facebook',
													'url_social' => '#' 
											),
											array (
													'title' => 'Twitter',
													'icons_social' => 'fa-twitter',
													'url_social' => '#' 
											) 
									) 
							) 
					) 
			),
			
			/**
			 * Metabox Classes
			 */
			
			array (
					'id' => 'date-metabox',
					'title' => __ ( 'Date', 'mTheme' ),
					'desc' => __ ( '', 'mTheme' ),
					'pages' => array (
							'mclasses'
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
								
							array (
									'id' => '__start',
									'label' => __ ( 'Start Date', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'type' => 'date-time-picker'
							),
							array (
									'id' => '__repeat',
									'label' => __ ( 'Repeat', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'type' => 'radio',
									'std'         => 'weekly',
									'choices'     => array(
											array(
													'value'       => 'no',
													'label'       => __( 'No', 'mTheme' ),
											),
											array(
													'value'       => 'weekly',
													'label'       => __( 'Repeat Weekly', 'mTheme' ),
											),
											array(
													'value'       => 'customize',
													'label'       => __( 'Customize', 'mTheme' ),
											)
									)
							),
							array (
									'id' => '__repeat_days',
									'label' => __ ( 'Repeat days', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'type' => 'checkbox',
									'std'         => array('all'),
									'choices'     => array(
											array(
													'value'       => 'all',
													'label'       => __( 'All dates', 'mTheme' ),
													'src'         => ''
											),
											array(
													'value'       => 'mon',
													'label'       => __( 'Monday', 'mTheme' ),
													'src'         => ''
											),
											array(
													'value'       => 'tue',
													'label'       => __( 'Tuesday', 'mTheme' ),
													'src'         => ''
											),
											array(
													'value'       => 'wed',
													'label'       => __( 'Wednesday', 'mTheme' ),
													'src'         => ''
											),
											array(
													'value'       => 'thu',
													'label'       => __( 'Thursday', 'mTheme' ),
													'src'         => ''
											),
											array(
													'value'       => 'fri',
													'label'       => __( 'Friday', 'mTheme' ),
													'src'         => ''
											),
											array(
													'value'       => 'sat',
													'label'       => __( 'Saturday', 'mTheme' ),
													'src'         => ''
											),
											array(
													'value'       => 'sun',
													'label'       => __( 'Sunday', 'mTheme' ),
													'src'         => ''
											),
									),
									'condition'   => '__repeat:is(weekly)',
							),
							array (
									'id' => '__customize',
									'label' => __ ( 'Customize', 'mTheme' ),
									'type' => 'list-item',
									'settings' => array (
											array (
													'id' => 'date',
													'label' => __ ( 'Date', 'mTheme' ),
													'desc' => __ ( '', 'mTheme' ),
													'type' => 'date-time-picker',
											),
									),
									'condition'   => '__repeat:is(customize)',
							),
							array (
									'id' => '__end',
									'label' => __ ( 'End Date', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'type' => 'date-time-picker',
									'condition'   => '__repeat:not(no)',
							),
					)
			),
			
			array (
					'id' => 'detail-metabox',
					'title' => __ ( 'Detail', 'mTheme' ),
					'desc' => __ ( '', 'mTheme' ),
					'pages' => array (
							'mclasses' 
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							
							array (
									'id' => '__duration',
									'label' => __ ( 'Duration', 'mTheme' ),
									'desc' => __ ( '(Minute)', 'mTheme' ),
									'type' => 'text'
							),
							array (
									'id' => '__locations',
									'label' => __ ( 'Locations', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'std' => '',
									'type' => 'select',
									'choices' => $locations,
							),
							array(
									'id' => '__trainer',
									'label' => __ ( 'Trainer', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'std'         => '',
									'type'        => 'custom-post-type-checkbox',
									'post_type'   => 'mtrainers',
							),
							array(
									'id' => '__level',
									'label' => __ ( 'Level', 'mTheme' ),
									'desc' => __ ( '', 'mTheme' ),
									'std'         => '',
									'type'        => 'numeric-slider',
									'min_max_step'=> '0,9,1',
							),
					) 
			), 
			
			/**
			 * Metabox Teams
			 */
			// Avatar
			array (
					'id' => 'avatar-metabox',
					'title' => __ ( 'Avatar', 'mTheme' ),
					'desc' => __ ( 'Upload avatar image', 'mTheme' ),
					'pages' => array (
							'mmember' 
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
							'mmember' 
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
																	'label' => 'Facebook' 
															),
															array (
																	'value' => 'fa-twitter',
																	'label' => 'Twitter' 
															),
															array (
																	'value' => 'fa-pinterest',
																	'label' => 'Pinterest' 
															),
															array (
																	'value' => 'fa-google-plus',
																	'label' => 'Google+' 
															),
															array (
																	'value' => 'fa-tumblr',
																	'label' => 'Tumblr' 
															),
															array (
																	'value' => 'fa-stumbleupon',
																	'label' => 'Stumbleupon' 
															),
															array (
																	'value' => 'fa-dribbble',
																	'label' => 'Dribbble' 
															),
															array (
																	'value' => 'fa-linkedin',
																	'label' => 'LinkedIn' 
															),
															array (
																	'value' => 'fa-youtube',
																	'label' => 'Youtube' 
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
									'std' => array (
											array (
													'title' => 'Facebook',
													'icons_social' => 'fa-facebook',
													'url_social' => '#' 
											),
											array (
													'title' => 'Twitter',
													'icons_social' => 'fa-twitter',
													'url_social' => '#' 
											) 
									) 
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
							'mtestimonial' 
					),
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array (
							array (
									'id' => '__address',
									'type' => 'text' 
							) 
					) 
			) 
	)
	;
	
	/**
	 * Register our meta boxes using the
	 * ot_register_meta_box() function.
	 */
	if (function_exists ( 'ot_register_meta_box' ))
		
		foreach ( $my_meta_box as $meta_box ) {
			ot_register_meta_box ( $meta_box );
		}
}

/**
 * Script Metabox
 */
function mTheme_admin_scripts($hook) {
	$metaboxes = array (
			'embed-metabox' => 'default',
			'home-metabox' => 'page-templates/page-home.php' 
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