FROM php:8.2-apache
WORKDIR /var/www/html/final
EXPOSE 80
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli