/*-----------------------------------------------------------------------------------*/
/* 		Mian Js Start
/*-----------------------------------------------------------------------------------*/
$(document).ready(function($) {
"use strict"
/*-----------------------------------------------------------------------------------*/
/* 		Video Divs Show Hide
/*-----------------------------------------------------------------------------------*/
jQuery('#play').click(function(e) {
	jQuery(this).hide();
	jQuery('#pause').show();
});
jQuery('#pause').click(function(e) {
	jQuery(this).hide();
	jQuery('#play').show();
});




/*-----------------------------------------------------------------------------------*/
/* 		COURSER BOTTOM SCROLL
/*-----------------------------------------------------------------------------------*/
(function () {
  $('.mouse').removeClass('hidden');
}, 0);
setTimeout(function () {
  $('.mouse').addClass('play');
}, 1000);






/*-----------------------------------------------------------------------------------*/
/* 		Flex Slider
/*-----------------------------------------------------------------------------------*/
$(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "fade",
    controlNav: "thumbnails",
	slideshow: true
});





/*-----------------------------------------------------------------------------------*/
/* 		Flex Slider
/*-----------------------------------------------------------------------------------*/
$('.flex-blog').flexslider({
    animation: "fade",
	easing: "swing",               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
	direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
	reverse: false,                 //{NEW} Boolean: Reverse the animation direction
	animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
	smoothHeight: false,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
	startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
	slideshow: true,                //Boolean: Animate slider automatically
	slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
	animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
	initDelay: 0,                   //{NEW} Integer: Set an initialization delay, in milliseconds
	randomize: false,
  });
});






/*-----------------------------------------------------------------------------------*/
/*	ISOTOPE PORTFOLIO
/*-----------------------------------------------------------------------------------*/
/*$(document).ready(function () {
    var $container = $('.portfolio-wrapper .items');
    $container.imagesLoaded(function () {
        $container.isotope({
            itemSelector: '.item',
            layoutMode: 'fitRows'
        });
	});
    $('.filter li a').click(function () {
        $('.filter li a').removeClass('active');
        $(this).addClass('active');
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector
        });
        return false;
    });
});*/




/*-----------------------------------------------------------------------------------*/
/* 		Hove Effects
/*-----------------------------------------------------------------------------------*/
 $(document).ready(function(){
    if (Modernizr.touch) {
          // handle the closing of the overlay
          $(".close-overlay").click(function(e){
              e.preventDefault();
                e.stopPropagation();
                if ($(this).closest(".img").hasClass("hover")) {
                    $(this).closest(".img").removeClass("hover");
                }
            });
        } else {
            // handle the mouseenter functionality
            $(".img").mouseenter(function(){
                $(this).addClass("hover");
            })
            // handle the mouseleave functionality
            .mouseleave(function(){
                $(this).removeClass("hover");
            });
        }
});





/*-----------------------------------------------------------------------------------*/
/* 		Team Slider
/*-----------------------------------------------------------------------------------*/
$(document).ready(function() {
  $("#owl-team").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
	  stopOnHover : true,
      navigation : true, // Show next and prev buttons
	  pagination : false,
	  navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  });
});




/*-----------------------------------------------------------------------------------*/
/* 		CLIENT Slider
/*-----------------------------------------------------------------------------------*/
$(document).ready(function() {
  $("#owl-client").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
	  stopOnHover : true,
      navigation : true, // Show next and prev buttons
	  pagination : false,
	  navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  });
});





/*-----------------------------------------------------------------------------------*/
/* 		CLIENT Slider
/*-----------------------------------------------------------------------------------*/
$(document).ready(function() {
  $("#owl-sevices").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 1,
      itemsDesktop : [1199,1],
	  singleItem : true,
      itemsDesktopSmall : [979,1],
	  stopOnHover : true,
      navigation : true, // Show next and prev buttons
	  pagination : false,
	  navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  });
});




/*-----------------------------------------------------------------------------------*/
/* 		 Slider
/*-----------------------------------------------------------------------------------*/
$(document).ready(function() {
  $(".owl-img").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 1,
      itemsDesktop : [1199,1],
	  singleItem : true,
      itemsDesktopSmall : [979,1],
	  stopOnHover : true,
      navigation : true, // Show next and prev buttons
	  pagination : false,
	  navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  });
});





/*-----------------------------------------------------------------------------------*/
/*		STICKY NAVIGATION
/*-----------------------------------------------------------------------------------*/
$(document).ready(function(){
    $(".sticky").sticky({topSpacing:0});
});





/*-----------------------------------------------------------------------------------*/
/* 	ANIMATION
/*-----------------------------------------------------------------------------------*/
var wow = new WOW({
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       false        // trigger animations on mobile devices (true is default)
});
wow.init();





/*-----------------------------------------------------------------------------------*/
/* 	LOADER
/*-----------------------------------------------------------------------------------*/
$(window).load(function() {
	$("#loader").delay(200).fadeOut("slow");
});




/*-----------------------------------------------------------------------------------*/
/* 		Back to Top
/*-----------------------------------------------------------------------------------*/
$(window).scroll(function(){
 if($(window).scrollTop() > 1000){
      $("#back-to-top");
    } else{
      $("#back-to-top");
    }
});
$('#back-to-top, .back-to-top').click(function() {
      $('html, body').animate({ scrollTop:0 }, '1000');
      return false;
});











/*-----------------------------------------------------------------------------------*/
/*    HOME 100% Height
/*-----------------------------------------------------------------------------------*/
$(function(){
    var windowH = $(window).height();
    var wrapperH = $('#home').height();
    if(windowH > wrapperH) {
        $('#home').css({'height':($(window).height())+'px'});
    }
    $(window).resize(function(){
        var windowH = $(window).height();
        var wrapperH = $('#wrap').height();
        var differenceH = windowH - wrapperH;
        var newH = wrapperH + differenceH;
        var truecontentH = $('#home').height();
        if(windowH > truecontentH) {
            $('#home').css('height', (newH)+'px');
        }

    })
});















