<?php 

function myplugin_add_meta_box() {

	$screens = array( 'pizza' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'myplugin_sectionid',
			__( 'Pizza Commerce', 'myplugin_textdomain' ),
			'myplugin_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );
add_action( 'save_post', 'myplugin_save_meta_box_data');



function myplugin_meta_box_callback( $post) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	* Use get_post_meta() to retrieve an existing value
	* from the database and use the value for the form.
	*/

  	$plugin_url = plugin_dir_url( __FILE__ );
	$post_id = $post->ID;
	global $wpdb;
	?>
	  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/bootstrap.min.css' type='text/css'/>
	  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/toastr.css' type='text/css'/>
	  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/style.css' type='text/css'/>
	  <script src="<?php echo $plugin_url; ?>js/bootstrap.min.js"></script>
	  <script src="<?php echo $plugin_url; ?>js/toastr.js"></script>
	  <script src="<?php echo $plugin_url; ?>js/custom.js"></script>


	<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
	<div id="exTab1" class="container1">	
		<ul  class="nav nav-pills">
			<li class="active">
				<a  href="#size" data-toggle="tab">Size & Pricing</a>
			</li>
			<li>
				<a href="#base" data-toggle="tab">Base</a>
			</li>
			<li>
				<a href="#toppings" data-toggle="tab">Toppings</a>
			</li>
			<li>
				<a href="#extra" data-toggle="tab">Extra</a>
			</li>
			
		</ul>

		<div class="tab-content clearfix">
			<div class="tab-pane active" id="size">
				<?php  include('backend/pizza-admin-size.php'); ?>
			</div>
			<div class="tab-pane" id="base">
				<?php  include('backend/pizza-base-select.php'); ?>
			</div>
			<div class="tab-pane" id="toppings">
				<?php  include('backend/pizza-base-toppings.php'); ?>
			</div>
			<div class="tab-pane" id="extra">
				<?php  include('backend/pizza-base-extra.php'); ?>
			</div>
		</div>
	</div>

	
	<?php
}




function myplugin_save_meta_box_data( $post_id ) {
	
	global $wpdb;
	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.

	$size = $_POST['size'];
	$size_price = $_POST['size_price'];
	$base_price = $_POST['base_price'];
	$pizza_base = $_POST['pizza_base'];
	$toppings_base = $_POST['toppings_base'];
	$toppings_price = $_POST['toppings_price'];
	$sizeToppings = $_POST['sizeToppings'];
	$extra_base = $_POST['extra_base'];
	$extra_price = $_POST['extra_price'];
	$i=0;
	$table_name = $wpdb->prefix . 'postmeta';
	$wpdb->query("DELETE  FROM `$table_name` WHERE `meta_key` = 'size_price' AND `post_id` = $post_id");
	$wpdb->query("DELETE  FROM `$table_name` WHERE `meta_key` = 'base_price' AND `post_id` = $post_id");
	$wpdb->query("DELETE  FROM `$table_name` WHERE `meta_key` = 'toppings_price' AND `post_id` = $post_id");
	$wpdb->query("DELETE  FROM `$table_name` WHERE `meta_key` = 'extra_price' AND `post_id` = $post_id");
	foreach($size as $sizeval)
	{
		$sizeSection = array("size" => $sizeval , "prize" => $size_price[$i]);
		$sizejson = json_encode($sizeSection);
		add_post_meta( $post_id, 'size_price', $sizejson);
		$i++;
	}
	$i=0;
	foreach($pizza_base as $baseval)
	{
		$baseSection = array("base" => $baseval , "prize" => $base_price[$i]);
		$basejson = json_encode($baseSection);
		add_post_meta( $post_id, 'base_price', $basejson);
		$i++;
	}

	$i=0;
	foreach($toppings_base as $toppingval)
	{
		$toppingsSection = array("toppings" => $toppingval , "size" => $sizeToppings[$i] , "prize" => $toppings_price[$i]);
		$toppingsjson = json_encode($toppingsSection);
		add_post_meta( $post_id, 'toppings_price', $toppingsjson);
		$i++;
	}
	$i=0;
	foreach($extra_base as $extraval)
	{
		$extraSection = array("extra" => $extraval , "prize" => $extra_price[$i]);
		$extrajson = json_encode($extraSection);
		add_post_meta( $post_id, 'extra_price', $extrajson);
		$i++;
	}
	
}
	 ?>