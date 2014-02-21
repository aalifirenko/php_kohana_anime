// Filename: description.js

define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone){

    var descModel = Backbone.Model.extend({
        defaults: {
            serial_id: null,
            desc: ''
        }
    });

    return descModel;

});