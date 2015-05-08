<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : ?>
<header class="header">

</header>
<?php $postCount = 0; ?>
<?php while ( have_posts() ) : the_post(); 
	$postCount++;
?>
<?php endwhile; ?>
<?php if ($postCount > 0){
	$searchWord = get_search_query(); ?>
	<div class="fullContainer galleryContainer">
	<div class="fixedContainerBox">
		<div class="fixedContainer">
			<div class="galleryWrapper">
				<div class="galleryBoxContainer js-isotope" data-isotope-options='{ "columnWidth": 280, "gutter":20, "itemSelector": ".galleryImageContainer" }'>
				</div>
			</div>
		</div>
	</div>
	<script>
		searchWord('<?php echo $searchWord; ?>');
	</script>
<?php } ?>
<?php else : 
$searchWord = get_search_query();
 ?>
	<div class="fullContainer">
	<div class="fixedContainerBox">
		<div class="fixedContainer">
			<div class="searchText">
			<h1>Sorry, we couldn’t find any results for that search. Please try again or <a href="<?php echo get_page_link(382); ?>">browse our inventory</a>.</h1>
			</div>
		</div>
	</div>
	<script>
		searchWord('<?php echo $searchWord; ?>');
	</script>
<?php endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>