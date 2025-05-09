'use strict';

$(document).ready(function() {
    
      $('.dropdown-trigger', 'ul.dropdown-nav').on('click', function(e){
      //FULLSCREEN SUPERMENU

      e.preventDefault();

      //TODO: keyoard events;
      //TODO: Screen-reader and 508

      var globalHeader = $('#global-header');
      var navContainer = $('#nav-menus');
      var parentMenu = $(this).parents('.dropdown-nav');
      var parentLi = $(this).parent('.dropdown-parent');
      var childSubmenu = $(this).next('.dropdown-subnav');


      // $('.navbar-toplevel-trigger', 'li.has-panel.active').not(this).each(function() {
      //     togglePanel($(this));
      // });

      if (parentLi.hasClass('active')) {
          //close nav

          parentLi.removeClass('active');
          globalHeader.removeClass("supermenu-open");
          parentLi.children('.dropdown-trigger').attr('aria-expanded','false');

      } else {
          //open nav

          $('li.active', navContainer).removeClass('active').children('.dropdown-trigger').attr('aria-expanded','false');

          parentLi.addClass('active');

          if (window.innerWidth > 1199) {

            var offset = childSubmenu.offset();
            var left = offset.left;
            var width = childSubmenu.width();
            var docW = $(globalHeader).width();  

            var isEntirelyVisible = (left + width + 92 <= docW);

            if (!isEntirelyVisible) {
                parentLi.addClass('edge');
            }
          }

          globalHeader.addClass("supermenu-open");

          parentLi.children('.dropdown-trigger').attr('aria-expanded','true');

          if (window.innerWidth < 1200) {
            navContainer.scrollTop(0);
          }
      }

    });

    $('.supermenu-toggle').on('click', function(e){

        e.preventDefault();

        var navContainer = $('#nav-menus');

        navContainer.toggleClass('open');
        $(this).toggleClass('open').parent().toggleClass('open');
        $(this).attr('aria-expanded', function (i, attr) {
          return attr == 'true' ? 'false' : 'true'
        });

    });

    $('.mobile-drawer-close').on('click', function(e){

        e.preventDefault();

        var globalHeader = $('#global-header');
        var parentLi = $(this).parents('.dropdown-parent');

        parentLi.removeClass('active');
        globalHeader.removeClass("supermenu-open");
        parentLi.children('.dropdown-trigger').attr('aria-expanded','false');

    });

    $(window).on('click', function(e) {

        var globalHeader = $('#global-header');
        var navContainer = $('#nav-menus');
        var menuToggle = $('#header-toggle');
  

        if (window.innerWidth < 1200) {

            if (($.contains(globalHeader[0], e.target) == false)  && navContainer.hasClass('open')) {

                globalHeader.removeClass('supermenu-open');
                navContainer.removeClass('open');
                menuToggle.removeClass('open').children('.supermenu-toggle').removeClass('open');
                // menuBackdrop.removeClass('show');
            }

        } else {
            if ($.contains(globalHeader[0], e.target) == false) {

                var activeTab = $('li.active', navContainer);
                if (activeTab.length > 0) {
                    activeTab.removeClass('active');
                    activeTab.children('.dropdown-trigger').attr('aria-expanded','false');
                    globalHeader.removeClass("supermenu-open");
                }
            }
        }

    });

});