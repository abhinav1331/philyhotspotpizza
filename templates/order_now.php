<?php 
include('../../../../wp-config.php');
session_start();
if($_COOKIE['myCookies']) {
	$myCookies = $_COOKIE['myCookies'];
} else {
	$myCookies = session_id();
	setcookie("myCookies", $myCookies, time() + (86400 * 60), "/"); // 86400 = 1 day
}
/*echo "<pre>";
	print_r($_POST);
echo "</pre>";
die();*/
$pizza_id = $_POST['pizza_id'];
$quantity = $_POST['quantity'];
$pizza_size = stripslashes($_POST['pizza_size']);
$pizza_base = stripslashes($_POST['pizza_base']);
$pizza_toppings = stripslashes($_POST['pizza_toppings']);
$pizza_extra = stripslashes($_POST['pizza_extra']);
$pizza_final = stripslashes($_POST['pizza_final']);
$final_prize = $pizza_final * $quantity;
$wpdb->insert( $wpdb->prefix.'pizza_cart_temp', array(
'session_id' => $myCookies,
'product_id' => $pizza_id,
'pizza_size' => $pizza_size,
'pizza_base' => $pizza_base,
'pizza_toppings' => $pizza_toppings,
'pizza_Price' => $final_prize,
'quantity' => $quantity,
'pizza_extra' => $pizza_extra )
);
 ?>