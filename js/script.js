var searchSwitch = 0;
var currentClient;
//var currentTag = 'all';
var container;
//var paged = 1;
var iso;
var galleryType;
var headerHeight;
var opacityInc;
var hTextTopPos;
var hTextOpacityInc;
var searchHeight;
var headerDiv;
var mobileHeaderDiv;
var navSwitch = 0;


$(document).ready(function(){
	
	mobileHeaderDiv = $('header#header.mobile');
	headerDiv = $('header#header.desktop');
	
	closeNav();
	
	if ($(window).width() < 692){
		$('.current_page_item').click(function(){
			toggleNav();
			return false;
		});
	}
	
/*	$.getJSON("https://spreadsheets.google.com/feeds/list/1AncOH1nvmy0JAdYv2R_P1KORPDtPMWIg2W-1jw2wuO4/od6/public/basic?hl=en_US&alt=json", function(data) {
  //first row "title" column
  console.log(data.feed.entry);
});*/
container = document.querySelector('.galleryBoxContainer');
// init
if ($('body').hasClass('.galleryBoxContainer')){
 iso = new Isotope( container, {
  // options
  itemSelector: '.galleryImageContainer',
  layoutMode: 'masonry'
});
}

$('.filter_submit').click(function(){
	filterPage = 1;
	getFilterOptions();
});

$('.filter_clear').click(function(){
	clearFilterOptions();
});

});

$(window).resize(function(){
	/*if ($('.searchPlaceholder').height() > 0){
		if ($(window).width() >= 692){
			$('.searchPlaceholder').css('height', 120+'px');
		}else{
			$('.searchPlaceholder').css('height', 60+'px');
		}
	}*/
	
});

$(window).scroll(function(){
	if (!$('body').hasClass('error404') && !$('body').hasClass('search') && !$('body').hasClass('page-template-simple-php') && !$('body').hasClass('page-template-inventory-php')){
	var placeholderHeight = $('.searchPlaceholder').height();
	var fixedHeaderP = $(window).scrollTop()-($('.searchPlaceholder').position().top);
	var headerP = $(window).scrollTop()-(headerDiv.position().top);
	headerHeight = headerDiv.height();
	opacityInc = 1/(headerHeight - 100);
	hTextTopPos = $('.headerText', headerDiv).position().top;
	hTextOpacityInc = 1/(hTextTopPos - 50);
	var logoMoveInc = 392 / hTextTopPos;
	var moveLogoTo = headerP * logoMoveInc;
		moveLogoTo = -92 + (moveLogoTo*.8);

	
	if ((fixedHeaderP) >= 16 && $('.headerNavBox', headerDiv).css('position') != 'fixed' ){
		$('.headerNavBox', headerDiv).css({'position': 'fixed', 'top':( placeholderHeight + 42 )+'px', 'right': 0, 'left' :0});
		$('.fixedBackground', headerDiv).css({'position': 'fixed', 'top':placeholderHeight+'px', 'right': 0, 'left' :0});
		$('.fixedBackground', headerDiv).show();
	}else if((fixedHeaderP) < 16 && $('.headerNavBox', headerDiv).css('position') == 'fixed' ){
		$('.headerNavBox', headerDiv).css({'position': 'relative', 'top': 60 +'px'});
		$('.fixedBackground', headerDiv).hide();
	}
	
	// FADE BACKGROUND
	if (fixedHeaderP > 0 && fixedHeaderP <= (headerHeight - 100)){
		$('.headerBackground', headerDiv).css('opacity', 1 - (fixedHeaderP * opacityInc));
	}
	
	// FADE TEXT
	if (fixedHeaderP > 10 && fixedHeaderP <= ((headerHeight + placeholderHeight) - 50)){
		$('.headerText', headerDiv).css('opacity', 1- (fixedHeaderP * hTextOpacityInc));
	}else if (fixedHeaderP <= 10){
		$('.headerText', headerDiv).css('opacity', 1);
	}
	
	// MOVE LOGO
	if (headerP > 0 && headerP <= ((headerHeight + placeholderHeight) - 50)){
		$('.headerLogo', headerDiv).css( 'bottom', moveLogoTo + 'px');
	}
		if (headerP >= 0){
			$('.headerLogo', headerDiv).css( 'bottom', moveLogoTo + 'px');
		}else if (moveLogoTo < 1){
			$('.headerLogo', headerDiv).css( 'bottom', -93 + 'px');
		}
	
	if (fixedHeaderP >= 270){
		//$('.headerLogoContainer').css({position:'fixed', top: 0});
		if ($('.headerLogoBottom', headerDiv).css('display') == 'none'){
			$('.headerLogoBottom', headerDiv).slideDown('fast');
		}
	}else{
		if ($('.headerLogoBottom', headerDiv).css('display') == 'block'){
			$('.headerLogoBottom', headerDiv).slideUp('fast');
		}
	}
	}
	
});

