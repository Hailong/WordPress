<?php
/**
 * The template for displaying an archive page for services
 *
 * @package SitePoint Business
 * @since SitePoint Business 1.0
 */

get_header(); ?>


<div class="single-banner-container">
		<div class="grid-container">
				<div class="grid-100">
					<div class="text-align-center single-caption">
						<h1><?php echo /*$post->post_type*/'代表项目' ?></h1>
					</div>
				</div>
		</div>
</div>

<section class="services">

		<?php $sctr = 1 ?>
		<?php while(have_posts()) : the_post() ?>
			<?php if($sctr % 3 == 1 ||  $sctr == 1 ){
				echo '<div class="grid-container">';
			} ?>

			<div class="grid-33 tablet-grid-33 mobile-grid-100 service-item">
				<div class="services-thumbnail">
					<a href="<?php echo the_permalink() ?>">
						<?php
							if(has_post_thumbnail()) {
								the_post_thumbnail('sitepoint_sevices_listing');
							}else{
								echo '<img src="http://placehold.it/300x100">';
							}
						 ?>
					</a>
				</div>
				<div class="services-title">
					<a href="<?php echo the_permalink() ?>"><?php the_title() ?></a>
				</div>
				<div class="services-content">
					<?php if(has_excerpt()) {
						echo the_excerpt();
					}else{
						echo wp_trim_words(get_the_content(), 20);
						?>

					<?php }?>
				</div>

			</div>
			<?php if($sctr % 3 == 0 ){
				echo '</div>';
			} ?>
		<?php $sctr++;endwhile; ?>

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
									<div class="grid-20 mobile-grid-60 mobile-prefix-20  tablet-grid-20">

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

<?php

if(function_exists("register_field_group")) {
$botText = get_field('bottom_text');
$botLink = get_field('bottom_link_to');
 ?>

 <?php if($botText && $botLink) : ?>

 			<div class="grid-container custom-metabox-section">
				<?php if($botText):  ?>
					<div class="contact-link-section">
						<h3><?php echo $botText ?></h3>
					</div>
				<?php endif; ?>

 				<div class="btn-container-contact">
 					<a href="<?php echo $botLink ?>" class="btn">Contact us</a>
 				</div>

 			</div>

<?php endif;
}
?>



<?php get_footer(); ?>
