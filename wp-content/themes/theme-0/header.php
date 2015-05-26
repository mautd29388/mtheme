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
	
<?php if ( is_page_template('page-templates/page-contact.php') ) { 
	$LatLng = ot_get_option('latlng_contact');
	$desc_contact = ot_get_option('desc_contact');
	?>
<script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js">
</script>
<script type="text/javascript">
	var map;
	var grayStyles = [ {
		featureType : "all",
		stylers : [ {
			saturation : -100
		}, {
			lightness : 47
		}, {
			gamma : 0.34
		} ]
	}, ];
	var mapOptions = {
		center : new google.maps.LatLng(<?php echo $LatLng; ?>),
		zoom : 16,
		styles : grayStyles,
	};

	function initialize() {
		map = new google.maps.Map(document.getElementById("map_canvas"),
				mapOptions);

		var marker = new google.maps.Marker({
			map : map,
			position : map.getCenter()
		});

		var infowindow = new google.maps.InfoWindow();
		infowindow.setContent('<?php echo $desc_contact; ?>');
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map, marker);
		});
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php } ?>

<?php 

$typography = ot_get_option('typography');

if ( isset($typography) && is_array($typography) && count($typography) > 0 ) {
	if ( isset($typography['font-family']) && !empty($typography['font-family']) ) {
		$google_font = mTheme_ot_google_font_stack( array(), $typography['font-family'] );
		$typography['font-family'] = $google_font[$typography['font-family']];
	}
	
	$style = array();
	
	if ( isset($typography['font-color']) && !empty($typography['font-color']) ) {
		$style[] = 'color' . ':' . $typography['font-color'];
		unset($typography['font-color']);
	}
	
	foreach ( $typography as $k => $val ) {
	
		if ( !empty($val) )
			$style[] = $k . ':' . $val;
	}
	
	$style = implode(';', $style);
	?>
	<style type="text/css">
	body{
		<?php echo $style; ?>
	}
	</style>
	
<?php } ?>

</head>
<?php 
$logo_default = trailingslashit(get_template_directory_uri()) . 'assets/imgs/logo.png';
$logo = ot_get_option('logo', $logo_default);

$style = ot_get_option('style', 'style_v1');
$style_home = get_post_meta( get_the_ID(), '__style', true);

if ( is_page_template('page-templates/page-home.php') && isset($style_home) && !empty($style_home) )
	$style = $style_home;

if ( isset($logo) && $logo == $logo_default ) {
		
	if ( $style == 'style_v2' || $style == 'style_v3' ) {
		$logo = trailingslashit(get_template_directory_uri()) . 'assets/imgs/logo_v2.png'; 
	
	} elseif ( $style == 'style_v4' )
		$logo = trailingslashit(get_template_directory_uri()) . 'assets/imgs/logo_v4.png';
}

?>
<body <?php body_class(); ?>>
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	<div id="wrap" class="clearfix">

		<!-- Header -->
		<header class="header">

			<div id="logo">
				<a href="<?php echo esc_url( home_url() ); ?>">
					<?php if ( isset($logo) ) { ?>
						<img alt="" src="<?php echo $logo; ?>">
					<?php } else echo bloginfo('name'); ?>
				</a>
			</div>

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
						<h3 class="navbar-brand">Menu</h3>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<?php 
						wp_nav_menu ( 
							array ( 
								'theme_location' => 'primary',
								'container' => '',
								'menu_class' => 'nav'
							) 
						);
						?>
					</div>
					<!--/.navbar-collapse -->
				</div>
			</nav>
			<!-- End Main Menu -->

		</header>
		<!-- End Header -->

		<!-- Main Content -->
		<div id="main-content" class="main-content">
	