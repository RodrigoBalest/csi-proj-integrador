const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    // Copia jQuery e Bootstrap
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/assets/js')
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/assets/css')
    .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/assets/js')
    // Copia FontAwesome
    .copy('node_modules/@fortawesome/fontawesome-free/css/all.css', 'public/assets/fa/css')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/assets/fa/webfonts')
    // Copia Boostrap Select
    .combine([
        'node_modules/bootstrap-select/dist/js/bootstrap-select.js',
        'node_modules/bootstrap-select/dist/js/i18n/defaults-pt_BR.js'
    ], 'public/assets/js/bootstrap-select.js')
    .copy('node_modules/bootstrap-select/dist/css/bootstrap-select.min.css', 'public/assets/css')
    // Copia imagens
    .copyDirectory('resources/img', 'public/assets/img')
    // Copia logos de marcas
    .copyDirectory('resources/logos', 'public/assets/logos')
    // Outros
    .copy('resources/css/custom.css', 'public/assets/css')
    .copy('resources/js/app.js', 'public/assets/js')
    .copy('resources/js/contas.js', 'public/assets/js')
    .copy('resources/js/categorias.js', 'public/assets/js');
