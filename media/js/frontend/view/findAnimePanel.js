// Filename: findAnimePanel.js

define([
    'jquery',
    'underscore',
    'backbone',
    'text!js/templates/findPanel.html',
    'js/frontend/view/descPopover'
], function($, _, Backbone, findPanelTemplate, popoverDesc){

    var findPanel = Backbone.View.extend({

        el: ".find-anime-panel",

        template: _.template(findPanelTemplate),

        events: {
            "click #findAnimePanel a": "showTab",
            "click #find_panel_show_all": "showAllInBlock",
            "click .filter-genre-btn": 'filterGenre'
        },

        initialize: function() {
            this.render();
            this.popoverDesc = new popoverDesc;
        },

        showTab: function(event) {
            event.preventDefault();

            var type = $(event.target).data('type');
            this.getByGenre(type);


            $(event.target).tab('show');
        },

        getByGenre: function(type) {
            var that = this;
            var loadGenrePanel = false;

            if (type == 'genre') {
                type = 'popular';
                loadGenrePanel = true;
            }

            if (type != 'genre' &&type != 'popular' && type != 'hits' && type != 'ongoing' && type != 'aninice' && type != 'sub') {
                loadGenrePanel = true;
            }

            $.post(
                window.baseUrl + 'request/getserialbygenre',
                {
                    genre: type
                },
                function(response) {
                    var tabId = that.$el.find('#findAnimePanel li.active a').attr('href');
                    that.$el.find(tabId).html(response);

                    if (loadGenrePanel == true) {
                        that.$el.find(tabId).prepend($('#genrePanel').html());
                    }

                    that.popoverDesc.enablePopover();
                }
            );
        },

        filterGenre: function(event) {
            var genre = $(event.target).data('genre');
            this.getByGenre(genre);
        },

        showAllInBlock: function(event) {
            $(event.target)
                .parent('.tab-pane')
                .children('.find-anime-block')
                .css('height', 'auto');

            $(event.target).hide();
        },

        render: function() {
            this.$el.html(this.template());

            this.$el.removeClass('no-loaded-pane');

            this.getByGenre('genre');
        }

    });

    return findPanel;

});