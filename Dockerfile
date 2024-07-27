FROM php:8.2-fpm

RUN apt-get update && apt-get install -y libzip-dev libpq-dev libicu-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) zip pdo_pgsql intl \
    && pecl install redis && docker-php-ext-enable redis

RUN  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN   php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN  php composer-setup.php
RUN  php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
    && apt-get install -y symfony-clia

WORKDIR /app/

# Copy composer files and install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-scripts --prefer-dist

# Copy the rest of the application files
COPY . .

# Expose port 8000
EXPOSE 8000

# Start the Symfony server
CMD ["symfony", "server:start", "--no-tls", "--port=8000", "--dir=public"]