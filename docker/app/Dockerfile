FROM php:7.2

# Install PHP modules
RUN apt-get update \
  && apt-get install -y --force-yes libsqlite3-dev git zlib1g-dev bzip2 unzip libzip-dev \
  && pecl channel-update pecl.php.net \
  && pecl install xdebug zip \
  && docker-php-ext-install -j$(nproc) pdo_mysql zip \
  && docker-php-ext-enable xdebug

# set timezone to UTC
RUN echo "date.timezone = UTC" > /usr/local/etc/php/conf.d/date.timezone.ini

# install composer
RUN apt-get install --yes wget
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
RUN chmod +x /usr/local/bin/composer

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /app

CMD ["/app/run.sh"]
