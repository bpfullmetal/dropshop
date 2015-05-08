<!--<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<label class="hidden" for="s"><?php _e('Search:'); ?></label>
	<input type="text" value="<?php the_search_query(); ?>" autocorrect="off" autocomplete="off" placeholder="I'm looking for..." name="s" id="s" />
	<input type="submit" id="searchsubmit" value="Search" />
	<div class="searchArrowBig" onclick="searchToggle();">
		</div>
</form>-->

<?php
$taxonomies = array( 
    'location',
);

$povTax = array(
	'point-of-view',
);

$termArgs = array(
    'orderby'           => 'count', 
    'order'             => 'ASC',
    'hide_empty'        => false,  
    'fields'            => 'all', 
    'hierarchical'      => true, 
    'child_of'          => 0, 
    'get'               => '', 
    'name__like'        => '',
    'description__like' => '',
    'pad_counts'        => false, 
    'cache_domain'      => 'core',
    'parent'			=> 0
); 
$terms = get_terms($taxonomies, $termArgs);
$povs = get_terms($povTax, $termArgs);
$catArgs = array(
	'hide_empty' => false
);
$cats = get_categories($catArgs);
?>
<div class="closeForm" onclick="searchToggle();">
	<img src="<?php echo get_template_directory_uri(); ?>/images/x_pink.png">
</div>
<form id="searchform">
			
			<div class="filter_left">
			<div class="filter_box filter_size">
			<h4 class="filter_header">Size</h4>
				<div class="filter_width">
				<h6 class="filter_item">Width</h6>
				<input class="size" type="number" name="width">
				<h6 class="filter_item">FT</h6>
				</div>
				
				<div class="filter_height">
				<h6 class="filter_item">Height</h6>
				<input class="size" type="number" name="height">
				<h6 class="filter_item">FT</h6>
				</div>
			</div>
			
			<div class="filter_box filter_cats">
			<h4 class="filter_header">Categories</h4>
			<?php foreach($cats as $cat){ ?>
				<input class="cat_checkbox" type="checkbox" name="<?php echo $cat->name ?>" value="<?php echo $cat->slug ?>"> <h6 class="filter_item"><?php echo $cat->name ?></h6>
				<div class="clear"></div>
			<?php }?>
			</div>
			
			</div>
			
			
			<div class="filter_left">
			<div class="filter_box filter_daynight">
			<h4 class="filter_header">Day / Night</h4>
				<input class="daynight" type="checkbox" name="day" value="day"> <h6 class="filter_item">Day</h6>
				<div class="clear"></div>
				<input class="daynight" type="checkbox" name="night" value="night"> <h6 class="filter_item">Night</h6>
			</div>
			<div class="filter_box filter_povs">
				<h4 class="filter_header">POINT OF VIEW</h4>
					<?php foreach($povs as $pov){ ?>
						<input class="pov_checkbox" type="checkbox" name="<?php echo $pov->name ?>" value="<?php echo $pov->slug ?>"> <h6 class="filter_item"><?php echo $pov->name ?></h6>
					<?php if($pov->slug == 'floor'){ ?>
						<input class="pov_select" type="number" name="floor" width="50">	
					<?php } ?>
				<div class="clear"></div>
					<?php }?>
			</div>
			</div>
			
			
			<div class="filter_left">
			<div class="filter_box filter_locations">
			<h4 class="filter_header">Locations</h4>
			<?php foreach($terms as $term){ ?>
				<input class="location_checkbox" type="checkbox" name="<?php echo $term->name ?>" value="<?php echo $term->slug ?>"> <h6 class="filter_item"><?php echo $term->name ?></h6>
				<div class="clear"></div>
			<?php }?>
			</div>
			
			</div>
			
			
			<div class="filter_left filter_keyword_holder">
				<div class="filter_box filter_keyword">
					<h4 class="filter_header">KEYWORD</h4>
	
				<input class="keyword" type="text" name="keyword">
				
				</div>
			</div>
			
			<div class="filter_left left_id">
			<div class="filter_or">
				<h4 class="filter_header">-OR-</h4>
			</div>
			<div class="filter_box filter_id">
				<div class="filter_box filter_id">
					<div class="filter_header_holder">
					<h4 class="filter_header">Drop ID</h4>
					</div>
					<input class="drop_id" type="text" name="drop_id">
				</div>
			</div>
			</div>
			
			<div class="filter_submit_holder">
				<div class="filter_clear">
					Clear
				</div>
				<div class="filter_submit">
					Search
				</div>
			</div>
			<div class="clear"></div>
			
			</form>