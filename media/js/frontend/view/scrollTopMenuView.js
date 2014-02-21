// Filename: scrollView.js

define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone){

    var scroll = Backbone.View.extend({

        el: ".navbar-inner",

        initialize: function() {
            _.bindAll(this, 'scroll');
            // bind to window
            $(window).scroll(this.scroll);
        },

        scroll: function() {
            var marginTop = $(window).scrollTop();

            if (marginTop >= 50) {
                this.$el.css("background-color", "rgba(0, 0, 0, 0.8)");
            } else if (marginTop < 50) {
                this.$el.css("background-color", "rgba(0, 0, 0, 1)");
            }
        }

    });

    return scroll;

});