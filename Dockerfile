FROM utayuta/docker-laravel-alpine:latest

WORKDIR /app

COPY . /app

RUN set -x \
    && chmod -R ug+rwx storage bootstrap/cache \
    && chgrp -R www-data storage bootstrap/cache