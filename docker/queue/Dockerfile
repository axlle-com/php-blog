FROM php:8.2-cli

# Install php extentions and composer
RUN apt-get update && apt-get install -y git zip libzip-dev unzip mc nano
RUN pecl install redis
RUN docker-php-ext-enable redis
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath zip
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add user
RUN getent group www || groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

USER www

WORKDIR /var/www

VOLUME ["/var/www", "/var/log/php"]

CMD ["php", "artisan", "queue:work"]
