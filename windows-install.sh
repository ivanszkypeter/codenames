#!/bin/bash

composer install
npm install --only=production
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed --class=WordsTableSeeder
curl https://raw.githubusercontent.com/ServiceStack/redis-windows/master/downloads/redis-latest.zip > redis-latest.zip
unzip redis-latest -d redis