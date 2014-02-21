$(document).ready(function(){

    $('.playlist-item').click(function(){
        var fileUrl = $(this).data('src');
        $('#animenice_player').children('video').html('<source src=" ' + fileUrl + '" type="video/mp4">');
    });

    $('#remember-serial').click(function(){
        $.post(
            window.baseUrl + 'request/rememberserial',
            {
                id: $('#remember-serial').data('serial')
            },
            function() {
                $('#remember-serial').text('Запомнил');
            }
        );
    });
});