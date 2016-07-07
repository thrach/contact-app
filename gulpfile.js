var elixir = require('laravel-elixir');

var publicCss = 'public/css/';
var publicJs = 'public/js/';
var resourceCss = 'resources/assets/css/';
var resourceJs = 'resources/assets/js/';


elixir(function(mix) {
    mix.scripts([
        'respond.min.js',
        'excanvas.min.js'
    ],publicJs + 'ie.js');
    
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
            'login.min.js'
        ],publicJs + 'auth.js')
    
    mix.version([
        publicCss + 'auth.css',
        publicJs + 'ie.js',
        publicJs + 'auth.js'
    ])
});