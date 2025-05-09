'use strict';

$(document).ready(function() { 

    var imageCarouselNext = $('.image-carousel-next');
    var imageCarouselPrev = $('.image-carousel-prev');
    var imageCarouselCoin = $('.image-coin-pager button');

    var donutGraphicSegment = $('.donut-graphic a.segment-link');


    function goToSlide(slideIndex, targetCarousel) {

        $('.carousel-slide', targetCarousel).attr('aria-hidden', 'true');
        $('.carousel-slide a', targetCarousel).attr('tabindex', '-1');
        $('.carousel-slide', targetCarousel).removeClass('active');
        var newCurrent = $('.carousel-slide', targetCarousel).eq(parseInt(slideIndex));
        newCurrent.addClass('active').removeAttr('aria-hidden');
        $('a', newCurrent).attr('tabindex', '0');


        var translateFactor = parseInt(newCurrent.index()) * -100;

        //advance slide
        $('.carousel-inner', targetCarousel).css('transform', 'translatex(' + translateFactor + '%)');

        //coin pager
        var coinPager = $('.coin-pager', targetCarousel);
        $('button', coinPager).removeClass('active');
        $('button', coinPager).eq(parseInt(slideIndex)).addClass('active');

        //donut graphic
        var donutGraphic = $('.donut-graphic', targetCarousel);
        $('.segment-link', donutGraphic).removeClass('active-segment');
        $('.segment-link', donutGraphic).eq(parseInt(slideIndex)).addClass('active-segment');

        var center = $('.center', donutGraphic);
        var numSlides = $('.carousel-slide', targetCarousel).length;
        var segmentArc = 360/numSlides;


        center.css('transform', 'rotate(' + segmentArc * (slideIndex)  + 'deg)');
        center.attr('data-pos', segmentArc * (slideIndex) );

    }
    

    imageCarouselNext.on('click', function(e) {

        var targetCarousel = $(this).attr('data-target');
        var currentSlide = $('.carousel-slide.active', targetCarousel).index();
        var numSlides = $('.carousel-slide', targetCarousel).length;
        var nextSlide = currentSlide + 1;

        if (nextSlide < numSlides) { 
            goToSlide(nextSlide, targetCarousel);
        }
        if (nextSlide == (numSlides - 1)) {
            $(this).css('opacity', '0').attr('aria-hidden', 'true').attr('tabindex', '-1');
        }
        if ($('.carousel-prev', targetCarousel).css('opacity') == '0')
            $('.carousel-prev', targetCarousel).css('opacity', '1').removeAttr('aria-hidden').attr('tabindex', '0');

    });

    imageCarouselPrev.on('click', function(e) {

        var targetCarousel = $(this).attr('data-target');
        var currentSlide = $('.carousel-slide.active', targetCarousel).index();
        var numSlides = $('.carousel-slide', targetCarousel).length;
        var prevSlide = currentSlide - 1;

        if (prevSlide >= 0) { 
            goToSlide(prevSlide, targetCarousel);
        }
        if (prevSlide == 0) {
            $(this).css('opacity', '0').attr('aria-hidden', 'true').attr('tabindex', '-1');
        }
        if ($('.carousel-next', targetCarousel).css('opacity') == '0')
            $('.carousel-next', targetCarousel).css('opacity', '1').removeAttr('aria-hidden').attr('tabindex', '0');

    });

    imageCarouselCoin.on('click',function(e) {

        var targetCarousel = $(this).attr('data-target');
        var targetSlide = $(this).index();
        var numSlides = $('.carousel-slide', targetCarousel).length;

        if (targetSlide == 0) {
            $('.carousel-prev', targetCarousel).css('opacity', '0').attr('aria-hidden', 'true').removeAttr('tabindex');
        } else {
            if ($('.carousel-prev', targetCarousel).css('opacity') == '0')
                $('.carousel-prev', targetCarousel).css('opacity', '1').removeAttr('aria-hidden').attr('tabindex', '0');
        }
        if (targetSlide == (numSlides - 1)) {
            $('.carousel-next', targetCarousel).css('opacity', '0').attr('aria-hidden', 'true').removeAttr('tabindex');
        } else {
            if ($('.carousel-next', targetCarousel).css('opacity') == '0')
                $('.carousel-next', targetCarousel).css('opacity', '1').removeAttr('aria-hidden').attr('tabindex', '0');
        }

        goToSlide(targetSlide, targetCarousel);

    });

    donutGraphicSegment.on('click', function(e) {
        var targetCarousel = $(this).attr('data-target');
        var targetSlide = $(this).index() - 1;
        var numSlides = $('.carousel-slide', targetCarousel).length;

        e.preventDefault();
        
        if (targetSlide == 0) {
            $('.carousel-prev', targetCarousel).css('opacity', '0').attr('aria-hidden', 'true').removeAttr('tabindex');
        } else {
            if ($('.carousel-prev', targetCarousel).css('opacity') == '0')
                $('.carousel-prev', targetCarousel).css('opacity', '1').removeAttr('aria-hidden').attr('tabindex', '0');
        }
        if (targetSlide == (numSlides - 1)) {
            $('.carousel-next', targetCarousel).css('opacity', '0').attr('aria-hidden', 'true').removeAttr('tabindex');
        } else {
            if ($('.carousel-next', targetCarousel).css('opacity') == '0')
                $('.carousel-next', targetCarousel).css('opacity', '1').removeAttr('aria-hidden').attr('tabindex', '0');
        }

        goToSlide(targetSlide, targetCarousel);



    });

    $( ".image-carousel" ).on( "swiperight", function(e) {

        $(this).closest('.container').find('.carousel-prev').click();

    });
    $( ".image-carousel" ).on( "swipeleft", function(e) {

        $(this).closest('.container').find('.carousel-next').click();

    });

    $('.usaaef-carousel').each(function() {goToSlide(0, $(this))});

});