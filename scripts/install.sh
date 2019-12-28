#!/bin/bash

composer install

npm install

cp .env.example .env

php artisan key:generate && php artisan jwt:secret

php artisan config:cache

npm run dev

php echo "don't forget to copy the JWT scret/ttl to the .env.testing for testing"

php echo "when you're ready create a database and migrate and seed the db"