function toggleNav(){
	if (navSwitch == 0){
		openNav();
	}else{
		closeNav();
	}
}

function openNav(){
	$('.menu-item', mobileHeaderDiv).each(function(){
		if (!$(this).hasClass('current-menu-item')){
			$(this).slideDown();
		}
		
	});
	$('header#header.mobile .searchLink').slideDown();
	$('.openNav').animateRotate(45, 300, 'linear', function () {});
	$('.mobile .headerNavInner').animate({'padding-top':10+'px', 'padding-bottom': 10+ 'px'}, function(){});
	navSwitch = 1;
	$('.mobile .headerLogo').animate({bottom: 210+'px'}, function(){});
}

function closeNav(){
	$('.menu-item', mobileHeaderDiv).each(function(){
		if (!$(this).hasClass('current-menu-item')){
			if ($('body').hasClass('single-post') && $(this).hasClass('menu-item-389')){
				$('.menu-item-389').addClass('current-menu-item');
			}else{
				$(this).slideUp();
			}
		}
		
	});
	if (!$('body').hasClass('error404') && !$('body').hasClass('search') && !$('body').hasClass('page-template-simple-php') && !$('body').hasClass('page-template-inventory-php')){
		$('header#header.mobile .searchLink').slideUp();
	}
	$('.current-menu-item', mobileHeaderDiv).slideDown();
	$('.openNav').animateRotate(90, 300, 'linear', function () {});
	$('.mobile .headerNavInner').animate({'padding-top':10+'px', 'padding-bottom': 20+ 'px'}, function(){});
	navSwitch = 0;
	$('.mobile .headerLogo').animate({bottom: 310+'px'}, function(){});
}

$.fn.animateRotate = function(angle, duration, easing, complete) {
  var args = $.speed(duration, easing, complete);
  var step = args.step;
  return this.each(function(i, e) {
    args.complete = $.proxy(args.complete, e);
    args.step = function(now) {
      $.style(e, 'transform', 'rotate(' + now + 'deg)');
      if (step) return step.apply(e, arguments);
    };

    $({deg: 0}).animate({deg: angle}, args);
  });
};

function detectImageLoad(imageUrl, div){
	//console.log('url: '+imageUrl);
	var image = new Image();
image.onload = function () {
	$('.'+div).fadeIn('slow');
}
image.onerror = function () {
   console.error("Cannot load image");
   //do something else...
}
image.src = imageUrl;
}

function toggleClientType(type){
	if (currentClient != type){
		currentClient = type;
	$('.filterButton').each(function(){
		$(this).removeClass('on');
	});
	$('.filter_'+type).addClass('on');
	
	var total = $('.clientType.on .clientName').length;
	if (total > 0){
	$($('.clientType.on .clientName').get().reverse()).each(function(index) {

		$(this).delay(50*index).animate({"opacity":0}, 'fast', function(){
			if (index == total -1){
				setTimeout(function(){
					showClients(type);
				},200);
			}
		});
	});
	}else{
		showClients(type);
	}
	}
}

function showClients(type){

	$('.clientType').removeClass('on');
	$('.clientType.type_'+type).addClass('on');
		$('.clientType.on .clientName').each(function(index){
			$(this).delay(150*index).animate({"opacity":1}, 'fast');
		});
}

