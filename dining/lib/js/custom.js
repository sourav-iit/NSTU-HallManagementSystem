/*
	Template Name	: Tech World
	Author			: Maniruzzaman Akash
	Designed Date	: 20/06/2016
 */



(function ($) {

	new WOW().init();

	jQuery(window).load(function() {
		jQuery("#preloader").delay(100).fadeOut("slow");
		jQuery("#load").delay(100).fadeOut("slow");
	});


	//jQuery to collapse the navbar on scroll
	$(window).scroll(function() {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").addClass("top-nav-collapse");
		} else {
			$(".navbar-fixed-top").removeClass("top-nav-collapse");
		}
	});


	//our work
	$(window).load(function(){
		$(".pop-background").fadeOut("slow");
		$("#loader").fadeOut("slow");
	});

	$(function(){
		$(".nav>li").click(function(){
			$(this).addClass("active1").siblings().removeClass("active1");
		});
	});

	$(function(){
		$("#send_message").click(function(){
			$(".pop-background").fadeIn();
			$(".pop-box").fadeIn();
			return false;
		});
		$("#close_pop").click(function(){
			$(".pop-background").fadeOut();
			$(".pop-box").fadeOut();
			return false;
		});
		$("#close_pop_text").click(function(){
			$(".pop-background").fadeOut();
			$(".pop-box").fadeOut();
			return false;
		});

	});






	//jQuery for page scrolling feature - requires jQuery Easing plugin
	$(function() {
		$('.navbar-nav li a').bind('click', function(event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
		});
		
		$('.page-scroll a').bind('click', function(event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
		});
	});

})(jQuery);