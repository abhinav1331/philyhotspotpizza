<?php 
$cart = get_page_by_path( 'cart' );
$shop = get_page_by_path( 'shop' );

add_filter( 'template_include', 'contact_page_template', 99 );

function contact_page_template( $template ) {

	if ( is_page( 'shop' )  ) {
		 $file_name = 'shop.php';
		$new_template =  dirname( __FILE__ ) . '/templates/' . $file_name;
		if ( '' != $new_template ) {
			return $new_template;
		}
	}

	return $template;
}

add_filter( 'template_include', 'cart_page_template', 99 );

function cart_page_template( $template ) {

	if ( is_page( 'cart' )  ) {
		 $file_name = 'cart.php';
		$new_template =  dirname( __FILE__ ) . '/templates/' . $file_name;
		if ( '' != $new_template ) {
			return $new_template;
		}
	}

	return $template;
}
 ?>