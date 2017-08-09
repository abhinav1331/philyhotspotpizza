<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); 
global $post;
$plugin_url = plugin_dir_url( __FILE__ );
$page = get_page_by_path( 'cart' );
$cartPageURL = esc_url( get_permalink($page->ID) );
?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="container">
	<div class="row">
		<div class="col-lg-5">
			<?php if ( has_post_thumbnail() )  {
				$url = get_the_post_thumbnail_url();
			} else  {
				$url = "http://placehold.it/1920x1024&amp;text=No image found";
			} 
			?>
			<ul id="lightgallery">
				<li data-responsive="<?php echo $url; ?>" data-src="<?php echo $url; ?>">
					<a href="">
						<img class="img-responsive" src="<?php echo $url; ?>" alt="thumbnail">
					</a>
				</li>
			</ul>
			
		</div>
		<div class="col-lg-7">
			<div class="major-heading">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="major-content">
				<?php the_content(); ?>
			</div>
			<div class="extra-component">
				<form action="" id="add_to_cart">
					<h1>Pizza Size</h1>
					<ul class="sizes">
					<?php 
					$size_price = get_post_meta($post->ID,'size_price');
					$sizeIndex = 1; 
					foreach ($size_price as $key => $value) {
						$val = json_decode($value);
						?>
						<li>
							<label for="sizeIndex_<?php echo $sizeIndex ?>"><?php echo ucfirst($val->size); ?></label>
							<input type="radio" name="base_size" value="<?php echo $val->size ?>" id="sizeIndex_<?php echo $sizeIndex ?>">
							<input type="hidden" name="base_price" value="<?php echo $val->prize; ?>">
						</li>
						<?php
						$sizeIndex++;
					}
					 ?>
					 </ul>
					 <div class="extra" style="display:none;">
						 <h1>Pizza Base</h1>
						 <ul class="pizza-base">
						 	<?php 
							$base_price = get_post_meta($post->ID,'base_price');
							$baseIndex = 1; 
							foreach ($base_price as $key => $value) {
								$val = json_decode($value);
								?>
								<li>
									<label for="baseIndex_<?php echo $baseIndex ?>"><?php echo ucfirst($val->base); ?></label>
									<input type="radio" name="base_base" value="<?php echo $val->base ?>" id="baseIndex_<?php echo $baseIndex ?>">
									<input type="hidden" name="base_price" value="<?php echo $val->prize; ?>">
								</li>
								<?php
								$baseIndex++;
							}
						 	?>
						 </ul>
						 <h1>Pizza Toppings</h1>
						 <ul class="pizza-baseToppings">
						 	<?php 
							$toppings_price = get_post_meta($post->ID,'toppings_price');
							$toppingsIndex = 1; 
							foreach ($toppings_price as $key => $value) {
								$val = json_decode($value);
								?>
								<li>
									<label for="toppingsIndex<?php echo $toppingsIndex ?>"><?php echo ucfirst($val->toppings); ?></label>
									<input type="checkbox" name="base_toppings" value="<?php echo $val->toppings ?>" id="toppingsIndex<?php echo $toppingsIndex ?>">
									<input type="hidden" name="base_price" value="<?php echo $val->prize; ?>">
									<input type="hidden" class="class_selected_<?php echo $val->size; ?>">
								</li>
								<?php
								$toppingsIndex++;
							}
						 	?>
						 </ul>
						 <h1>Extra</h1>
						 <ul class="pizza-base">
						 	<?php 
							$extra_price = get_post_meta($post->ID,'extra_price');
							$extra_priceIndex = 1; 
							foreach ($extra_price as $key => $value) {
								$val = json_decode($value);
								?>
								<li>
									<label for="extra_priceIndex<?php echo $extra_priceIndex ?>"><?php echo ucfirst($val->extra); ?></label>
									<input type="checkbox" name="extra_toppings" value="<?php echo $val->extra; ?>" id="extra_priceIndex<?php echo $extra_priceIndex ?>">
									<input type="hidden" name="base_price" value="<?php echo $val->prize; ?>">
								</li>
								<?php
								$extra_priceIndex++;
							}
						 	?>
						 </ul>
						  	<div class="quantity">
							  <input type="number" min="1" max="9" step="1" value="1" name="quantity">
							</div>
					 </div>
					 <div class="priceOuter">
					 	<p class="myPrice"></p>
					 </div>
					
					 <div class="addToCarT">
					 	<input type="hidden" name="site_url" value="<?php echo site_url(); ?>">
					 	<input type="hidden" name="admin_url" value="<?php echo $plugin_url; ?>">
					 	<input type="hidden" name="pizza_id" value="<?php echo $post->ID; ?>">
					 	<input type="hidden" name="pizza_size" value="">
					 	<input type="hidden" name="pizza_base" value="">
					 	<input type="hidden" name="pizza_toppings" value="">
					 	<input type="hidden" name="pizza_extra" value="">
					 	<input type="hidden" name="pizza_final" value="">
					 	<input type="hidden" name="cartURL" value="<?php echo $cartPageURL; ?>">
					 	<button type="button" class="btn btn-success Addto-cart" disabled onclick="AddToCart()">Order Now</button>
					 </div>
				 </form>
			</div>

		</div>
	</div>
</div>
<?php endwhile; wp_reset_query(); ?>
<?php get_footer();
