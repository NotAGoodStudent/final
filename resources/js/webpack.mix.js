const mix = require('laravel-mix');

mix.js('resources/js/echosetup.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
