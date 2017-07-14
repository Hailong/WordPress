<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="maincontentcontainer">
 *
 * @package SitePoint Business
 * @since SitePoint Business 1.0
 */
?><!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta http-equiv="cleartype" content="on">

	<!-- Responsive and mobile friendly stuff -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<style type="text/css">
	    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
	    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
	</style>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed site">

	<div class="visuallyhidden skip-link"><a href="#primary"><?php esc_html_e( 'Skip to main content', 'sitepoint-business' ); ?></a></div>

	<div id="headercontainer">

		<header id="masthead" class="grid-container site-header" role="banner">
			<div class="grid-40 tablet-grid-40 mobile-grid-70 site-title">
				<?php sitepoint_business_the_custom_logo() ?>
			</div> <!-- /.grid-40.site-title -->

			<div class="grid-60 tablet-grid-60 mobile-grid-100">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'sitepoint-business' ); ?>"><?php esc_html_e( 'Skip to content', 'sitepoint-business' ); ?></a></div>
						<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_class' => 'navigation nav-menu', 'container_class' => 'navigation_container' ) ); ?>
				</nav> <!-- /.site-navigation.main-navigation -->

				<!-- /. slicknav mobile will be appended here-->
				<div class="menu-mobile"></div>
			</div> <!-- /.grid-60 -->

		</header> <!-- /#masthead.grid-container.site-header -->
	</div> <!-- /#headercontainer -->

<div class="sticky-spacer">

</div>


	<?php	do_action( 'sitepoint_business_before_woocommerce' ); ?>
