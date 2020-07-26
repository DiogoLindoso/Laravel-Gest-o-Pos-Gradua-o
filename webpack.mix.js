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
   .js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps()
   .sass('resources/sass/app.scss', 'public/css')
   .styles(['resources/css/multstep.css'],'public/css/all.css')
   .scripts([
      'resources/js/multstep.js',
      'resources/js/selectFilter.js',
   ],'public/js/all.js')
   .scripts(['resources/js/admin.js'],'public/js/adm.js')
   .copy(['node_modules/jquery-mask-plugin/dist/jquery.mask.js','node_modules/chart.js/dist/Chart.js'],'public/js')
   .version();
