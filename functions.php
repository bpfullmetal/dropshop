<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
);
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}


function setup_theme_admin_menus() {  
    add_submenu_page('options-general.php',  
        'Drop Shop Settings', 'Drop Shop Settings', 'manage_options',  
        'dropshop-Customization-elements', 'blankslate_dropshop_Customization_settings');     
        }  


add_action('after_setup_theme', 'blankslate_setup');

function blankslate_dropshop_Customization_settings() {  
 if (!current_user_can('manage_options')) {  
    wp_die('You do not have sufficient permissions to access this page.');  
}      
if (isset($_POST["update_settings"])) {  


$phoneOne = esc_attr($_POST["phoneOne"]);  
update_option("phoneOne", $phoneOne); 

$phoneTwo = esc_attr($_POST["phoneTwo"]);  
update_option("phoneTwo", $phoneTwo);

$daysNew = esc_attr($_POST["daysNew"]);  
update_option("daysNew", $daysNew);  


?>  
<div id="message" class="updated">Settings saved</div>  
<?php }  
$phoneOne = get_option("phoneOne"); 
$phoneTwo = get_option("phoneTwo"); 
$daysNew = get_option("daysNew");

?>
 <div class="wrap">  
        <?php screen_icon('themes'); ?> <h2>Drop Shop</h2>  
        <form method="POST" action="">  
            <table class="form-table">  
            <tr width="50"><td style="width:200px; padding:0;"><h1>Info</h1></td></tr>
                <tr valign="top">  
                    <th scope="row">  
                        <label for="phoneOne">  
                           Phone 1:
                        </label>  
                    </th>  
                    <td>  
                        <input id="phoneOne" name="phoneOne" value="<?php echo get_option("phoneOne"); ?>" type="text">
                    </td>  
                </tr>
                <tr valign="top">  
                    <th scope="row">  
                        <label for="phoneTwo">  
                           Phone 2:
                        </label>  
                    </th>  
                    <td>  
                        <input id="phoneTwo" name="phoneTwo" value="<?php echo get_option("phoneTwo"); ?>" type="text">
                    </td>  
                </tr>
                <tr valign="top">  
                    <th scope="row">  
                        <label for="daysNew">  
                           Days "New":
                        </label>  
                    </th>  
                    <td>  
                        <input id="daysNew" name="daysNew" value="<?php echo get_option("daysNew"); ?>" type="text">
                    </td>  
                </tr>
            </table>
            <p>  
    <input type="submit" value="Save settings" class="button-primary"/>  
</p>  
            <input type="hidden" name="update_settings" value="Y" /> 
        </form>  
    </div>  
    <?php
} 

add_action("admin_menu", "setup_theme_admin_menus");  

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<table class="form-table">
		
				<th><label for="jobTitle">Title</label></th>
				<td>
					<input type="text" name="jobTitle" value='<?php echo esc_attr( get_the_author_meta( 'jobTitle', $user->ID ) ); ?>' size="25" />
				</td>
			</tr>
		
		<tr>

	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'jobTitle', $_POST['jobTitle'] );
	}

/*function change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Backdrops';
    $submenu['edit.php'][5][0] = 'Backdrops';
    $submenu['edit.php'][10][0] = 'Add Backdrop';
    $submenu['edit.php'][16][0] = 'Backdrop Tags';
    echo '';
}
function change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Backdrops';
    $labels->singular_name = 'Backdrops';
    $labels->add_new = 'Add Backdrop';
    $labels->add_new_item = 'Add Backdrop';
    $labels->edit_item = 'Edit Backdrop';
    $labels->new_item = 'Backdrops';
    $labels->view_item = 'View Backdrop';
    $labels->search_items = 'Search Backdrops';
    $labels->not_found = 'No Backdrops found';
    $labels->not_found_in_trash = 'No Backdrops found in Trash';
    $labels->all_items = 'All Backdrops';
    $labels->menu_name = 'Backdrops';
    $labels->name_admin_bar = 'Backdrops';
}
 
add_action( 'admin_menu', 'change_post_label' );
add_action( 'init', 'change_post_object' );*/

