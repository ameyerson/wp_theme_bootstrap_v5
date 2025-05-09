'use strict';

$(document).ready(function() { 

    var blogCarouselCoin = $('.blog-coin-pager button');

    function goToSlide(slideIndex, targetCarousel) {

        $('.tile-item.active', targetCarousel).attr('aria-hidden', 'true');
        $('.tile-item', targetCarousel).removeClass('active');
        var newCurrent = $('.tile-item', targetCarousel).eq(parseInt(slideIndex));
        newCurrent.addClass('active').removeAttr('aria-hidden');

        // var translateFactor = parseInt(newCurrent.index()) * -300;
        var rowLength = 600;
        var containerWdith = $(window).width();
        var translateFactor = 0;

        if (slideIndex == 1) {
            translateFactor = containerWdith - rowLength - 35;
        }

        //advance slide
        $(targetCarousel).stop(true,true).css('transform', 'translatex(' + translateFactor + 'px)');

        //coin pager
        var coinPager = $(targetCarousel).next('.coin-pager');
        $('button', coinPager).removeClass('active');
        $('button', coinPager).eq(parseInt(slideIndex)).addClass('active');

    }
    

    blogCarouselCoin.on('click',function(e) {

        var targetCarousel = $(this).attr('data-target');
        var targetSlide = $(this).index();
        var numSlides = $('.tile-item', targetCarousel).length;

        goToSlide(targetSlide, targetCarousel);

    });

    $( ".related-blog-section .carousel-inner.has-slides" ).on( "swiperight", function(e) {

        var currentSlide = $('.tile-item.active', this).index();

        if (currentSlide == 1) {
            goToSlide(0, this);
        }

    });
    $( ".related-blog-section .carousel-inner.has-slides" ).on( "swipeleft", function(e) {

        var currentSlide = $('.tile-item.active', this).index();

        if (currentSlide == 0) {
            goToSlide(1, this);
        }

    });

});