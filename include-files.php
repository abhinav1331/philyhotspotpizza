<?php 
function add_my_css() {
  $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style('pizza_bootstrap',  $plugin_url . 'css/bootstrap.min.css');
    wp_enqueue_style('pizza_lightbox',  $plugin_url . 'css/lightgallery.min.css');
    wp_enqueue_style('toastrcss',  $plugin_url . 'css/toastr.css');
    wp_enqueue_style('pizza_style',  $plugin_url . 'css/style.css');
    wp_enqueue_style('pizza_newFontAwesme', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
    // wp_enqueue_style('pizza_font_awesme',  $plugin_url . 'css/font-awesome.min.css');
    wp_enqueue_script('pizza_basic',  "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js");
    wp_enqueue_script('pizza_ligh',  $plugin_url . 'js/lightgallery.js');
   wp_enqueue_script('pizza_lightbox_full',  $plugin_url . 'js/lg-fullscreen.min.js');
   wp_enqueue_script('pizza_bootstrapjs',  $plugin_url . 'js/bootstrap.min.js');
   wp_enqueue_script('toastrjs',  $plugin_url . 'js/toastr.js');
    wp_enqueue_script('my_custom',  $plugin_url . 'js/custom-fron.js');
   
}
add_action('wp_footer', 'add_my_css');



 ?>