
// @prepros-prepend main-nav.js
// @prepros-prepend featured-assets-block.js
// @prepros-prepend social-share.js
// @prepros-prepend blog-carousel.js
// @prepros-prepend image-carousel.js
// @prepros-prepend flip-cards.js
// @prepros-prepend section-sidebar.js
// @prepros-prepend life-events-sidebar.js
// @prepros-prepend team-gallery.js
// @prepros-prepend modals.js
// @prepros-prepend search-dropdown-list.js

// Begin site.js
// ===================================
'use strict';

// When the user scrolls the page, execute usaaefSticky
// window.onscroll = function() {usaaefSticky()};

// // Get the navbar
// var navbar = document.getElementById("global-header");

// // Get the offset position of the navbar
// var sticky = '150';
// var x = window.matchMedia("(max-width: 1199px)");

// // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
// function usaaefSticky() {

//   if (x.matches) {
//     return;
//   }

//   if (window.pageYOffset >= sticky) {
//     navbar.classList.add("sticky")
//   } else {
//     navbar.classList.remove("sticky");
//   }
// }




$(document).ready(function() {
    
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
  });

  $('html').removeClass('no-js').addClass('js');

  // document.addEventListener('touchstart', onTouchStart, {passive: true});

});