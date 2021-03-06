<?php
/**
 * Header functions.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */
 

/* ---------------------------------------------------------------------------
 * Title
 * --------------------------------------------------------------------------- */
function mfn_title()
{
	$title = false;
	if( mfn_opts_get('mfn-seo') && mfn_ID() ){
		if( get_post_meta( mfn_ID(), 'mfn-meta-seo-title', true ) ){
			$title = stripslashes( get_post_meta( mfn_ID(), 'mfn-meta-seo-title', true ) );
		}
	}
	
	return $title;
}


/* ---------------------------------------------------------------------------
 * Meta and Desctiption
 * --------------------------------------------------------------------------- */
function mfn_seo() 
{
	if( mfn_opts_get('mfn-seo') && mfn_ID() ){

		// description
		if( get_post_meta( mfn_ID(), 'mfn-meta-seo-description', true ) ){
			echo '<meta name="description" content="'. stripslashes( get_post_meta( mfn_ID(), 'mfn-meta-seo-description', true ) ) .'" />'."\n";
		} elseif( mfn_opts_get('meta-description') ){
			echo '<meta name="description" content="'. stripslashes( mfn_opts_get('meta-description') ) .'" />'."\n";
		}
		
		// keywords
		if( get_post_meta( mfn_ID(), 'mfn-meta-seo-keywords', true ) ){
			echo '<meta name="keywords" content="'. stripslashes( get_post_meta( mfn_ID(), 'mfn-meta-seo-keywords', true ) ) .'" />'."\n";
		} elseif( mfn_opts_get('meta-keywords') ){
			echo '<meta name="keywords" content="'. stripslashes( mfn_opts_get('meta-keywords') ) .'" />'."\n";
		}
		
	}

	// google analytics
	if( mfn_opts_get('google-analytics') ){
		mfn_opts_show('google-analytics');
	}
}
add_action('wp_seo', 'mfn_seo');


/* ---------------------------------------------------------------------------
 * Styles
 * --------------------------------------------------------------------------- */
function mfn_styles() 
{
	// wp_enqueue_style ------------------------------------------------------
	wp_enqueue_style( 'style', get_stylesheet_uri(), false, THEME_VERSION, 'all' );
	wp_enqueue_style( 'prettyPhoto', THEME_URI .'/css/prettyPhoto.css', false, THEME_VERSION, 'all' );

	wp_enqueue_style( 'owl-carousel', THEME_URI .'/js/owl-carousel/owl.carousel.css', false, THEME_VERSION, 'all' );
	wp_enqueue_style( 'owl-theme', THEME_URI .'/js/owl-carousel/owl.theme.css', false, THEME_VERSION, 'all' );
	wp_enqueue_style( 'jquery-ui', THEME_URI .'/css/ui/jquery.ui.all.css', false, THEME_VERSION, 'all' );
	
	// Custom Theme Options styles & responsive ------------------------------
	if( mfn_opts_get('responsive') ) wp_enqueue_style( 'responsive', THEME_URI .'/css/responsive.css', false, THEME_VERSION, 'all' );

	if( $_GET && key_exists('mfn-c', $_GET) ){
		$skin = $_GET['mfn-c']; // demo
	} else {
		$skin = mfn_opts_get('skin','custom');
	}
	
	if( $skin == 'custom' ){
		wp_enqueue_style( 'images-green', THEME_URI .'/css/skins/green/images.css', false, THEME_VERSION, 'all' );
		wp_enqueue_style( 'style-colors-php', THEME_URI .'/style-colors.php', false, THEME_VERSION, 'all' );
	} else {
		wp_enqueue_style( 'images-'. $skin, THEME_URI .'/css/skins/'. $skin .'/images.css', false, THEME_VERSION, 'all' );
		wp_enqueue_style( 'skin-'. $skin, THEME_URI .'/css/skins/'. $skin .'/style.css', false, THEME_VERSION, 'all' );
	}
	
	wp_enqueue_style( 'style-php', THEME_URI .'/style.php', false, THEME_VERSION, 'all' );
	
	// Google Fonts ----------------------------------------------------------
	$system_fonts = mfn_fonts('system');
	$webfont_fonts = mfn_fonts('default');
	
	$subset = mfn_opts_get('font-subset');
	if( $subset ){
		$subset = '&amp;subset='. str_replace(' ', '', $subset);
	}
	
	$fonts['content'] = mfn_opts_get( 'font-content', 'Exo' );
	$fonts['menu'] = mfn_opts_get( 'font-menu', 'Exo' );
	$fonts['headings'] = mfn_opts_get( 'font-headings', 'Exo' );
	
	foreach( $fonts as $font ){
		if( in_array( $font, $webfont_fonts ) ){
			$font_slug = strtolower($font);
			wp_enqueue_style( 'webfont-'. $font_slug, THEME_URI .'/fonts/'. $font_slug .'.css', false, THEME_VERSION, 'all' );
		} elseif( ! in_array( $font, $system_fonts ) ){
			$font_slug = str_replace(' ', '+', $font);
			wp_enqueue_style( $font_slug, 'http://fonts.googleapis.com/css?family='. $font_slug .':300,400,400italic,700'. $subset );	
		}
	}
}
add_action( 'wp_enqueue_scripts', 'mfn_styles' );


