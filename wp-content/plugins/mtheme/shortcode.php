<?php

class mTheme_Sshortcode {
		
	
	public function __construct(){
		
		add_shortcode('mTheme_classes', array(	$this, 'mTheme_classes_shortcode'));
		add_shortcode('mTheme_classes_news', array(	$this, 'mTheme_classes_news_shortcode'));
		add_shortcode('mTheme_upcoming_classes', array(	$this, 'mTheme_upcoming_classes_shortcode'));
		/*
		add_shortcode('mTheme_team', array(	$this, 'mTheme_team_shortcode'));
		add_shortcode('mTheme_portfolio', array(	$this, 'mTheme_portfolio_shortcode'));
		add_shortcode('mTheme_testimonials', array( $this, 'mTheme_testimonials_shortcode') );
		add_shortcode('mTheme_tabs', array( $this, 'mTheme_tabs_shortcode' ));
		add_shortcode('mTheme_tab_titles', array( $this, 'mTheme_tab_titles_shortcode' ));
		add_shortcode('mTheme_tab_title', array( $this, 'mTheme_tab_title_shortcode' ));
		add_shortcode('mTheme_tab_contents', array( $this, 'mTheme_tab_contents_shortcode' ));
		add_shortcode('mTheme_tab_content', array( $this, 'mTheme_tab_content_shortcode' ));
		*/
		
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
		
		$atts = shortcode_atts( array(
					'style' => ot_get_option('portfolio_style', 'style_v1'),
					'posts_per_page' => ot_get_option('portfolio_posts_per_page', 12),
				),
				$atts );
		
		
		$portfolio['style'] = $atts['style'];
		
		$args = array(
				'post_type' => 'mportfolio',
				'posts_per_page' => $atts['posts_per_page'],
		);
	
			
		$portfolio['query'] = new WP_Query( $args );
	
		$portfolio['next_posts'] = mTheme_get_post_type_archive_pagenum_link( 'mportfolio', $portfolio['query']->max_num_pages, 2);
		
		ob_start();
	
		get_template_part('contents/portfolio', '');
	
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
	
	/**
	 * Classes
	 */
	public function mTheme_classes_shortcode( $atts ){
	
		global $classes;
	
		$atts = shortcode_atts( array(
		), $atts );
	
		$week_next	= strtotime( "next monday" );
		$week_start	= strtotime( "previous monday" );
		$week_previous	= strtotime( "-7days today");
		
		if ( $week_start == $week_previous ) {
			$week_start = strtotime( "today" );
		}
		
		$args = array(
				'post_type' => 'mclasses',
				'posts_per_page' => '-1',
				'meta_query' => array(
						'relation' => 'AND',
						array(
								'key'		=> '__start',
								'value'		=> date('Y-m-d', $week_next),
								'type'		=> 'DATE',
								'compare'	=> '<',
						),
						array(
								'key'		=> '__end',
								'value'		=> date('Y-m-d', $week_start),
								'type'		=> 'DATE',
								'compare'	=> '>=',
						),
				),
		);
	
			
		$classes['query'] = new WP_Query( $args );
	
		ob_start();
		
		get_template_part('contents/shortcodes/classes', '');
	
		$html = ob_get_contents();
	
		ob_end_clean();
	
		wp_reset_postdata();
	
		return $html;
	}
	
	function mTheme_classes_news_shortcode($atts) {
		global $classes;

		$atts = shortcode_atts( array(
			'posts_per_page'	=> '4',
			'class_name'		=> '',
		), $atts );
		
		$args = array(
				'post_type' => 'mclasses',
				'posts_per_page' => $atts['posts_per_page'],
		);
		
		$classes['instance'] = $atts;
		
		$classes['query'] = new WP_Query( $args );
		
		ob_start();
		
		get_template_part('contents/shortcodes/classes-news', '');
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		wp_reset_postdata();
		
		return $html;
	}
	
	function mTheme_upcoming_classes_shortcode( $atts ) {
		
		global $upcoming_classes;
		
		$atts = shortcode_atts( 
				array(
						'number' => '4',
						'style' => 'style_v1',
				),
		$atts );
		
		$tomorrow	= strtotime( "tomorrow" );
		$now 		= strtotime("now");
		
		$query_args = array(
				'post_type' => 'mclasses',
				'posts_per_page' => '-1',
				'meta_query' => array(
						'relation' => 'AND',
						array(
								'key'		=> '__start',
								'value'		=> date('Y-m-d', $now),
								'type'		=> 'DATE',
								'compare'	=> '<',
						),
						array(
								'key'		=> '__end',
								'value'		=> date('Y-m-d', $tomorrow),
								'type'		=> 'DATE',
								'compare'	=> '>',
						),
				),
		);
		
			
		$upcoming_classes['query'] = new WP_Query( $query_args );
		
		$upcoming_classes['instance'] = $atts;
		
		ob_start();
		
		get_template_part('contents/shortcodes/upcoming-classes', '');
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		wp_reset_postdata();
		
		return $html;
	}
	
}

new mTheme_Sshortcode();