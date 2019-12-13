const mix = require('laravel-mix');
require('laravel-mix-alias');
const public = 'public';

mix.alias({
    '@components': '/resources/js/components',
});

/* JS */
mix.js('resources/js/app.js', `${public}/js`)
    .js('resources/js/pages/welcome/index.js', `${public}/js/pages/welcome`)
    .js('resources/js/pages/articles/edit.js', `${public}/js/pages/articles`)
    .js('resources/js/pages/organ/index/index.js', `${public}/js/pages/organ/index`)
    .js('resources/js/pages/city/index/index.js', `${public}/js/pages/city/index`)
    .js('resources/js/pages/articles/index/index.js', `${public}/js/pages/articles/index`)
    .js('resources/js/pages/article_types/index/index.js', `${public}/js/pages/article_types/index`);

/* SASS */
mix.sass('resources/sass/app.scss', `${public}/css`);


mix.copyDirectory('resources/js/ckeditor4', `${public}/js/ckeditor`)

/* ETC */
mix.disableSuccessNotifications()
    .version();
