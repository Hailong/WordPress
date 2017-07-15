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
						<h1><?php /*_e( 'Our Team', 'my-text-domain' );*/ ?>服务项目</h1>
					</div>
				</div>
		</div>
</div>

<section class="teams">
	<div class="grid-container">
		<?php while(have_posts($teams)) : the_post(); ?>
			<div class="grid-50 tablet-grid-50 mobile-grid-100 team-member">
					<div class="team-thumbnail grid-100">
						<?php
							if(has_post_thumbnail()) {
								the_post_thumbnail("sitepoint_team_listing");
							}else{
								echo '<img src="http://placehold.it/280x280">';
							}
						 ?>
					</div>
					<div class="team-name">
						<span class="team-name">
								<?php the_title(); ?> -
						</span>
						<span class="team-position">
							<?php
							if(function_exists("register_field_group")) {
							$position_title = get_field('position_title');
							if( !empty($position_title) ):
							?><?php echo $position_title; ?>
						<?php endif; } ?>
						</span>
					</div>
					<div class="team-description">
						<?php the_content(); ?>
					</div>

			</div>
		<?php endwhile; ?>
	</div>
</section>

<?php get_footer(); ?>
