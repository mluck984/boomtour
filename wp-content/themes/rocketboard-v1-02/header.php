<!DOCTYPE html>

<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->

<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->

<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>



	<!-- Basic Page Needs

  ================================================== -->

	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<title><?php bloginfo('name'); ?>  <?php wp_title(); ?></title>



	<!--[if lt IE 9]>

		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

	<![endif]-->



	<!-- CSS

  ================================================== -->

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />

	<link rel="stylesheet" href="wp-content/themes/rocketboard-v1-02/stylesheet/magnific-popup.css"/>
    
	<link rel="stylesheet" href="wp-content/themes/rocketboard-v1-02/stylesheet/jquery-ui.min.css"/> 
    
	<link rel="stylesheet" href="wp-content/themes/rocketboard-v1-02/stylesheet/bigvideo.css"/> 
	

	<?php global $gdl_is_responsive ?>

	<?php if( $gdl_is_responsive ){ ?>

		<meta name="viewport" content="width=device-width, user-scalable=no">

		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/foundation-responsive.css">

	<?php }else{ ?>

		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/foundation.css">

	<?php } ?>

	

	<!--[if IE 7]>

		<link rel="stylesheet" href="<?php echo GOODLAYERS_PATH; ?>/stylesheet/ie7-style.css" /> 

	<![endif]-->	

	

	<?php

	

		// include favicon in the header

		if(get_option( THEME_SHORT_NAME.'_enable_favicon','disable') == "enable"){

			$gdl_favicon = get_option(THEME_SHORT_NAME.'_favicon_image');

			if( $gdl_favicon ){

				$gdl_favicon = wp_get_attachment_image_src($gdl_favicon, 'full');

				echo '<link rel="shortcut icon" href="' . $gdl_favicon[0] . '" type="image/x-icon" />';

			}

		} 

		

		// add facebook thumbnail to this page

		$thumbnail_id = get_post_thumbnail_id();

		if( !empty($thumbnail_id) ){

			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );

			echo '<link rel="image_src" href="' . $thumbnail[0] . '" />';		

		}

		// start calling header script

		wp_head();		



	?>
    
	<script src="wp-content/themes/rocketboard-v1-02/javascript/jquery-1.10.2.min.js"></script>
	<script src="wp-content/themes/rocketboard-v1-02/javascript/jquery-ui.min.js"></script>
	<script src="wp-content/themes/rocketboard-v1-02/javascript/masonry.js"></script>
	<script src="wp-content/themes/rocketboard-v1-02/javascript/video.js"></script>
	<script src="wp-content/themes/rocketboard-v1-02/javascript/bigvideo.js"></script>

</head>

<body <?php echo body_class(); ?>>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-548CQ7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-548CQ7');</script>
<!-- End Google Tag Manager -->

<?php

	// print custom background

	$background_style = get_option(THEME_SHORT_NAME.'_background_style', 'Pattern');

	if($background_style == 'Custom Image'){

		$background_id = get_option(THEME_SHORT_NAME.'_background_custom');

		$alt_text = get_post_meta($background_id , '_wp_attachment_image_alt', true);

		

		if(!empty($background_id)){

			$background_image = wp_get_attachment_image_src( $background_id, 'full' );

			echo '<div class="gdl-custom-full-background">';

			echo '<img src="' . $background_image[0] . '" alt="' . $alt_text . '" />';

			echo '<div class="custom-background-overlay" ></div>';

			echo '</div>';

		}

	}else if($background_style == 'Predefined Image'){

		$background_id = get_option(THEME_SHORT_NAME.'_predefined_background');

		echo '<div class="gdl-custom-full-background">';

		echo '<img src="' . GOODLAYERS_PATH . '/images/background/bg-' . $background_id . '.jpg" alt="" />';

		echo '<div class="custom-background-overlay" ></div>';

		echo '</div>';

	}

?>

<div class="body-outer-wrapper">
	
    <div class="header-video">
<!--        <video autoplay loop poster="polina.jpg" id="bgvid">
        <source src="wp-content/themes/rocketboard-v1-02/assets/road.mp4" type="video/mp4">
        </video>-->
    </div>
    
	<div class="header-navigation-wrapper">

		<div class="header-navigation-container container">

		
			            
			<img id="bcp-logo" src="wp-content/themes/rocketboard-v1-02/images/AngiesBCP_logo.png" />

			<!-- Get Logo -->

			<div class="logo-wrapper">

			<?php

				$logo_id = get_option(THEME_SHORT_NAME.'_logo');

				if( empty($logo_id) ){	

					$alt_text = 'default-logo';	

					$logo_attachment = GOODLAYERS_PATH . '/images/default-logo.png';

				}else{

					$alt_text = get_post_meta($logo_id , '_wp_attachment_image_alt', true);	

					$logo_attachment = wp_get_attachment_image_src($logo_id, 'full');

					$logo_attachment = $logo_attachment[0];

				}



				if( is_front_page() ){

					echo '<h1><a href="'; 

					echo home_url();

					echo '"><img src="' . $logo_attachment . '" alt="' . $alt_text . '"/></a></h1>';	

				}else{

					echo '<a href="'; 

					echo home_url();

					echo '"><img src="' . $logo_attachment . '" alt="' . $alt_text . '"/></a>';				

				}			

			?>
            
			</div>
            
    
            <div class="header-text">
                <h1>Welcome to the Boom Tour<sup>™</sup>!</h1>
                <h3>Bringing the Boom is what we do. We're out on a fantastical 
adventure across the U.S. of A! Join us for the road trip of the summer.</h3>
            </div>

			<div class="gdl-navigation-wrapper">

			<?php

				// responsive menu

				if( $gdl_is_responsive && has_nav_menu('main_menu') ){

					dropdown_menu( array('dropdown_title' => '-- Main Menu --', 'indent_string' => '- ', 'indent_after' => '','container' => 'div', 'container_class' => 'responsive-menu-wrapper', 'theme_location'=>'main_menu') );	

				}

				

				// main menu

				echo '<div class="navigation-wrapper">';

				echo '<div class="gdl-current-menu"></div>';

				if( has_nav_menu('main_menu') ){

					wp_nav_menu( array('container' => 'div', 'container_class' => 'menu-wrapper', 'container_id' => 'main-superfish-wrapper', 'menu_class'=> 'sf-menu',  'theme_location' => 'main_menu' ) );

				}

				echo '<div class="clear"></div>';

				echo '</div>'; // navigation-wrapper 

			?>

			</div>	

			<div class="clear"></div>	

			<?php

				if( get_option(THEME_SHORT_NAME . '_enable_top_search', 'enable') == 'enable' ){

					echo '<div class="top-search-wrapper">';

					get_search_form();

					echo '</div>';

				}	

			?>

		</div>

	</div>

	<div class="body-wrapper boxed-style">

		<div class="content-wrapper container main">