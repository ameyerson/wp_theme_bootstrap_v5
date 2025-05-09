'use strict';

$(document).ready(function() { 

    $('.team-slide', '.team-gallery').on('click', function(e){

        e.preventDefault();
        var clickedSlide = $(this).attr('id');
        $(this).parent('ul').removeClass('active-slide0 active-slide1 active-slide2').addClass('active-' + clickedSlide).attr('data-activeslide', clickedSlide);

    });

    $('.team-slide', '.team-gallery').on('keypress', function(e){

        if (e.which == 13) {
            $(this).click();
        }

    });
    
    $('.team-gallery-controls button').on('click', function(e) {

        var target = $(this).attr('data-target');
        var activeSlide = parseInt($(target).attr('data-activeslide').at(-1));
        var numSlides = $('.team-slide', target).length;

        var direction = $(this).attr('data-slide');
        var newSlide;

        switch (direction) {
            case 'prev' :
                if (activeSlide == 0) {
                    newSlide = '.team-slide#slide' + (numSlides-1);
                } else {
                    newSlide = '.team-slide#slide' + (activeSlide - 1);
                }

                break;
            default:
                if (activeSlide == numSlides - 1) {
                    newSlide = '.team-slide#slide0';
                } else {
                    newSlide = '.team-slide#slide' + (activeSlide + 1);
                }

        }   

        $(newSlide, target).click();
    });
});