let mix = require('laravel-mix');

mix.setPublicPath('public')
    .js("assets/js/app.js", "public/js/app.js")
    .styles("assets/styles/app.css", "public/css/app.css");