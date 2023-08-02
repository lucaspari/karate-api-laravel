FROM composer
WORKDIR /app
COPY . .
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN composer install
CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181
