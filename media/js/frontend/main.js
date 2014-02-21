// Filename: main.js

define([
    'jquery',
    'underscore',
    'backbone',
    'js/frontend/view/scrollTopMenuView',
    'js/frontend/view/sendMail'
], function($, _, Backbone, scrollView, SendMail){

    // Enable default views
    var scroll = new scrollView();
    var sendMail = new SendMail();

    if (window.scriptList == 'home') {
        require(["js/frontend/view/sliderView", "js/frontend/view/findAnimePanel", "js/frontend/view/lineNews",
            "js/frontend/view/descPopover"],
        function(SliderView, FindPanel, LineNews, DescPopover) {
            // Enable Slider
            var slider = new SliderView();

            // Enable FindPanel
            var findPanel = new FindPanel();

            // Enable Line News
            var lineNews = new LineNews();

            // Enable Desc Popover
            var descPopover = new DescPopover();
        });
    } else if (window.scriptList == 'blog') {
        require(["js/frontend/view/sliderView"],
            function(SliderView) {
                // Enable Slider
                var slider = new SliderView();
            });
    } else if (window.scriptList == 'serial') {
        require(["js/swfobject", "js/frontend/view/serialView"], function(swfobj, SerialView) {
            var serialView = new SerialView();
        });
    } else if (window.scriptList == 'search') {
        require(["js/frontend/view/descPopover"], function(DescPopover) {
            // Enable Desc Popover
            var descPopover = new DescPopover();
        });
    } else if (window.scriptList == 'all_anime') {
        require(["js/frontend/view/descPopover"], function(DescPopover) {
            // Enable Desc Popover
            var descPopover = new DescPopover();
        });
    } else if (window.scriptList == 'popular') {
        require(["js/frontend/view/descPopover"], function(DescPopover) {
            // Enable Desc Popover
            var descPopover = new DescPopover();
        });
    } else if (window.scriptList == 'new_anime') {
        require(["js/frontend/view/descPopover"], function(DescPopover) {
            // Enable Desc Popover
            var descPopover = new DescPopover();
        });
    }
});