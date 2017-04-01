<?php
// this template is used for the default front page of the theme
get_header(); ?>
<div class="grid-container">
  	<?php
  	// get product categories
  			$args = array(
  					'number'     => $number,
  					'orderby'    => 'title',
  					'order'      => 'ASC',
  					'hide_empty' => $hide_empty,
  			);
  			$product_categories = get_terms( 'product_cat', $args );
  			$count = count($product_categories);
  	?>
  <?php if(false/*$count > 0*/){ ?>
  	<div class="container homepage">
      <?php if(have_posts()) : ?>
        <div class="body-content grid-100">
          <?php while(have_posts()) : the_post();
            the_content();
          endwhile;?>

          <?php   if ( function_exists( 'register_field_group' ) ) : ?>
            <h2><?php echo get_field('featured_title') ?></h2>
          <?php endif; ?>
        </div>
      <?php endif; ?>

  			<ul class="feat">
  				<?php foreach ($product_categories as $featured_cat) { ?>
  							<?php if($featured_cat->parent == 0){ ?>
  									<li class="featured-categories">
                      <a class="feat-cat-title" href="<?php echo site_url('/product-category/') ?><?php echo $featured_cat->slug ?>">
  										<?php
                        $image = get_field('category_image', $featured_cat->taxonomy.'_'.$featured_cat->term_id);
  												if ( $image ) {
  													echo '<img src="' . $image['url'] . '" alt="" />';
  											}else{
                            echo '<img class="img-placeholder" src="http://placehold.it/350x300" alt="" />';
                        }
  										 ?>
                     </a>
  											<div class="title-container">
  												<a class="feat-cat-title" href="<?php echo site_url('/product-category/') ?><?php echo $featured_cat->slug ?>"><?php echo $featured_cat->name ?></a>
  											</div>
  									</li>
  							<?php  } //endif
  										} //endforeach?>
  				</ul>
  	</div>
  <?php } ?>

  <div class="clear"></div>

  <div class="main-content-container">
  	<div class="container">
  		<!-- display product categories sidebar -->
  				<?php if($count > 0){ ?>
            <div class="mobile-category">
              <?php if(function_exists('register_field_group')) : ?>
  						<h2><?php echo get_field('sidebar_title', get_option('page_on_front')) ?></h2>
  						<?php endif; ?>
              <div class="mobile-grid-50">
                <span>Parent</span>
                <div class="select-container">
                  <i class="fa-chevron-down fa"></i>
                  <select class="parent" name="parent">
                    <option selected><?php echo "Select Category" ?></option>
                    <?php foreach ($product_categories as $mobileCat) { ?>
                      <?php if($mobileCat->parent == 0){ ?>
                          <option class="cat-id-<?php echo $mobileCat->term_id ?>" value="<?php echo $mobileCat->slug ?>"><?php echo $mobileCat->name ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="mobile-grid-50">
                <span>Sub Cat</span>
                <div class="select-container">
                  <i class="fa-chevron-down fa"></i>
                  <select class="select-label" name="">
                      <option>Select Sub Cat</option>
                  </select>
                  <?php foreach ($product_categories as $subMobile) { ?>
                      <?php if($subMobile->parent == 0){ ?>
                          <?php $mobTermID = $subMobile->term_id  ?>
                          <select class="sub-category <?php echo  $subMobile->slug?>" name="subcat">
                              <?php foreach ($product_categories as $subMob) { ?>
                                  <?php if($mobTermID == $subMob->parent){ ?>
                                    <option value="<?php echo site_url('/product-category/') ?><?php echo $subMob->slug ?>"><?php echo $subMob->name ?></option>
                                  <?php } ?>
                              <?php } ?>
                          </select>
                      <?php } ?>
                  <?php } ?>
                </div>
              </div>
            </div>

  					<div class="categories">
  						<!-- parent category -->
              <?php if(function_exists('register_field_group')) : ?>
              <h2><?php echo get_field('sidebar_title', get_option('page_on_front')) ?></h2>
              <?php endif; ?>
  							<ul>
  							<?php foreach ($product_categories as $prod_cat) { ?>
  										<?php if($prod_cat->parent == 0){
  											$termID = $prod_cat->term_id;
  											 ?>
  											<li class="parent"><a class="<?php echo ($queried_object->term_id == $termID)? "active" : "" ?> parent-category" href="<?php echo site_url('/product-category/') ?><?php echo $prod_cat->slug ?>"><?php echo $prod_cat->name ?></a>
  												<ul class="sub-category">
  												<?php foreach ($product_categories as $sub_category) {
  															if($termID == $sub_category->parent){ ?>
  																		<li><a class="<?php echo ($queried_object->term_id == $sub_category->term_id)? "active" : "" ?>" href="<?php echo site_url('/product-category/') ?><?php echo $sub_category->slug ?>"><?php echo  $sub_category->name?></a></li>
  															<?php }
  												} ?></ul>
  											</li>
  										<?php } ?>
  							<?php } ?>
  							</ul>
  					</div>
  			<?php	}
  		 ?>

       <div class="listing-container">
         <?php   if ( function_exists( 'register_field_group' ) ) : ?>
          <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h2 class="page-title"><?php echo get_field('products_title') ?></h2>
          <?php endif; ?>
         <?php endif; ?>
          <?php echo do_shortcode('[recent_products per_page="9" columns="3"]') ?>
      </div>

    </div><!--container -->
</div>

</div><!--main-content-container -->

<?php if(is_front_page()): ?>
  <?php if(function_exists('register_field_group')) :
    $insOption = get_field('do_you_want_to_display_the_instagram_section', get_option('page_on_front'));
  endif; ?>

   <?php if($insOption) : ?>
			<?php
			  if( function_exists( 'display_instagram' ) ) { ?>
			    <section class="mid-section">
			      <div class="grid-container">

			        <?php echo do_shortcode('[instagram-feed]'); ?>

			      </div>
			    </section>
			<?php  }  ?>
			<?php endif; ?>
<?php endif; ?>


<?php
// check if best selling product is not 0
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 4,
    'meta_key' => 'total_sales',
    'orderby' => 'meta_value_num',
);
$bestSelling = new WP_Query( $args );
wp_reset_postdata();
?>

<?php if(count($bestSelling->posts) > 1) : ?>
<div class="grid-container">
	<div class="main-content-container">
		<div class="container">
			<div class="best-selling-products">
        <?php if(function_exists('register_field_group')) : ?>
				<h2><?php echo get_field('best_seller_title', get_option('page_on_front')) ?></h2>
				<?php endif; ?>
        <?php if($_SESSION['width'] < 767){
          // if mobile. this query will run
           echo do_shortcode('[best_selling_products per_page="2"]');
         }else{
         // else 4 items will display
           echo do_shortcode('[best_selling_products per_page="4"]');
         } ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php get_footer( 'shop' ); ?>
