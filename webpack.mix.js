const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/bootstrap.css', 'public/css')
    .postCss('resources/css/cust/card-custom.css', 'public/css/cust')
    .postCss('resources/css/cust/custom.css', 'public/css/cust')
    .postCss('resources/css/cust/footer_to_bottom.css', 'public/css/cust')
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
