# 최신 안정화 버전 (LTS 호환)
FROM php:8.3-fpm

# 시스템 패키지 설치 (git, zip 등 필수 유틸리티)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# PHP 필수 확장 모듈 설치 (MySQL 연동, BCMath 등)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer 설치 (Laravel 필수)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 작업 디렉토리 설정
WORKDIR /var/www/html