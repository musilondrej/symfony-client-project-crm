# syntax=docker/dockerfile:1.7
FROM php:8.3-fpm-alpine

# Install system deps
RUN apk add --no-cache \
    bash \
    fcgi \
    icu-dev \
    libpq-dev \
    oniguruma-dev \
    libzip-dev \
    git \
    unzip

# PHP extensions
RUN docker-php-ext-configure intl \
 && docker-php-ext-install -j"$(nproc)" \
    intl pdo pdo_pgsql opcache zip

# Composer
ENV COMPOSER_HOME=/tmp/composer \
    COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# PHP dev settings (build context is project root)
COPY docker/php/php.dev.ini $PHP_INI_DIR/conf.d/99-dev.ini

# Workdir
WORKDIR /srv/app

# Default user for dev (optional)
# RUN addgroup -g 1000 app && adduser -D -G app -u 1000 app
# USER app

# Healthcheck: php-fpm ping
HEALTHCHECK --interval=10s --timeout=3s --start-period=10s --retries=3 CMD SCRIPT_NAME=/ping SCRIPT_FILENAME=/ping REQUEST_METHOD=GET cgi-fcgi -bind -connect 127.0.0.1:9000 || exit 1

CMD ["php-fpm", "-F"]
