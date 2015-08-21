<?php
add_action ( 'load-themes.php', 'mTheme_init_theme' );
function mTheme_init_theme() {
	global $pagenow;
	
	if ('themes.php' == $pagenow && isset ( $_GET ['activated'] )) {
		update_option ( 'thumbnail_size_h', 400 );
		update_option ( 'thumbnail_size_w', 400 );
		update_option ( 'medium_size_h', 0 );
		update_option ( 'medium_size_w', 400 );
	}
}

/**
 * Theme Options
 */
add_filter ( 'ot_child_theme_mode', '__return_false' );

// add_filter( 'ot_show_pages', '__return_false' );

add_filter ( 'ot_show_options_ui', '__return_false' );

add_filter ( 'ot_show_new_layout', '__return_false' );

add_filter ( 'ot_use_theme_options', '__return_true' );

add_filter ( 'ot_meta_boxes', '__return_true' );

add_filter ( 'ot_post_formats', '__return_true' );

require (trailingslashit ( get_template_directory () ) . 'inc/theme-options.php');
require (trailingslashit ( get_template_directory () ) . 'inc/meta-boxes.php');

require (trailingslashit ( get_template_directory () ) . 'inc/widgets.php');

/**
 * Extend body classes
 */
function mTheme_body_classes($classes) {
	$style = ot_get_option ( 'style', 'style_v1' );
	
	$style_home = get_post_meta ( get_the_ID (), '__style', true );
	
	if (is_page_template ( 'page-templates/page-home.php' ) && isset ( $style_home ) && ! empty ( $style_home ))
		$classes [] = $style_home;
	
	elseif (isset ( $style ))
		$classes [] = $style;
	
	else
		$classes [] = 'style_v1';
	
	if (is_page_template ( 'page-templates/page-home.php' ))
		$classes [] = 'home';
	
	return $classes;
}
add_filter ( 'body_class', 'mTheme_body_classes' );

// Disable support for comments and trackbacks in post types
function disable_comments_page_support() {
	remove_post_type_support ( 'page', 'comments' );
}
add_action ( 'init', 'disable_comments_page_support' );

/**
 * Get link post_type and page number
 */
function get_post_type_archive_pagenum_link($post_type, $max_page, $pagenum) {
	global $wp_rewrite;
	
	$pagenum = ( int ) $pagenum;
	$max_page = ( int ) $max_page;
	
	if ($max_page < $pagenum)
		return false;
	
	if (! $post_type_obj = get_post_type_object ( $post_type ))
		return false;
	
	if (! $post_type_obj->has_archive)
		return false;
	
	if (get_option ( 'permalink_structure' ) && is_array ( $post_type_obj->rewrite )) {
		$struct = (true === $post_type_obj->has_archive) ? $post_type_obj->rewrite ['slug'] : $post_type_obj->has_archive;
		if ($post_type_obj->rewrite ['with_front'])
			$struct = $wp_rewrite->front . $struct;
		else
			$struct = $wp_rewrite->root . $struct;
		
		$request = user_trailingslashit ( $struct, 'post_type_archive' );
	} else {
		$request = '?post_type=' . $post_type;
	}
	
	$home_root = parse_url ( home_url () );
	$home_root = (isset ( $home_root ['path'] )) ? $home_root ['path'] : '';
	$home_root = preg_quote ( $home_root, '|' );
	
	$request = preg_replace ( '|^' . $home_root . '|i', '', $request );
	$request = preg_replace ( '|^/+|', '', $request );
	
	if (! $wp_rewrite->using_permalinks () || is_admin ()) {
		$base = trailingslashit ( home_url () );
		
		if ($pagenum > 1) {
			$result = add_query_arg ( 'paged', $pagenum, $base . $request );
		} else {
			$result = $base . $request;
		}
	} else {
		$qs_regex = '|\?.*?$|';
		preg_match ( $qs_regex, $request, $qs_match );
		
		if (! empty ( $qs_match [0] )) {
			$query_string = $qs_match [0];
			$request = preg_replace ( $qs_regex, '', $request );
		} else {
			$query_string = '';
		}
		
		$request = preg_replace ( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request );
		$request = preg_replace ( '|^' . preg_quote ( $wp_rewrite->index, '|' ) . '|i', '', $request );
		$request = ltrim ( $request, '/' );
		
		$base = trailingslashit ( home_url () );
		
		if ($wp_rewrite->using_index_permalinks () && ($pagenum > 1 || '' != $request))
			$base .= $wp_rewrite->index . '/';
		
		if ($pagenum > 1) {
			$request = ((! empty ( $request )) ? trailingslashit ( $request ) : $request) . user_trailingslashit ( $wp_rewrite->pagination_base . "/" . $pagenum, 'paged' );
		}
		
		$result = $base . $request . $query_string;
	}
	
	/**
	 * Filter the page number link for the current request.
	 *
	 * @since 2.5.0
	 *       
	 * @param string $result
	 *        	The page number link.
	 */
	$result = apply_filters ( 'get_pagenum_link', $result );
	
	if ($escape)
		return esc_url ( $result );
	else
		return esc_url_raw ( $result );
}

