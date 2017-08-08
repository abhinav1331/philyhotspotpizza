<?php 
include('../../../../wp-config.php');
global $wpdb;
echo $Latitude = $_GET['Latitude'];
$longitude = $_GET['longitude'];
$wpdb->query("DELETE  FROM `".$wpdb->prefix ."options` where `option_name` = 'pizza_commerce_Latitude'");
$wpdb->query("DELETE  FROM `".$wpdb->prefix ."options` where `option_name` = 'pizza_commerce_longitude'");

$wpdb->insert( $wpdb->prefix .'options', array(
	'option_name' => "pizza_commerce_Latitude",
	'option_value' => $Latitude,
	'autoload' => "yes")
);
$wpdb->insert( $wpdb->prefix .'options', array(
	'option_name' => "pizza_commerce_longitude",
	'option_value' => $longitude,
	'autoload' => "yes")
);
echo $lastid = $wpdb->insert_id;
?>