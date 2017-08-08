<?php 
include('../../../../wp-config.php');
global $wpdb;
$addedQuantity = $_POST['addedQuantity'];
$order_id = $_POST['order_id'];
$resultGet = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix ."pizza_cart_temp` WHERE `id`= $order_id");
$pizza_Price = $resultGet[0]->pizza_Price;
$quantity = $resultGet[0]->quantity;
echo  $singlePizza = $pizza_Price / $quantity;
$newPrice = $singlePizza * $addedQuantity;
$query1="UPDATE `".$wpdb->prefix."pizza_cart_temp` SET `quantity` = '$addedQuantity' WHERE `id`= $order_id";
$wpdb->query($query1);

$query2="UPDATE `".$wpdb->prefix."pizza_cart_temp` SET `pizza_Price` = '$newPrice' WHERE `id`= $order_id";
$wpdb->query($query2);
?>