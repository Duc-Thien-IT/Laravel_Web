#!/bin/bash
composer install
php /var/www/artisan key:generate
php /var/www/artisan migrate
#php /var/www/artisan queue:listen --timeout=0 &

php-fpm