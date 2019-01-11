FROM php:7-apache

RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Virtual host
COPY .docker/config/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /app