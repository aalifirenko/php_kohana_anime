$(document).ready(function(){

    if ($('#relise-page').length > 0) {
        $('#relise-page').wysihtml5();
    }

    if ($('#news-page').length > 0) {
        $('#news-page').wysihtml5();
    }

    $('#select-serial').click(function(e){
        e.preventDefault();
        var serial_id = $('#serial-select :selected').val();
        var url = window.baseUrl + 'admin_ajax/getSeasonSelectBox';

        $.post(
            url,
            {
                serial_id: serial_id
            },
            function(response) {
                $('.seasons-list').html(response);
            }
        );
    });

    $('.save-comment').click(function(){
        var id = $(this).data('id');
        var url = window.baseUrl + 'admin_ajax/savecomment';
        var obj = $(this);

        $.post(
            url,
            {
                id:id
            }, function(){
                obj.parents('tr').hide();
            }
        );
    });

    $('.delete-comment').click(function(){
        var id = $(this).data('id');
        var url = window.baseUrl + 'admin_ajax/deletecomment';
        var obj = $(this);

        $.post(
            url,
            {
                id:id
            }, function(){
                obj.parents('tr').hide();
            }
        );
    });

    $('.delete-news').click(function(){
        var id = $(this).data('id');
        var url = window.baseUrl + 'admin_ajax/deletenews';
        var obj = $(this);

        $.post(
            url,
            {
                id:id
            }, function(){
                obj.parents('tr').hide();
            }
        );
    });

    $('#delete-series').live('click', function(){
        var id = $(this).data('id');
        var thisObj = $(this);

        var url = window.baseUrl + 'admin_ajax/deleteSeries';

        $.post(
            url,
            {
                id: id
            },
            function(response) {
                thisObj.parents('tr').hide();
            }
        );
    });

    $('#season-select-btn').live('click', function(e){
        e.preventDefault();
        var url = window.baseUrl + 'admin_ajax/getFileUpload';

        $.post(
            url,
            {},
            function(response) {
                $('.add-series-box').html(response);
            }
        );
    });

    $('#display-all-serues').live('click', function(e){
        e.preventDefault();
        var url = window.baseUrl + 'admin_ajax/getSeasonSeries';

        $.post(
            url,
            {
                serial_id: $('#serial-select :selected').val(),
                season_id: $('#season-select :selected').val()
            },
            function(response) {
                $('.show-all-series').html(response);
            }
        );
    });

    $('#select_category_serial').click(function(){
        var serialId = $('#serial-select :selected').val();

        $.post(
            window.baseUrl + 'admin_other/getcategoryserials',
            {
                id: serialId
            },
            function(response) {
                $('.category-serial-options').html(response);
            }
        );
    });

});