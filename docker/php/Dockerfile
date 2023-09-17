FROM php:8.2-fpm

USER root

WORKDIR /var/www/html

RUN docker-php-ext-install \
    pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER www-data

EXPOSE 9000
CMD ["php-fpm"]

RUN composer install
RUN php bin/console doctrine:migrations:migrate
RUN php bin/console doctrine:fixtures:load
RUN php bin/console lexik:jwt:generate-keypair
