FROM php:8.1-fpm
RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
  && docker-php-ext-install intl opcache pdo pdo_mysql \
  && pecl install apcu \
  && docker-php-ext-enable apcu \
  && docker-php-ext-configure zip \
  && docker-php-ext-install zip \
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions xdebug
ENV PHP_IDE_CONFIG 'serverNeme=localhost'
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host=10.202.32.32" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.log = /var/log/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey = PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY --from=composer/composer:latest /usr/bin/composer /usr/bin/composer
RUN composer global require phpmd/phpmd
ENV PATH="/usr/bin/phpmd.phar:${PATH}"
WORKDIR /var/www/project
RUN docker-php-ext-install pdo pdo_mysql

