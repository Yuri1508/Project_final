// ======================================================================
// NAV-BAR   NAV-BAR   NAV-BAR   NAV-BAR   NAV-BAR   NAV-BAR   NAV-BAR
// ======================================================================
const menuSlide = () => {
	const burger = document.querySelector('.burger');
	const menu_ul = document.querySelector('.menu_ul');
	const menu_ul_li = document.querySelectorAll('.menu_ul li');


	burger.addEventListener('click', () => {

		//Toggle Menu
		menu_ul.classList.toggle('menu_active');

		//Animate Menu
		menu_ul_li.forEach((link, index) => {
			if (link.style.animation) {
				link.style.animation = ''
			}
			else {
				link.style.animation = `menuUlFade 0.5s ease forwards ${index / 7 + 0.5}s`;
			}
		});

		//Burger Animation
		burger.classList.toggle('toggle');

		burger.classList.toggle('burgerHidde');
	});
}

menuSlide();
// ======================================================================



// ======================================================================
// LANDING   LANDING   LANDING   LANDING   LANDING   LANDING   LANDING
// ======================================================================
'use strict';

$(document).ready(function () {
	var $cont = $('.cont');
	var $slider = $('.slider');
	var $nav = $('.nav');
	var winW = $(window).width();
	var animSpd = 750; // Change also in CSS
	var distOfLetGo = winW * 0.2;
	var curSlide = 1;
	var animation = false;
	var diff = 0;

	// Generating slides
	var arrCities = ['COMPRENDRE', 'PRESERVER', 'TRANSMETRE']; // Change number of slides in CSS also
	var numOfCities = arrCities.length;
	var arrCitiesDivided = [];

	arrCities.map(function (city) {
		var length = city.length;
		var letters = Math.floor(length / 4);
		var exp = new RegExp(".{1," + letters + "}", "g");

		arrCitiesDivided.push(city.match(exp));
	});

	var generateSlide = function generateSlide(city) {
		var frag1 = $(document.createDocumentFragment());
		var frag2 = $(document.createDocumentFragment());
		var numSlide = arrCities.indexOf(arrCities[city]) + 1;
		var firstLetter = arrCitiesDivided[city][0].charAt(0);

		var $slide = $('<div data-target="' + numSlide + '" class="slide slide--' + numSlide + '">\n\t\t\t\t\t\t\t<div class="slide__darkbg slide--' + numSlide + '__darkbg"></div>\n\t\t\t\t\t\t\t<div class="slide__text-wrapper slide--' + numSlide + '__text-wrapper"></div>\n\t\t\t\t\t\t</div>');

		var letter = $('<div class="slide__letter slide--' + numSlide + '__letter">\n\t\t\t\t\t\t\t' + firstLetter + '\n\t\t\t\t\t\t</div>');

		for (var i = 0, length = arrCitiesDivided[city].length; i < length; i++) {
			var text = $('<div class="slide__text slide__text--' + (i + 1) + '">\n\t\t\t\t\t\t\t\t' + arrCitiesDivided[city][i] + '\n\t\t\t\t\t\t\t</div>');
			frag1.append(text);
		}

		var navSlide = $('<li data-target="' + numSlide + '" class="nav__slide nav__slide--' + numSlide + '"></li>');
		frag2.append(navSlide);
		$nav.append(frag2);

		$slide.find('.slide--' + numSlide + '__text-wrapper').append(letter).append(frag1);
		$slider.append($slide);

		if (arrCities[city].length <= 4) {
			$('.slide--' + numSlide).find('.slide__text').css("font-size", "12vw");
		}
	};

	for (var i = 0, length = numOfCities; i < length; i++) {
		generateSlide(i);
	}

	$('.nav__slide--1').addClass('nav-active');

	// Navigation
	function bullets(dir) {
		$('.nav__slide--' + curSlide).removeClass('nav-active');
		$('.nav__slide--' + dir).addClass('nav-active');
	}

	function timeout() {
		animation = false;
	}

	function pagination(direction) {
		animation = true;
		diff = 0;
		$slider.addClass('animation');
		$slider.css({
			'transform': 'translate3d(-' + (curSlide - direction) * 100 + '%, 0, 0)'
		});

		$slider.find('.slide__darkbg').css({
			'transform': 'translate3d(' + (curSlide - direction) * 50 + '%, 0, 0)'
		});

		$slider.find('.slide__letter').css({
			'transform': 'translate3d(0, 0, 0)'
		});

		$slider.find('.slide__text').css({
			'transform': 'translate3d(0, 0, 0)'
		});
	}

	function navigateRight() {
		if (curSlide >= numOfCities) return;
		pagination(0);
		setTimeout(timeout, animSpd);
		bullets(curSlide + 1);
		curSlide++;
	}

	function navigateLeft() {
		if (curSlide <= 1) return;
		pagination(2);
		setTimeout(timeout, animSpd);
		bullets(curSlide - 1);
		curSlide--;
	}

	function toDefault() {
		pagination(1);
		setTimeout(timeout, animSpd);
	}

	// Events
	$(document).on('mousedown touchstart', '.slide', function (e) {
		if (animation) return;
		var target = +$(this).attr('data-target');
		var startX = e.pageX || e.originalEvent.touches[0].pageX;
		$slider.removeClass('animation');

		$(document).on('mousemove touchmove', function (e) {
			var x = e.pageX || e.originalEvent.touches[0].pageX;
			diff = startX - x;
			if (target === 1 && diff < 0 || target === numOfCities && diff > 0) return;

			$slider.css({
				'transform': 'translate3d(-' + ((curSlide - 1) * 100 + diff / 30) + '%, 0, 0)'
			});

			$slider.find('.slide__darkbg').css({
				'transform': 'translate3d(' + ((curSlide - 1) * 50 + diff / 60) + '%, 0, 0)'
			});

			$slider.find('.slide__letter').css({
				'transform': 'translate3d(' + diff / 60 + 'vw, 0, 0)'
			});

			$slider.find('.slide__text').css({
				'transform': 'translate3d(' + diff / 15 + 'px, 0, 0)'
			});
		});
	});

	$(document).on('mouseup touchend', function (e) {
		$(document).off('mousemove touchmove');

		if (animation) return;

		if (diff >= distOfLetGo) {
			navigateRight();
		} else if (diff <= -distOfLetGo) {
			navigateLeft();
		} else {
			toDefault();
		}
	});

	$(document).on('click', '.nav__slide:not(.nav-active)', function () {
		var target = +$(this).attr('data-target');
		bullets(target);
		curSlide = target;
		pagination(1);
	});

	$(document).on('click', '.side-nav', function () {
		var target = $(this).attr('data-target');

		if (target === 'right') navigateRight();
		if (target === 'left') navigateLeft();
	});

	$(document).on('keydown', function (e) {
		if (e.which === 39) navigateRight();
		if (e.which === 37) navigateLeft();
	});

	// $(document).on('mousewheel DOMMouseScroll', function (e) {
	// 	if (animation) return;
	// 	var delta = e.originalEvent.wheelDelta;

	// 	if (delta > 0 || e.originalEvent.detail < 0) navigateLeft();
	// 	if (delta < 0 || e.originalEvent.detail > 0) navigateRight();
	// });
});


