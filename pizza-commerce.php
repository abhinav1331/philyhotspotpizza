<?php
/*
Plugin Name: Pizza Commerce
Description: Pizza Commerce
Author: Abhinav Grover
*/

if (is_admin())
{   
  function form_create_pizza_commerce_section()  {  
    add_menu_page("Pizza Commerce","Pizza Commerce",1,"pizza_commerce","");
    add_submenu_page("pizza_commerce","Pizza Commerce","Pizza Commerce",8,"pizza_commerce","pizza_commerce");
    add_submenu_page("pizza_commerce","Order Settings","Order Settings",8,"order_settings","order_settings");
    add_submenu_page("pizza_commerce","Payment Method","Payment Method",8,"payment_method","payment_method");
	 }

   add_action('admin_menu','form_create_pizza_commerce_section');

          /***************Plugin Activation*******************/
        		function PizzaPlugin_install() {
              global $wpdb;
              include( ABSPATH . 'wp-config.php');
            			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

                  $table_name = $wpdb->prefix . 'pizza_cart_temp';
                  $charset_collate = $wpdb->get_charset_collate();
                  $sql = "CREATE TABLE $table_name (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    session_id varchar(5500) DEFAULT '' NOT NULL,
                    product_id varchar(5500) DEFAULT '' NOT NULL,
                    pizza_size varchar(500) DEFAULT '' NOT NULL,
                    pizza_base varchar(500) DEFAULT '' NOT NULL,
                    pizza_toppings varchar(500) DEFAULT '' NOT NULL,
                    pizza_extra varchar(500) DEFAULT '' NOT NULL,
                    pizza_Price varchar(500) DEFAULT '' NOT NULL,
                    PRIMARY KEY  (id)
                  )
                  $charset_collate;";
                  dbDelta( $sql );

            			$table_name1 = $wpdb->prefix . 'pizza_taxes_include';
            			$charset_collate1 = $wpdb->get_charset_collate();
                  $pizza_taxes_include = "CREATE TABLE $table_name1 (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    tax_name varchar(5500) DEFAULT '' NOT NULL,
                    tax_amount varchar(5500) DEFAULT '' NOT NULL,
                    PRIMARY KEY  (id)
                  )
                  $charset_collate1;";
                  dbDelta( $pizza_taxes_include );
                  $my_post = array(
                    'post_type'    => 'page',
                    'post_title'    => 'Shop',
                    'post_content'  => '[pizza-shop]',
                    'post_status'   => 'publish',
                    'post_author'   => 1
                );
                  $my_post = array(
                    'post_type'    => 'page',
                    'post_title'    => 'Cart',
                    'post_content'  => '[pizza-cart]',
                    'post_status'   => 'publish',
                    'post_author'   => 1
                );
                 
                // Insert the post into the database.
                wp_insert_post( $my_post );
        		}
        		register_activation_hook( __FILE__, 'PizzaPlugin_install' );

          /***************Plugin Activation*******************/


          /***************Plugin Deactivation*******************/

        		function PizzaPlugin_uninstall() {
              $mycustomposts = get_posts( array( 'post_type' => 'pizza', 'numberposts' => -1));
                 foreach( $mycustomposts as $mypost ) {
                  wp_delete_post( $mypost->ID, true);
                 }
                 $page = get_page_by_path( 'shop' );
                 wp_delete_post( $page->ID, true);
                 $sql = "DROP TABLE IF EXISTS `".$wpdb->prefix ."pizza_cart_temp`";
                 $wpdb->query($sql);
      		    }
        		// register_deactivation_hook( __FILE__, 'PizzaPlugin_uninstall' );
          /***************Plugin Deactivation*******************/
}
//Include Important Files
      include('pizza-install.php');
      include('plugin-attributes.php');
      include('include-files.php');
      include('plugin-shortcodes.php');
      include('include-template.php');
      include('include-functions.php');
//Include Important Files




function pizza_commerce() {
  include('../wp-config.php');
  global $wpdb;
  $plugin_url = plugin_dir_url( __FILE__ );
  ?>
  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/style.css' type='text/css'/>
  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/bootstrap.min.css' type='text/css'/>
  <script src="<?php echo $plugin_url; ?>js/bootstrap.min.js"></script>
  <script src="<?php echo $plugin_url; ?>js/jquery.validate.js"></script>
  <script src="<?php echo $plugin_url; ?>js/form.js"></script>
  <div class="container">
  <div class="row">
    <div class="heading">
      <h1>Welcome To Philly Hot Spot Pizza</h1>
    </div>
    <div class="content-body">
      <div class="row">
        
      </div>
    </div>
  </div>
</div>
<?php
}



