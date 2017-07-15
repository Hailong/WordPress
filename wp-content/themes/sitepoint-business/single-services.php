<?php
/**
 * The Template for displaying all single posts.
 *
 * @package SitePoint Business
 * @since SitePoint Business 1.0
 */
 // get the value of custom fields added
global $custom_meta_fields;
get_header(); ?>

<section class="banner" class="entry-header" style="background-image: url(<?php the_post_thumbnail_url( 'sitepoint_business_theme_post_feature_full_width' ); ?>)">

		<div class="banner-caption wow fadeIn" data-wow-duration="2s">
			<div class="grid-container">
				<div class="prefix-20 grid-60">
					<h1><?php the_title() ?></h1>
				</div>
			</div>
		</div>

</section> <!-- /.entry-header -->


<div id="maincontentcontainer">
	<?php $curID = get_the_ID();
	$metadata = get_post_meta($curID);
	?>

<?php if(have_posts()) : ?>
	<section class="single-service">
		<div class="grid-container">
				<div class="prefix-10 grid-80 tablet-grid-80 tablet-prefix-10">
					<div class="aligncenter text-center text-align-center"></div>
					<?php
					if(function_exists("register_field_group")) {
					 $subTitle = get_field('sub_title') ?>
					<?php if($subTitle) : ?>
							<h2><?php echo $subTitle ?></h2>
					<?php endif;
					}
					?>
						<?php
							while(have_posts()) : the_post();
								wpautop(the_content());
							endwhile; ?>
				</div>

		</div>
	</section>
<?php endif; ?>

<section>
	<div class="grid-container">
		<?php echo '<h2 class="text-align-center">' . /*esc_html__( 'More Services', 'sitepoint-business' )*/'更多项目' . '</h2>'; ?>
	</div>
	<div class="grid-container">
			<?php $related = query_posts(array('post_type' => 'services', 'posts_per_page' => 3, 'orderby' => 'rand', 'post__not_in' => array( $post->ID ))) ?>

			<?php while(have_posts($related)) : the_post(); ?>
				<div class="grid-33 tablet-grid-33">
					<div class="services-thumbnail">
						<a href="<?php echo the_permalink() ?>">
							<?php the_post_thumbnail('sitepoint_sevices_listing') ?>
						</a>
					</div>
					<div class="services-title">
						<a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
					</div>
				</div>


			<?php endwhile; wp_reset_query() ?>
			</div>
	</div>
</section>


<?php
if(/*function_exists("register_field_group")*/false) {
$teams = query_posts(array('post_type' => 'clients')) ?>
<section class="teams">
	<div class="grid-container">
		<div id="owl-demo" class="owl-carousel owl-theme">
				<?php while(have_posts($teams)) : the_post(); ?>
					<div class="item">
							<div class="grid-100">
									<div class="grid-5 tablet-grid-5">
										&nbsp;
									</div>
									<div class="grid-20 mobile-grid-60 mobile-prefix-20 tablet-grid-20">

									<?php
									$image = get_field('client_image');
									if( !empty($image) ): ?>

										<img src="<?php echo $image['sizes']['sitepoint_team_listing']; ?>" alt="<?php echo $image['alt']; ?>" />

									<?php endif; ?>
									</div>
									<div class="grid-65 mobile-grid-100 tablet-grid-65">
											<div class="message">
												<?php the_content(); ?>
											</div>
											<div class="team-name">
											<?php
											$client_name = get_field('client_name');
											if( !empty($client_name) ):
											?><?php echo $client_name; ?>
											<?php endif; ?>
											</div>
										<?php
										$position_title = get_field('position_title');
										if( !empty($position_title) ):
										?><?php echo $position_title; ?> at <?php the_title() ?>
									<?php endif; ?>
									</div>
							</div>
					</div>
				<?php endwhile; ?>
		</div>
	</div>
</section>
<?php } ?>
<?php wp_reset_query() ?>

<?php
if(function_exists("register_field_group")) {

		$botText = get_field('bottom_text');
		$botLink = get_field('bottom_link_to');
		$btnText = get_field('button_text');

 ?>
 <?php if($botText && $botLink) : ?>

 			<div class="grid-container custom-metabox-section">
				<?php if($botText):  ?>
					<div class="contact-link-section">
						<h3><?php echo $botText ?></h3>
					</div>
				<?php endif; ?>


 				<div class="btn-container-contact">
					<?php $RadioVal = get_field('button_open');
					if( $RadioVal == 'URL' ) { ?>
 					<a href="<?php echo $botLink ?>" class="btn"><?php echo $btnText ?></a>
				<?php	}
				elseif ($RadioVal == 'Modal') { ?>
					<a href="#" class="btn open-modal"><?php echo $btnText ?></a>
				<?php } ?>
 				</div>

 			</div>

<?php endif;
}
 ?>


</div> <!-- /#maincontentcontainer -->

<?php get_footer(); ?>
