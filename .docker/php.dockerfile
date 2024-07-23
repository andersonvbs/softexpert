FROM php:8.2-fpm-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN addgroup -g ${GID} --system softexpert
RUN adduser -G softexpert --system -D -s /bin/sh -u ${UID} softexpert

RUN sed -i "s/user = www-data/user = softexpert/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = softexpert/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf


RUN apk add --no-cache \
    oniguruma-dev \
    libpq-dev

RUN docker-php-ext-install pgsql pdo pdo_pgsql mbstring

USER softexpert

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]