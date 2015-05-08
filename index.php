<?php get_header(); ?>
<section id="content" role="main">
	<div class="fullContainer">
		<div class="fixedContainerBox">
			<div class="fixedContainer">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php if ( has_post_thumbnail() ) { ?>
			<div class="backdropBox">
				<div class="backdropHover">
					<h5>
						<?php print_custom_field('backdrop_id'); ?>
					</h5>
				</div>
				<?php the_post_thumbnail(); ?>
			</div>
			<?php } ?>

<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
	
<?php get_template_part('nav', 'below'); ?>
</section>
<?php get_footer(); ?>