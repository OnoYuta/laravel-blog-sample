FROM utayuta/docker-laravel-alpine:latest

WORKDIR /app

COPY . /app

RUN set -x \
    && php artisan cache:clear \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && chmod -R ug+rwx storage bootstrap/cache \
    && chgrp -R www-data storage bootstrap/cache