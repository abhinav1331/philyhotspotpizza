<?php 
function shop_page_function(){
 include('shortcodes/shop-page.php');
}
add_shortcode( 'pizza-shop', 'shop_page_function' );



function cart_page_function(){
 include('shortcodes/cart-page.php');
}
add_shortcode( 'pizza-cart', 'cart_page_function' );


 ?>