// Filename: sliderView.js

define([
    'jquery',
    'underscore',
    'backbone',
    'text!js/templates/slider.html',
    'image!/media/slider/first.jpg',
    'image!/media/slider/new.jpg',
    'image!/media/slider/1.jpg',
    'image!/media/slider/5.jpg',
    'image!/media/slider/2.jpg',
    'image!/media/slider/8.jpg'
], function($, _, Backbone, sliderTemplate, image1, image2, image3, image4, image5, image6){

    var slider = Backbone.View.extend({

        el: ".slider",

        template: _.template(sliderTemplate),

        initialize: function() {
            this.render();
        },

        render: function() {
            var image = [];
            image[1] = image1;
            image[2] = image2;
            image[3] = image3;
            image[4] = image4;
            image[5] = image5;
            image[6] = image6;
            this.$el.html(this.template({
                image: image
            }));

            this.enableSlider();
        },

        enableSlider: function() {
            $('#aniniceTopSlider').carousel();
        }

    });

    return slider;

});