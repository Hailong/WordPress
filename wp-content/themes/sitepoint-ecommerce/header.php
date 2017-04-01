<?php
session_start();
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="maincontentcontainer">
 *
 * @package SitePoint Ecommerce
 * @since SitePoint Ecommerce 1.0
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

	<?php wp_head(); ?>
</head>


<?php $queried_object = get_queried_object(); ?>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed site">
	<div class="visuallyhidden skip-link"><a href="#primary"><?php esc_html_e( 'Skip to main content', 'sitepoint-base' ); ?></a></div>
	<div id="headercontainer">
		<header id="masthead" class="grid-container site-header" role="banner">

			<div class="grid-30 tablet-grid-40 site-title">

				<?php SitePoint_Ecommerce_the_custom_logo() ?>
			</div> <!-- /.grid-40.site-title -->

			<div class="grid-70 tablet-grid-60">
				<div class="right-nav">
					<!-- cart -->
					<div class="cart">
						<!-- cart icon -->
						<a href="<?php echo wc_get_cart_url(); ?>"><i class="fa-shopping-cart fa"></i></a>
						<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>  -  <?php echo WC()->cart->get_cart_total(); ?></a>

					</div>

					<div class="nav-wrapper hidden-mobile">
						<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu',  'menu_id' => 'large-id','menu_class' => 'navigation nav-menu', 'container_class' => 'navigation_container' ) ); ?>
					</div>

						<div class="site-menu-mobile">
							<nav  class="main-navigation" role="navigation">
								<h3 class="menu-toggle close-menu">
									<i class="fa fa-bars" aria-hidden="true"></i>
									<i class="fa fa-close" aria-hidden="true"></i>
								</h3>
								<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'sitepoint-base' ); ?>"><?php esc_html_e( 'Skip to content', 'sitepoint-base-theme' ); ?></a></div>
									<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_id' => 'mobile-menu-id','menu_class' => 'navigation nav-menu', 'container_class' => 'navigation_container' ) ); ?>
							</nav> <!-- /.site-navigation.main-navigation -->
						</div>

				</div>
			</div> <!-- /.grid-60 -->
		</header> <!-- /#masthead.grid-container.site-header -->

	</div> <!-- /#headercontainer -->

	<?php
		if(is_front_page()){  ?>
			<?php if(function_exists('register_field_group')) : ?>

				<?php
				if($queried_object) {
					$banner =  get_field('front_page_banner', $queried_object->ID );
					$bannerText =  get_field('banner_caption', $queried_object->ID );
				}else{
					$banner =  get_field('front_page_banner');
					$bannerText =  get_field('banner_caption');
				}
				?>

				<div id="bannercontainer">
					<div class="gray-bg"></div>

					<div class="banner">

							<div class="<?php echo ($bannerText)? "filtered" : "" ?> header-image" style="background: url('<?php echo $banner['url'] ?>');background-size: cover; background-repeat: no-repeat;background-position: center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
							</div>
							<!-- header image caption -->
							<?php if($bannerText): ?>
								<div class="banner-caption">
										<?php echo $bannerText ?>
								</div>
							<?php endif; ?>

					</div> <!-- /.banner.grid-container` -->

				</div> <!-- /#bannercontainer -->
			<?php endif; ?>
		<?php }elseif(is_home()) { ?>
			<?php $banner = get_field('banner', $queried_object->ID); ?>
			<?php if($banner) : ?>
			<div id="bannercontainer">
				<div class="gray-bg"></div>

				<div class="banner">
						<div class="filtered header-image" style="background: url('<?php echo $banner['url'] ?>');background-size: cover; background-repeat: no-repeat;background-position: center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
						</div>
						<!-- header image caption -->
							<div class="banner-caption">
									<h1><?php echo $queried_object->post_title ?></h1>
							</div>
				</div> <!-- /.banner.grid-container` -->



			</div> <!-- /#bannercontainer -->
			<?php endif; ?>
		<?php }else{ ?>
			<?php $banner = get_field('banner'); ?>
			<?php if($banner) : ?>
			<div id="bannercontainer">
				<div class="gray-bg"></div>

				<div class="banner">
						<div class="filtered header-image" style="background: url('<?php echo $banner['url'] ?>');background-size: cover; background-repeat: no-repeat;background-position: center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
						</div>
						<!-- header image caption -->
							<div class="banner-caption">
									<h1><?php the_title() ?></h1>
							</div>
				</div> <!-- /.banner.grid-container` -->


			</div> <!-- /#bannercontainer -->
		<?php endif; ?>
		<?php }?>

		<?php if($queried_object) : ?>

				<div class="caption-container <?php echo (isset($_GET['s']))? '' : '' ?> <?php echo ($post)? '' : '' ?>">

						<?php if(!is_front_page()) : ?>
							<div class="banner-caption">
									<?php echo ucfirst($queried_object->name) ?>
							</div>
						<?php endif; ?>


					<?php if(function_exists("register_field_group")) :  ?>
						<?php
							if(is_front_page()){
								$catBanner = get_field('banner', $queried_object->ID);
							}else{
								$catBanner = get_field('category_banner', $queried_object->taxonomy.'_'.$queried_object->term_id);
							}
						 ?>
						<?php if($catBanner) : ?>

							<div id="bannercontainer" class="category-banner">
								<div class="gray-bg"></div>
								<div class="banner">
										<div class="filtered header-image" style="background: url('<?php echo $catBanner['url'] ?>');background-size: cover; background-repeat: no-repeat;background-position: center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
										</div>
								</div> <!-- /.banner.grid-container` -->
							</div> <!-- /#bannercontainer -->

						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>



	<div class="grid-container secondary-menu row">
		<div class="second-menu-wrapper">

		</div>
	</div>
	<?php	do_action( 'SitePoint_Ecommerce_before_woocommerce' ); ?>
