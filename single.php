<?php get_header(); ?>
<section id="content" role="main">
<?php 
$currentPostID = '';
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$title = get_the_title(); 
		$currentPostID = $post->ID;
	 if(get_custom_field('header_image:to_image_src')){ 
		 $imageUrl = get_custom_field('header_image:to_image_src'); ?>
		 <script>
			 addHeaderBackground('<?php echo $imageUrl ?>', 'casestudy');
		</script>
	<?php } ?>
	<?php if (get_the_content()){ ?>
		<div class="caseStudyContent">
			<?php the_content(); ?>
		</div>
	<?php } ?>
		<script>
			addHeaderText('<?php echo $title; ?>', 'casestudy', '<?php echo get_the_date(); ?>');
		</script>
		
<?php endwhile; endif; 

$clientPosts = new WP_Query(array( 'post__not_in' => array($cid), 'post_type' => 'post', 'posts_per_page' => -1 ));
$clientPostCount = $clientPosts->found_posts;
$loadMore = 0;
if ($clientPostCount > 6){
	$loadMore = 1;
}
	
	
$my_secondary_loop = new WP_Query(array( 'post__not_in' => array($currentPostID), 'post_type' => 'post', 'posts_per_page' => 6 )); 
	 if( $my_secondary_loop->have_posts() ): ?>
	 <div class="fullContainer cases">
	 <div class="fixedContainerBox cases">
		<div class="fixedContainer">
			<p class="moreCases">MORE</p>
	 		<div class="otherCaseStudys">
			<?php while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post();
			$caseStudyStyle = ''; 
			if ( has_post_thumbnail() ) { 
				$imageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
				$caseStudyStyle = 'style="background-image:url('.$imageURL.');"'; 
			}
		$title = get_the_title(); 
		$link = get_the_permalink(); ?>
		<a href="<?php echo $link; ?>">
		<div class="otherCaseStudyBox new" <?php echo $caseStudyStyle; ?>>
		
			<div class="caseCover">
				<div class="caseCoverTable">
					<div class="caseCoverCell">
						<h5><?php echo get_the_date(); ?></h5>
						<p><?php the_title(); ?></p>
					</div>
				</div>
			</div>
			
		</div>
		</a>
			<?php 
					
						endwhile; ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
				<div class="loadMore" onclick="loadMoreCases('<?php echo $currentPostID; ?>');">
					<h5><a>Load More</a></h5>
				</div>
		</div>
	 </div>
	 </div>
						<?php
						endif; 
						wp_reset_postdata(); ?>
	<div class="clear"></div>
	
						<script>
							caseStudys('<?php echo $loadMore; ?>');
						</script>
<!--<footer class="footer">
<?php get_template_part( 'nav', 'below-single' ); ?>
</footer>-->
</section>
<?php get_footer(); ?>