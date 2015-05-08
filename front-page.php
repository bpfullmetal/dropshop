<?php get_header(); ?>
<section id="content" role="main">

<?php if ( is_active_sidebar( 'home-sidebar' ) ){ ?>
<?php dynamic_sidebar( 'home-sidebar' ); ?>
<?php } ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if (get_the_content()){ ?>
	<div class="fullContainer greyBox">
		<div class="fixedContainerBox">
			<div class="fixedContainer">
				<?php the_content(); ?>
				<div class="mobile servicesGif">
					<img src="<?php echo get_template_directory_uri(); ?>/images/icons.gif"/>
				</div>
			</div>
		</div>
			<?php if (get_custom_field("bottom_link:get_post")){
				   	$linkpost = get_custom_field("bottom_link:get_post");
				   	$link = $linkpost['permalink'];
				   	$title = $linkpost['post_title']; 
				   	if (get_custom_field('bottom_text')){
				   		$title = get_custom_field('bottom_text');
				   	}
				   	?>
			<div class="bottomLink">
				<div class="fixedInnerBox">
				   	<a href="<?php echo $link; ?>"><?php echo $title; ?></a>
				</div>	
			</div>
			   	<?php } ?>
	</div>
	<?php } ?>
</article>
<?php endwhile; endif; ?>
<?php if ( get_custom_field('footer_image:to_image_src', 'get_post')){
		$imageUrl = get_custom_field('footer_image:to_image_src', 'get_post');
		//$shortUrl = explode( 'wp-content/', $imageUrl );
		//$shortUrl = 'wp-content/'.$shortUrl[1]; ?>
		<div class="imageFooter">
			<div class="imageFooterBackground" style="background-image:url('<?php echo $imageUrl ?>');">
			</div>
		</div>
		<script>
			detectImageLoad('<?php echo $imageUrl; ?>', 'imageFooterBackground');
		</script>
<?php } ?>

</section>

<?php get_footer(); ?>