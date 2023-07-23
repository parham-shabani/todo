const mix = require('laravel-mix')

mix.js('resource/js/app.js', 'public.js').sass('resource/sass/app.scss', 'public.css').sourceMaps()
