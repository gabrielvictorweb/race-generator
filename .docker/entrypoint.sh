#! /usr/bin/bash
php composer.phar install

php artisan migrate --force
php artisan test
php artisan serve --host 0.0.0.0
