(function(window, undefined) {
    $('a[data-action]').click(function(e) {
        e.preventDefault();
        $('#results').empty();
        var action = $(this).data('action');
        $.ajax({
            url: '/service/population.php',
            data: {action: action, top: 10 },
            dataType: 'JSON'
        }).done(function(data){
            var list;
            for(var i = 0, end = data.length; i < end; i++) {
                list = data[i];
                $('#results').append($('<p>').text(list.Name + ' ' +  (list.Population)));
            }
        });
    });
})(window);
