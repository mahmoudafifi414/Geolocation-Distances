FROM php:8.2.0-fpm

WORKDIR /var/www

ADD . /var/www

CMD ["php-fpm"]