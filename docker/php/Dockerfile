FROM php:8.1-fpm

RUN apt-get update
RUN apt-get install -y git
RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libicu-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        unzip \
        libpq-dev \
        --no-install-recommends

RUN docker-php-ext-install pdo_pgsql sockets
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-configure zip \
    && docker-php-ext-install intl mbstring pdo_mysql exif gd pcntl soap bcmath zip sockets

RUN pecl install xdebug ds \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

COPY ./php.ini /usr/local/etc/php/
COPY ./www.conf /usr/local/etc/php/
COPY ./docker-php-ext-ds.ini /usr/local/etc/php/conf.d/

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/*

RUN usermod -u 1000 www-data

RUN curl https://getcomposer.org/composer.phar > /usr/local/bin/composer && chmod a+x /usr/local/bin/composer

EXPOSE 9000
WORKDIR "/app"
CMD ["php-fpm"]
