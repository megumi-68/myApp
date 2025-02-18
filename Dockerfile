# PHP
FROM php:8.2-fpm

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    zip unzip git curl nodejs npm libpq-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql gd

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリを設定
WORKDIR /var/www

# Laravelのファイルをコピー
COPY . .

# パーミッションの設定
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
