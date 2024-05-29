$(document).ready(function() {
    var journalistsLink = $('a[href="#journalists"]');
    var transfersLink = $('a[href="#transfers"]');

    journalistsLink.click(function() {
        $('#transfersList').html('');
        $.ajax({
            url: 'getJournalists.php',
            type: 'GET',
            success: function(data) {
                $('#journalistsList').html(data);
            }
        });
    });

    transfersLink.click(function() {
        $('#journalistsList').html('');
        $.ajax({
            url: 'getTransfers.php',
            type: 'GET',
            success: function(data) {
                $('#transfersList').html(data);
            }
        });
    });

    function checkHash() {
        if (window.location.hash === '#journalists') {
            journalistsLink.click();
        } else if (window.location.hash === '#transfers') {
            transfersLink.click();
        }
    }

    checkHash();

    window.onhashchange = checkHash;
});