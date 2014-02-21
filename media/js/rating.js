$(document).ready(function(){
    $( "#slider-range" ).slider({
        range: true,
        min: 1,
        max: 5,
        values: [ 1, 5 ],
        slide: function( event, ui ) {
            $( "#anime-range" ).val( "Рейтинг: " + "от " + ui.values[ 0 ] + " - " + "до " + ui.values[ 1 ] );
        }
    });
    $( "#anime-range" ).val( "Рейтинг: от " + $( "#slider-range" ).slider( "values", 0 ) +
        " - до " + $( "#slider-range" ).slider( "values", 1 ) );

    $('.find-by-rating').click(function(){
        var first = $( "#slider-range" ).slider( "values", 0 );
        var last = $( "#slider-range" ).slider( "values", 1 );
        var $this = this;
        $('.ajax-loader').show();

        $.post(
            window.baseUrl + 'request/findbyrating',
            {
                first: first,
                last: last
            },
            function(response) {
                $('.finded-result').html(response);
                $('.ajax-loader').hide();
            }
        );
    });
});