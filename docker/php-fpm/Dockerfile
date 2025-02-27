# Используем официальный образ PHP
FROM php:8.3-fpm

# Устанавливаем системные зависимости и расширения PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    libicu-dev \
    libmcrypt-dev \
    libcurl4-openssl-dev \
    supervisor \
    librdkafka-dev \
    # Настройка и установка расширений PHP
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip xml mysqli pdo pdo_mysql pcntl intl \
    # Установка PECL расширений
    && pecl install redis rdkafka \
    && docker-php-ext-enable redis rdkafka \
    # Очистка кеша для уменьшения размера образа
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Устанавливаем Composer из официального образа
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создаем системного пользователя и группу
RUN groupadd -g 1000 www \
    && useradd -u 1000 -ms /bin/bash -g www www \
    && mkdir -p /var/log/xdebug \
    && chown -R www:www /var/log/xdebug

# Копируем конфигурационные файлы
COPY www.conf /usr/local/etc/php-fpm.d/www.conf
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Устанавливаем зависимости проекта
COPY . /var/www/html

USER www

# Рабочая директория
WORKDIR /var/www/html

VOLUME ["/var/www/html", "/var/run/php-fpm", "/var/log/php"]

EXPOSE 9000

CMD ["php-fpm"]
