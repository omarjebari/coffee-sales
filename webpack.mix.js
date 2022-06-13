/*const mix = require('laravel-mix');
mix.webpackConfig({
    stats: {
        children: true,
    },
});
mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);*/

const mix = require('laravel-mix');
require('mix-tailwindcss');

mix.webpackConfig({
    stats: {
        children: true,
    },
});

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);
