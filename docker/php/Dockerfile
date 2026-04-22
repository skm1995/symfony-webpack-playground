FROM php:8.5-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    curl \
    && curl -sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
    && apt-get install -y symfony-cli \
    && docker-php-ext-install zip pdo pdo_mysql bcmath

# Install Xdebug
RUN pecl install xdebug-3.5.1 && docker-php-ext-enable xdebug

# Install redis
RUN pecl install redis && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD ["symfony", "server:start", "--allow-all-ip"]
