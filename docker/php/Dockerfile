FROM php:fpm

ENV WORKDIR "/var/www/smartfact"

RUN apt-get update -y \
    && apt-get install -y \
               libfreetype6-dev \
               libjpeg62-turbo-dev \
               libmcrypt-dev \
               libpng12-dev \
               zip \
               unzip \
               wget \
               curl \
               libcurl4-openssl-dev \
               pkg-config \
               libssl-dev

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY conf/php.ini /usr/local/etc/php/

# Core extensions
RUN pecl install apcu \
                 xdebug \
                 mongodb \
    && docker-php-ext-install pdo_mysql opcache json sockets \
    && docker-php-ext-enable apcu xdebug mongodb.so

# Blackfire (Docker approach)
RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/linux/amd64/$version \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp \
    && mv /tmp/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > $PHP_INI_DIR/conf.d/blackfire.ini

# Blackfire Player
RUN curl -OLsS http://get.blackfire.io/blackfire-player.phar \
    && chmod +x blackfire-player.phar \
    && mv blackfire-player.phar /usr/local/bin/blackfire-player

# Sami (API)
RUN curl -O http://get.sensiolabs.org/sami.phar \
    && mv sami.phar /usr/local/bin/sami

RUN mkdir -p ${WORKDIR}

RUN chown www-data:www-data -R ${WORKDIR}

WORKDIR ${WORKDIR}

EXPOSE 9000

CMD ["php-fpm"]
