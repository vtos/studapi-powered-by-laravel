FROM php:7.4.22-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

WORKDIR /var/www/html/studapi

COPY ./ ./

RUN apt-get update \
    && apt-get -y install git \
    && chmod +x /usr/local/bin/install-php-extensions \
    && sync \
    && install-php-extensions mongodb \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && chown -R www-data /var/www/html/studapi/storage