/*-----------------------------------------------------------------------------------*/
/* 		NAVIGATION SMOOTH SCROLL
/*-----------------------------------------------------------------------------------*/
$('.menu nav ul a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
        || location.hostname == this.hostname) {
      var target = $(this.hash);
      var href = $.attr(this, 'href');
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
         scrollTop: target.offset().top
        }, 1000, function () {
            window.location.hash = href;
        });
        return false;
      }
    }
});
var navLinkIDs = "";
 $('.menu nav ul a[href*=#]:not([href=#])').each(function(index) {
     if(navLinkIDs != "") {
         navLinkIDs += ", ";
     }
     navLinkIDs += $('.menu nav ul a[href*=#]:not([href=#])').eq(index).attr("href");
 });
if( navLinkIDs ) {
   $(navLinkIDs).waypoint(function(direction) {
       if(direction=='down') {
           $('.menu nav ul a').parent().removeClass("active");
           $('.menu nav ul a[href="#'+$(this).attr('id')+'"]').parent().addClass("active");
       }
   }, { offset: 70 });
    $(navLinkIDs).waypoint(function(direction) {
       if(direction=='up') {
           $('.menu nav ul a').parent().removeClass("active");
           $('.menu nav ul a[href="#'+$(this).attr('id')+'"]').parent().addClass("active");
       }
   }, {  offset: function() {
       return -$(this).height() + 20;
   } });
}




/*-----------------------------------------------------------------------------------*/
/* 		Active Menu Item on Page Scroll
/*-----------------------------------------------------------------------------------*/
$(window).scroll(function(event) {
		Scroll();
});
$('.scroll a').click(function() {
		$('html, body').animate({scrollTop: $(this.hash).offset().top -10}, 1000);
		return false;
});
// User define function
function Scroll() {
var contentTop      =   [];
var contentBottom   =   [];
var winTop      =   $(window).scrollTop();
var rangeTop    =   200;
var rangeBottom =   500;
$('nav').find('.scroll a').each(function(){
	contentTop.push( $( $(this).attr('href') ).offset().top);
		contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
})
$.each( contentTop, function(i){
	if ( winTop > contentTop[i] - rangeTop ){
		$('nav li.scroll')
		  .removeClass('active')
			.eq(i).addClass('active');
		}}
)};


/*-----------------------------------------------------------------------------------*/
/*    CONTACT FORM
/*-----------------------------------------------------------------------------------*/
$(document).ready(function () {
      $('#contactForm .error').remove();
      var form = $('#contactForm'); // contact form
      var submit = $('#contactForm_submit'); // submit button
      var alertx = $('.successMsg'); // alertx div for show alert message
      // form submit event
      form.on('submit', function (e) {
      var hasError = false;
        $('.required').each(function () {
            if (jQuery.trim($(this).val()) === '') {
                $(this).parent().append('<span class="error"><i class="fa fa-exclamation-triangle"></i></span>');
                hasError = true;
            } else if ($(this).hasClass('email')) {
                var emailReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (!emailReg.test(jQuery.trim($(this).val()))) {
                    $(this).parent().append('<span class="error"><i class="fa fa-exclamation-triangle"></i></span>');
                    hasError = true;
                }
            }else if($(this).hasClass('phone')){
                    var telReg= /^[5-9]{1}[0-9]{9}$/;
                    if(!telReg.test(jQuery.trim($(this).val()))){
                        $(this).parent().append('<span class="error"><i class="fa fa-exclamation-triangle"></i></span>');
                        hasError = true;
                    }
                }
        });
        if (!hasError) {
            e.preventDefault(); // prevent default form submit
          // sending ajax request through jQuery
            $('#overlay, #PleaseWait').show();
          $.ajax({
              url: 'Class/procesa_form.php', // form action url
              type: 'POST', // form submit method get/post
              dataType: 'html', // request type html/json/xml
              data: form.serialize(), // serialize form datae
              recaptcha:grecaptcha.getResponse(),
              beforeSend: function () {
                  alertx.fadeOut();
                  submit.html('Sending....'); // change submit button text
              },
              success: function (data){
                  form.fadeOut(300);
                  alertx.html(data).fadeIn(1000); // fade in response data
                  setTimeout(function() {
                    alertx.html(data).fadeOut(300);
                    $('#formName, #formEmail,#phone, #message, #idn_services, #sitio, #submit').val('');
                    form.fadeIn(1800);

                      console.log(data);
                      $('#overlay, #PleaseWait').hide();

                }, 4000);

                  if(data == "Captcha incorrecto"){
                      $('#overlay, #PleaseWait').hide();

                  }
                  $('.successMsg').html(data);

              },
              error: function (e) {
                  console.log(e)
              }

          });
          $('.required').val('');
        }
        return false;
      });

    $('#contactForm input').focus(function () {
        $('#contactForm .error').remove();
    });
    $('#contactForm textarea').focus(function () {
        $('#contactForm .error').remove();
    });

    $('body').prepend('<div id="overlay" class="ui-widget-overlay" style="z-index: 1001; display: none;"></div>');
    $('body').prepend('<div id="PleaseWait" class="wait"><img src="css/ajax-loader.gif" /></div>');

});


/*-----------------------------------------------------------------------------------*/
/* 		Parallax
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){
  jQuery.stellar({
    horizontalScrolling: false,
    scrollProperty: 'scroll',
    positionProperty: 'position',
  });
});
});




/*------------------------------------------------------------------------------------*/
/*
/*------------------------------------------------------------------------------------*/

$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    }
});