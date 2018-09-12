let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

// custom theme style
mix.styles([
    'node_modules/gentelella/build/css/custom.min.css',
    'node_modules/gentelella/vendors/google-code-prettify/bin/prettify.min.css'
], 'public/css/custom-theme-style.css');

// custom theme scripts
mix.scripts([
    'node_modules/gentelella/build/js/custom.min.js',
    'node_modules/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js',
    'node_modules/gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js',
    'node_modules/gentelella/vendors/google-code-prettify/src/prettify.js'
], 'public/js/admin/custom-theme-scripts.js');
