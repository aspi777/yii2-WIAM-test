FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    postgresql-client \
    && docker-php-ext-configure pgsql --with-pgsql=/usr/include/postgresql \
    && docker-php-ext-install pdo_pgsql pgsql \
    && docker-php-ext-install mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -s https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer \
    && chown -R www-data: /var/www/

RUN mkdir -p /var/cache/composer && chmod -R 777 /var/cache/composer

WORKDIR /var/www

ENV PHP_USER_ID=1000
ENV PHP_GROUP_ID=1000

RUN usermod -u $PHP_USER_ID www-data \
    && groupmod -g $PHP_GROUP_ID www-data

USER "${PHP_USER_ID}:${PHP_GROUP_ID}"

EXPOSE 9000

CMD ["php-fpm"]
