<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id #maincontentcontainer div and all content after.
 * There are also four footer widgets displayed. These will be displayed from
 * one to four columns, depending on how many widgets are active.
 *
 * @package SitePoint Ecommerce
 * @since SitePoint Ecommerce 1.0
 */
?>
	<?php	do_action( 'SitePoint_Ecommerce_after_woocommerce' ); ?>

<?php
// initialize created function
	$shortcode = get_option('mailchimp_option');
// if has mailchimp shortcode. this section will show. else this section will remove
if(is_front_page()):
 if($shortcode['shortcode']) : ?>
 <?php $MailChimpOpt = get_field('mailchimp_option', get_option('page_on_front')); ?>
	<?php if($MailChimpOpt) : ?>

	<section class="guest-list">
		<div class="grid-container">
				<div class="grid-100">
					<!-- mailchimp -->
						<?php echo do_shortcode($shortcode['shortcode']) ?>
						<div class="spacer30">
						</div>
				</div>
		</div>
	</section>

<?php endif; ?>
<?php endif;endif ?>

	<div id="footercontainer" class="footer">

		<div class="spacer30">
		</div>

		<div class="grid-container smallprint">
			<div class="grid-50 row tablet-grid-50">
				<h3><?php echo get_bloginfo( 'name' ) ?></h3>
				<hr>

				<div class="grid-40 row">

					<?php if(get_theme_mod('SitePoint_Ecommerce_footer_address') ){
						echo "<p class='address'>",get_theme_mod('SitePoint_Ecommerce_footer_address'),"</p>";
					}	?>

				</div>

				<div class="grid-60 row">
					<p>
						<?php if(get_theme_mod('SitePoint_Ecommerce_footer_contact_email') ){ ?>
							<a href="mailto:<?php echo get_theme_mod('SitePoint_Ecommerce_footer_contact_email') ?>"><?php echo get_theme_mod('SitePoint_Ecommerce_footer_contact_email') ?></a>
						<?php }	?>
						<br>
						<?php if(get_theme_mod('SitePoint_Ecommerce_footer_contact_tel') ){ ?>
							<a href="mailto:<?php echo get_theme_mod('SitePoint_Ecommerce_footer_contact_tel') ?>"><?php echo get_theme_mod('SitePoint_Ecommerce_footer_contact_tel') ?></a></p>
						<?php }	?>
					</p>



				</div>
				<?php if(get_theme_mod('SitePoint_Ecommerce_facebook') || get_theme_mod('SitePoint_Ecommerce_pinterest') || get_theme_mod('SitePoint_Ecommerce_instagram') ) : ?>
					<div class="grid-100 row social-media-wrapper">
						<ul class="social-media">
							<li>Be Social:</li>
							<?php if(get_theme_mod('SitePoint_Ecommerce_facebook')): ?>
								<li><a href="http://facebook.com/<?php echo esc_html(get_theme_mod('SitePoint_Ecommerce_facebook')); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<?php endif; ?>

							<?php if(get_theme_mod('SitePoint_Ecommerce_pinterest')): ?>
								<li><a href="http://pinterest.com/<?php echo esc_html(get_theme_mod('SitePoint_Ecommerce_pinterest')); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
							<?php endif ?>

							<?php if(get_theme_mod('SitePoint_Ecommerce_instagram')): ?>
								<li><a href="http://instagram.com/<?php echo esc_html(get_theme_mod('SitePoint_Ecommerce_instagram')); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
							<?php endif ?>
						</ul>
					</div>
				<?php endif; ?>

			</div>
			<div class="grid-20 row tablet-grid-10">
			<!-- offset -->
			&nbsp;
			</div>

			<div class="grid-30 row tablet-grid-40">
				<?php if(function_exists('register_field_group')) : ?>
					<?php if (get_field('footer_right_title', get_option('page_on_front'))) : ?>
						<h3><?php echo get_field('footer_right_title', get_option('page_on_front')) ?></h3>
						<hr>
					<?php endif; ?>
				<?php endif; ?>


				<!-- widget for faq here -->
				<div class="other-links">
						<?php wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'menu_class' => '',
								'container_class' => 'navigation_container'
						) ); ?>


				</div>
				<div class="grid-100 row tablet-grid-100 mobile-grid-100 payment-option">

				<?php if(function_exists('register_field_group')) :
					$frontPageID  = get_option('page_on_front');
					?>
					<p><?php echo get_field('extra_text', $frontPageID) ?></p>
					<?php
					$cards = get_field('cards', $frontPageID);
					 ?>

					 <?php if($cards) : ?>
						 <ul class="footer-payment-options">
							 <?php foreach ($cards as $card) { ?>
								 <li>
									 <i class="fa-cc-<?php echo $card ?> fa"></i>
								 </li>
							 <?php } ?>
						</ul>
					<?php endif; ?>


				<?php endif; ?>
				</div>
			</div>
		</div> <!-- /.grid-container.smallprint -->

		<div class="grid-container">
			<div class="grid-100 row">
				<hr>
			</div>
		</div>

		<div class="grid-container smallprint">
			<div class="copyright">
				<?php if(get_theme_mod('SitePoint_Ecommerce_footer_copyright_center')): ?>
						<p>
							<?php echo wp_kses_post(get_theme_mod('SitePoint_Ecommerce_footer_copyright_center')); ?>
						</p>
				<?php endif; ?>
			</div>
		</div> <!-- /.grid-container.smallprint -->
	</div> <!-- /.footercontainer -->
</div> <!-- /.#wrapper.hfeed.site -->

<?php wp_footer(); ?>
    <script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?bdeeafda98f015d57776153d2f6f71a9";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>

</html>