function searchToggle(){
	searchHeight = $('.searchBar').outerHeight();
	if ($('.headerNavBox').css('position') == 'fixed'){
		if (searchSwitch == 0){
			$('.searchPlaceholder').animate({'height':searchHeight+'px'}, function(){});
			$('.searchBar').css('position', 'fixed');
			$('.searchBar').slideDown(function(){});
			$('.searchLink').addClass('on');
			$('.headerNavBox').animate({'top': '+='+searchHeight+'px'}, function(){});
			$('.fixedBackground').animate({'top': '+=' +searchHeight+'px'}, function(){});
			searchSwitch = 1;
		}else{
			$('.searchPlaceholder').animate({'height':0}, function(){});
			$('.searchBar').slideUp();
			$('.searchLink').removeClass('on');
			$('.headerNavBox').animate({'top': '-='+searchHeight+'px'}, function(){});
			$('.fixedBackground').animate({'top': '-=' +searchHeight+'px'}, function(){});
			searchSwitch = 0;
		}
	}else{
		if (searchSwitch == 0){
			$('.searchPlaceholder').animate({'height':searchHeight+'px'}, function(){});
			$('.searchBar').slideDown(function(){
				
			});
			$('.searchLink').addClass('on');
			searchSwitch = 1;
		}else{
			$('.searchPlaceholder').animate({'height':0}, function(){});
			$('.searchBar').slideUp();
			$('.searchLink').removeClass('on');
			searchSwitch = 0;
		}
	}
}

function addHeaderBackground(image){
	$('.headerBackground').css('background-image', 'url('+image+')');
	
	detectImageLoad(image, 'headerBackground');
}

function addHeaderText(text, type, date){
	$('.headerText').empty();
	if (type == 'casestudy'){
	$('.headerText').append('<h5>'+date+'</h5><h1>Case Study:</h1><h1>'+text+'</h1>');
	}else if (type == '404'){
		var header404 = $('.hidden404').html();
		$('.headerText').append(header404);
	}
}

function filterTags(tagId){
	galleryType = 0; // TYPE INVENTORY
	processImages(tagId);
}

function searchWord(search){
	galleryType = 1; // TYPE SEARCH
	searchSwitch = 0;
	searchToggle();
	//$("html, body").delay(1000).animate({ scrollTop: $(document).height() }, "slow");
	processImages(search);
	
}

function loadMore(){
	filterBDs();
}

function processImages( filterData ){
	//console.log('current tag: '+currentTag+' tag id: '+tagId);
	if ($('header#header.mobile').is(':visible') && $('.searchBar').is(':visible')){
		searchToggle();
	}
	if (filterPage == 1){
		$('.galleryBoxContainer').empty();
	}
	if (filterData[0].length == 0){
		$('.galleryBoxContainer').append('<div class="no_results"><h1>Can\'t find what you\'re looking for?</h1><h2><a href="tel:818-961-7805">Give Us A Call</a></h2></div><div class="clear"></div></div>');
		$('.galleryBoxContainer').css('height', 'auto');
		$('.loadMore').hide();
	}else{
	
	$('.filterButton').removeClass('on');
	$('.filterButton').addClass('on');

          	console.log( filterData );
          	var arrayOfImages = filterData[0];
          	var loadMoreSwitch = filterData[1];
          	if (loadMoreSwitch == 1){
	          	$('.loadMore').fadeIn();
          	}else{
	          	$('.loadMore').hide();
          	}
          	for (var i = 0; i < filterData[0].length; i++) {
          		var galleryImage = arrayOfImages[i];
          		//$('.galleryBoxContainer').append(galleryImage);
          		}
          		var currentWidth = $('.galleryImageContainer').width();
          		var container = $('.galleryBoxContainer').isotope({
	          		masonry:{
			          	columnWidth:280,
			          	gutter:20
		          	},
		          	hiddenStyle: {
			          	opacity: 0
			        },
			        visibleStyle: {
				        opacity: 0
				    },
				    transitionDuration: '0.5s'
          		});
          		$('.galleryBoxContainer').append( arrayOfImages );
          		var arrayI = $( ".galleryImageContainer.new" ).toArray();
          			container.isotope( 'appended', arrayI );
          			container.imagesLoaded( function() {
	          		container.isotope('layout');
	          		container.isotope( 'once', 'layoutComplete', function( isoInstance, laidOutItems ) {
		          		
		          		$('.galleryImageContainer.new').each(function(i, item){
		          			//console.log(500*i);
		          			$(item).delay(200*i).animate({opacity: 1},100, function(){
			          			$(this).removeClass('new');
		          			});
		          			
		          		});
		          		
		          		
	          		});
	          		//$( ".galleryImageContainer").removeClass('new');
	          		//$(".galleryImageHover").fancybox();
	          		
	          		});
	          		}
	          		filterPage++;
}

