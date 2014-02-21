// Filename: serialView.js

define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone){

    var lineNews = Backbone.View.extend({

        el: ".serial",

        events: {
            "click .playlist-item": "changeSeries",
            "click .rating-block": "setRating"
        },

        initialize: function () {
            player_init();
        },

        changeSeries: function (event) {
            var fileUrl = $(event.target).data('src');
            this.$el.find('#animenice_player').children('video').html('<source src=" ' + fileUrl + '" type="video/mp4">');

            this.$el.find(".playlist-item").removeAttr('style');
            $(event.target).css("background-color", "#b6b6b6");
        },

        setRating: function (event) {
            var serial_id = $(event.target).data('serial');
            var rating = $(event.target).data('rating');
            var that = this;

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
                            that.$el.find('.rating-block').hide();
                            that.$el.find('.serial-rating-title').hide();
                            that.$el.find('.calc-rating').text('Рейтинг сериала: ' + rating).show();
                        }
                    }
                });
            }
        }

    });

    return lineNews;

});