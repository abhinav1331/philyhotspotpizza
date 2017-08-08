<div class="container">
	<div class="row">
		<?php
	      global $post;
	      $i=1;
	      $paged = ( get_query_var('page') ) ? get_query_var('page') : 1; $query = new WP_Query( array( 'paged' => $paged ) );
			  $query_args = array( 'post_type' => 'pizza' ,'posts_per_page' => 12 , 'order' => 'DESC', 'paged' => $paged );
			  // create a new instance of WP_Query
			  $the_query = new WP_Query( $query_args );
			   if ( $the_query->have_posts() ) :
			    while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop 
		    ?>
			<div class="div col-lg-4" style="border:1px;">
				<figure>
					<?php if ( has_post_thumbnail() ) 
                    {
						$url = get_the_post_thumbnail_url();
                    }
                    else
                    {
                   		$url = "http://placehold.it/400x400&amp;text=No image found";
                    };
                    ?>
                    <img src="<?php echo $url; ?>" alt="">
				</figure>
				<div class="view-detai">
					<p><?php the_title(); ?></p>
					<a href="<?php the_permalink(); ?>">View Details</a>
				</div>
			</div>
		<?php endwhile; ?>
		<?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
			<nav class="prev-next-posts">
				<div class="prev-posts-link">
					<?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); // display older posts link ?>
				</div>
				<div class="next-posts-link">
					<?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
				</div>
			</nav>
		<?php } ?>

		<?php else: ?>
		<article>
			<h1>Sorry...</h1>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		</article>
		<?php endif; ?>
	</div>
</div>