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

if (!mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'inline-source-map'
    })
}



mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/home.js', 'public/js')
    .vue();

mix.js('resources/js/welcome.js', 'public/js')
    .vue();

mix.js('resources/js/admin.js', 'public/js')
    .vue();


mix.js('resources/js/FrontUser/index.js', 'public/js/FrontUser')
    .vue();



mix.sass('resources/sass/welcome.scss', 'public/css');
mix.sass('resources/sass/admin.scss', 'public/css');
mix.sass('resources/sass/user_admin.scss', 'public/css');

