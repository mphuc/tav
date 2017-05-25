
/*************************************

Template Name: APPS - Responsive APP Landing Page
Author: perfect_coders
Version: 1.0
Design and Developed by: perfect_coders

NOTE: This is main jquery of the template.

****************************************/



(function ($) {
	"use strict";
    
    var $window = $(window),
            $body = $('body');

    jQuery(document).ready(function($){
        
         
        
        /*=============================
                Sticky header
        ==============================*/
        $('.navbar-collapse a').on('click',function(){
          $(".navbar-collapse").collapse('hide');
        });

        $window.on('scroll', function() {
          if ($(".navbar").offset().top > 100) {
            $(".navbar-fixed-top").addClass("menu-top-fixed");
              } else {
                $(".navbar-fixed-top").removeClass("menu-top-fixed");
              }
        });
    
        /*=============================
                Smoothscroll js
        ==============================*/
        $(function() {
          $('.custom-navbar a, a.scroll-btn').on('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 0
            }, 1000);
            event.preventDefault();
          });
        });  
            
        
        
        
    /*======================================
        jquery scroll spy
    ========================================*/
        $body.scrollspy({
        
            target : ".navbar-collapse",
            offset : 95
        
        });
        
        
     /*=================================
            Bootstrap menu fix
     ==================================*/
        $(".navbar-toggle").on("click", function(){
        
            $body.addClass("mobile-menu-activated");
        
        });
        
        $("ul.nav.navbar-nav li a").on("click", function(){
        
            $(".navbar-collapse").removeClass("in");
        
        });
        
        
        /*=================================
            Bootstrap menu fix
     ==================================*/
	(function () {

		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		 
		} else {
			$(window).stellar({
				horizontalScrolling: false,
				responsive: true
			});
		}

	}());
        
        
        
    /*=============================
        WOW js
    ==============================*/
    new WOW({ mobile: false }).init();


    /*===================================
            owl carousel screenshot
     ====================================*/
    $('.screenshot-slider').owlCarousel({ 
        autoPlay: 10000, //Set AutoPlay to 4 seconds
        loop:true,
        margin : 10,
        pagination	: true,
        autoplay:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });
        
        
    /*===================================
            owl carousel testimonial
     ====================================*/
    $(".testimonial-list").owlCarousel({
        loop:true,
        margin:30,
        nav:false,
        dots:true,
        autoplay:true,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });
        
        
    /*=========================
        magnificPopup video
   ============================*/
    var videoPopup = $(".video");
        videoPopup.magnificPopup({
        type: 'iframe'

    });
        
        
    /*=========================
        faq
   ============================*/
       function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
        }
        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
        $('.panel-group').on('shown.bs.collapse', toggleIcon);
        
       
    /*=========================
        AJAX CHIMP
	============================*/
	$('#mc-form').ajaxChimp({
		url: 'http://hasanbitm144.us15.list-manage.com/subscribe/post?u=d2ca262cb6a6f8a462c7e5f70&amp;id=28919d1386' //Set Your Mailchamp URL
	});
        
        
        
    /*=========================
		  CONTACT FORM
	============================*/    
    $("#contactForm").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            //formError();
            submitMSG(false, "Did you fill in the form properly?");
        } else {
            // everything looks good!
            event.preventDefault();
            submitForm();
        }
    });


    function submitForm(){
        // Initiate Variables With Form Content
        var name = $("#name").val();
        var email = $("#email").val();
        var msg_subject = $("#msg_subject").val();
        var message = $("#message").val();


        $.ajax({
            type: "POST",
            url: "assets/php/form-process.php",
            data: "name=" + name + "&email=" + email + "&msg_subject=" + msg_subject + "&message=" + message,
            success : function(text){
                if (text === "success"){
                    formSuccess();
                } else {
                    formError();
                    submitMSG(false,text);
                }
            }
        });
    }

    function formSuccess(){
        $("#contactForm")[0].reset();
        submitMSG(true, "Message Submitted!");
    }

    function formError(){
        $("#contactForm").removeClass().addClass('fadeIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass();
        });
    }

    function submitMSG(valid, msg){
        if(valid){
            var msgClasses = "h3 text-center tada animated text-success";
        } else {
            var msgClasses = "h3 text-center text-danger";
        }
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    }
        
        
        

    });


   $window.on('load', function(){
          /*=============================
                Preloder
        ==============================*/
         $('.spinner').fadeOut(); 
        $('.preloader').delay(350).fadeOut(500);
        $body.delay(350).css({'overflow':'visible'});
       
       
        /*========================================
			Portfolio Items
		==========================================*/
		$('.testimonial-items').masonry({
            itemSelector : '.inner',
            columnWidth : '.inner',
          transitionDuration  : 0
        });
       
       
       
            
        });


}(jQuery));	