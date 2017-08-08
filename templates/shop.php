<?php 
/*
* Template Name: Pizza Shop Page Template
*/
get_header();
 while ( have_posts() ) : the_post(); ?>
<div class="container">
	<div class="row">
		<div class="heading">
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="content-body">
			<div class="row">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
 <?php endwhile; wp_reset_query(); ?>
 <?php 
get_footer();

  ?>