/* ---------------------------------------------------------------------------
 * Custom Styles
* --------------------------------------------------------------------------- */
function mfn_custom_styles()
{
	// custom.css
	echo '<link rel="stylesheet" href="'. THEME_URI .'/css/custom.css?ver='.THEME_VERSION.'" media="all" />'."\n";
	
	// Thme Options > Custom CSS
	if( $custom_css = mfn_opts_get('custom-css') ){
		echo '<style>'."\n";
		echo $custom_css."\n";
		echo '</style>'."\n";
	}
}
add_action('wp_head', 'mfn_custom_styles');


/* ---------------------------------------------------------------------------
 * IE fix
 * --------------------------------------------------------------------------- */
function mfn_ie_fix() 
{
	if( ! is_admin() )
	{
		echo "\n".'<!--[if lt IE 9]>'."\n";
		echo '<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>'."\n";
		echo '<![endif]-->'."\n";
		
		echo '<!--[if lte IE 8]>'."\n";
		echo '<link rel="stylesheet" href="'. THEME_URI .'/css/ie8.css" />'."\n";
		echo '<![endif]-->'."\n\n";	
	}	
}
add_action('wp_head', 'mfn_ie_fix');


/* ---------------------------------------------------------------------------
 * Scripts
 * --------------------------------------------------------------------------- */
function mfn_scripts() 
{
	if( ! is_admin() ) 
	{
		wp_enqueue_script( 'jquery-ui-core', THEME_URI .'/js/ui/jquery.ui.core.js', false, THEME_VERSION, true );
		wp_enqueue_script( 'jquery-ui-widget', THEME_URI .'/js/ui/jquery.ui.widget.js', false, THEME_VERSION, true );
		wp_enqueue_script( 'jquery-ui-tabs', THEME_URI .'/js/ui/jquery.ui.tabs.js', false, THEME_VERSION, true );
		wp_enqueue_script( 'jquery-ui-accordion', THEME_URI .'/js/ui/jquery.ui.accordion.js', false, THEME_VERSION, true );

		wp_enqueue_script( 'owl-carousel', THEME_URI. '/js/owl-carousel/owl.carousel.min.js', false, THEME_VERSION, true );
		wp_enqueue_script( 'jquery-swiper', THEME_URI. '/js/jquery.swiper.min.js', false, THEME_VERSION, true );

		wp_enqueue_script( 'jquery-plugins', THEME_URI. '/js/jquery.plugins.js', false, THEME_VERSION, true );
		wp_enqueue_script( 'jquery-mfn-menu', THEME_URI. '/js/mfn.menu.js', false, THEME_VERSION, true );
		wp_enqueue_script( 'jquery-mfn-fsa', THEME_URI. '/js/mfn.fsa.js', false, THEME_VERSION, true );	
		
		// sliders config -----------------------------
		mfn_slider_config();
		wp_enqueue_script( 'jquery-scripts', THEME_URI. '/js/scripts.js', false, THEME_VERSION, true );

		if ( is_singular() && get_option( 'thread_comments' ) ){ 
			wp_enqueue_script( 'comment-reply' ); 
		}
	}
}
add_action('wp_enqueue_scripts', 'mfn_scripts');


/* ---------------------------------------------------------------------------
 * Retina logo
* --------------------------------------------------------------------------- */
function mfn_retina_logo()
{
	$retina_logo = mfn_opts_get('retina-logo-img');
	$retina_logo_width = intval( mfn_opts_get('retina-logo-width') );
	$retina_logo_height = intval( mfn_opts_get('retina-logo-height') );

	if( $retina_logo && $retina_logo_width && $retina_logo_height ){
		echo '<script>'."\n";
		echo '//<![CDATA['."\n";
			echo 'jQuery(document).ready(function(){'."\n";
				echo 'var retina=window.devicePixelRatio>1?true:false;';
				echo 'if(retina){';
					echo 'jQuery("#logo img")';
					echo '.attr("src","'. $retina_logo .'")';
					echo '.attr("width","'. $retina_logo_width .'")';
					echo '.attr("height","'. $retina_logo_height .'");';
				echo '}';
				echo '});'."\n";
			echo '//]]>'."\n";
		echo '</script>'."\n";
	}
}
add_action('wp_head', 'mfn_retina_logo');


