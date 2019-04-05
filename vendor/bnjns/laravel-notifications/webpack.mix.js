const {mix} = require('laravel-mix');

mix.sass('src/resources/assets/sass/notifications.scss', 'src/resources/assets/css/notifications.min.css')
    .js('src/resources/assets/js/notifications.js', 'src/resources/assets/js/notifications.min.js');