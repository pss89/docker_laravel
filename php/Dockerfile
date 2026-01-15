# 최신 안정화 버전 (LTS 호환)
FROM php:8.3-fpm

# 1. 필수 패키지 설치
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libzip-dev

# 2. PHP 확장 모듈 설치
RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd opcache intl zip

# Composer 설치 (Laravel 필수)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 작업 디렉토리 설정
WORKDIR /var/www/html