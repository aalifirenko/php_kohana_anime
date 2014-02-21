// Filename: lineNews.js

define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone){

    var lineNews = Backbone.View.extend({

        el: ".line-new-anime",

        initialize: function() {
            this.render();
        },

        render: function() {
            var that = this;
            $.post(
                window.baseUrl + 'request/getNewAnime',
                {

                },
                function(response) {
                    that.$el.html(response);
                    that.$el.removeClass('no-loaded-pane');
                    that.$el.parent('.container').addClass('load-new-anime-line').css('padding', '10px');
                }
            );
        }

    });

    return lineNews;

});