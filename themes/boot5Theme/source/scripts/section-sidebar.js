// ===================================
// Begin section-sidebar.js
// ===================================
'use strict';

$(document).ready(function() {

    $('#guideMenuLink').on('click', function(e) {

        e.preventDefault();

        if (window.innerWidth > 1177) 
            return;

        var toggle = $(this);
        var target = $(this).next('.guide-sidebar-dropdown');
        var open = ($(this).attr('aria-expanded'));

        if (open == 'true') {
            target.slideUp();
            toggle.removeClass('expanded').attr('aria-expanded', false);
        } else { 
            target.slideDown();
            toggle.addClass('expanded').attr('aria-expanded', true);
        }

    });

    if (window.innerWidth < 1178) {
        $('#guideMenuLink').click();
    }

});