add_action ( 'pre_get_posts', 'mTheme_pre_get_posts' );
function mTheme_pre_get_posts() {
	global $wp_query;
	
	if (is_post_type_archive ( 'mportfolio' )) {
		
		$posts_per_page = ot_get_option ( 'portfolio_items', 12 );
		
		$wp_query->set ( 'posts_per_page', $posts_per_page );
	}
}

/**
 * Less
 */
// add_action( 'ot_after_theme_options_save', 'mTheme_include_less' );
function mTheme_include_less($options) {
	$featured_color = ot_get_option ( 'featured_color' );
	
	require_once ('lessc.inc.php');
	
	$less = new lessc ();
	
	$less->setVariables ( array (
			"featured_color" => $featured_color 
	) );
	
	try {
		$less->compileFile ( get_template_directory () . "/assets/less/styles.less", get_template_directory () . "/assets/css/color/less.css" );
	} catch ( exception $e ) {
		echo "fatal error: " . $e->getMessage ();
	}
}

// Get Font google
function mTheme_ot_google_font_stack($families, $field_id) {
	$ot_google_fonts = get_theme_mod ( 'ot_google_fonts', array () );
	$ot_set_google_fonts = get_theme_mod ( 'ot_set_google_fonts', array () );
	
	if (! empty ( $ot_set_google_fonts )) {
		foreach ( $ot_set_google_fonts as $id => $sets ) {
			foreach ( $sets as $value ) {
				$family = isset ( $value ['family'] ) ? $value ['family'] : '';
				if ($family && isset ( $ot_google_fonts [$family] )) {
					$spaces = explode ( ' ', $ot_google_fonts [$family] ['family'] );
					$font_stack = count ( $spaces ) > 1 ? '"' . $ot_google_fonts [$family] ['family'] . '"' : $ot_google_fonts [$family] ['family'];
					$families [$family] = apply_filters ( 'ot_google_font_stack', $font_stack, $family, $field_id );
				}
			}
		}
	}
	
	return $families;
}

// Custom Comment
add_filter ( 'comment_form_default_fields', 'mTheme_comment_form_fields' );
function mTheme_comment_form_fields($fields) {
	return array (
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __ ( 'Name', 'mTheme' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr ( $commenter ['comment_author'] ) . '" size="30" required="required" /></p>',
			'email' => '<p class="comment-form-email"><label for="email">' . __ ( 'Email', 'mTheme' ) . '</label> ' . '<input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr ( $commenter ['comment_author_email'] ) . '" size="30" aria-describedby="email-notes" required="required" /></p>' 
	);
}
function mTheme_comment($comment, $args, $depth) {
	$GLOBALS ['comment'] = $comment;
	extract ( $args, EXTR_SKIP );
	
	if ('div' == $args ['style']) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
		<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
<article class="comment-body">
	<div class="comment-avatar">
					<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
	<div class="comment-content">
					<?php comment_text(); ?>
				</div>
	<div class="comment-meta">
		<p>by <?php echo get_comment_author_link(); ?> on <span
				class="comment-date"><?php echo get_comment_date(); ?></span>
		</p>
	</div>

	<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
</article>
<?php
}

add_action ( 'wp_head', 'mTheme_classes_style' );
function mTheme_classes_style() {
	$classes_cats = get_terms ( 'mclasses_cat' );
	
	$style = '';
	foreach ( $classes_cats as $classes_cat ) {
		$style .= '.search-class .' . $classes_cat->slug . ' {';
		$background_color = get_field ( "background_color", "{$classes_cat->taxonomy}_{$classes_cat->term_id}" );
		$text_color = get_field ( "text_color", "{$classes_cat->taxonomy}_{$classes_cat->term_id}" );
		
		if (isset ( $background_color ) && ! empty ( $background_color )) {
			$style .= 'background-color: ' . $background_color . ';';
		}
		
		if (isset ( $text_color ) && ! empty ( $text_color )) {
			$style .= 'color: ' . $text_color . ';';
		}
		
		$style .= '}';
	}
	
	echo "<style type='text/css'>$style</style>";
}

/**
 * Check Ajax
 */
function mTheme_is_ajax() {
	if (! empty ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) && strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest') {
		return true;
	}
	
	return false;
}

