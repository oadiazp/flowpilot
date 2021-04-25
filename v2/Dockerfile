FROM php:7.4-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli
COPY apache/vhost /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite
RUN a2enmod actions
