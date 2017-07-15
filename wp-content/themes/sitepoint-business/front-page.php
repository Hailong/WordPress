<?php
/**
 * frontpage template file.
 * Learn more: https://codex.wordpress.org/Creating_a_Static_Front_Page#Configuration_of_front-page.php
 *
 * @package Sitepoint SitePoint Business
 * @since Sitepoint SitePoint Business 1.0
 */

get_header(); ?>
  <?php
  if(function_exists("register_field_group")) {
  $image = get_field('hero_image');
  if( !empty($image) ): ?>
  <section class="banner" style="background-image: url(<?php echo $image['url']; ?>);">

      <div id="banner-animate" class="banner-caption animated" data-wow-duration="2s">
        <?php
        $herotext = get_field( "hero_text" );

        if( $herotext ) { ?>

          <h1><?php  echo $herotext; ?></h1>

        <?php } ?>

          <a class="btn" href="#">
            <?php
            $btn = get_field( "button_text_to_contact_form" );

            if( $btn ) { ?>

              <?php  echo $btn; ?>

          <?php } ?>
          </a>
     </div>


  </section>
<?php endif; } ?>
<style type="text/css">
  #owl-hero .owl-prev,
  #owl-hero .owl-next {
    bottom: 242px;
    font-size: 56px;
  }
</style>
<section class="hero">
    <div id="owl-hero" class="owl-carousel owl-theme">
        <?php
          $items = array(
            array(
              'image' => '//cdn.bjrhxk.cn/wp-content/uploads/2016/12/hero_banner.jpg',
              'message' => '我们的服务项目：<br>移动、联通、电信、铁塔四大运营商的网络工程综合布线、监控安装、服务器局域网组建。',
            ),
            array(
              'image' => '//cdn.bjrhxk.cn/wp-content/uploads/2017/02/hero_banner.jpg',
              'message' => '我们的理念：<br>老老实实做人，踏踏实实做事。',
            ),
          );
        ?>
        <?php foreach($items as $key => $item): ?>
          <div class="item">
              <div class="grid-100" style="height: 504px;background-image: url(<?php echo $item['image']; ?>);background-size: cover;background-position: 0% 50%;">
                  <div class="grid-5 tablet-grid-5">
                    &nbsp;
                  </div>
                  <div class="grid-40 mobile-grid-100 tablet-grid-100" style="padding-top: 230px;">
                      <div class="message" style="background-color: rgba(0,0,0,.6);;color: white;font-size: 24px;padding: 40px;height: 224px;">
                        <?php echo $item['message']; ?>
                      </div>
                  </div>
                  <div class="grid-65 mobile-grid-100 tablet-grid-65">
                      <div class="team-name">
                      <?php
                      $client_name = '';
                      if( !empty($client_name) ):
                      ?><?php echo $client_name; ?>
                      <?php endif; ?>
                      </div>
                    <?php
                    $position_title = '';
                    if( !empty($position_title) ):
                    ?><?php echo $position_title; ?>
                  <?php endif; ?>
                  </div>
              </div>
          </div>
        <?php endforeach; ?>
    </div>
</section>
<?php
if(function_exists("register_field_group")) { ?>
<section class="welcome-section">
  <div class="main-content">
      <div class="grid-container">
          <div class="grid-60 tablet-grid-60 push-40">
            <div class="main-content-text">
              <?php  $title = get_field('welcome_title');
                if( !empty($title) ):
                ?>
                <h3><?php echo $title; ?></h3>
                <?php

                 endif; ?>

            <?php  $text = get_field('welcome_text');
              if( !empty($text) ):
              echo $text;

               endif; ?>

              <?php
              $signature = get_field('signature');
              if( !empty($signature) ):
              ?><img src="<?php echo $signature[url]; ?>" alt="" />

              <?php endif; ?>

              <?php  $name = get_field('welcome_name');
                if( !empty($name) ):
                ?><p><?php echo $name; ?></p>

                <?php endif; ?>
            </div>

          </div>
          <div class="grid-40 tablet-grid-40 pull-60">
            <div class="welcome-image">
              <?php
              $image = get_field('welcome_image');
              if( !empty($image) ):
              ?><img src="<?php echo $image[sizes][sitepoint_homepage_feat_img]; ?>" alt="" />

              <?php endif; ?>
            </div>
          </div>
      </div>
    </div>
</section>
<?php } ?>