// JavaScript Document
//swiper script

var swiper = new Swiper('.swiper-container', {
	slidesPerView: 5.2,
	spaceBetween: 30,
	pagination: {
		el: '.swiper-container',
		clickable: true,
	},
});
// ======================================================================



// ======================================================================
// Add active class to the current button (highlight it)
var header = document.getElementById("my-active");
var btns = header.getElementsByClassName("go");
for (var i = 0; i < btns.length; i++) {
	btns[i].addEventListener("click", function () {
		var current = document.getElementsByClassName("active");
		current[0].className = current[0].className.replace(" active", "");
		this.className += " active";
	});
}
// ======================================================================

// ======================================================================
// button return up
$('<div></div>')
    .attr('id', 'scrolltotop')
    .hide()
    .css({ 'z-index': '1000', 'position': 'fixed', 'bottom': '25px', 'right': '35px', 'cursor': 'pointer', 'width': '40px', 'height': '40px', 'background': '#263677', 'border-radius': '50%' })
    .appendTo('body')
    .click(function () {
        $('html,body').animate({ scrollTop: 0 }, '3000');
    });
$('<div></div>')
    .css({ 'width': '6px', 'height': '6px', 'transform': 'rotate(-135deg)', 'border': 'solid ghostwhite', 'border-width': '0 3px 3px 0', 'padding': '3px', 'margin-top': '16px', 'margin-left': '15px' })
    .appendTo('#scrolltotop');
$(window).scroll(function () {
    if ($(window).scrollTop() < 500) {
        $('#scrolltotop').fadeOut();
    } else {
        $('#scrolltotop').fadeIn();
    }
});
// ======================================================================