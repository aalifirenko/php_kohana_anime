// Filename: sendMail.js

define([
    'jquery',
    'underscore',
    'backbone',
    'text!js/templates/sendMailModal.html'
], function($, _, Backbone, ModalTemplate){

    var sendMail = Backbone.View.extend({

        el: ".footer-block",

        events: {
            "click #sendMessage": "showModal",
            "click .closeSendMail": "closeModal",
            "click .sendMailAction": "sendMailAction"
        },

        template: _.template(ModalTemplate),

        initialize: function() {
            this.render();
        },

        showModal: function(event) {
            event.preventDefault();
            this.$el.find(".sendMailModal").modal('show');
        },

        sendMailAction: function(event) {
            event.preventDefault();

            var message = this.$el.find(".send-mail-input").val();
            if (message != "") {
                this.$el.find(".send-mail-input").hide();
                this.$el.find(".msg-succ").html("Сообщение отправлено!").show();
            }
        },

        closeModal: function(event) {
            this.$el.find(".sendMailModal").modal('hide');
        },

        render: function() {
            this.$el.find(".send-mail-box").html(this.template());
        }

    });

    return sendMail;

});