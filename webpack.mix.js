const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles([
       'resources/css/animate.min.css'
   ], 'public/css/animate.min.css')
   .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
   .scripts('node_modules/vali-admin/docs/js/main.js', 'public/js/main.js')
   .scripts('node_modules/vali-admin/docs/js/plugins/pace.js', 'public/js/pace.js')
   .scripts('node_modules/vali-admin/docs/js/plugins/bootstrap-notify.min.js', 'public/js/bootstrap-notify.min.js')
   .scripts('node_modules/vali-admin/docs/js/plugins/sweetalert.min.js', 'public/js/plugins/sweetalert.min.js')
   .scripts('node_modules/vali-admin/docs/js/plugins/bootstrap-datepicker.min.js', 'public/js/plugins/bootstrap-datepicker.min.js')
   .scripts('node_modules/vali-admin/docs/js/plugins/select2.min.js', 'public/js/plugins/select2.min.js');

if (mix.inProduction()) {
    mix.version();
}