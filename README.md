
# Laravel Epin App

## Installation

Install and run with docker, first rename .env.example file to .env

```bash
docker-compose up -d
# wait for the MySQL server to be up
docker-compose exec main php artisan migrate
docker-compose exec main php artisan db:seed --class=EpinSeeder
```

go your browser http://localhost:8000/pin

## Installation

To install manually, rename .env.example file to .env and change database settings to your database settings

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=EpinSeeder
php artisan serve
```

go your browser http://localhost:8000/pin
    