function my_connection_types() {
    p2p_register_connection_type( array(
        'name' => 'posts_to_clients',
        'from' => 'post',
        'to' => 'clients'
    ) );
}
add_action( 'p2p_init', 'my_connection_types' );

add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = "<div class=\"slideshow-wrapper\">\n";
    $output .= "<div class=\"preloader\"></div>\n";
    $output .= "<ul data-orbit>\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        // Fetch the thumbnail (or full image, it's up to you)
//      $img = wp_get_attachment_image_src($id, 'medium');
//      $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
        $img = wp_get_attachment_image_src($id, 'full');
        $imgcount = count($attachments);
        $imgwidth = 100/$imgcount;
        $output .= "<li style='width:".$imgwidth."%; height:auto'>\n";
        $output .= "<img src=\"{$img[0]}\" style='width:100%; height:100%;' alt=\"\" />\n";
        $output .= "</li>\n";
    }

    $output .= "<div class='clear'></div></ul>\n";
    $output .= "</div>\n";

    return $output;
}

function infinite_scroll_render() {  
    get_template_part( 'content-post', 'standard' );  
} 

add_theme_support( 'infinite-scroll', array(  
    'type' => 'click',  
    'container' => 'primary',  
    'render'    => 'infinite_scroll_render',  
)); 

add_action('wp_ajax_nopriv_do_ajax', 'our_ajax_function');
add_action('wp_ajax_do_ajax', 'our_ajax_function');

function our_ajax_function(){
     switch($_REQUEST['fn']){
               case 'filter':
          	   		$tid = $_REQUEST['tid'];
          	   		$paged = $_REQUEST['paged'];
          	   		$type = $_REQUEST['type'];
          	   		$arg = '';
          	   		if($tid == 'all'){
	          	   	$arg = array('post_type' => 'backdrops', 'posts_per_page' => 6, 'paged' => $paged);
          	   		}else if($type == '1'){
	          	   	$arg = array('post_type' => 'backdrops', 'posts_per_page' => 6, 'paged' => $paged, 's' => $tid);	
          	   		}else{
	          	   	$arg = array('post_type' => 'backdrops', 'posts_per_page' => 6, 'tag__in' => $tid, 'paged' => $paged);	
          	   		}
          	   		
		  	   		$output = json_encode(filterTags($arg, $tid, $paged));
               echo $output;
          break;
          case 'load':
          	   		$cid = $_REQUEST['cid'];
          	   		$pid = $_REQUEST['pid'];
          	   		$arg = '';
          	   		if($cid == 'all'){
	          	   	$arg = array('post_type' => 'backdrops', 'posts_per_page' => 6, 'paged' => $pid);
          	   		}else{
	          	   	$arg = array('post_type' => 'backdrops', 'posts_per_page' => 6, 'tag__in' => $cid, 'paged' => $pid);	
          	   		}
          	   		
		  	   		$output = loadMore($arg, $pid, $cid);
               echo $output;
          break;
          case 'moreCases':
          	   		$cid = $_REQUEST['cid'];
          	   		$paged = $_REQUEST['paged'];
		  	   		$output = getCases($cid, $paged);
               echo json_encode($output);
          break;
          case 'filter_bds':
          			//$locs = $_REQUEST['locs'];
          	   		//$daynight = $_REQUEST['daynight'];
          	   		//$cats = $_REQUEST['cats'];
          	   		//$povs = $_REQUEST['povs'];
          	   		//$dropwidth = $_REQUEST['width'];
          	   		//$dropheight = $_REQUEST['height'];
          	   		//$dropid = $_REQUEST['dropid'];
          	   		//$kWord = $_REQUEST['keyword'];
          	   		$fJson = $_REQUEST['fJSON'];
          	   		$paged = $_REQUEST['paged'];

		  	   		//$output = filterdrops($locs, $daynight, $cats, $dropwidth, $dropheight, $dropid, $povs, $kWord);
		  	   		$output = filterdrops( $fJson, $paged );
               echo json_encode($output);
          break;
          case 'filter_session':
          		$filterJson = $_REQUEST['fJson'];
		  	   	$output = setFilterSession($filterJson);
		  	   	echo $output;
          break;
          case 'clear_session':
		  	   	$output = clearFilterSession();
		  	   	echo $output;
          break;
          
          }
     die;
}