/**
 * Add Shortcodes to Visual Composer
 */
add_action ( 'vc_before_init', 'add_shortcodes_classes' );
add_action ( 'vc_before_init', 'add_shortcodes_classes_news' );
add_action ( 'vc_before_init', 'add_shortcodes_upcoming_classes' );
function add_shortcodes_classes() {
	vc_map ( 

	array (
			'name' => __ ( 'mTheme Classes', 'mTheme' ),
			'base' => 'mTheme_classes',
			'category' => __ ( 'mTheme', 'mTheme' ),
			'icon' => 'vc_element-icon icon-wpb-atm',
			"params" => array (
					array (
							'type' => 'textfield',
							'heading' => __ ( 'Extra class name', 'mTheme' ),
							'param_name' => 'class_name',
					),
			) 
	) );
}
function add_shortcodes_classes_news() {
	vc_map ( array (
			'name' => __ ( 'mTheme Classes News', 'mTheme' ),
			'base' => 'mTheme_classes_news',
			'category' => __ ( 'mTheme', 'mTheme' ),
			'icon' => 'vc_element-icon icon-wpb-atm',
			"params" => array (
					array (
							'type' => 'textfield',
							'heading' => __ ( 'Number of Classes', 'mTheme' ),
							'param_name' => 'posts_per_page',
							'value' => '4' 
					),
					array (
							'type' => 'textfield',
							'heading' => __ ( 'Extra class name', 'mTheme' ),
							'param_name' => 'class_name',
					),
			) 
	) );
}
function add_shortcodes_upcoming_classes() {
	vc_map ( array (
			'name' => __ ( 'mTheme Upcoming Classes', 'mTheme' ),
			'base' => 'mTheme_upcoming_classes',
			'category' => __ ( 'mTheme', 'mTheme' ),
			'icon' => 'vc_element-icon icon-wpb-atm',
			"params" => array (
					array (
							'type' => 'textfield',
							'heading' => __ ( 'Number of Classes', 'mTheme' ),
							'param_name' => 'number',
							'value' => '4' 
					),
					array (
							'type' => 'dropdown',
							'heading' => __ ( 'Style', 'mTheme' ),
							'param_name' => 'style',
							'value' => array (
									__ ( 'Style v1', 'mTheme' ) => 'style_v1',
									__ ( 'Style v2', 'mTheme' ) => 'style_v2' 
							) 
					),
					array (
							'type' => 'textfield',
							'heading' => __ ( 'Extra class name', 'mTheme' ),
							'param_name' => 'class_name',
					),
			) 
	) );
}

/**
 * Custom Maps
 */
if (class_exists ( 'WPSL_Frontend' )) {
	class mTheme_Map extends WPSL_Frontend {
		public function __construct() {
			$this->settings = $this->get_settings ();
		}
		public function render_store_locator() {
			$this->add_frontend_scripts ();
			
			$template_list = $this->get_templates ();
			$output = include ($template_list [absint ( $this->settings ['template_id'] )] ['path']);
			
			return $output;
		}
	}
}