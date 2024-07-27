FROM php:8.2-fpm

# Install system dependencies and Composer
RUN apt-get update && \
    apt-get install -y libzip-dev libpq-dev libicu-dev curl unzip && \
    docker-php-ext-configure zip && \
    docker-php-ext-install -j$(nproc) zip pdo_pgsql intl && \
    pecl install redis && docker-php-ext-enable redis && \
    # Install Composer
    curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); exit(1); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    # Install Symfony CLI
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash && \
    apt-get install -y symfony-cli

WORKDIR /app

# Copy composer files and install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-scripts --prefer-dist

# Copy the rest of the application files
COPY . .

# Expose port 8000
EXPOSE 8000

# Start the Symfony server
CMD ["symfony", "server:start", "--no-tls", "--port=8000", "--dir=public"]
