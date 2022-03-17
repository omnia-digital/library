let mix = require('laravel-mix');

mix.js('resources/js/library.js', 'dist').setPublicPath('resources/dist');
mix.js('resources/js/tiptap/tiptap.js', 'dist').setPublicPath('resources/dist');
mix.postCss('resources/css/library.css', 'dist').setPublicPath('resources/dist');
