FROM php:8.4-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    supervisor \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pcntl zip gd bcmath  \
    && pecl install -o -f redis-6.2.0 swoole \
    && docker-php-ext-enable redis bcmath swoole \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/pear

WORKDIR /var/www/html

COPY .docker/php/limit.ini /usr/local/etc/php/conf.d/limit.ini

# Install Composer dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set permissions
RUN groupadd --gid 1000 appuser \
    && useradd --uid 1000 -g appuser \
        -G www-data,root --shell /bin/bash \
        --create-home appuser

# RUN chown -R www-data:www-data /var/www/html \
#     && chmod -R 755 /var/www/html

RUN mkdir -p /var/lib/nginx/body /run/nginx /var/log/nginx \
    && chown -R appuser:appuser /var/lib/nginx /run /var/log/nginx \
    && chmod -R 755 /var/lib/nginx /run /var/log/nginx

RUN mkdir -p /var/log/supervisord \
    && touch /dev/stdout /dev/stderr /var/log/supervisord/supervisord.log \
    && chown -R appuser:appuser /dev/stdout /dev/stderr /var/log/supervisord/supervisord.log  \
    && chmod -R 755 /dev/stdout /dev/stderr /var/log/supervisord/supervisord.log

USER appuser

# Copy Nginx and Supervisor configs
COPY .docker/nginx/nginx.conf /etc/nginx/sites-available/default
COPY .docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