<?php
if(function_exists("register_field_group")) { ?>
<section class="scenarios">
    <div class="grid-container">

      <h2 class="text-align-center">
      <?php
      $title = get_field('user_scenario_title');
      if( !empty($title) ):
      ?><?php echo $title; ?>
      <?php endif; ?>
      <?php
      $text = get_field('user_scenario_sub_text');
      if( !empty($text) ):
      ?><span class="aligncenter subtext"><?php echo $text; ?></span>
      <?php endif; ?>
      </h2>
    </div>

    <div class="grid-container links-container">

        <?php $var=1 ;

        while($var !=8 ){

        $link = get_field( 'scenario_link_'.$var);
        $icon = get_field( 'scenario_icon_'.$var);
        $text = get_field( 'scenario_text_'.$var);

        if( $link && $text ) { ?>


            <div class="grid-25 tablet-grid-25 mobile-grid-80 mobile-prefix-10 border-solid-gray">
              <a href="<?php  echo $link; ?>" class="box-link">
                <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                <span class="title-tag"><?php echo $text; ?></span>
              </a>
            </div>


        <?php } ?>

        <?php if($var==4 ){ ?>

        <?php echo '</div><div class="grid-container">'; } $var++; } ?>
    </div>
</section>
<?php } ?>

<?php
if(function_exists("register_field_group")) { ?>
<section class="services">
      <div class="grid-container">
        <h2 class="text-align-center">
          <?php
          $title = get_field('services_title');
          if( !empty($title) ):
          ?><?php echo $title; ?>
          <?php endif; ?>

          <?php
          $text = get_field('services_sub_text');
          if( !empty($text) ):
          ?><span class="aligncenter"><?php echo $text; ?></span>
          <?php endif; ?>
        </h2>
        <?php

        $posts = get_field('services_to_display');

        if( $posts ): ?>
        <?php $sctr = 1 ?>
        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
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
        <?php $sctr++; endforeach; ?>
      <?php endif;  ?>
      </div>
</section>
<?php } ?>
<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>


<?php
  $teams = query_posts(array('post_type' => 'teams'));
 ?>
<?php if(have_posts($teams) && function_exists("register_field_group")) : ?>
<section class="teams">
    <div class="grid-container">
      <h2 class="text-align-center">
        <?php
        $title = get_field('our_team_title');
        if( !empty($title) ):
        ?><?php echo $title; ?>
        <?php endif; ?>

        <?php
        $text = get_field('our_team_sub_text');
        if( !empty($text) ):
        ?><span class="aligncenter"><?php echo $text; ?></span>
        <?php endif; ?>
      </h2>
      <?php while(have_posts($teams)) : the_post(); ?>
        <div class="grid-25 tablet-grid-25 mobile-grid-60 mobile-prefix-20">
            <div class="team-thumbnail">
              <?php
                if(has_post_thumbnail()) {
                  the_post_thumbnail("sitepoint_team_listing");
                }else{
                  echo '<img src="http://placehold.it/280x280">';
                }
               ?>
            </div>
            <div class="team-name text-align-center">
                <?php the_title(); ?>
                <?php
                $value = get_field( 'position_title' );

                if( $value ) { ?>

                    <span><?php echo $value; ?></span>
                <?php
                }
                 ?>

            </div>
            <div class="text-align-center team-position">
                <?php echo ( has_excerpt() )? the_excerpt() : "" ?>
            </div>
        </div>
      <?php endwhile; ?>
    </div>
</section>
<?php endif; wp_reset_query(); ?>

<?php $clients = query_posts(array('post_type' => 'clients'));
if(have_posts($clients) && function_exists("register_field_group")) :  ?>
  <section class="clients">
     <div class="grid-container">
        <h2 class="text-align-center">
          <?php
          $title = get_field('our_clients_title');
          if( !empty($title) ):
          ?><?php echo $title; ?>
          <?php endif; ?>

          <?php
          $text = get_field('our_clients_sub_text');
          if( !empty($text) ):
          ?><span class="aligncenter"><?php echo $text; ?></span>
          <?php endif; ?>
        </h2>
    </div>
    <div class="grid-container clients-container">



        <?php while(have_posts($clients)) : the_post() ?>
          <div class="grid-20 tablet-grid-20 mobile-grid-80 mobile-prefix-10 client-image">
              <div class="client-thumbnail">
                <?php
                  if(has_post_thumbnail()) {
                    the_post_thumbnail();
                  }else{
                    echo '<img src="http://placehold.it/100x100">';
                  }
                 ?>
              </div>
          </div>
        <?php endwhile; ?>
      </div><!-- //.clients-container -->
     </div>
  </section>
<?php endif; wp_reset_query();?>

<?php get_footer(); ?>
