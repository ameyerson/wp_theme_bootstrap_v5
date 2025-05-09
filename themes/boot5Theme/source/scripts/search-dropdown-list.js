// ===================================
// Begin search-dropdown-list.js
// ===================================
'use strict';

function updateDropdownChecks(dropdownList) {

    var checkedFilters = $('input[type="checkbox"]:checked', dropdownList);
    var trigger = $('#searchDropdownTrigger', dropdownList);

    if ($(trigger)) {
        if (checkedFilters.length == 1) {
            $(trigger).html($(checkedFilters[0]).attr('data-display'));
        } else if (checkedFilters.length > 1) {
            $(trigger).html(checkedFilters.length + ' Selected');
        } else {
           $(trigger).html('Filter by Resource Type');
        }
    }

    return;
}

$(document).ready(function() {

    $('#searchDropdownTrigger').on('click', function(e) {

        e.preventDefault();

        var toggle = $(this);
        var target = $(this).next('.dropdown-list');
        var open = ($(this).attr('aria-expanded'));

        if (open == 'true') {
            updateDropdownChecks($(this).parent());
            target.slideUp();
            toggle.removeClass('expanded').attr('aria-expanded', false);
        } else { 
            target.slideDown();
            toggle.addClass('expanded').attr('aria-expanded', true);
        }

    });

    $('#search-apply').on('click', function(e) {

        e.preventDefault();
        var form = $(this).attr('data-form');
        var dropdownlist = $(this).attr('data-filters');
        if ($('#searchDropdownTrigger', dropdownlist)) {
            $('#searchDropdownTrigger', dropdownlist).click();
        }
        if ($(form)) {
            $(form).submit();
        }

    });
    $('#search-clear').on('click', function(e) {
        
        e.preventDefault();
        var form = $(this).attr('data-form');
        var dropdownlist = $(this).attr('data-filters');
        if ($(dropdownlist)) {
            $('input[type="checkbox"]', dropdownlist).each(function(){
                $(this).prop( "checked", false );
            });
            updateDropdownChecks($(dropdownlist));
        }
        if ($('#searchDropdownTrigger', dropdownlist)) {
            $('#searchDropdownTrigger', dropdownlist).click();
        }
        if ($(form)) {
            $(form).submit();
        }

    });

    $('.dropdown-checks').each(function() {
        updateDropdownChecks($(this));
    });

});