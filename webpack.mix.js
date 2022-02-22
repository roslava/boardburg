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
    .js('resources/js/button_disabled.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/bootstrap.css', 'public/css')

    .postCss('resources/css/cust/card-custom.css', 'public/css/cust')
    .postCss('resources/css/cust/custom.css', 'public/css/cust')
    .postCss('resources/css/cust/footer_to_bottom.css', 'public/css/cust')
    // .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()

mix.browserSync({
    proxy: 'boardburg.xx',
    open: false,
    watchOptions: {
        usePolling: true,
        interval: 1
    }
})


.webpackConfig(require('./webpack.config'));
