FROM php:5.6-apache

# Исправляем репозитории Debian Stretch на archive
RUN sed -i 's/deb.debian.org/archive.debian.org/g' /etc/apt/sources.list && \
    sed -i 's|security.debian.org|archive.debian.org|g' /etc/apt/sources.list && \
    sed -i '/stretch-updates/d' /etc/apt/sources.list

# Устанавливаем системные библиотеки и генерируем локаль
RUN apt-get update && apt-get install -y --no-install-recommends --allow-unauthenticated \
    locales \
 && echo "ru_RU.UTF-8 UTF-8" >> /etc/locale.gen \
 && locale-gen ru_RU.UTF-8 \
 && update-locale LANG=ru_RU.UTF-8 \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Устанавливаем переменные окружения для локали
ENV LANG=ru_RU.UTF-8 \
    LANGUAGE=ru_RU:ru \
    LC_ALL=ru_RU.UTF-8

# Устанавливаем расширение MySQLi для PHP
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
