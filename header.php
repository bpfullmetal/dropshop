<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Poly:400,400italic' rel='stylesheet' type='text/css'>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
var surl ='<?php echo 'http://' . $_SERVER['SERVER_NAME'].'/site'; ?>';
</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/less-1.7.5.js"></script>



<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<div class="lightBoxCover">
	<div class="lightBoxContainerInner">
		<div class="lightBox" onclick="closeLightBox();">
			<div class="lightBoxInner">
				<div class="lbImage">
				</div>
				<div class="x" onclick="closeLightBox();"></div>
			</div>
				<div class="lbTitle">
				<h3></h3>
				</div>
		</div>
	</div>
</div>

<?php
	global $post;
	$pid = $post->ID;
	
	//$shortUrl = explode( 'wp-content/', $imageUrl );
	
	//$shortUrl = 'http://' . $_SERVER['SERVER_NAME'].$imageUrl;

	//$imageUrl = wp_get_attachment_url( get_custom_field('header_image:to_image_src') );
?>
<div class="searchPlaceholder">

<div class="searchBar">
	<div class="fixedInnerBox">
		<div id="search">
			<?php get_search_form(); ?>
		</div>
	</div>
		
</div>

</div>

<header id="header" class="desktop" role="banner">
<?php if(get_custom_field('header_image:to_image_src')){ 
	$imageUrl = get_custom_field('header_image:to_image_src');
?>
<?php } ?>

<div class="fixedBackground">
	<div class="fixedContainerBox">
			<div class="headerLogoBottom">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo_bottom.png"/>
			</div>
	</div>
</div>
<div class="fixedHeader">
	<div class="headerNavBox">
	<div class="headerNavInner">
		<nav id="menu" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
			<div class="searchLink" onclick="searchToggle(); return false;">
				<a href="#">Search</a><div class="searchArrowSmall"></div>
			</div>
			<div class="clear"></div>
		</nav>
	</div>
	<div class="clear"></div>
	</div>
</div>

<div class="headerOverlay">
</div>
<div class="headerGradient">
</div>
		
<div class="headerBackground" style="background-image:url('<?php echo $imageUrl; ?>');">
</div>
<script>
	detectImageLoad('<?php echo $imageUrl ?>', 'headerBackground');
</script>


<div class="fixedContainerBox">
	<div class="fixedContainer">

			<div class="headerText">
			<?php if(get_custom_field('headercontent:do_shortcode') && $post){ ?>
				<?php print_custom_field('headercontent:do_shortcode'); ?>
				<?php } ?>
			</div>
	</div>
			<div class="headerLogo">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo_header.png"/>
				<div class="logoDrips">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo_drips.png"/>
				</div>
			</div>
</div>

</header>
<header id="header" class="mobile" role="banner">
<?php if(get_custom_field('header_image:to_image_src')){ 
	$imageUrl = get_custom_field('header_image:to_image_src');
?>
<?php } ?>

<div class="fixedBackground">
	<div class="fixedContainerBox">
			<div class="headerLogoBottom">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo_bottom.png"/>
			</div>
	</div>
</div>
<div class="fixedHeader">

	<div class="fixedContainerBox">
	<div class="headerNavBox">
		<div class="openNav" onclick="toggleNav();"></div>
	<div class="headerNavInner">
		<nav id="menu" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
			<div class="searchLink" onclick="searchToggle(); return false;">
					<a href="#">Search</a><div class="searchArrowSmall"></div>
			</div>
			<div class="clear"></div>
		</nav>
	</div>
	<div class="clear"></div>
	</div>
	</div>
	
</div>

<div class="headerOverlay">
</div>
<div class="headerGradient">
</div>
		
<div class="headerBackground" style="background-image:url('<?php echo $imageUrl; ?>');">
</div>
<script>
	detectImageLoad('<?php echo $imageUrl ?>', 'headerBackground');
</script>


<div class="fixedContainerBox mobileContainer">
	<div class="fixedContainer">

			<div class="headerText">
			<?php if(get_custom_field('headercontent:do_shortcode') && $post){ ?>
				<?php print_custom_field('headercontent:do_shortcode'); ?>
				<?php } ?>
			</div>
	</div>
			<div class="headerLogo">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo_header.png"/>
				<div class="logoDrips">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo_drips.png"/>
				</div>
			</div>
</div>

</header>
<div id="container">