
# Laravel Epin App

## Installation

Install and run with docker first .env.example file rename to .env

```bash
docker-compose up -d
docker-compose exec main php artisan migrate
docker-compose exec main php artisan db:seed --class=EpinSeeder
```

go your browser http://localhost:8000/pin

## Installation

Install manually change .env file your database info

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=EpinSeeder
php artisan serve
```

go your browser http://localhost:8000/pin
    