FROM php:8.1-fpm-alpine

WORKDIR /app
RUN apk add --update zlib-dev libpng-dev jpeg-dev freetype-dev libzip-dev;docker-php-ext-configure gd --with-freetype --with-jpeg; docker-php-ext-install gd pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .
RUN composer install --optimize-autoloader --no-dev
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
