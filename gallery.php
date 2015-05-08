<?php
/*
Template Name: Gallery
*/
?>

<?php get_header(); ?>
<div class="galleryWrapper">
<h1>Backdrop Inventory</h1>
<div class="allTags">
	<div class="singleTag all on" onclick="filterTags('all');">
		<h6>all</h6>
	</div>
	<?php $allTags = get_tags(); ?>
	<?php foreach($allTags as $tag){ ?>
		<div class="singleTag <?php echo $tag->term_id; ?>" onclick="filterTags('<?php echo $tag->term_id; ?>')">
		<h6><?php print $tag->name; ?></h6>
		</div>
<?php } ?>

	<div class="clear"></div>
</div>	
	<div class="galleryBoxes">
	<div class="galleryBoxesInner" style="position:relative;">
	<?php $my_secondary_loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => 6)); ?>

				<?php if( $my_secondary_loop->have_posts() ):
			   		 while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post(); 
			   		 $imageURL = '';
			   		 	if ( has_post_thumbnail() ) { 
				   	$imageURL = wp_get_attachment_url( get_post_thumbnail_id() ); 
				   	$imageTitle = get_the_title();
			   		 	?>
				   		 	 <div class="galImage" onclick="lightbox('<?php echo $imageURL?>', '<?php echo $imageTitle ?>');">
				   		 	 <div class="galImageImage">
				   		 	 		<div class="galImageCover">
				   		 	 			<div class="galImageCoverBox">
					   		 	 			<div class="magnifyingGlass">

				   		 	 				</div>
				   		 	 			</div>
					   		 	 	</div>
					   		 	 	<div class="imageHolder">
					   		 	 <?php the_post_thumbnail(); ?>
					   		 	 	</div>
				   		 	 </div>
					   		 	 <div class="galTitle">
					   		 	 	<h6><?php the_title(); ?></h6>
					   		 	 </div>
				   		 	 </div>
				   		 	<?php }
					
						endwhile;
						endif;
						wp_reset_postdata(); ?>
						<div class="clear"></div>
						</div>
						<div class="clear"></div>
						<?php $postCount = wp_count_posts(); 
							if($postCount->publish > 6){
						?>
		<div class="loadMore" onclick="loadMore()">
			<img src="<?php echo get_template_directory_uri(); ?>/images/Load_More.png"/>
		</div>
                <div class="checkBack"><h5>Please check back soon, new inventory is being added daily.</h5></div>
		<?php } ?>
	</div>

</div>
			
<?php get_footer(); ?>