<?php
// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="查看购物车"><?php echo sprintf(_n('%d 件', '%d 件', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
}

// change "add to cart" text to "add" archive
add_filter( 'add_to_cart_text', 'woo_custom_product_add_to_cart_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );
function woo_custom_product_add_to_cart_text() {
    // return __( 'BUY', 'woocommerce' );
    return '放进购物车';
}
// woocommerce search form
add_filter( 'get_product_search_form' , 'woo_custom_product_searchform' );
/**
 * woo_custom_product_searchform
 *
 * @access      public
 * @since       1.0
 * @return      void
*/
function woo_custom_product_searchform( $form ) {
	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
		<div>
			<label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
			<span class="icon"><i class="fa fa-search"></i></span>
			<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'woocommerce' ) .'" />
			<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Product Search', 'woocommerce' ) . '" />
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>';
	return $form;
}

//remove product tabs (description,reviews,additional_information)
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}

// Move WooCommerce price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 80 );

// Move WooCommerce add to cart
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 60 );

// remove categories / tags
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/*
Disable Variable Product Price Range completely:
*/
add_filter( 'woocommerce_variable_sale_price_html', 'my_remove_variation_price', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'my_remove_variation_price', 10, 2 );

function my_remove_variation_price( $price ) {
$price = '';
return $price;
}

add_filter( 'woocommerce_variable_sale_price_html', 'SitePoint_Ecommerce_variation_price_format', 10, 2 );

add_filter( 'woocommerce_variable_price_html', 'SitePoint_Ecommerce_variation_price_format', 10, 2 );

function SitePoint_Ecommerce_variation_price_format( $price, $product ) {

	// Main Price
	$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
	$price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

	// Sale Price
	$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
	sort( $prices );
	$saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

	if ( $price !== $saleprice ) {
		$price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
	}

	if(is_single()){
		$price = '<div class="single-wrap">' .$price. '</div>';
		return $price;
	}else{
		return $price;
	}

}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}
