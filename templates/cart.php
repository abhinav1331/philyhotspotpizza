<?php 
/*
* Template Name: Pizza Cart Page Template
*/
get_header();
 while ( have_posts() ) : the_post(); ?>
<div class="container1">
	<div class="row1">
		<div class="heading">
			<h1><?php the_title(); ?></h1>
		</div>
		<?php the_content(); ?>
	</div>
</div>
 <?php endwhile; wp_reset_query(); ?>
 <?php 
get_footer();

  ?>