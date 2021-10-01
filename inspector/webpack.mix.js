const mix = require('laravel-mix');

/** DIRS **/
const resJsDir = 'resources/js';
const resCssDir = 'resources/sass';
const publicJsDir = 'public/js';
const publicCssDir = 'public/css';

mix.js(`${resJsDir}/app.js`, publicJsDir).vue()
    .js(`${resJsDir}/home.js`, publicJsDir)
    .js(`${resJsDir}/sites.js`, publicJsDir)
    .sass(`${resCssDir}/app.scss`, publicCssDir)
    .sass(`${resCssDir}/error.scss`, publicCssDir)
    .sass(`${resCssDir}/home.scss`, publicCssDir)
    .sass(`${resCssDir}/sites.scss`, publicCssDir)
    .sass(`${resCssDir}/inspector.scss`, publicCssDir)
    .postCss('resources/css/app.css', publicCssDir, [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .extract()
    .version();
