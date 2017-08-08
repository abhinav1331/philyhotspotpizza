
<?php 


/*   $zipcode="160101";
    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=false";
    $details=file_get_contents($url);
    $result = json_decode($details,true);
    echo "<pre>";
        print_r($result);
    echo "</pre>";

    $lat=$result['results'][0]['geometry']['location']['lat'];

    $lng=$result['results'][0]['geometry']['location']['lng'];

    echo "Latitude :" .$lat;
    echo '<br>';
    echo "Longitude :" .$lng;*/


global $wpdb;
$cookies = $_COOKIE['myCookies'];
$countt = $wpdb->get_var("SELECT count(`session_id`) FROM `".$wpdb->prefix ."pizza_cart_temp` WHERE `session_id` = '".$cookies."'");
if($_COOKIE['myCookies'] && $countt != 0) {
$plugin_url = plugin_dir_url( __FILE__ );
$cookies = $_COOKIE['myCookies'];
$name = array();
$tax = array();
$res = $wpdb->get_results("SELECT * FROM `".$wpdb->prefix ."pizza_taxes_include`");
foreach ($res as $key => $value) {
    $name[] = $value->tax_name;
    $tax[] = $value->tax_amount;
}
    ?>
     <section class="review_checkout_section">
        <div class="container">
            <h2>review your order</h2>
            <div class="all_details_boxes_with_price">
                <div class="cmplt_box_one_third">
                    <h3>Please enter the details below to complete your order</h3>
                        <input type="hidden" name="admin_url" value="<?php echo str_replace("shortcodes/","templates/",$plugin_url); ?>">
                        <input type="hidden" name="taxName" value="<?php echo implode("," , $name); ?>">
                        <input type="hidden" name="taxInc" value="<?php echo implode("," , $tax); ?>">
                        <input type="hidden" name="latitudeRest" value="<?php echo get_site_option( 'pizza_commerce_Latitude' ); ?>">
                        <input type="hidden" name="longitudeRest" value="<?php echo get_site_option( 'pizza_commerce_longitude' ); ?>">
                        <input type="text" placeholder="First Name*" name="first_name">
                        <input type="text" placeholder="Last Name*" name="last_name">
                        <input type="email" placeholder="Email*" name="email">
                        <input type="tel" placeholder="Mobile Number*" name="mobile_number">
                </div>
                <div class="cmplt_box_one_third mid_box">
                    <h3><i class="fa fa-home" aria-hidden="true"></i>Your Delivery Address</h3>
                    <h5>Please complete your delivery address to place the order</h5>
                        <input type="text" placeholder="Building No./Flat/House No." name="flat_no">
                        <input type="text" placeholder="Street/Society Name" name="stree">
                        <input type="text" placeholder="City" name="city">
                        <input type="text" placeholder="State" name="state">
                        <input type="text" placeholder="Country" name="country">
                        <input type="text" name="zip" placeholder="Zip">
                </div>
                <div class="deliveryMethod" style="display:none;">
                    <label for="pickup">Pick Up</label>
                    <input type="radio" name="delivery" value="pickup" id="pickup">
                    <label for="homeDelivery" id="homeDeliveryLabel">Home Delivery</label>
                    <input type="radio" name="delivery" value="home delivery" id="homeDelivery">
                </div>
                <div class="cmplt_box_one_third">
                    <ul class="grand_Total_Details">
                        <li>
                            <span>Net Price</span>
                            <span></span>
                            <span id="net_price"><i class="fa fa-inr"></i>&nbsp;<p class="netAmount">1025.00</p></span>
                        </li>
                        <?php
                        $i=1;
                        foreach( $wpdb->get_results("SELECT * FROM `".$wpdb->prefix ."pizza_taxes_include`") as $key => $row) {
                        ?>
                        <li class="TaxInc">
                            <span><?php echo $row->tax_name; ?></span>
                            <span></span>
                            <span id="vat_review_page"><i class="fa fa-inr"></i>&nbsp;<p class="netTax">00.00</p></span>
                        </li>
                        <?php } ?>
                        <li class="grandTotalText">
                            <span class="grand_total">Grand Total</span>
                            <span></span>
                            <span id="total_price"><i class="fa fa-inr"></i>&nbsp;<p class="netGrand">1210.00</p></span>
                        </li>
                    </ul>
                    <button class="ordr_plcd">Place order</button>
                </div>
            </div>
            <div class="slctd_items">
                <h2>Items you have selected</h2>
                <div class="reviewMainContent1 revieworder1" id="cartView">
                    <div class="orderdItems1">
                        <ul class="orderdItemsList1">
                            <?php 
                            foreach( $wpdb->get_results("SELECT * FROM `".$wpdb->prefix ."pizza_cart_temp` WHERE `session_id` = '".$cookies."'") as $key => $row) {
                                $productData = get_post( $row->product_id );
                                /*echo "<pre>";
                                    print_r($row);
                                echo "</pre>";*/
                                $thumbnail_id    = get_post_thumbnail_id($row->product_id);
                                $imgAlt = get_post_meta($thumbnail_id,'_wp_attachment_image_alt', true);
                                $featured_img_url = get_the_post_thumbnail_url($row->product_id, 'full');
                                $pizza_base = json_decode($row->pizza_base);
                                $pizza_size = json_decode($row->pizza_size);
                                $pizza_toppings = json_decode($row->pizza_toppings);
                                $pizza_extra = json_decode($row->pizza_extra);
                                $var = "";
                                foreach($pizza_toppings as $val) { $var = $var.$val->name." + "; }
                                $var1 = "";
                                foreach($pizza_extra as $val) { $var1 = $var1.$val->name." + "; }
                                
                             ?>
                            <li class="order_items1 cartPadding">

                                <input type="hidden"name="order_idd" value="<?php echo $row->id; ?>">
                                <a href="javascript:void(0)" onclick="deleteCart(this);" class="del1 remove-cart-item1">X</a>
                                <div class="w1">
                                    <figure class="orderProductPic"><img src="<?php echo $featured_img_url; ?>" alt="<?php echo $imgAlt; ?>"></figure>
                                    <div class="productDiscription1">
                                        <h5><?php echo $productData->post_title; ?></h5>
                                        <p>
                                            <strong>Crust:</strong> <?php echo $pizza_base->name; ?> </p>
                                        <p>
                                            <strong>Toppings:</strong> <?php echo $var = substr(trim($var), 0, -1); ?> </p>
                                        <p>
                                            <strong>Extra:</strong> <?php echo $var1 = substr(trim($var1), 0, -1); ?> </p>
                                    </div>
                                </div>
                                <div class="detailBox1 w2 ">
                                    <h4>Size</h4>
                                    <p>
                                        <span> <?php echo ucwords($pizza_size->name); ?></span>
                                        <small></small>
                                    </p>
                                </div>
                                <div class="detailBox1 w3">
                                    <h4>Qty</h4>
                                    <div class="qty1">
                                        <input type="hidden"name="order_id" value="<?php echo $row->id; ?>">
                                        <button class="minusBtn product_counter" onclick="minusBtn(this);">-</button>
                                        <input class="product_quantity" readonly="" name="product_quantity" value="<?php echo $row->quantity; ?>" dval="6" type="text">
                                        <button class="plusBtn product_counter" onclick="plusBtn(this);">+</button>
                                    </div>
                                    <input class="product_string" name="product_string" value="11#1125525,1125773,1125537,1125549,1125561,1125573,1125585,1125597,1125609,1125793" type="hidden">
                                </div>
                                <div class="detailBox1 w4">
                                    <h4>Price (<i class="fa fa-inr"></i>)</h4>
                                    <p>
                                        <strong><?php echo $row->pizza_Price; ?>.00</strong>
                                    </p>
                                </div>
                                <input class="hidden-basket-id" name="hidden_basid" value="242310053" type="hidden">
                            </li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
} else {
	echo "Your Cart is Empty";
}


 ?>
