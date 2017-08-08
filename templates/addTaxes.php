<?php 
include('../../../../wp-config.php');
global $wpdb;
$taxName = $_POST['taxName'];
$taxPercent = $_POST['taxPercent'];
$i =0;
$wpdb->query("DELETE  FROM `".$wpdb->prefix ."pizza_taxes_include`");
foreach ($taxName as $key => $value) {
	echo $i;
	$wpdb->insert( $wpdb->prefix.'pizza_taxes_include', array(
		'tax_name' => $value,
		'tax_amount' => $taxPercent[$i] )
	);
	$i++;
}
 ?>