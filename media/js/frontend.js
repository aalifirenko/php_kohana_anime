$(document).ready(function(){

    if ($('#new_anime').length > 0) {
        $('#new_anime').carousel();
    }
    if ($('#news').length > 0) {
        $('#news').carousel({
            interval: 10000
        }).on('slide', function (e) {
                $('#news').find('.news-image').hide();
                $('#slide-change-background').fadeIn(1000);

                setTimeout(function(){
                    $('#slide-change-background').fadeOut(3000);
                    $('#news').find('.news-image').removeAttr('style');
                } ,2000);

            });
    }

    $('.sidebar-live-search').keyup(function(){
        var search = $(this).val().toLowerCase();
        search.replace(/(<([^>]+)>)/ig,"");
        var finded = 0;

        $('span.sidebar-serial-item').each(function(index, item){
            var engVal = $(this).data('eng-title').toLowerCase();
            var ruVal = $(this).children('a').children('.serial-item-anime-title').text().toLowerCase();

            if (search.length == 0 || ruVal.indexOf(search) >= 0 || engVal.indexOf(search) >= 0) {
                $(this).show();
                finded++;
            } else {
                $(this).hide();
            }
        });
        if (finded == 0 || finded <= 30)
            $('div.sidebar-serial-item').hide();
        else if (finded > 30)
            $('div.sidebar-serial-item').show();
    });

    $('#auth-close').click(function(){
        $.post(
            window.baseUrl + 'social-auth/userblock',
            {
                operation: 'close'
            }
        );
        $('.auth-box').animate(
            {'margin-top': -150},
            {queue:false, duration:'slow'});
        $('#hidden-profile').show();
    });

    $('#hidden-profile').click(function(){
        $.post(
            window.baseUrl + 'social-auth/userblock',
            {
                operation: 'open'
            }
        );
        $('.auth-box').animate(
            {'margin-top': 0},
            {queue:false, duration:'slow'});
        $(this).hide();
    });

    $('.filter-genre-btn').live('click', function(){
        var genre = $(this).data('genre');
        var $this = this;
        $(this).button('loading');

        $.post(
            window.baseUrl + 'request/filterbygenre',
            {
                genre: genre
            },
            function(response) {
                $('.anime-box-content').html(response);
                $($this).button('reset');
            }
        );
    });

    $('.rating-block').click(function(){
        var serial_id = $(this).data('serial');
        var rating = $(this).data('rating');

        if (serial_id && rating) {
            $.ajax({
                url: window.baseUrl + 'request/addrating',
                dataType: 'json',
                type: 'post',
                data: {
                    serial_id: serial_id,
                    rating: rating
                },
                success: function(response) {
                    if (response.status) {
                        var calc = response.sum / response.count;
                        var rating = parseFloat(calc.toFixed(2));
                        $('.rating-block').hide();
                        $('.serial-rating-title').hide();
                        $('.calc-rating').text('Рейтинг сериала: ' + rating).show();
                    }
                }
            });
        }
    });

    $('.view-all-sidebar').click(function(e){
        e.preventDefault();

        $('.left-sidebar-box').css('max-height', 'none');
        $(this).parents('.sidebar-serial-item').hide();
    });

    $('#top-nav-search-btn').popover({
        html: true,
        placement: "bottom",
        title: "Поиск аниме",
        content: $('#top-search-form-template').html()
    });

    $('#top-nav-login-btn').popover({
        html: true,
        placement: "bottom",
        title: "Авторизация",
        content: $('#top-login-form-template').html()
    });

    $('#top-nav-register-btn').popover({
        html: true,
        placement: "bottom",
        title: "Регистрация",
        content: $('#top-register-form-template').html()
    });

    $('html').on('mouseup', function(e) {
        if(!$(e.target).closest('.popover').length) {
            $('.popover').each(function(){
                $(this.previousSibling).popover('hide');
            });
        }
    });

    $('#comment-add-action').click(function(){
        var serialId = $('#serial_id').val();
        var seasonId = $('#season_id').val();
        var text = $('#comment-add').val();
        var name = $('#comment-name').val();
        var avatar = $('#comment-avatar').val();

        if (text != '') {
            $('#comment-status').html("");

            $.post(
                window.baseUrl + 'request/addcomment',
                {
                    serial_id: serialId,
                    season_id: seasonId,
                    name: name,
                    avatar:avatar,
                    text: text
                },
                function(response) {
                    if (response != 'false' && response != 'bad_nick') {
                        $('.comment-list').before(response);
                        $('#comment-status').html('<div class="alert alert-success">Ваш комментарий добавлен</div>');
                        $('#comment-add').val("");
                    } else {
                        if (response == false)
                            $('#comment-status').html('<div class="alert alert-error">Извините, сервис временно не работает, попробуйте позже</div>');
                        else if (response == 'bad_nick')
                            $('#comment-status').html('<div class="alert alert-error">Этот псевдоним только для администрации, выберите другой!</div>');
                    }
                }
            );

        } else {
            $('#comment-status').html('<div class="alert alert-error">Пожалуйста, введите комментарий</div>');
        }
    });

});