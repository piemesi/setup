FROM php:7.1-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && \
    apt-get install -y git zip

WORKDIR /var/www/html

COPY ./src /var/www/html

RUN composer install --optimize-autoloader --no-scripts
RUN chown www-data:www-data ./ -R

#ONBUILD RUN php ./bin/console cache:clear --env=prod --no-debug --no-warmup
#ONBUILD RUN php ./bin/console cache:warmup --env=prod

CMD ["php-fpm"]
