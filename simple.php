<?php
/*
Template Name: Simple Page
*/
?>

<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<header class="header">

</header>
	<div class="fullContainer">
	<div class="fixedContainerBox">
		<div class="fixedContainer simpleContainer">
			<?php the_content(); ?>
		</div>
	</div>
	</div>
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</section>
<?php get_footer(); ?>