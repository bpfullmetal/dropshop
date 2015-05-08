var secondsBetweenImages = 6;
var fadeSpeedInSeconds = 1.2;
var urlt = surl + "/wp-admin/admin-ajax.php";
console.log(surl);

var fsiS = fadeSpeedInSeconds *1000;
var sbI = secondsBetweenImages *1000;

var myVar = setInterval(function(){moveByImage()},sbI);
var currentPic = 1;
var picCount;



$(document).ready(function(){
	loadStuff();		
});

function loadStuff(){
	$('.image').hide();
	$('.image'+'.'+currentPic).show();
	mason();
	$('.galImage').mouseenter(function(){
		$('.galImageCover', this).animate({
    opacity: 1
  }, 200, function() {
    // Animation complete.
  });
		$('.imageHolder', this).animate({
    opacity: 0.15
  }, 200, function() {
    // Animation complete.
  });
  
	});
	$('.galImage').mouseleave(function(){
		$('.galImageCover', this).animate({
    opacity: 0
  }, 200, function() {
    // Animation complete.
  });
		$('.imageHolder', this).animate({
    opacity: 1.0
  }, 200, function() {
    // Animation complete.
  });
	});
}

$(window).load(function(){

mason();

});

$(window).resize(function(){

});

function mason(){
	$('.galleryBoxesInner').masonry({
					columnWidth: 0,
					itemSelector: '.galImage',
				    isAnimated: false
					});
}
/*function resizeImage(){
	var winHeight = $('.greyy').height();
	var winWidth = $(window).width();
      $('.image').css('width', winWidth+'px');
	  $('.image').css('height', winHeight+'px');
	  $('.fullGallery').css('width', winWidth +'px');
	  $('.fullGallery').css('height', winHeight +'px');
	  $('.galleryImageHolder').css('height', winHeight);
	  $('.image img').each(function(){
	    if (($('.image').width()/$('.image').height()) < ($(this).width()/$(this).height())) {
          $(this).css({'height':'100%','width':'auto'});
        } else {
          $(this).css({'width':'100%','height':'auto'});
        }
        });
        var holderCount = $('.image').length;
}*/

function lightbox(imageurl, title){
	console.log(imageurl);
	$('.lbImage').empty();
	$('.lbImage').append('<img src="'+imageurl+'"/>');
	$('.lbTitle h6').append(title);
	$('.lightBoxCover').fadeIn();
}
function closeLightBox(){
	$('.lightBoxCover').fadeOut(function(){
		$('.lbImage').empty();
		$('.lbTitle h6').empty();
	});
	
}
var paged = 2;
var currentTag = 'all';
function filterTags(tagId){
	console.log(tagId);
	$('.singleTag').removeClass('on');
	$('.singleTag'+'.'+tagId).addClass('on');
	$('.galImage').fadeOut();
	currentTag = tagId;
	$.ajax({
    url:urlt,
           data:{
               'action':'do_ajax',
               'fn':'filter',
               'tid': tagId
               },
          success:function(data){
          appendTags(data);
                             },
          error: function(errorThrown){
               //alert('error');
               console.log(errorThrown);
          }
     });
     
}

function loadMore(){
	$.ajax({
    url:urlt,
           data:{
               'action':'do_ajax',
               'fn':'load',
               'cid': currentTag,
               'pid' : paged
               },
          success:function(data){
          	
          appendMoreTags(data);
                             },
          error: function(errorThrown){
               //alert('error');
               console.log(errorThrown);
          }
     });
     
}

function appendTags(data){
	$('.galleryBoxes').html('');
	$('.galleryBoxes').append(data);
    $('.galImage img').load(function(){
	   $('.galImage').fadeIn(); 
    });
	paged=2;
	loadStuff();
}
function appendMoreTags(data){
	console.log(data);
	$('.galleryBoxesInner').append( data ).masonry( 'reloadItems', { isAnimated: true } );
	$('.galImage img').load(function(){
		mason();
	});
	paged++;
	loadStuff();
	
}

function moveForward(){
	clearInterval(myVar);
	moveByImage();
}

function moveByImage(){
var picCount = $('.image').length;
	if(currentPic == picCount){
		currentPic = 1;
	}else{
	currentPic++;
	}
	$('.image').fadeOut(fsiS);
	$('.image'+'.'+currentPic).fadeIn(fsiS);
	//resizeImage();
}

function moveBackByImage(){
clearInterval(myVar);
var picCount = $('.image').length;
	if(currentPic == 1){
		currentPic = picCount;
	}else{
	currentPic = currentPic -1;
	}
	$('.image').fadeOut(fsiS);
	$('.image'+'.'+currentPic).fadeIn(fsiS);
	console.log(currentPic);
	//resizeImage();
}