/* ---------------------------------------------------------------------------
 * Slider configuration
* --------------------------------------------------------------------------- */
function mfn_slider_config()
{	
	// Vertical
	$args_vertical = array(
		'autoplay'	=> intval( mfn_opts_get( 'slider-vertical-auto' ) ),
	);
	
	// Offer
	$args_offer = array(
		'autoPlay'	=> intval( mfn_opts_get( 'slider-offer-auto' ) ),
	);
	
	// Portfolio
	$args_portfolio = array(
		'autoPlay'	=> intval( mfn_opts_get( 'slider-portfolio-auto' ) ),
	);

	echo '<script>'."\n";
	echo '//<![CDATA['."\n";
	
	echo 'window.mfn_slider_vertical	= { autoplay:'. (int)$args_vertical['autoplay'] .' 	};'."\n";
	echo 'window.mfn_slider_offer 		= { autoPlay:'. (int)$args_offer['autoPlay'] .' 	};'."\n";
	echo 'window.mfn_slider_portfolio 	= { autoPlay:'. (int)$args_portfolio['autoPlay'] .' };'."\n";
	
	echo '//]]>'."\n";
	echo '</script>'."\n";
}


/* ---------------------------------------------------------------------------
 * Adds classes to the array of body classes.
 * --------------------------------------------------------------------------- */
function mfn_sidebar_classes( $postID = false )
{
	global $post;
	$classes = false;
	
	if( is_object($post) ){
		
		if( intval( $postID ) ){
			// do nothing, use $postID
		} elseif( is_tax() ){
			// taxonomy-portfolio-types.php
			$postID = mfn_opts_get( 'portfolio-page' );
		} elseif( get_post_type()=='post' && ! is_singular() ){
			// index.php
			$postID = get_option( 'page_for_posts' );
		} else {
			$postID = get_the_ID();
		}
		
		switch ( get_post_meta( $postID, 'mfn-post-layout', true) ) {
			case 'left-sidebar':
				$classes = ' with_aside aside_left';
				break;
			case 'right-sidebar':
				$classes = ' with_aside aside_right';
				break;
		}
		
		if( $_GET && key_exists('mfn-s', $_GET) ) $classes = ' with_aside aside_right';; // demo
	}

	return $classes;
}

function mfn_body_classes( $classes )
{
	// template-slider
	if( ! is_404() && get_post_type()=='page' && $slider = get_post_meta( get_the_ID(), 'mfn-post-slider', true ) ){
		if( $slider == 'mfn-offer-slider' ){
			$classes[] = 'template-offer-slider';
		} else {
			$classes[] = 'template-slider';
		} 
	}
	
	// sidebar classes
	$classes[] = mfn_sidebar_classes();
	
	// theme layout
	if( $_GET && key_exists('mfn-box', $_GET) ){
		$classes[] = 'layout-boxed'; // demo
	} else {
		$classes[] = 'layout-'. mfn_opts_get('layout','full-width');
	}
	
	// header layout
	if( $_GET && key_exists('mfn-h', $_GET) ){
		$classes[] = 'header-'. $_GET['mfn-h']; // demo
	} else {
		$classes[] = 'header-'. mfn_opts_get('header-layout','mt');
	}
	
	// header white mod
	if( $_GET && key_exists('mfn-dark', $_GET) ){ 
		$classes[] = 'header-dark-mod'; // demo
	} else {
		if( mfn_opts_get('header-white-mod') ) $classes[] = 'header-white-mod';
	}
	
	// sticky menu
	if( mfn_opts_get('sticky-header') ){
		$classes[] = 'sticky-header';
	}
	
	// demo
	if( $_GET && key_exists('mfn-c', $_GET) ) $classes[] = 'color-'. $_GET['mfn-c'];

	return $classes;
}
add_filter( 'body_class', 'mfn_body_classes' );


/* ---------------------------------------------------------------------------
 * Annoying styles remover
 * --------------------------------------------------------------------------- */
function mfn_remove_recent_comments_style() {  
    global $wp_widget_factory;  
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}  
add_action( 'widgets_init', 'mfn_remove_recent_comments_style' ); 

?>