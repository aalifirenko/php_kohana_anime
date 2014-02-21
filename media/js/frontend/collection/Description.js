// Filename: Description.js

define([
    'jquery',
    'underscore',
    'backbone',
    'js/frontend/model/description'
], function($, _, Backbone, descModel){

    var descCollection = Backbone.Collection.extend({
        model: descModel,

        checkBySerialId: function (serialId) {
            var findResult = this.find(function (model) { return model.get("serial_id") == serialId; });
            return findResult != null;
        },

        getBySerialId: function (serialId) {
            var findResult = this.find(function (model) { return model.get("serial_id")  == serialId; });
            return findResult;
        }
    });

    return descCollection;

});