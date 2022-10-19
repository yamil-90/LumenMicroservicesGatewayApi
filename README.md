# Lumen Api gateway

this app connects the books and authors api 

remember to create a secret for the books and author api, and add it the the .env

AUTHORS_SERVICE_SECRET=
BOOKS_SERVICE_SECRET=

the same secret should be added to the .env of the authors or books api

steps
composer install
create database.sqlite in database if using sqlite
php artisan migrate
php -S localhost:8002 -t ./public
create credentials 
php artisan passport:client
get token 
post 

