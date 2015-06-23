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
$style = '';

if ( is_page() && !is_front_page() ) {

	$__background = get_post_meta(get_the_ID(), '__background', true);
	$background = array();
	if ( is_array($__background) && count($__background) > 0 ) {
		foreach ( $__background as $k => $val ) {
		
			if ( $k == 'background-image' )
				$background[] = $k . ': url(' . $val . ')';
		
			else
				$background[] = $k . ':' . $val;
		}
	}
	
	$style .= '.bannercontainer { min-height: 650px;' ;
	$style .= implode(';', $background);
	$style .= '}';
}
?>

<style type="text/css">
<?php echo $style; ?>
</style>
</head>

<body <?php body_class(); ?>>
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	<div id="wrap" class="clearfix">
	
		<div class="header-holder">
			<div class="container">
				<div class="row header">
					<div class="col-md-2 logo align-c">
						<div class="inner-top-bottom-20">
            			<?php $logo = ot_get_option('logo'); ?>
             				<h1 class="no-margin">
								<a href="<?php echo esc_url( home_url() ); ?>">
									<?php if ( isset($logo) && !empty($logo) ) { ?>
									<img alt="" src="<?php echo $logo; ?>">
									<?php } else echo bloginfo('name'); ?>
								</a>
							</h1>
						</div>
						<!-- /.inner-top-bottom-10 -->
					</div>
					<!-- /.col-md-2 logo -->
					<div class="col-md-10 col-md-xs-12 navigation-holder">
						<div class="inner-top-bottom-10 ">
							<span class="open-navigation js-open-navigation"> Navigation </span>
               					<?php
								wp_nav_menu ( array (
										'theme_location' => 'primary',
										'container' => '',
										'menu_class' => 'main-navigation' 
								) );
								?>
            			</div>
						<!-- /.inner-top-bottom-10 -->
					</div>
					<!-- /.col-md-10 align-r -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</div>
		<!-- /.header-holder absolute -->
    
	    <?php if ( is_front_page() && is_active_sidebar('slider') ) { ?>
	    <div class="bannercontainer">
	    	<?php dynamic_sidebar('slider'); ?>
	    </div>
	    <?php } elseif ( !is_front_page() ) { ?>
	    <div class="bannercontainer">
		    <?php if ( is_active_sidebar('top-content') && !is_front_page() ) { ?>
		    <div id="top-content" class="top-content">
				<div class="container">
					<?php dynamic_sidebar('top-content'); ?>
				</div>
			</div>
			<?php } ?>
	    </div>
	    <?php } ?>
		
		<!-- Main Content -->
		<div id="main-content" class="main-content">