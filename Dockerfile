FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite

WORKDIR /var/www

CMD ["php-fpm"]