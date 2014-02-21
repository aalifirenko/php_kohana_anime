// Filename: descPopover.js

define([
    'jquery',
    'underscore',
    'backbone',
    'js/frontend/collection/Description'
], function($, _, Backbone, descCollection){

    var descPopover = Backbone.View.extend({

        el: "body",

        initialize: function() {
            this.descCollection = new descCollection();
            this.render();
        },

        enablePopover: function() {
            var that = this;

            this.$el.find(".popular-anime-item").popover({
                trigger: "hover",
                placement: "right",
                html: true,
                title: function() {
                    return '<b>' + $(this).find('span').text() + '</b>';
                },
                content: function() {
                    var html = "";
                    var serialId = $(this).data('serial');
                    if (that.descCollection.checkBySerialId(serialId) == false) {
                        $.ajax({
                            async: false,
                            url: window.baseUrl + 'request/getSerialDesc',
                            data: { serial_id: serialId },
                            type: "POST",
                            success: function(response) {
                                that.descCollection.add([{
                                    serial_id: serialId,
                                    desc: response
                                }]);

                                html = response;
                            }
                        });
                    } else {
                        var descModel = that.descCollection.getBySerialId(serialId);
                        html = descModel.get('desc');
                    }

                    return html;
                }
            });
        },

        render: function() {
            this.enablePopover();
        }

    });

    return descPopover;

});