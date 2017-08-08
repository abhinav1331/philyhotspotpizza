<?php 
function get_book_post_type_template($single_template) {
 global $post;

 if ($post->post_type == 'pizza') {
 	$plugin_url = plugin_dir_url( __FILE__ );
      $single_template = dirname( __FILE__ ). '/templates/single-pizza.php';
 }
 return $single_template;
}

add_filter( "single_template", "get_book_post_type_template" ) ;
 ?>