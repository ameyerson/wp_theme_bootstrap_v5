// ===================================
// Begin social-share.js
// ===================================
'use strict';

$(document).ready(function() {
    
    $('#share-facebook').on('click', function(e) {

      e.preventDefault();

      var targetURL = $(this).attr('href');

      window.open(`http://www.facebook.com/sharer?u=${targetURL}`, 
        'sharewin', 
        'left=20,top=20,width=500,height=500,toolbar=1,resizable=0');

    });

    $('#share-twitter').on('click', function(e) {

      e.preventDefault();

      var targetURL = $(this).attr('href');
      var pageTitle = $(this).attr('data-title');
      var message = "Tap into intel from financial experts to help inform your decisions and make smart money moves. Check out info from The USAA Educational Foundation: ";

      var twitterString = encodeURIComponent(message + targetURL);

      window.open(`https://twitter.com/intent/tweet?text=${twitterString}`, 
        'sharewin', 
        'left=20,top=20,width=500,height=500,toolbar=1,resizable=0');

    });

    $('#share-linkedin').on('click', function(e) {

      e.preventDefault();

      var targetURL = $(this).attr('href');

      window.open(`https://www.linkedin.com/shareArticle?mini=false&url=${targetURL}`, 
        'sharewin', 
        'left=20,top=20,width=500,height=500,toolbar=1,resizable=0');

    });

    $('#share-print').on('click', function(e) {

      e.preventDefault();
      window.print();

    });

});