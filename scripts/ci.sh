#!/bin/bash

echo '-down-'
php artisan down

echo 'Composer packages'
rm -rf vendor
rm composer.lock
composer install --optimize-autoloader

echo 'Key generation'
php artisan key:generate

echo 'Cache'
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo 'Migration'
php artisan migrate:fresh --seed

echo 'Storage link'
php artisan storage:link

echo 'Run tests'
php artisan test

echo '-up-'
php artisan up