function caseStudys(loadMore){
	if (loadMore == 1){
	         	 	$('.loadMore').fadeIn();
	         	}else{
	          		$('.loadMore').hide();
	          	}
	var container = $('.otherCaseStudys').isotope({
	          		masonry:{
			          	columnWidth:280,
			          	gutter:20,
			          	itemSelector:'.otherCaseStudyBox'
		          	},
		          	hiddenStyle: {
			          	opacity: 0
			        },
			        visibleStyle: {
				        opacity: 1
				    },
				    transitionDuration: '0.5s'
          		});
          		$( ".otherCaseStudyBox.new" ).removeClass('new');
          		$('#menu-item-389').addClass('current-menu-item');
          		$('#menu-item-389').addClass('current_page_item');
        paged++;
}

function loadMoreCases(cId){
	$.ajax({
    url:ajaxurl,
           data:{
               'action':'do_ajax',
               'fn':'moreCases',
               'cid': cId,
               'paged':paged
               },
          dataType: 'json',
          success:function(data){
          	paged++;
          	var moreCases = data[0];
          	var loadMoreSwitch = data[1];
          	appendCases(moreCases, loadMoreSwitch);
          	console.log(loadMoreSwitch);
          		if (loadMoreSwitch == 1){
	         	 	$('.loadMore').fadeIn();
	         	}else{
	          		$('.loadMore').hide();
	          	}
          	},                   
          error: function(errorThrown){
               //alert('error');
               console.log(errorThrown);
          }
     });
}

function appendCases(cases, loadmore){

      var container = $('.otherCaseStudys').isotope({
	          		masonry:{
			          	columnWidth:280,
			          	gutter:20,
			          	itemSelector:'.otherCaseStudyBox'
		          	}
		          	
          		});
          		$('.otherCaseStudys').append( cases );
          		
          		var arrayI = $( ".otherCaseStudyBox.new" ).toArray();
          			console.log(arrayI);
          			container.isotope( 'appended', arrayI );
          			if ($('.otherCaseStudyBox.new').find("img").length > 0){
          				$('.otherCaseStudyBox.new').imagesLoaded( function() {
	          			container.isotope('layout');
	          			});
	          		}else{
		          		container.isotope('layout');
	          		}
	          		container.isotope( 'once', 'layoutComplete', function( isoInstance, laidOutItems ) {
		          		
		          		$('.otherCaseStudyBox.new').each(function(i, item){
		          			//console.log(500*i);
		          			$(item).delay(200*i).animate({opacity: 1},100, function(){
			          			$(this).removeClass('new');
		          			});
		          			
		          		});
		          		
		          		
	          		});
	          		//$(".galleryImageHover").fancybox();

}

function clearFilterOptions(){
	$('form#searchform input[type="checkbox"]').prop('checked', false);
	$('form#searchform input[type="text"]').val('');
	$('form#searchform input[type="number"]').val('');
	(function ($) {
		$.ajax({
		url: ajaxurl,
		data: {
			'action': 'do_ajax',
			'fn':'clear_session',
		},
		success: function(data) {

		},
		error: function(errorThrown) {
			//alert('error');
			console.log(errorThrown);
		}
	});
   	}(jQuery));
}

function lightbox(imageurl, title, bdId){
	if ($(window).width() > 691){
	$('.lbImage').empty();
	$('.lbImage').append('<img src="'+imageurl+'"/>');
	
	var newImgHeight = $(window).height() * .8;
	
	$('.lbImage img').load(function(){
		$('.lbImage').slideDown(function(){
			$('.lbTitle').fadeIn('fast');
			if ($('.lbImage').height() > newImgHeight){
				$('.lbImage').css({ 'height':newImgHeight + 'px', 'width' : 'auto' });
				$('.lbImage img').css({ 'height': 100 + '%', 'width' : 'auto' });
			}else{
				$('.lbImage').css({ 'height':'auto', 'width' : 100 + '%' });
				$('.lbImage img').css({ 'width': 100 + '%', 'height' : 'auto' });
			}
			
		});
		
}).error(function (){
   $(this).remove();//remove image if it fails to load// or what ever u want
});

	$('.lbTitle h3').html(bdId+' &mdash; '+title);
	$('.lightBoxCover').fadeIn('fast');
	}
}

function closeLightBox(){
	$('.lightBoxCover').fadeOut('fast', function(){
		$('.lbImage').empty();
		$('.lbTitle h3').empty();
		$('.lbImage').fadeOut('fast');
		$('.lbTitle').fadeOut('fast');
		$('.lbImage').css({ 'height':'auto', 'width' : 100 + '%' });
				$('.lbImage img').css({ 'width': 100 + '%', 'height' : 'auto' });
	});
	
}