function order_settings() {
include('../wp-config.php');
  global $wpdb;
  $plugin_url = plugin_dir_url( __FILE__ );
  ?>
  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/style.css' type='text/css'/>
  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/bootstrap.min.css' type='text/css'/>
  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/toastr.css' type='text/css'/>
  <script src="<?php echo $plugin_url; ?>js/bootstrap.min.js"></script>
  <script src="<?php echo $plugin_url; ?>js/jquery.validate.js"></script>
  <script src="<?php echo $plugin_url; ?>js/form.js"></script>
  <script src="<?php echo $plugin_url; ?>js/toastr.js"></script>
  <script src="<?php echo $plugin_url; ?>js/custom.js"></script>
  <div class="container">
  <div class="row">
    <div class="heading">
      <h1>Philly Hot Spot Pizza</h1>
    </div>
    <div class="content-body">
      <div class="row">
        <h1>Order Settings</h1>
         <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#tax_included">Tax Included</a></li>
          <li><a data-toggle="tab" href="#currency">Location</a></li>
        </ul>

        <div class="tab-content">
          <div id="tax_included" class="tab-pane fade in active">
            <form action="" id="add_to_tax">
              <input type="hidden" name="myPluginURL" value="<?php echo $plugin_url; ?>">
                <div class="row myRow">
                  <div class="col-lg-3"><h3>Tax Name</h3></div>
                  <div class="col-lg-3"><h3>Tax Percent</h3></div>
                  <div class="col-lg-3"><h3>Delete Taxes</h3></div>
                </div>
                <?php
                $i=1;
                foreach( $wpdb->get_results("SELECT * FROM `".$wpdb->prefix ."pizza_taxes_include`") as $key => $row) {
                ?>
                    <div class="row myRow">
                      <div class="col-lg-3"><input type="text" class="form-control" name="taxName[]" value="<?php echo $row->tax_name; ?>"></div>
                      <div class="col-lg-3"><input type="text" class="form-control" name="taxPercent[]" value="<?php echo $row->tax_amount; ?>"></div>
                      <div class="col-lg-3"><button type="button" class="btn-danger btn" onclick="deleteRec(this);"> DELETE</button></div>
                    </div>
                  <?php 
                  $i++;
                  }
                  if($i==1) {
                    ?>
                    <div class="row myRow">
                      <div class="col-lg-3"><input type="text" class="form-control" name="taxName[]"></div>
                      <div class="col-lg-3"><input type="text" class="form-control" name="taxPercent[]"></div>
                      <div class="col-lg-3"><button type="button" class="btn-danger btn" onclick="deleteRec(this);"> DELETE</button></div>
                    </div>
                    <?php
                  }
                  ?>
              <button type="button" class="btn btn-primary" onclick="addTaxCurrentSection();">Add Tax</button>
              <button type="submit" class="btn btn-success">Save All Taxes</button>
            </form>
          </div>
          <div id="currency" class="tab-pane fade">
            <h3>Hotel Location</h3>
            <form action="" method="" id="add_locations">
              <div class="row">
                <?php 
                 ?>
                <div class="col-lg-3"><input type="text" class="form-control" placeholder="Latitude" name="Latitude" value="<?php echo get_site_option( 'pizza_commerce_Latitude' ); ?>"></div>
                <div class="col-lg-3"><input type="text" class="form-control" placeholder="longitude" name="longitude"  value="<?php echo get_site_option( 'pizza_commerce_longitude' ); ?>"></div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success" name="buttonSubmit">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}

function payment_method() {

include('../wp-config.php');
  global $wpdb;
  $plugin_url = plugin_dir_url( __FILE__ );


  ?>
  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/style.css' type='text/css'/>
  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/bootstrap.min.css' type='text/css'/>
  <link rel='stylesheet' href='<?php echo $plugin_url; ?>css/toastr.css' type='text/css'/>
  <script src="<?php echo $plugin_url; ?>js/bootstrap.min.js"></script>
  <script src="<?php echo $plugin_url; ?>js/jquery.validate.js"></script>
  <script src="<?php echo $plugin_url; ?>js/form.js"></script>
  <script src="<?php echo $plugin_url; ?>js/toastr.js"></script>
  <script src="<?php echo $plugin_url; ?>js/custom.js"></script>
  <div class="container">
    <div class="row">
      <h4>Payment Methods</h4>
      <form action="">
        <label for="paypal">Paypal</label>
        <input type="checkbox" name="paymentMethod" id="paypal" value="Paypal" class="form-control">

        <label for="stripe">Stripe</label>
        <input type="checkbox" name="paymentMethod" id="stripe" value="Stripe" class="form-control">
      </form>
      <?php 
        if(isset($_SERVER['HTTPS'])) { 
            ?>
            <input type="hidden" name="httpsStatus" value="yes">
            <?php
        } else { 
            ?>
            <input type="hidden" name="httpsStatus" value="no">
            <?php
        }
       ?>

    </div>
  </div>
<?php
}