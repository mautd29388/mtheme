<?php

class mTheme_Sshortcode {
		
	
	public function __construct(){
		
		add_shortcode('mTheme_team', array(	$this, 'mTheme_team_shortcode'));
		add_shortcode('mTheme_portfolio', array(	$this, 'mTheme_portfolio_shortcode'));
		add_shortcode('mTheme_testimonials', array( $this, 'mTheme_testimonials_shortcode') );
		
		add_shortcode('mTheme_tabs', array( $this, 'mTheme_tabs_shortcode' ));
		add_shortcode('mTheme_tab_titles', array( $this, 'mTheme_tab_titles_shortcode' ));
		add_shortcode('mTheme_tab_title', array( $this, 'mTheme_tab_title_shortcode' ));
		add_shortcode('mTheme_tab_contents', array( $this, 'mTheme_tab_contents_shortcode' ));
		add_shortcode('mTheme_tab_content', array( $this, 'mTheme_tab_content_shortcode' ));
		
		add_filter( 'the_content', array($this, 'shortcode_empty_paragraph_fix') );
	}
	
	public function shortcode_empty_paragraph_fix( $content ) {

        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );

        $content = strtr( $content, $array );

        return $content;
    }
    
	/**
	 * Our Team 
	 */
	public function mTheme_team_shortcode( $atts ){
		
		global $team;
		
		$args = array(
				'post_type' => 'mmember',
				'posts_per_page' => '-1',
		);
		
		$team['query'] = new WP_Query( $args );
		
		ob_start();
		
		get_template_part('contents/content', 'team');
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		wp_reset_postdata();
		
		return $html;
	}
	
	
	/**
	 * Portfolio
	 */
	public function mTheme_portfolio_shortcode( $atts ){
	
		global $portfolio;
		
		if ( isset($atts) && is_array($atts) && count($atts) > 0 )
			extract($atts);
		
		if ( !isset($layout) || empty($layout) ) 
			$layout = ot_get_option('portfolio_layout', 'layout_1');
		
		$portfolio['layout'] = $layout;
		
		$posts_per_page = ot_get_option('portfolio_items', 12);
		$args = array(
				'post_type' => 'mportfolio',
				'posts_per_page' => $posts_per_page,
		);
	
		if ( $layout == 'layout_3' ) {
			
			if(is_front_page()) {
				$paged = (get_query_var('page')) ? get_query_var('page') : 1;
			} else {
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			}
			
			$args = array_merge( $args, array( 'paged' => $paged ) );
		}
			
		$portfolio['query'] = new WP_Query( $args );
	
		$portfolio['next_posts'] = get_post_type_archive_pagenum_link( 'mportfolio', $portfolio['query']->max_num_pages, 2);
		
		ob_start();
	
		get_template_part('contents/content', 'portfolio');
	
		$html = ob_get_contents();
	
		ob_end_clean();
	
		wp_reset_postdata();
	
		return $html;
	}
	
	
	/**
	 * Testimonials 
	 */
	public function mTheme_testimonials_shortcode( $atts ){
	
		global $testimonials;
	
		$args = array(
				'post_type' => 'mtestimonial',
				'posts_per_page' => '-1',
		);
	
		$testimonials['query'] = new WP_Query( $args );
	
		ob_start();
	
		get_template_part('contents/content', 'testimonials');
	
		$html = ob_get_contents();
	
		ob_end_clean();
	
		wp_reset_postdata();
	
		return $html;
	}
	
	
	
	/**
	 * Tabs
	 */
	
	private static $mTheme_tabs = 0;
	private static $mTheme_tab_title = 0;
	private static $mTheme_tab_content = 0;
	
	public function mTheme_tabs_shortcode( $atts, $content = null ){
		
		self::$mTheme_tabs++;
		self::$mTheme_tab_title = 0;
		self::$mTheme_tab_content = 0;
		
		
		ob_start(); ?>
	
		<div class="aella-tabs" role="tabpanel">
		<?php  echo do_shortcode($content); ?>
		</div>
		<?php 
		$html = ob_get_contents();
	
		ob_end_clean();
	
		return $html;
	}
	
	public function mTheme_tab_titles_shortcode( $atts, $content = null ){
		
		
		
		ob_start(); ?>
	
		<ul id="aellaTab-<?php echo self::$mTheme_tabs; ?>" class="nav nav-tabs" role="tablist">
		<?php  echo do_shortcode($content); ?>
		</ul>
		<?php 
		$html = ob_get_contents();
	
		ob_end_clean();
	
		return $html;
	}
	
	public function mTheme_tab_title_shortcode( $atts, $content = null ){
		
		self::$mTheme_tab_title++;
		
		$atts = shortcode_atts( array(
			'id_content' => '',
			'id' => '',
			'title' => '',
		), $atts );
	
		extract($atts);
		
		ob_start(); ?>
	
		<li role="presentation" class="<?php echo self::$mTheme_tab_title == 1 ? 'active' : ''; ?>">
			<a href="<?php echo '#' . $id_content; ?>" id="<?php echo $id; ?>" role="tab" data-toggle="tab"><?php echo $title; ?></a>
		</li>
		
		<?php 
		$html = ob_get_contents();
	
		ob_end_clean();
	
		return $html;
	}
	
	public function mTheme_tab_contents_shortcode( $atts, $content = null ){
	
	
	
			ob_start(); ?>
		
			<div id="aellaContent-<?php echo self::$mTheme_tabs; ?>" class="tab-content">
			<?php  echo do_shortcode($content); ?>
			</div>
			<?php 
			$html = ob_get_contents();
		
			ob_end_clean();
		
			return $html;
		}
		
		public function mTheme_tab_content_shortcode( $atts, $content = null ){
			
			self::$mTheme_tab_content++;
			
			$atts = shortcode_atts( array(
				'id' => '',
			), $atts );
		
			extract($atts);
			
			ob_start(); ?>
			<div role="tabpanel" class="tab-pane fade <?php echo self::$mTheme_tab_content == 1 ? 'in active' : ''; ?>" id="<?php echo $id; ?>">
				<?php echo do_shortcode($content); ?>
			</div>
			<?php 
			$html = ob_get_contents();
		
			ob_end_clean();
		
			return $html;
		}
}

new mTheme_Sshortcode();