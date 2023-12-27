FROM php:8.2.1-fpm

RUN apt-get update && apt-get --assume-yes  install git unzip openssl procps acl zlib1g-dev
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install extensions
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath zip
RUN pecl install xdebug && docker-php-ext-enable xdebug
# Create an alias for Symfony console
RUN echo 'alias symfony="php bin/console"' >> ~/.bashrc

WORKDIR /var/www/app