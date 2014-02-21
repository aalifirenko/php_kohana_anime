// Load JS
    require.config({
        baseUrl: "/media/",

        deps: ["js/frontend/main", "bootstrap"],

        paths: {
            'text': "js/require/text",
            'image': "js/require/image",
            'jquery': 'js/jquery',
            'backbone': 'js/backbone/backbone',
            'underscore': 'js/backbone/underscore',
            'bootstrap': 'js/bootstrap'
        },

        shim: {
            'jquery': {
                exports: 'jQuery'
            },
            'jquery-ui': {
                deps: ['jquery']
            },
            underscore: {
                exports: '_'
            },
            backbone: {
                deps: ['jquery', 'underscore'],
                exports: 'Backbone'
            },
            bootstrap: {
                deps: ['jquery']
            }
        }
    });