<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
global $product;
?>



<div itemprop="description">
	<?php the_content() ?>
</div>

<?php if ( $product->is_type( 'variable' ) ) { ?>
	<?php if(has_excerpt()) :?>
		<div class="tooltip-con">
		  <div class="tooltip">Shipping Details
		    <span class="tooltiptext">
		      <i class="fa-plane fa"></i><span class="head">Shipping Details</span> <br>
		      <?php echo the_excerpt(); ?>
		    </span>
		  </div>
		</div>
	<?php endif; ?>
<?php }
 ?>

 <?php if ( !$product->is_type( 'variable' ) ) { ?>
			<div class="tool-tip-not-var">
				<?php if(has_excerpt()) :?>
					<div class="tooltip-con">
					  <div class="tooltip">快递信息
					    <span class="tooltiptext">
					      <i class="fa-plane fa"></i><span class="head">快递信息</span> <br>
					      <?php echo the_excerpt(); ?>
					    </span>
					  </div>
					</div>
				<?php endif; ?>
			</div>
	 <?php } ?>
