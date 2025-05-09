//TODO: Screen-reader and 508

'use strict';

$(document).ready(function() { 

    $('.flippable').on('click', function(e){

        $(this).toggleClass('active');

    });
    $('.flippable').on('keypress', function(e){

        if (e.which == 13) {
            $(this).click();
        }

    });
    
});