// ===================================
// Begin featured-assets-block.js
// ===================================
'use strict';

$(document).ready(function() {

	function filterAssets(target) {

		var featuredAssetsJson = $(target).attr('data-resources');

		var checked = $('input[type=checkbox]:checked', this);
		if (checked.length > 0) {
			var checkedTypes = [];
			checked.each(function() {
				checkedTypes.push($(this).val());
			});

			var filteredAssets = (JSON.parse(featuredAssetsJson).filter(function (entry) {
			    return (checkedTypes.indexOf(entry.resource_slug) != -1);
			}));

		} else {
			//show all
			var filteredAssets = JSON.parse(featuredAssetsJson);
		}

		return(filteredAssets);

	}

	function loadAssets(assets) {

	}

	$('.loadMoreAssets').on('click', function(e) {

		e.preventDefault();

		var target = $(this).attr('data-controls');
		var featuredAssetsJson = $(target).attr('data-resources');
		var resources = filterAssets(target);

		if (typeof resources !== 'undefined') {

			var showing = parseInt($(this).attr('data-showing'));
			var totalAssets = resources.length;
			var numtoLoad = Math.min(totalAssets - showing, 8);

			var tileList = $('.resource-tiles', target);

			for (let i = (showing); i < (showing + numtoLoad); i++) {
			  	var newResource = '<div class="col-md-6 col-lg-3 tile-item">';
			  	newResource += '<a class="tile-wrapper" href="' + resources[i]['card_link'] + '">';
			  	newResource += '<div class="post-meta"><div class="tile-icon">';
			  	newResource += '<img src="' + resources[i]['resource_icon'] + '" height="50" width="50" alt="' + resources[i]['resource_title'] + ' icon" />';
			  	newResource += '</div>';
			  	newResource += '<div><h4 class="tile-title">' + resources[i]['card_title'] + '</h4></div>';
			  	newResource += '</div>';
			  	newResource += '<div class="resource-title">' + resources[i]['resource_title'] + '</div>';
			  	newResource += '</div></div></a></div>';
			  	tileList.append(newResource);
			}

			showing = showing + numtoLoad;

			var showingText;
			if (totalAssets == 1) {
				showingText = 'Showing the single result';
			} else if (showing == totalAssets) {
				showingText = 'Showing all ' + totalAssets + ' results';
			} else {
				showingText = 'Showing ' + showing + ' of ' + totalAssets + ' results';
			}

			$('.assets-count', target).html(showingText);

			if (showing >= totalAssets) {
				$(this).hide();
			} else {
				$(this).attr('data-showing', showing);
			}

		}

	});

	$('.assets-block-form').on('submit', function() {

		var target = $(this).attr('data-controls');
		var filteredAssets = filterAssets(target);

		if (typeof filteredAssets !== 'undefined') {

			//redo counter
			var showing = Math.min(filteredAssets.length, 8);
			var showingText;

			if (filteredAssets.length == 1) {
				showingText = 'Showing the single result';
			} else if (showing == filteredAssets.length) {
				showingText = 'Showing all ' + filteredAssets.length + ' results';
			} else {
				showingText = 'Showing ' + showing + ' of ' + filteredAssets.length + ' results';
			}

			$('.assets-count', target).html(showingText);

			//setup load more button
			var loadMoreBtn = $('.loadMoreAssets', target);

			if (filteredAssets.length > 8) {
				loadMoreBtn.attr('data-showing', 8).show();
			} else {
				loadMoreBtn.hide();
			}

			//load from new list

			var tileList = $('.resource-tiles', target);

			tileList.addClass('loading');

			setTimeout(function() {
				tileList.html('');
			    for (let i = (0); i < (showing); i++) {
			      	var newResource = '<div class="col-md-6 col-lg-3 tile-item">';
			      	newResource += '<a class="tile-wrapper" href="' + filteredAssets[i]['card_link'] + '">';
			      	newResource += '<div class="post-meta"><div class="tile-icon">';
			      	newResource += '<img src="' + filteredAssets[i]['resource_icon'] + '" height="50" width="50" alt="' + filteredAssets[i]['resource_title'] + ' icon" />';
			      	newResource += '</div>';
			      	newResource += '<div><h4 class="tile-title">' + filteredAssets[i]['card_title'] + '</h4></div>';
			      	newResource += '</div>';
			      	newResource += '<div class="resource-title">' + filteredAssets[i]['resource_title'] + '</div>';
			      	newResource += '</div></div></a></div>';
			      	tileList.append(newResource);
			    }
			}, 200);

			setTimeout(function() {
			    tileList.removeClass('loading');
			}, 400);

		}

	});

});