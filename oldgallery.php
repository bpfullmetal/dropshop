<div class="fullGallery">
<div class="buttonCoverRight"></div>
<div class="galleryButtonRight" onclick="moveForward()"></div>
<div class="buttonCoverLeft"></div>
<div class="galleryButtonLeft" onclick="moveBackByImage()"></div>
	<div class="galleryImageHolder">

	<?php	
	$counter = 1;
	
	$my_secondary_loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => -1, 'cat' => 14 ));
				if( $my_secondary_loop->have_posts() ):
			   		 while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post(); 
			   		 
			   		 $imageURL = '';
			   		 	if ( has_post_thumbnail() ) {
				   		 	$imageURL = wp_get_attachment_url( get_post_thumbnail_id() );  ?>
				   		 	 <div class="image <?php echo $counter; ?>" style="background-image:url('<?php echo $imageURL ?>');"></div>
				   		 	<?php }
					
				   		$counter++;
						endwhile;
						endif;
						wp_reset_postdata(); ?>
		
		<div class="clear"></div>
	</div>