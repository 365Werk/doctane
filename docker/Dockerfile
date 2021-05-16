FROM php:8.0-cli-alpine3.13

# PHP: Copy configuration files & remove dist files
RUN mkdir /phpIni
COPY files/bin/ /usr/local/bin/
COPY files/php/ /phpIni



# SYS: Install required packages
RUN apk --no-cache upgrade && \
    apk --no-cache add bash git sudo openssh  libxml2-dev postgresql-dev oniguruma-dev autoconf gcc g++ make npm freetype-dev libjpeg-turbo-dev libpng-dev libzip-dev

RUN apk add librdkafka librdkafka-dev \
        --update-cache --repository http://dl-3.alpinelinux.org/alpine/edge/community



# COMPOSER: install binary and prestissimo
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# PHP: Install php extensions
RUN pecl channel-update pecl.php.net
RUN pecl install rdkafka pcov swoole
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install mbstring xml iconv pcntl gd zip sockets pdo pdo_pgsql pdo_mysql bcmath
RUN docker-php-ext-enable mbstring xml rdkafka gd iconv zip swoole pcov pcntl sockets bcmath pdo pdo_pgsql pdo_mysql

# fix work iconv library with alphine
RUN apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ --allow-untrusted gnu-libiconv
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

WORKDIR /home/application


CMD [ "php", "artisan", "octane:start", "--host=0.0.0.0"]

EXPOSE 8666


