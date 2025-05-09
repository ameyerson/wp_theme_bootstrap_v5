// ===================================
// Begin life-events-sidebar.js
// ===================================
'use strict';

$(document).ready(function() {

    $('.dropdown-sidebar a[role="button"]').on('click', function(e) {

        e.preventDefault();

        if (window.innerWidth > 1177) 
            return;

        var toggle = $(this);
        var target = $(this).next('.sidebar-dropdown');
        var open = ($(this).attr('aria-expanded'));

        if (open == 'true') {
            target.slideUp();
            toggle.removeClass('expanded').attr('aria-expanded', false);
        } else { 
            target.slideDown();
            toggle.addClass('expanded').attr('aria-expanded', true);
        }

    });

    $('#life-event-nav a').on('click', function(e) {

        event.preventDefault();

        if (window.innerWidth < 1178) {
            $('#lifeEventLink').click();
        }

        var target = $(this.hash);

        if (target.length) {

          event.preventDefault();

          var scroll_offset = target.offset().top;
          var scroll_correction = 100;

          if (window.innerWidth < 1178) {
              scroll_correction = 300;
          }

          scroll_offset = scroll_offset - scroll_correction;

          $('html, body').stop(true, true).animate({

            scrollTop: scroll_offset

          }, 100, 'swing', function() {

            // Callback after animation
            // Must change focus!
            var $target = $(target);

            $target.focus();

            if ($target.is(":focus")) { // Checking if the target was focused

              return false;

            } else {

              $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again

            };

          });
        }

    });

    if (window.innerWidth < 1178) {
        $('.dropdown-sidebar a[role="button"]').removeClass('expanded').attr('aria-expanded', false);
    }

});