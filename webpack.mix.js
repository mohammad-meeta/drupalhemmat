const mix = require('laravel-mix');
const public = 'public';

/* JS */
mix.js('resources/js/app.js', `${public}/js`)
    .js('resources/js/pages/welcome/index.js', `${public}/js/pages/welcome`)
    .js('resources/js/pages/articles/edit.js', `${public}/js/pages/articles`);


/* SASS */
mix.sass('resources/sass/app.scss', `${public}/css`);


mix.copyDirectory('resources/js/ckeditor4', `${public}/js/ckeditor`)

/* ETC */
mix.version();
