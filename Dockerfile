FROM php:7.1.5-fpm

RUN apt-get update -y \
    && apt-get install zip unzip -y \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
    && composer -v

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www/smartfact

COPY composer.json ./
COPY composer.lock ./

RUN mkdir -p \
		var/cache \
		var/logs \
		var/sessions \
	&& composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest \
	&& composer clear-cache \
	&& chown -R www-data var

COPY app app/
COPY bin bin/
COPY src src/
COPY web web/

RUN composer dump-autoload --optimize --classmap-authoritative --no-dev

RUN rm -rf var/cache/*
