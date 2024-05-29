$(document).ready(function() {
    $('a[href="#journalists"]').click(function() {
        $('#transfersList').html('');
        $.ajax({
            url: 'getJournalists.php',
            type: 'GET',
            success: function(data) {
                $('#journalistsList').html(data);
            }
        });
    });

    $('a[href="#transfers"]').click(function() {
        $('#journalistsList').html('');
        $.ajax({
            url: 'getTransfers.php',
            type: 'GET',
            success: function(data) {
                $('#transfersList').html(data);
            }
        });
    });
});