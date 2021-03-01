FROM php:7.3-apache

EXPOSE 80

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y

RUN apt-get -y install apt-utils nano wget dialog \
    build-essential git curl libcurl3-dev zip
    
RUN apt-get install -y \
    zlib1g-dev \
    libzip-dev

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# PHP Extensions
RUN apt install -y libxml2-dev \
    && docker-php-ext-install soap \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install curl \
    && docker-php-ext-install tokenizer \
    && docker-php-ext-install json \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install openssl
    
## IMAP para configuracoes de email
RUN apt install -y libc-client-dev libkrb5-dev && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap
RUN apache2ctl graceful

## Configuracao EXT Zzip
RUN docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

# Enable apache modules
RUN a2enmod rewrite headers

# # Add user for laravel application
# RUN groupadd -g 1000 www
# RUN useradd -u 1000 -ms /bin/bash -g www www

# # Copy existing application directory contents
# COPY . /var/www

# # Copy existing application directory permissions
# COPY src /var/www/
RUN chown -R www-data:www-data /var/www

# # Change current user to www
# USER www