function getFilterOptions(){
	var locations = [];
	var daynight = [];
	var categories = [];
	var povs = [];
	var floorVal = $('input[name="Floor"]').val();
	var filterJson = new Object();
	
	var width = $('input.size[name="width"]').val();
	var height = $('input.size[name="height"]').val();
	var dropid = $('input.drop_id').val();
	var kWord = $('input.keyword').val();
	
	filterJson.width = width;
	filterJson.height = height;
	filterJson.dId = dropid;
	filterJson.kWord = kWord;
	
	$('input.location_checkbox').each(function(){
		if($(this).is(':checked')){
			locations.push( $(this).attr('value') );
		}
	});
		
	filterJson.locs = locations;
	
	$('input.daynight').each(function(){
		if($(this).is(':checked')){
			daynight.push( $(this).attr('value') );
		}
	});
	
	filterJson.dorn = daynight;
	
	$('input.cat_checkbox').each(function(){
		if($(this).is(':checked')){
			categories.push( $(this).attr('value') );
		}
	});
	
	filterJson.cats = categories;
	
	$('input.pov_checkbox').each(function(){
		if($(this).is(':checked')){
			povs.push( $(this).attr('value') );
			if ($(this).attr('value') != 'floor'){
					
			}else{
				povs.push('floor-' + $('input.pov_select').val());
			}
		}
	});
	
	filterJson.povs = povs;
	
	if ($('body').hasClass('page-template-inventory-php')){
			filterOptionsJson = filterJson;
			filterBDs();
		}else{
			setSession(filterJson);
		}
		console.log(filterJson);
}

var filterOptionsJson;

function placeFilterOptions( filterJson ){
	console.log(filterJson);
	
	filterJson = jQuery.parseJSON( filterJson );
	var locations = filterJson.locs;
	var daynight = filterJson.dorn;
	var categories = filterJson.cats;
	var povs = filterJson.povs;
	
	var width = filterJson.width;
	var height = filterJson.height;
	
	var dropid = filterJson.dId;
	var keyword = filterJson.kWord;
	
	console.log (width + ' ' + height);
	$('input.size[name="width"]').val( width );
	$('input.size[name="height"]').val( height );
	$('input.keyword').val( keyword );
	$('input.drop_id').val( dropid );
	
	for ( var c = 0; c < categories.length; c++){
		$('input.cat_checkbox[value="'+categories[c]+'"]').prop('checked', true);
	}
	for ( var dn = 0; dn < daynight.length; dn++){
		$('input.daynight[value="'+daynight[dn]+'"]').prop('checked', true);
	}
	for ( var l = 0; l < locations.length; l++){
		$('input.location_checkbox[value="'+locations[l]+'"]').prop('checked', true);
	}
	for ( var pov = 0; pov < povs.length; pov++){
		
		var floor = povs[pov].split("-");
			console.log(floor);
		if( floor[0] == 'floor'){
			$('input[name="Floor"]').val(floor[1]);
		}
			$('input.pov_checkbox[value="'+povs[pov]+'"]').prop('checked', true);
		
	}
	
	filterOptionsJson = filterJson;
	console.log(filterOptionsJson);
	filterBDs();
}

var filterPage = 1;

function filterBDs(){
	var fJson = filterOptionsJson;
	console.log(fJson);
	if (fJson){
		fJson.kWord = fJson.kWord.replace(/ /g, '-');
	}
	$.ajax({
    url:ajaxurl,
           data:{
               'action':'do_ajax',
               'fn':'filter_bds',
               'fJSON':JSON.stringify(fJson),
               'paged':filterPage,
               },
          dataType: 'json',
          success:function(data){
          		console.log(data);
          		
          		processImages(data);
          },                   
          error: function(errorThrown){
               //alert('error');
               console.log(errorThrown);
          }
     });
}

function setSession(filterJson){
console.log(filterJson);
	(function ($) {
		$.ajax({
		url: ajaxurl,
		data: {
			'action': 'do_ajax',
			'fn':'filter_session',
			'fJson':JSON.stringify(filterJson)
		},
		success: function(data) {
			console.log(data);
			window.location.href = '/inventory';
			//document.location.href= homeurl;
		},
		error: function(errorThrown) {
			//alert('error');
			console.log(errorThrown);
		}
	});
   	}(jQuery));
}