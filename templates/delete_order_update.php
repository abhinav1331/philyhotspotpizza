<?php 
include('../../../../wp-config.php');
global $wpdb;
$order_id = $_POST['order_id'];
$wpdb->query("DELETE  FROM `".$wpdb->prefix ."pizza_cart_temp` WHERE `id` = '".$order_id."'");
?>