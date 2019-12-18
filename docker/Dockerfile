FROM php:7.3-apache-stretch

COPY . /var/www/html
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/start.sh /usr/local/bin/start

RUN chown -R www-data:www-data /var/www/html \
    && chmod u+x /usr/local/bin/start \
    && a2enmod rewrite

RUN apt-get update \
    && apt-get install -y libpq-dev libzip-dev zlib1g-dev libpng-dev libjpeg-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-install zip \
    && docker-php-ext-install gd \
    && docker-php-ext-install exif
RUN chmod -R 775 storage

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#CMD ["/usr/local/bin/start"]
