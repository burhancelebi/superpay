FROM php:8.5-fpm

WORKDIR /var/www/html

# Önce sistem paketlerini güncelle ve temel bağımlılıkları kur
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev \
    libsodium-dev \
    supervisor \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libxpm-dev

# GD extension için gerekli kütüphaneleri kur ve configure et
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm

RUN docker-php-ext-install exif
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd

# Composer'ı kur
RUN curl -s https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer about

# Debug için PHP modüllerini listele
RUN php -m && echo "============================================="

# Uygulama dosyalarını EN SON kopyala (cache için daha iyi)
COPY . /var/www/html

# İzinleri ayarla
RUN chmod -R 775 /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY docker/supervisor/conf.d /etc/supervisor/conf.d

# Expose port 8002 and start php-fpm server
EXPOSE 8002
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