function filterTags($arg, $tid, $paged){ ?>
	<?php 
	$contentArray = array();
	$galleryImageArray = array();
	$my_secondary_loop = new WP_Query($arg);
				if( $my_secondary_loop->have_posts() ):
			   		 while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post(); 
		$imageURL = '';
			if ( has_post_thumbnail() ) { 
				$ID = get_the_ID();
				$terms = get_the_terms($post->ID, 'category');
				$availability = '';
				$new = '';
				$numOfDays = get_option('daysNew');
				$mylimit = $numOfDays * 86400; //days * seconds per day
$post_age = date('U') - get_the_date('U');
			if ($post_age < $mylimit) {
				$new = '<div class="newTag"><img src="'.get_template_directory_uri().'/images/new.png"/></div>';
				
					}
			if ($terms){
				foreach($terms as $term){
					if ($term->slug == 'not_available'){
						$availability = '<div class="unavailable"><div class="unavailableTable"><div class="unavailableCell"><h2>Not Available</h2></div></div></div>';
					}
				}
			}
				$imageURL = wp_get_attachment_url( get_post_thumbnail_id(), 'small-image' );
	$galleryImageBox = '<div class="galleryImageContainer new" onclick="lightbox(&#39;'.$imageURL.'&#39;,&#39;'.get_the_title().$termslist.'&#39;,&#39;'.get_custom_field("backdrop_id").'&#39;);">'.$availability.$new.'<div class="galleryImageHover"><div class="galleryTable"><div class="galleryCell"><h4>'.get_custom_field('backdrop_id').'</h4><h4 class="galleryHoverTitle">'.get_the_title().'</h4></div></div></div><img src="'.$imageURL.'"/></div>';
	array_push($galleryImageArray, $galleryImageBox);
  		 	 
		 }
					
		endwhile;
		endif;
		wp_reset_postdata(); 
		array_push($contentArray, $galleryImageArray);
		
		$postCount = '';
			if($tid == 'all'){
				$posts = wp_count_posts();
				$postCount = $my_secondary_loop->found_posts;
			}else{
				$taxonomy = "post_tag";
				$term_id = $tid;
				$term = get_term_by('term_id', $term_id, $taxonomy);
				$postCount = $term->count; 
			} 
			if($postCount > ($paged*6)){
				array_push($contentArray, '1');
				}else{
				array_push($contentArray, '0');	
				}
		return $contentArray;
}

