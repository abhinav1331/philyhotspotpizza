<?php 



/*--------------Events---------------*/
function codex_int_Events_section() {
  $labels = array(
    'name' => 'Pizza',
    'singular_name' => 'Pizza',
    'add_new' => 'Add Pizza',
    'add_new_item' => 'Add New Pizza',
    'edit_item' => 'Edit Pizza',
    'new_item' => 'New Pizza',
    'all_items' => 'All Pizza',
    'view_item' => 'View Pizza',
    'search_items' => 'Search Pizza',
    'not_found' =>  'No Pizza found',
    'not_found_in_trash' => 'No Pizza found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Pizza'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'pizza' => 'about' ), 
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 

  register_post_type( 'pizza', $args ); 
}  

    add_action( 'init', 'codex_int_Events_section' );
/*--------------/Events---------------*/

 ?>