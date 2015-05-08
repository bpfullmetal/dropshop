<?php
/*
Template Name: Inventory
*/
?>

<?php get_header(); ?>
<!--<div class="fullContainer inventoryContainer greyBox">
	<div class="fixedContainerBox">
		<div class="fixedContainer">

<div class="tagFilterHolder">
	<div class="filterButtonHolder">
	<div class="filterButton filter_all" onclick="filterTags('all');">
		<h6>all</h6>
	</div>
	</div>
	<?php $allTags = get_tags(); ?>
	<?php foreach($allTags as $tag){ ?>
		<div class="filterButtonHolder">
		<div class="filterButton <?php echo 'filter_'.$tag->term_id; ?>" onclick="filterTags(<?php echo $tag->term_id; ?>)">
		<h6><?php print $tag->name; ?></h6>
		</div>
		</div>
<?php } ?>

	<div class="clear"></div>
</div>
		</div>
	</div>
</div>-->

<div class="fullContainer galleryContainer">
	<div class="fixedContainerBox">
		<div class="fixedContainer">
			<div class="galleryWrapper">
				<div class="galleryBoxContainer js-isotope" data-isotope-options='{ "columnWidth": 280, "gutter":20, "itemSelector": ".galleryImageContainer" }'>
					
				<div class="clear"></div>
				
			</div>
			<div class="loadMore" onclick="loadMore();">
					<h5><a>Load More</a></h5>
				</div>
		</div>
	</div>
</div>
<?php if ($_SESSION['filterJson']){ ?>
	<script>
		//filterTags('all');
		placeFilterOptions( '<?php echo $_SESSION['filterJson'] ?>' );
		//searchWord('city');
	</script>
<?php }else{ ?>
	<script>
		filterBDs();
	</script>
<?php } ?>
<script>
	searchToggle();
</script>

<?php get_footer(); ?>