function loadMore($arg, $pid, $cid){
	 $my_secondary_loop = new WP_Query($arg);
				if( $my_secondary_loop->have_posts() ):
			   		 while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post(); 
			   		 $imageURL = '';
			   		 $ID = get_the_ID();
			   		 	if ( has_post_thumbnail() ) { 
				   		 	$imageURL = wp_get_attachment_url( get_post_thumbnail_id(), 'small-image' );  
			   		 	?>
			   		 	
				   		 	 <div class="galImage" onclick="lightbox('<?php echo $imageURL?>', '<?php the_title() ?>');">
				   		 	 <div class="galImageImage">
				   		 	 		<div class="galImageCover">
				   		 	 			<div class="galImageCoverBox">
					   		 	 			<div class="magnifyingGlass">

				   		 	 				</div>
				   		 	 			</div>
					   		 	 	</div>
					   		 	 <div class="imageHolder">
					   		 	 <?php the_post_thumbnail('extra-large-image'); ?>
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
						<?php 
						   if($cid == 'all'){
							$posts = wp_count_posts();
							$postCount = $posts->publish;
						}else{
							$taxonomy = "post_tag";
							$term_id = $tid;
							$term = get_term_by('term_id', $term_id, $taxonomy);
							$postCount = $term->count; 
						} 
							if($postCount <= (6*$pid)){ ?>
							<script>
							$('.loadMore').fadeOut();
							</script>
							<?php }

}

function getCases($cid, $paged){
$caseStudyArray = array();
$moreCasesArray = array();
$caseStudyDiv = '';	
	
$clientPosts = new WP_Query(array( 'post__not_in' => array($cid), 'post_type' => 'post', 'posts_per_page' => -1 ));
$clientPostCount = $clientPosts->found_posts;
 						
$my_secondary_loop = new WP_Query(array( 'post__not_in' => array($cid), 'post_type' => 'clients', 'posts_per_page' => 6, 'paged' => $paged, 'tax_query' => array(
		array(
			'taxonomy' => 'project_type',
			'field'    => 'slug',
			'terms'    => 'featured-2',
		),
	),
	)); 
	 if( $my_secondary_loop->have_posts() ): 
		while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post(); 
			$caseStudyStyle = ''; 
			if ( has_post_thumbnail() ) { 
				$imageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'small-image' ); 
				$caseStudyStyle = 'style="background-image:url('.$imageURL.');"'; 
			}
			$title = get_the_title(); 
			$link = get_the_permalink(); 
			$theDate = get_the_date();
		
			$case = '<a href="'.$link.'"><div class="otherCaseStudyBox new" '.$caseStudyStyle.'><div class="caseCover"><div class="caseCoverTable"><div class="caseCoverCell"><h5>'.$theDate.'</h5><p>'.$title.'</p></div></div></div></div></a>';
			array_push($moreCasesArray, $case);
					
						endwhile;
						$loadMore = 0;
						if ($clientPostCount > $paged*6){
							$loadMore = 1;
						}
						endif;
						wp_reset_postdata(); 
			array_push($caseStudyArray, $moreCasesArray);
			array_push($caseStudyArray, $loadMore);
			
			return $caseStudyArray;
}

function filterdrops( $fJson, $paged ){

$fJson = stripslashes($fJson);
$fJson = json_decode($fJson, true);

$locs = $fJson['locs'];
$daynight = $fJson['dorn'];
$cats = $fJson['cats'];
$dropW = $fJson['width'];
$dropH = $fJson['height'];
$dropId = $fJson['dId'];
$povs = $fJson['povs'];
$kword = $fJson['kWord'];

if ($_SESSION['filterJson']){
	unset($_SESSION['filterJson']);
}

$args = array(
	'post_type' => 'backdrops',
	'posts_per_page' => 6,
	'paged' => $paged,
);

$locArr = array();
$locArr = $locs;

$povArr = array();
$povArr = $povs;

$catArr = array();
$catArr = $cats;

$dornArr = array();
$dornArr = $daynight;

if (count($locArr) > 0){
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'location',
			'field'    => 'slug',
			'terms'    => $locArr,
			'relation' => 'OR',
		)
	);
}

if (count($povArr) > 0){
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'point-of-view',
			'field'    => 'slug',
			'terms'    => $povArr,
			'relation' => 'OR',
		)
	);
}

if (count($catArr) > 0){
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $catArr,
			'relation' => 'OR',
		)
	);
}

if (count($dornArr) > 0){

	$argArr = array(
			'key'	 	=> 'day_or_night',
			'value'	  	=> $dornArr,
			'relation' => 'OR',
		);
	$arg = array(
		$argArr
	);
	if ($args['meta_query']){
		array_push($args['meta_query'], $argArr);
	}else{
		$args['meta_query'] = $arg;
	}
}

if ($kword){
	$args['tag_slug__in'] = array( $kword );
	$args['s'] = $kword;
	//$args['s'] = $kword;

}


if ($dropW){
	$argArr = array(
			'key'	 	=> 'width',
			'value'	  	=> $dropW,
		);
	$arg = array(
		$argArr
	);
	if ($args['meta_query']){
		array_push($args['meta_query'], $argArr);
	}else{
		$args['meta_query'] = $arg;
	}
}

