var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

var publicCss = 'public/css/';
var publicJs = 'public/js/';
var resourceCss = 'resources/assets/css/';
var resourceJs = 'resources/assets/js/';


elixir(function(mix) {
    mix.scripts([
        'respond.min.js',
        'excanvas.min.js'
    ],publicJs + 'ie.js');
    
    mix.browserify('app-config.js',resourceJs + 'app.js');
    
    mix.styles([
        'font-awesome.min.css',
        'simple-line-icons.min.css',
        'bootstrap.min.css',
        'components.min.css',
        'login.min.css'
    ],publicCss + 'auth.css')
        .scripts([
            'jquery.min.js',
            'bootstrap.min.js',
            'jquery.backstretch.min.js',
            'app.js'
        ],publicJs + 'app.js')
    
    mix.version([
        publicCss + 'auth.css',
        publicJs + 'ie.js',
        publicJs + 'app.js'
    ])
});