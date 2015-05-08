<?php get_header(); ?>
<?php $my_secondary_loop = new WP_Query(array( 'post_type' => 'page', 'post__in' => array(476), 'posts_per_page' => 1)); ?>
	<?php if( $my_secondary_loop->have_posts() ):
			 while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post(); 
	 if(get_custom_field('header_image:to_image_src')){ 
		 $imageUrl = get_custom_field('header_image:to_image_src'); ?>
		 <script>
			 addHeaderBackground('<?php echo $imageUrl ?>');
		</script>
	<?php } 
		$headerText = get_custom_field('headercontent:do_shortcode');
	?>
	<div class="hidden404" style="display:none;">
		<?php echo $headerText; ?>
	</div>
		
		<script>
			addHeaderText('nothing', '404');
		</script>
				   		<?php 
						endwhile;
						endif;
						wp_reset_postdata(); ?>
<?php get_footer(); ?>