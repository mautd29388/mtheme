<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/html5.js"></script>
	<![endif]-->
	
<script>(function(){document.documentElement.className='js'})();</script>
	<?php wp_head(); ?>
	
<?php 
global $post;

$style = '';

$typography = ot_get_option('typography');
if ( isset($typography) && is_array($typography) && count($typography) > 0 ) {
	if ( isset($typography['font-family']) && !empty($typography['font-family']) ) {
		$google_font = mTheme_ot_google_font_stack( array(), $typography['font-family'] );
		$typography['font-family'] = $google_font[$typography['font-family']];
	}
	
	$body_style = array();
	
	if ( isset($typography['font-color']) && !empty($typography['font-color']) ) {
		$body_style[] = 'color' . ':' . $typography['font-color'];
		unset($typography['font-color']);
	}
	
	foreach ( $typography as $k => $val ) {
	
		if ( !empty($val) )
			$body_style[] = $k . ':' . $val;
	}
	
	$style .= 'body{' . implode(';', $body_style) . '}';
 } 

if ( !empty( $style ) ) { ?>
	<style type="text/css">
		<?php echo $style; ?>
	</style>
<?php } ?>
	
</head>
<?php $logo = ot_get_option('logo'); ?>
<body <?php body_class(); ?>>
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	<div id="wrap" class="clearfix">

		<!-- Main Menu -->
		<nav id="primary-navigation" class="navbar" role="navigation">
			<div class="navbar-inner">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#navbar">
						<span class="sr-only">Toggle navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
						<?php if ( isset($logo) && !empty($logo) ) { ?>
							<img alt="" src="<?php echo $logo; ?>">
						<?php } else echo bloginfo('name'); ?>
					</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<?php 
					wp_nav_menu ( 
						array ( 
							'theme_location' => 'primary',
							'container' => '',
							'menu_class' => 'nav navbar-nav navbar-right'
						) 
					);
					?>
				</div>
				<!--/.navbar-collapse -->
			</div>
		</nav>
		
		
		<!-- Main Content -->
		<div id="main-content" class="main-content">
	