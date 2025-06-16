
FROM php:7.4.9-fpm

# php.ini
COPY docker/php/php.ini /usr/local/etc/php/

# 必要なパッケージ（nginx含む）
RUN apt update && apt install -y \
    nginx \
    default-mysql-client \
    zlib1g-dev \
    libzip-dev \
    unzip \
    supervisor && \
    docker-php-ext-install pdo_mysql zip

# Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    composer self-update

# アプリ配置
WORKDIR /var/www
COPY src/ /var/www

# Composer install
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# nginx設定
COPY docker/nginx/default.conf /etc/nginx/sites-available/default

# Supervisor設定（nginx + php-fpm 同時起動用）
COPY docker/php/supervisord.conf /etc/supervisord.conf

# ポート開放（Renderが自動的に PORT を渡す）
EXPOSE 80

# Supervisor起動
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