if ($dropH){
	$argArr = array(
			'key'	 	=> 'height',
			'value'	  	=> $dropH,
		);
	$arg = array(
		$argArr
	);
	if ($args['meta_query']){
		array_push($args['meta_query'], $argArr);
	}else{
		$args['meta_query'] = $arg;
	}
}

if ($dropId){
	$args = array(
	'post_type' => 'backdrops',
	'posts_per_page' => -1,
	//'meta_key' => 'drop_id',
	//'meta_value' => $dropId,
	'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'backdrop_id',
				'value' => $dropId
			),
			array(
				'key' => 'drop_id',
				'value' => $dropId
			)
		)
	);
	//$args['s'] = $dropId;
}

$filterOuput = '';
$contentArray = array();
$galleryImageArray = array();

$my_secondary_loop = new WP_Query($args);
	if( $my_secondary_loop->have_posts() ):
		while( $my_secondary_loop->have_posts() ): $my_secondary_loop->the_post(); 
			$filterOuput .= '<div>'.get_the_title().'</div>';
			   
		$imageURL = '';
			if ( has_post_thumbnail() ) { 
				$ID = get_the_ID();
				$imageURL = wp_get_attachment_url( get_post_thumbnail_id(), 'small-image' );
	$galleryImageBox = '<div class="galleryImageContainer new" onclick="lightbox(&#39;'.$imageURL.'&#39;,&#39;'.get_the_title().$termslist.'&#39;,&#39;'.get_custom_field("backdrop_id").'&#39;);"><div class="galleryImageHover"><div class="galleryTable"><div class="galleryCell"><h4>'.get_custom_field('backdrop_id').'</h4><h4 class="galleryHoverTitle">'.get_the_title().'</h4></div></div></div><img src="'.$imageURL.'"/></div>';
	array_push($galleryImageArray, $galleryImageBox);
  		 	 
		 }
					
	endwhile;
	endif;
	wp_reset_postdata(); 
		array_push($contentArray, $galleryImageArray);
		
				$posts = wp_count_posts();
				$postCount = $my_secondary_loop->found_posts;
			if($postCount > ($paged*6)){
				array_push($contentArray, '1');
				}else{
				array_push($contentArray, '0');	
				}

return $contentArray;

}

add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}

function getMenus(){
	$menu_name = 'main-menu';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items($menu->term_id);
	
		foreach($menu_items as $menu_item){
			 if($menu_item->post_parent == 0){
				//print_r($menu_item);
				$name = $menu_item->title;
				$id = $menu_item->object_id;
				makesidebars($name, $id);
			}
		}
	}
}

add_action( 'after_setup_theme', 'getMenus');

function makesidebars($name, $id){
	if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
				'name' => $name,
				'id' => $id.'-sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4>',
				'after_title' => '</h4>'
				));
			}
}

function remove_sidebars() {
  unregister_sidebar( 'primary-widget-area' ); // primary on left
}
add_action( 'widgets_init', 'remove_sidebars', 11 );

function contactInfo( $atts ){
	$contact = '<div class="contact email">
				<h4>
				<a href="mailto:info@dropshopnyc.com">info@dropshopnyc.com</a>
				</h4>
			</div>
			<div class="contact phone">
				<a href="tel:818-96107805"><h4>818-961-7805</h4></a>
			</div>
			<div class="contact phone">
				<a href="tel:718-302-1458"><h4>718-302-1458</h4></a>
			</div>
			<div class="clear"></div>';
			
		return $contact;

}
add_shortcode( 'contact', 'contactInfo' );

add_filter('jpeg_quality', function($arg){return 80;});


if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'extra-large-image', 2000, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'large-image', 1500, 9999 );
	add_image_size( 'medium-image', 1100, 9999 );
	add_image_size( 'small-image', 800, 9999 );
}

function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

add_action( 'init', 'sessionSetup' );

function sessionSetup(){
	session_start(); 
}

function setFilterSession($fJson){
     $_SESSION['filterJson'] = $fJson;
     return $_SESSION['filterJson'];
}

function clearFilterSession(){
	unset($_SESSION['filterJson']);
}